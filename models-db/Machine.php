<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property int $id
 * @property string $name
 * @property int $Line_id
 *
 * @property Feeder[] $feeders
 * @property Line $line
 * @property TableMachine[] $tableMachines
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'Line_id'], 'required'],
            [['Line_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['Line_id' => 'id']],
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
            'Line_id' => 'Line ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeders()
    {
        return $this->hasMany(Feeder::className(), ['machine_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLine()
    {
        return $this->hasOne(Line::className(), ['id' => 'Line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableMachines()
    {
        return $this->hasMany(TableMachine::className(), ['machine_id' => 'id']);
    }
}
