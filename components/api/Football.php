<?php
namespace app\components\api;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use \app\models\Competition;
use \app\models\Team;

class Football extends Component
{
    static $uri = 'http://football-api.com/api/';
    static $apiKey = '510392b5-0578-b5e4-9ace1978dfa2';

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
        if ($competitions && $competitions->Competition) {
            // The competitions variable is valid. Cycle through it, updating and adding new competitions.
            foreach ($competitions->Competition as $c) {
                // Check if the competition exists already.
                $competition = Competition::find()->where(['api_id' => $c->id])->one();

                if (!$competition){
                    $competition = new Competition;
                    $competition->created = time();
                }

                // Now assign properties to the competition object.
                $competition->attributes = array(
                    'api_id' => $c->id,
                    'name' => $c->name,
                    'region' => $c->region,
                    'last_updated' => time(),
                );

                $competition->save();
            }
        } else {
            return null;
        }
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
            if ($standings && $standings->teams) {
                // The standings are valid, cycle through the teams.
                foreach ($standings->teams as $t) {
                    // Try and find a pre-existing team.
                    $team = Team::find()->where(['team_id' => $t->stand_team_id])->one();

                    // Check if the team exists.
                    if (!$team) {
                        // If not, create a new one.
                        $team = new Team;
                        $team->created = time();
                    }

                    // Assign all the remaining attributes.
                    $team->attributes = array(
                        'team_id' => $t->stand_team_id,
                        'competition' => $competition,
                        'name' => $t->stand_team_name,
                        'status' => $t->stand_status,
                        'form' => $t->stand_recent_form,
                        'position' => $t->stand_position,
                        'overall_gp' => $t->stand_overall_gp,
                        'overall_w' => $t->stand_overall_w,
                        'overall_d' => $t->stand_overall_d,
                        'overall_l' => $t->stand_overall_l,
                        'overall_gs' => $t->stand_overall_gs,
                        'overall_ga' => $t->stand_overall_ga,
                        'home_gp' => $t->stand_home_gp,
                        'home_w' => $t->stand_home_w,
                        'home_d' => $t->stand_home_d,
                        'home_l' => $t->stand_home_l,
                        'home_gs' => $t->stand_home_gs,
                        'home_ga' => $t->stand_home_ga,
                        'away_gp' => $t->stand_away_gp,
                        'away_w' => $t->stand_away_w,
                        'away_d' => $t->stand_away_d,
                        'away_l' => $t->stand_away_l,
                        'away_gs' => $t->stand_away_gs,
                        'away_ga' => $t->stand_away_ga,
                        'gd' => $t->stand_gd,
                        'points' => $t->stand_points,
                        'last_updated' => time(),
                    );

                    // Save the team.
                    $team->save();
                }
            }
        }
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

            if ($matches) {
                foreach ($matches as $match) {
                    // Use http://football-api.com/documentation/ to complete this from the sample.
                }
            }
        }
    }
}