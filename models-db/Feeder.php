<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feeder".
 *
 * @property int $id
 * @property string $name
 * @property string $size
 * @property int $direction_id
 * @property int $table_machine_id
 * @property int $machine_id
 * @property int $Line_id
 * @property int $feeder_point_id
 * @property string $barcode_feeder
 *
 * @property Line $line
 * @property Direction $direction
 * @property FeederPoint $feederPoint
 * @property Machine $machine
 * @property TableMachine $tableMachine
 * @property Program[] $programs
 * @property ProgramItem[] $programItems
 * @property StartDetail[] $startDetail
 */
class Feeder extends \yii\db\ActiveRecord
{
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feeder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'direction_id', 'table_machine_id', 'machine_id', 'Line_id', 'feeder_point_id'], 'required'],
            [['direction_id', 'table_machine_id', 'machine_id', 'Line_id', 'feeder_point_id'], 'integer'],
            [['name', 'size','barcode_feeder'], 'string', 'max' => 45],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['Line_id' => 'id']],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
            [['feeder_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => FeederPoint::className(), 'targetAttribute' => ['feeder_point_id' => 'id']],
            [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::className(), 'targetAttribute' => ['machine_id' => 'id']],
            [['table_machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => TableMachine::className(), 'targetAttribute' => ['table_machine_id' => 'id']],
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
            'size' => 'Size',
            'direction_id' => 'Direction',
            'table_machine_id' => 'Table Machine',
            'machine_id' => 'Machine',
            'Line_id' => 'Line',
            'feeder_point_id' => 'Feeder Point',
            'barcode_feeder'=>'barcode_feeder',
        ];
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
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeederPoint()
    {
        return $this->hasOne(FeederPoint::className(), ['id' => 'feeder_point_id']);
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
    public function getTableMachine()
    {
        return $this->hasOne(TableMachine::className(), ['id' => 'table_machine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Program::className(), ['feeder_id' => 'id']);
    }
    
    public function getStartDetail()
    {
        return $this->hasMany(StartDetail::className(), ['feeder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramItems()
    {
        return $this->hasMany(ProgramItem::className(), ['feeder_id' => 'id']);
    }
}
