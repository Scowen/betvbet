<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property integer $team_id
 * @property integer $competition
 * @property string $name
 * @property string $logo
 * @property string $status
 * @property string $form
 * @property integer $position
 * @property integer $overall_gp
 * @property integer $overall_w
 * @property integer $overall_d
 * @property integer $overall_l
 * @property integer $overall_gs
 * @property integer $overall_ga
 * @property integer $home_w
 * @property integer $home_d
 * @property integer $home_l
 * @property integer $home_gs
 * @property integer $home_ga
 * @property integer $away_gp
 * @property integer $away_w
 * @property integer $away_d
 * @property integer $away_l
 * @property integer $away_gs
 * @property integer $away_ga
 * @property integer $gd
 * @property integer $points
 * @property integer $last_updated
 * @property integer $created
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'competition', 'name', 'last_updated', 'created'], 'required'],
            [['team_id', 'competition', 'position', 'overall_gp', 'overall_w', 'overall_d', 'overall_l', 'overall_gs', 'overall_ga', 'home_w', 'home_d', 'home_l', 'home_gs', 'home_ga', 'away_gp', 'away_w', 'away_d', 'away_l', 'away_gs', 'away_ga', 'gd', 'points', 'last_updated', 'created'], 'integer'],
            [['logo'], 'string'],
            [['name', 'status', 'form'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'competition' => 'Competition',
            'name' => 'Name',
            'logo' => 'Logo',
            'status' => 'Status',
            'form' => 'Form',
            'position' => 'Position',
            'overall_gp' => 'Overall Gp',
            'overall_w' => 'Overall W',
            'overall_d' => 'Overall D',
            'overall_l' => 'Overall L',
            'overall_gs' => 'Overall Gs',
            'overall_ga' => 'Overall Ga',
            'home_w' => 'Home W',
            'home_d' => 'Home D',
            'home_l' => 'Home L',
            'home_gs' => 'Home Gs',
            'home_ga' => 'Home Ga',
            'away_gp' => 'Away Gp',
            'away_w' => 'Away W',
            'away_d' => 'Away D',
            'away_l' => 'Away L',
            'away_gs' => 'Away Gs',
            'away_ga' => 'Away Ga',
            'gd' => 'Gd',
            'points' => 'Points',
            'last_updated' => 'Last Updated',
            'created' => 'Created',
        ];
    }
}
