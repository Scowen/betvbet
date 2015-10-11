<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property integer $severity
 * @property string $type
 * @property integer $user
 * @property string $ip
 * @property string $page
 * @property string $message
 * @property integer $created
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['severity', 'user', 'created'], 'integer'],
            [['message'], 'string'],
            [['created'], 'required'],
            [['type', 'ip', 'page'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'severity' => 'Severity',
            'type' => 'Type',
            'user' => 'User',
            'ip' => 'Ip',
            'page' => 'Page',
            'message' => 'Message',
            'created' => 'Created',
        ];
    }
}
