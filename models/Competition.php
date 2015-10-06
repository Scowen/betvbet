<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "competition".
 *
 * @property integer $id
 * @property integer $api_id
 * @property string $name
 * @property string $region
 * @property integer $last_updated
 * @property integer $created
 */
class Competition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_id', 'name', 'region', 'last_updated', 'created'], 'required'],
            [['api_id', 'last_updated', 'created'], 'integer'],
            [['name', 'region'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'api_id' => 'Api ID',
            'name' => 'Name',
            'region' => 'Region',
            'last_updated' => 'Last Updated',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['competition' => 'api_id'])->orderBy(['position' => SORT_ASC]);
    }
}
