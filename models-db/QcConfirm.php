<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "qc_confirm".
 *
 * @property int $id
 * @property int $check_feeder
 * @property int $check_part
 * @property int $qc_emp
 * @property int $start_detail_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $feeder
 * @property string $part_no
 * @property int $qc_status
 * @property int $confirm_type_id
 *
 * @property QcStatus $checkFeeder
 * @property QcStatus $checkPart
 * @property StartDetail $startDetail
 * @property QcStatus $qcStatus
 */
class QcConfirm extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'qc_confirm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['check_feeder', 'check_part', 'start_detail_id', 'qc_status', 'confirm_type_id'], 'integer'],
            [['feeder', 'part_no'], 'string', 'max' => 50],
            [['created_at', 'updated_at'], 'safe'],
            [['confirm_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConfirmType::className(), 'targetAttribute' => ['confirm_type_id' => 'id']],
            [['check_feeder'], 'exist', 'skipOnError' => true, 'targetClass' => QcStatus::className(), 'targetAttribute' => ['check_feeder' => 'id']],
            [['check_part'], 'exist', 'skipOnError' => true, 'targetClass' => QcStatus::className(), 'targetAttribute' => ['check_part' => 'id']],
            [['start_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartDetail::className(), 'targetAttribute' => ['start_detail_id' => 'id']],
            [['qc_status'], 'exist', 'skipOnError' => true, 'targetClass' => QcStatus::className(), 'targetAttribute' => ['qc_status' => 'id']],
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
            'qc_emp' => 'Qc Emp',
            'start_detail_id' => 'Start Detail ID',
            'created_at' => 'Created At',
            'updated_at' => 'updated_at',
            'feeder' => 'Feeder',
            'part_no' => 'Part No',
            'qc_status' => 'Qc Status',
            'created_by' => 'created_by',
            'updated_by' => 'updated_by',
            'confirm_type_id'=>'confirm_type_id'
        ];
    }

    public function behaviors() {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckFeeder() {
        return $this->hasOne(QcStatus::className(), ['id' => 'check_feeder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckPart() {
        return $this->hasOne(QcStatus::className(), ['id' => 'check_part']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartDetail() {
        return $this->hasOne(StartDetail::className(), ['id' => 'start_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQcStatus() {
        return $this->hasOne(QcStatus::className(), ['id' => 'qc_status']);
    }

    public function getPart() {
        return $this->hasOne(Item::className(), ['part_no' => 'part_no']);
    }

    public function getUser() {
        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'updated_by']);
    }
    
    public function getConfirmType() {
        return $this->hasOne(ConfirmType::className(), ['id' => 'confirm_type_id']);
    }

}
