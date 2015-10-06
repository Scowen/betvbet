<?php
namespace app\components\api;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Football extends Component
{
	static $url = "http://football-api.com/api/";
	static $apiKey = "510392b5-0578-b5e4-9ace1978dfa2";

	public static function request($action, $params = null) {
		$url = self::$url . "?Action=$action&APIKey=" . self::$apiKey;
		if ($params)
			foreach ($params as $key => $value)
				$url .= "&$key=$value";
		
		$result = file_get_contents($url);
		$result = json_decode($result);

		return $result;
	}

	public static function competitions() {
		// Get the available competitions.
		$competitions = self::request("competitions");

		// Check if the result is valid.
		if ($competitions && $competitions->Competition) {
			// The competitions variable is valid. Cycle through it, updating and adding new competitions.
			foreach ($competitions->Competition as $c) {
				// Check if the competition exists already.
				$competition = \app\models\Competition::find()->where(['api_id' => $c->id])->one();

				if (!$competition){
					$competition = new \app\models\Competition;
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

	public static function standings($competition = 1204) { // For now, just PL (1204)
		$standings = self::request("standings", array('comp_id' => $competition));

		// Check if the result is valid.
		if ($standings && $standings->teams) {
			// The standings are valid, cycle through the teams.
			foreach ($standings->teams as $t) {
				// Try and find a pre-existing team.
				$team = \app\models\Team::find()->where(['team_id' => $t->stand_team_id])->one();

				// Check if the team exists.
				if (!$team) {
					// If not, create a new one.
					$team = new \app\models\Team;
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