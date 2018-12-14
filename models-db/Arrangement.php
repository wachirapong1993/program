<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "arrangement".
 *
 * @property int $id
 * @property int $pcb_id
 * @property int $program_detail_id
 * @property string $created_date
 * @property string $solder_paste
 * @property int $rev
 * @property int $Line_id
 * @property int $machine_id
 * @property int $table_machine_id
 *
 * @property Line $line
 * @property Machine $machine
 * @property Pcb $pcb
 * @property ProgramDetail $programDetail
 * @property TableMachine $tableMachine
 * @property ArrangementDetail[] $arrangementDetails
 */
class Arrangement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arrangement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pcb_id', 'program_detail_id', 'solder_paste', 'rev', 'Line_id', 'machine_id', 'table_machine_id'], 'required'],
            [['pcb_id', 'program_detail_id', 'rev', 'Line_id', 'machine_id', 'table_machine_id'], 'integer'],
            [['created_date'], 'string', 'max' => 45],
            [['solder_paste'], 'string', 'max' => 255],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['Line_id' => 'id']],
            [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::className(), 'targetAttribute' => ['machine_id' => 'id']],
            [['pcb_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pcb::className(), 'targetAttribute' => ['pcb_id' => 'id']],
            [['program_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramDetail::className(), 'targetAttribute' => ['program_detail_id' => 'id']],
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
            'pcb_id' => 'Pcb',
            'program_detail_id' => 'Program Detail',
            'created_date' => 'Created Date',
            'solder_paste' => 'Solder Paste',
            'rev' => 'Rev',
            'Line_id' => 'Line',
            'machine_id' => 'Machine',
            'table_machine_id' => 'Table Machine',
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
    public function getMachine()
    {
        return $this->hasOne(Machine::className(), ['id' => 'machine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcb()
    {
        return $this->hasOne(Pcb::className(), ['id' => 'pcb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetail()
    {
        return $this->hasOne(ProgramDetail::className(), ['id' => 'program_detail_id']);
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
    public function getArrangementDetails()
    {
        return $this->hasMany(ArrangementDetail::className(), ['arrangement_id' => 'id']);
    }
}
