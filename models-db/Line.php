<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "line".
 *
 * @property int $id
 * @property string $name
 *
 * @property Feeder[] $feeders
 * @property Machine[] $machines
 * @property TableMachine[] $tableMachines
 */
class Line extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'line';
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
        return $this->hasMany(Feeder::className(), ['Line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasMany(Machine::className(), ['Line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableMachines()
    {
        return $this->hasMany(TableMachine::className(), ['Line_id' => 'id']);
    }
}
