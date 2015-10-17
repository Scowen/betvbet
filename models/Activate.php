<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activate".
 *
 * @property integer $id
 * @property integer $user
 * @property string $code
 * @property integer $expires
 * @property integer $created
 */
class Activate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'code', 'expires', 'created'], 'required'],
            [['user', 'expires', 'created'], 'integer'],
            [['code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'code' => 'Code',
            'expires' => 'Expires',
            'created' => 'Created',
        ];
    }
}
