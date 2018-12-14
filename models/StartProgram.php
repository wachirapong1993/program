<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "start_program".
 *
 * @property int $id
 * @property int $emp_code
 * @property int $program_detail_id
 * @property int $program_status_id
 * @property int $start_main_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by

 *
 * @property ConfirmStart[] $confirmStarts
 * @property StartDetail[] $startDetails
 * @property ProgramDetail $programDetail
 * @property ProgramStatus $programStatus
 * @property StartMain $startMain
 * @property User $user

 */
class StartProgram extends \yii\db\ActiveRecord {

    public $customer_id;
    public $models;
    public $model_line;
    public $mainprogram;
    public $line;
    public $machine;
    public $tblmc;
    public $feeder;
    public $program_search;
    public $itemSearch;
    public $part_no;
    public $qc_emp;
    public $program;
    public $input_type_1;
    public $input_type_2;

    //public $program_detail;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'start_program';
    }

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['program_detail_id'], 'required'],
            [['emp_code', 'program_detail_id', 'program_search', 'part_no', 'qc_emp', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['program_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramDetail::className(), 'targetAttribute' => ['program_detail_id' => 'id']],
//            [['program_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStatus::className(), 'targetAttribute' => ['program_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'emp_code' => 'Emp Code',
            'program_detail_id' => 'Program Detail ID',
//            'program_status_id' => 'Program Status ID',
            'customer' => 'Customer',
            'models' => 'Models',
            'mainprogram' => 'MainProgram',
        ];
    }

//    public function Check(){
//        
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmStarts() {
        return $this->hasMany(ConfirmStart::className(), ['start_program_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartDetails() {
        return $this->hasMany(StartDetail::className(), ['start_program_id' => 'id']);
    }

    public function getStartDetail() {
        return $this->hasOne(StartDetail::className(), ['id' => 'id']);
    }
    
//    public function getStartMains() {
//        return $this->hasOne(StartMain::className(), ['id' => 'start_main_id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetail() {
        return $this->hasOne(ProgramDetail::className(), ['id' => 'program_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getProgramStatus() {
//        return $this->hasOne(ProgramStatus::className(), ['id' => 'program_status_id']);
//    }

    public function getUser() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'created_by']);
    }
    public function getStartMain() {
        return $this->hasOne(StartMain::className(), ['id' => 'start_main_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
}
