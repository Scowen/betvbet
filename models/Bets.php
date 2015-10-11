<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bets".
 *
 * @property integer $id
 * @property integer $bet_slip
 * @property integer $user
 * @property integer $selection
 * @property integer $last_updated
 * @property integer $created
 */
class Bets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bet_slip', 'user', 'selection', 'last_updated', 'created'], 'integer'],
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
            'bet_slip' => 'Bet Slip',
            'user' => 'User',
            'selection' => 'Selection',
            'last_updated' => 'Last Updated',
            'created' => 'Created',
        ];
    }
}
