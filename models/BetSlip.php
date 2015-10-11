<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet_slip".
 *
 * @property integer $id
 * @property double $amount
 * @property integer $football_match
 * @property integer $horse_race
 * @property integer $last_updated
 * @property integer $created
 */
class BetSlip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bet_slip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['football_match', 'horse_race', 'last_updated', 'created'], 'integer'],
            [['last_updated', 'created'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'football_match' => 'Football Match',
            'horse_race' => 'Horse Race',
            'last_updated' => 'Last Updated',
            'created' => 'Created',
        ];
    }
}
