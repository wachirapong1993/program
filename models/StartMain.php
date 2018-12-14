<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "start_main".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $Line_id
 * @property int $program_id
 * @property int $models_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by

 *
 * @property Line $line

 * @property Customer $customer
 * @property Program $program
 * @property StartProgram[] $startPrograms
 */
class StartMain extends \yii\db\ActiveRecord {

    public $lines;
    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'start_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['customer_id', 'Line_id', 'program_id', 'models_id'], 'required'],
            [['customer_id', 'Line_id', 'program_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'models_id','program_status_id','amount'], 'integer'],
            [['program_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStatus::className(), 'targetAttribute' => ['program_status_id' => 'id']],
            [['models_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsP::className(), 'targetAttribute' => ['models_id' => 'id']],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsLine::className(), 'targetAttribute' => ['Line_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['lines'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['lines' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'models_id' => 'Models',
            'customer_id' => 'Customer',
            'Line_id' => 'Line',
            'program_id' => 'Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'program_status_id'=>'ProgramStatus',
            'amount'=>'amount',
                //  'Line_id'=>'Machine',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLine() {
        return $this->hasOne(ModelsLine::className(), ['id' => 'Line_id']);
    }
    
     public function getLines() {
        return $this->hasOne(Line::className(), ['id' => 'Lines']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram() {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    public function getModelsP() {
        return $this->hasOne(ModelsP::className(), ['id' => 'models_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartPrograms() {
        return $this->hasMany(StartProgram::className(), ['start_main_id' => 'id']);
    }

    public function getStartProgram() {
        return $this->hasOne(StartProgram::className(), ['start_main_id' => 'id']);
    }

    public function getUserCreated() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'created_by']);
    }

    public function getUserUpdate() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'updated_by']);
    }
     public function getProgramStatus() {
        return $this->hasOne(ProgramStatus::className(), ['id' => 'program_status_id']);
    }

}
