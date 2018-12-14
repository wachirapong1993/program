<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property string $name
 *
 * @property Feeder[] $feeders
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeders()
    {
        return $this->hasMany(Feeder::className(), ['direction_id' => 'id']);
    }
}
