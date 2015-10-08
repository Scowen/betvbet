<?php
namespace app\components\api;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use \app\models\Competition;
use \app\models\Team;
use \app\models\Match;

class Football extends Component
    static $uri = 'http://football-api.com/api/';
{
    // static $apiKey = '510392b5-0578-b5e4-9ace1978dfa2 // Luke.
    static $apiKey = 'c8e1e1e1-6e70-9bcf-ccdde1e9c3cd'; // Steven.

    public static function request($action, $params = array()) {
        $params['Action'] = $action;
        $params['APIKey'] = self::$apiKey;

        // Create the Guzzle Client request.
        $client = new Client();
        $response = $client->request('GET', self::$uri, [
            'query' => $params
        ]);
        // Get the JSON data back from the response.
        $json = json_decode($response->getBody());
        // Finally, return the data.
        return $json;
    }

    public static function competitions() {
        // Get the available competitions.
        $competitions = self::request("competitions");

        // Check if the result is valid.
        if ($competitions && isset($competitions->Competition) && $competitions->Competition) {
            // The competitions variable is valid. Cycle through it, updating and adding new competitions.
            foreach ($competitions->Competition as $c) {
                $competition = self::getCompetition($c);

                $competition->save();
            }
        } else {
            return null;
        }
    }

    private static function getCompetition($json) {
        // Check if the competition exists already.
        $competition = Competition::find()->where(['api_id' => $json->id])->one();

        if (!$competition){
            $competition = new Competition;
            $competition->created = time();
        }

        // Now assign properties to the competition object.
        $competition->attributes = array(
            'api_id' => $json->id,
            'name' => $json->name,
            'region' => $json->region,
            'last_updated' => time(),
        );

        return $competition;
    }

    public static function standings($competition = null) { // If it's null, get all compeition standings.
        // Get all the competitions.
        $competitions = Competition::find()->all();

        // However, if a competition was given, only use that.
        if ($competition) {
            $competitions = array();
            $competitions[] = Competition::find()->where(['api_id' => $competition])->one();
        }

        // Now loop through the competitions and grab the live matches.
        foreach ($competitions as $c) {
            $standings = self::request("standings", ['comp_id' => $c->api_id]);

            // Check if the result is valid.
            if ($standings && isset($standings->teams) && $standings->teams) {
                // The standings are valid, cycle through the teams.
                foreach ($standings->teams as $t) {
                    $team = self::getTeam($t);

                    // Save the team.
                    $team->save();
                }
            }
        }
    }

    private static function getTeam($json) {
        // Try and find a pre-existing team.
        $team = Team::find()->where(['team_id' => $json->stand_team_id])->one();

        // Check if the team exists.
        if (!$team) {
            // If not, create a new one.
            $team = new Team;
            $team->created = time();
        }

        // Assign all the remaining attributes.
        $team->attributes = array(
            'team_id' => $json->stand_team_id,
            'competition' => $json->stand_competition_id,
            'name' => $json->stand_team_name,
            'status' => $json->stand_status,
            'form' => $json->stand_recent_form,
            'position' => $json->stand_position,
            'overall_gp' => $json->stand_overall_gp,
            'overall_w' => $json->stand_overall_w,
            'overall_d' => $json->stand_overall_d,
            'overall_l' => $json->stand_overall_l,
            'overall_gs' => $json->stand_overall_gs,
            'overall_ga' => $json->stand_overall_ga,
            'home_gp' => $json->stand_home_gp,
            'home_w' => $json->stand_home_w,
            'home_d' => $json->stand_home_d,
            'home_l' => $json->stand_home_l,
            'home_gs' => $json->stand_home_gs,
            'home_ga' => $json->stand_home_ga,
            'away_gp' => $json->stand_away_gp,
            'away_w' => $json->stand_away_w,
            'away_d' => $json->stand_away_d,
            'away_l' => $json->stand_away_l,
            'away_gs' => $json->stand_away_gs,
            'away_ga' => $json->stand_away_ga,
            'gd' => $json->stand_gd,
            'points' => $json->stand_points,
            'last_updated' => time(),
        );

        return $team;
    }

    public static function live($competition = null) {
        // Get all the competitions.
        $competitions = Competition::find()->all();

        // However, if a competition was given, only use that.
        if ($competition) {
            $competitions = array();
            $competitions[] = Competition::find()->where(['api_id' => $competition])->one();
        }

        // Now loop through the competitions and grab the live matches.
        foreach ($competitions as $c) {
            $matches = self::request("today", ['comp_id' => $c->api_id]);

            if ($matches && isset($matches->match) && $matches->match) {
                foreach ($matches as $m) {
                    // Try and find a pre-existing match.
                    $match = self::getMatch($m);
                    $match->save();
                }
            }
        }
    }

    public static function matches($competition = null, $date = null) {
        // Get all the competitions.
        $competitions = Competition::find()->all();

        // However, if a competition was given, only use that.
        if ($competition) {
            $competitions = array();
            $competitions[] = Competition::find()->where(['api_id' => $competition])->one();
        }

        // Now loop through the competitions and grab the live matches.
        foreach ($competitions as $c) {
            $matches = self::request("fixtures", [
                'comp_id' => $c->api_id,
                'match_date' => date("d.m.Y", ($date) ?: time()),
            ]);

            if ($matches && isset($matches->match) && $matches->match) {
                foreach ($matches as $m) {
                    // Try and find a pre-existing match.
                    $match = self::getMatch($m);
                    $match->save();
                }
            }
        }
    }

    public static function fixtures($competition = null, $from, $to) {
        // Get all the competitions.
        $competitions = Competition::find()->all();

        // However, if a competition was given, only use that.
        if ($competition) {
            $competitions = array();
            $competitions[] = Competition::find()->where(['api_id' => $competition])->one();
        }


        // Now loop through the competitions and grab the live matches.
        foreach ($competitions as $c) {
            $matches = self::request("fixtures", [
                'comp_id' => $c->api_id,
                'from_date' => date("d.m.Y", $from),
                'to_date' => date("d.m.Y", $to),
            ]);

            if ($matches && isset($matches->match) && $matches->match) {
                foreach ($matches as $m) {
                    // Try and find a pre-existing match.
                    $match = self::getMatch($m);
                    $match->save();
                }
            }
        }
    }

    private static function getMatch($json) {
        // Try and find a pre-existing match.
        $match = Match::find()->where(['match_id' => $json->match_id])->one();

        // Check if the match exists.
        if (!$match) {
            // If not, create a new one.
            $match = new Match;
            $match->created = time();
        }

        // As the match may in progress, we want to know if it's completed, and if this is the first tiem we have come
        // across the match being completed. This is to decide who wins their bets.
        if ($match && isset($match->status) && $match->status && $match->status != "FT" && $json->status == "FT")
            self::matchCompleted($match);

        // Assign all the remaining attributes.
        $match->attributes = array(
            'match_id' => $json->match_id,
            'comp_id' => $json->match_comp_id,
            'match_date' => strtotime($json->match_formatted_date . " " . $json->match_time),
            'status' => $json->match_status,
            'home_team_id' => $json->match_localteam_id,
            'home_score' => $json->match_localteam_score,
            'away_team_id' => $json->match_visitorteam_id,
            'away_score' => $json->match_visitorteam_score,
            'halftime_score' => $json->match_ht_score,
            'last_updated' => time(),
        );

        return $match;
    }

    private static function matchCompleted($match) {
        if (!$match)
            return false;

        // TODO: Get all bets related to this match and pay them off.
    }
}
