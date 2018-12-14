<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "table_machine".
 *
 * @property int $id
 * @property string $name
 * @property int $machine_id
 * @property int $Line_id
 * @property int $table_id
 *
 * @property Feeder[] $feeders
 * @property ProgramDetail[] $programDetails
 * @property Line $line
 * @property Machine $machine
 * @property Tables $table
 */
class TableMachine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table_machine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'machine_id', 'Line_id', 'table_id'], 'required'],
            [['machine_id', 'Line_id', 'table_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['Line_id' => 'id']],
            [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::className(), 'targetAttribute' => ['machine_id' => 'id']],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::className(), 'targetAttribute' => ['table_id' => 'id']],
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
            'machine_id' => 'Machine ID',
            'Line_id' => 'Line ID',
            'table_id' => 'Table ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeders()
    {
        return $this->hasMany(Feeder::className(), ['table_machine_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetails()
    {
        return $this->hasMany(ProgramDetail::className(), ['table_machine_id' => 'id']);
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
    public function getMachine()
    {
        return $this->hasOne(Machine::className(), ['id' => 'machine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Tables::className(), ['id' => 'table_id']);
    }
}
