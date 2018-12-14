<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program".
 *
 * @property int $id
 * @property string $name
 * @property int $pcb_id
 * @property string $rev
 * @property int $program_status_id
 * @property int $models_p_id
 * @property int $machine_id
 *
 * @property ModelsP $modelsP
 * @property Machine $machine
 * @property Pcb $pcb
 * @property ProgramStatus $programStatus
 * @property ProgramDetail[] $programDetails
 */
class Program extends \yii\db\ActiveRecord
{
    public $customer_id;
    public $models;
    public $mainprogram;
   
    public $table;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'pcb_id', 'rev', 'models_p_id','machine_id'], 'required'],
            [['pcb_id', 'program_status_id', 'models_p_id','machine_id','table'], 'integer'],
            [['name', 'rev'], 'string', 'max' => 45],
            [['models_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsP::className(), 'targetAttribute' => ['models_p_id' => 'id']],
                [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::className(), 'targetAttribute' => ['machine_id' => 'id']],
            [['pcb_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pcb::className(), 'targetAttribute' => ['pcb_id' => 'id']],
            [['program_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStatus::className(), 'targetAttribute' => ['program_status_id' => 'id']],
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
            'pcb_id' => 'Pcb ID',
            'rev' => 'Rev',
            'program_status_id' => 'Program Status ID',
            'models_p_id' => 'Models P ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelsP()
    {
        return $this->hasOne(ModelsP::className(), ['id' => 'models_p_id']);
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
    public function getProgramStatus()
    {
        return $this->hasOne(ProgramStatus::className(), ['id' => 'program_status_id']);
    }
    
     public function getMachine()
    {
        return $this->hasOne(ProgramStatus::className(), ['id' => 'machine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetails()
    {
        return $this->hasMany(ProgramDetail::className(), ['program_id' => 'id']);
    }
}
