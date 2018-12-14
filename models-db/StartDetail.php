<?php

namespace app\models;

use Yii;
//use kartik\daterange\DateRangeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "start_detail".
 *
 * @property int $id
 * @property int $start_program_id
 * @property int $check_feeder
 * @property int $check_part
 * @property string $lot_no
 * @property int $total
 * @property int $qc_status_id
 * @property string $part_no
 * @property int $feeder_id
 *
 * @property Feeder $feeder
 * @property Item $part_no
 * @property CheckStatus $checkFeeder
 * @property CheckStatus $checkPart
 * @property QcStatus $qcStatus
 * @property StartProgram $startProgram
 */
class StartDetail extends \yii\db\ActiveRecord {

    public $sacn_feeder;
    public $scan_part;
    public $program;
    public $table;
    public $feederP1;
    public $direction1;
    public $size1;
    public $joid_feeder;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;
    public $created_at;

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
//            [
//                'class' => DateRangeBehavior::className(),
//                'attribute' => 'createTimeRange',
//                'dateStartAttribute' => 'createTimeStart',
//                'dateEndAttribute' => 'createTimeEnd',
//            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'start_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['start_program_id', 'check_feeder', 'check_part', 'total', 'qc_status_id', 'feeder_id','created_at','updated_at','created_by','updated_by'], 'integer'],
            [['lot_no', 'part_no'], 'string', 'max' => 45],
            [['check_feeder'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_feeder' => 'id']],
            [['check_part'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_part' => 'id']],
            [['qc_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => QcStatus::className(), 'targetAttribute' => ['qc_status_id' => 'id']],
            [['part_no'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['part_no' => 'part_no']],
            [['feeder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feeder::className(), 'targetAttribute' => ['feeder_id' => 'id']],
                // [['start_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartProgram::className(), 'targetAttribute' => ['start_program_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'start_program_id' => 'Start Program ID',
            'check_feeder' => 'Check Feeder',
            'check_part' => 'Check Part',
            'lot_no' => 'Lot No',
            'total' => 'Total',
            'qc_status_id' => 'Qc Status ID',
            'part_no' => 'part_no',
            'feeder_id' => 'feeder',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeder() {
        return $this->hasOne(Feeder::className(), ['id' => 'feeder_id']);
    }

    public function getItem() {
        return $this->hasOne(Item::className(), ['part_no' => 'part_no']);
    }

    public function getCheckFeeder() {
        return $this->hasOne(CheckStatus::className(), ['id' => 'check_feeder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckPart() {
        return $this->hasOne(CheckStatus::className(), ['id' => 'check_part']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQcStatus() {
        return $this->hasOne(QcStatus::className(), ['id' => 'qc_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartProgram() {
        return $this->hasOne(StartProgram::className(), ['id' => 'start_program_id']);
    }

    public function getLine() {
        return $this->hasOne(Line::className(), ['id' => 'line']);
    }

    public function getJoids() {
        return $this->hasOne(JoidPart::className(), ['start_detail_id' => 'id']);
    }

    public function getProgram() {
        return $this->hasOne(Program::className(), ['id' => 'program']);
    }
      public function getUserCreated() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'created_by']);
    }

    public function getUserUpdated() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'updated_by']);
    }

}
