<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program_detail".
 *
 * @property int $id
 * @property string $title
 * @property string $barcode
 * @property int $program_id
 * @property string $solder_paste
 * @property int $table_machine_id
 *
 * @property Program $program
 * @property TableMachine $tableMachine
 * @property ProgramItem[] $programItems
 * @property ProgramItem $programItem
 * @property StartProgram[] $startPrograms
 */
class ProgramDetail extends \yii\db\ActiveRecord
{
   /* public $customer;
    public $models;*/
    public $line;
    public $machine;
    // public $tableMachine;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'program_id', 'solder_paste', 'table_machine_id'], 'required'],
            [['program_id', 'table_machine_id','machine'], 'integer'],
            [['solder_paste'], 'string'],
            [['title', 'barcode'], 'string', 'max' => 45],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
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
            'title' => 'Title',
            'barcode' => 'Barcode',
            'program_id' => 'Program ID',
            'solder_paste' => 'Solder Paste',
            'table_machine_id' => 'Table Machine ID',
            'machine'=>'machine',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
        // ID ของ
    }
    
     public function getProgramItem()
    {
        return $this->hasOne(ProgramItem::className(), ['program_detail_id' => 'id']);
        // ID ของ
    }
//     public function getProgramItem0()
//    {
//        return $this->hasOne(ProgramItem::className(), ['program_detail_id' => 'id']);
//        // ID ของ
//    }

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
    public function getProgramItems()
    {
        return $this->hasMany(ProgramItem::className(), ['program_detail_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartPrograms()
    {
        return $this->hasMany(StartProgram::className(), ['program_detail_id' => 'id']);
    }
}
