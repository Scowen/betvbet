<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "match".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $comp_id
 * @property integer $match_date
 * @property string $status
 * @property integer $home_team_id
 * @property integer $home_score
 * @property integer $away_team_id
 * @property integer $away_score
 * @property string $halftime_score
 * @property integer $last_updated
 * @property integer $created
 */
class Match extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'comp_id', 'match_date', 'home_team_id', 'away_team_id', 'last_updated', 'created'], 'required'],
            [['match_id', 'comp_id', 'match_date', 'home_team_id', 'home_score', 'away_team_id', 'away_score', 'last_updated', 'created'], 'integer'],
            [['status'], 'string', 'max' => 32],
            [['halftime_score'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'match_id' => 'Match ID',
            'comp_id' => 'Comp ID',
            'match_date' => 'Match Date',
            'status' => 'Status',
            'home_team_id' => 'Home Team ID',
            'home_score' => 'Home Score',
            'away_team_id' => 'Away Team ID',
            'away_score' => 'Away Score',
            'halftime_score' => 'Halftime Score',
            'last_updated' => 'Last Updated',
            'created' => 'Created',
        ];
    }
}
