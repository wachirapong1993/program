<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use kartik\daterange\DateRangeBehavior;

/**
 * This is the model class for table "joid_part".
 *
 * @property int $id
 * @property int $check_feeder
 * @property int $check_part
 * @property int $lot_no
 * @property int $total
 * @property int $qc_status_id
 * @property string $feeder_id
 * @property string $item_id
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $start_detail_id
 * @property int $use_status
 *
 * @property CheckStatus $checkFeeder
 * @property CheckStatus $checkPart
 * @property Feeder $feeder
 * @property QcStatus $qcStatus
 * @property StartDetail $startDetail
 * @property Item $item
 */
class JoidPart extends \yii\db\ActiveRecord {

    public $program;
    public $line;
    public $table;
    public $feederP1;
    public $direction1;
    public $direction2;
    public $feederP2;
    public $size1;
    public $size2;
    public $part1;
    public $part2;
    public $lot1;
    public $lot2;
    public $amount1;
    public $amount2;
    public $scanpart;
    public $st_id;
    public $scanfeeder;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'joid_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['item_id'], 'required'],
            //[['check_feeder', 'check_part', 'lot_no', 'total', 'qc_status_id', 'feeder_id', 'item_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'start_detail_id'], 'required'],
            [['check_feeder', 'scanpart', 'check_part', 'lot_no', 'total', 'qc_status_id', 'updated_at', 'updated_by', 'start_detail_id', 'use_status', 'st_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['feeder_id', 'item_id', 'scanfeeder', 'program'], 'string', 'max' => 50],
            [['check_feeder'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_feeder' => 'id']],
            [['check_part'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_part' => 'id']],
            //[['feeder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feeder::className(), 'targetAttribute' => ['feeder_id' => 'id']],
            [['qc_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => QcStatus::className(), 'targetAttribute' => ['qc_status_id' => 'id']],
            [['start_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartDetail::className(), 'targetAttribute' => ['start_detail_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'part_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'check_feeder' => 'Check Feeder',
            'check_part' => 'Check Part',
            'lot_no' => 'Lot No',
            'total' => 'Total',
            'qc_status_id' => 'Qc Status ID',
            'feeder_id' => 'Feeder ID',
            'item_id' => 'Item ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'start_detail_id' => 'Start Detail ID',
            'program' => 'program',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
    public function getFeeder() {
        return $this->hasOne(Feeder::className(), ['barcode_feeder' => 'feeder_id']);
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
    public function getStartDetail() {
        return $this->hasOne(StartDetail::className(), ['id' => 'start_detail_id']);
    }

    public function getUserc() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'created_by']);
    }

    public function getUseru() {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem() {
        return $this->hasOne(Item::className(), ['part_no' => 'item_id']);
    }

    public function getCreatedby() {
        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedby() {
        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'updated_by']);
    }

   

}
