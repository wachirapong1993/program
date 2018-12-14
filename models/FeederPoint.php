<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feeder_point".
 *
 * @property int $id
 *
 * @property Feeder[] $feeders
 */
class FeederPoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feeder_point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeders()
    {
        return $this->hasMany(Feeder::className(), ['feeder_point_id' => 'id']);
    }
}
