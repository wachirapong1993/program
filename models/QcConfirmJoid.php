<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "qc_confirm_joid".
 *
 * @property int $id
 * @property int $check_feeder
 * @property int $check_part
 * @property int $joid_part_id
 * @property int $qc_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property CheckStatus $checkFeeder
 * @property CheckStatus $checkPart
 * @property JoidPart $joidPart
 * @property QcStatus $qcStatus
 */
class QcConfirmJoid extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'qc_confirm_joid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
//            [['check_feeder', 'check_part', 'joid_part_id', 'qc_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['check_feeder', 'check_part', 'joid_part_id', 'qc_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['check_feeder'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_feeder' => 'id']],
            [['check_part'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_part' => 'id']],
            [['joid_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => JoidPart::className(), 'targetAttribute' => ['joid_part_id' => 'id']],
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
            'joid_part_id' => 'Joid Part ID',
            'qc_status' => 'Qc Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
    public function getJoidPart() {
        return $this->hasOne(JoidPart::className(), ['id' => 'joid_part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQcStatus() {
        return $this->hasOne(QcStatus::className(), ['id' => 'qc_status']);
    }
//    public function getCreateat() {
//        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'created_at']);
//    }
//    public function getUpdatedat() {
//        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'updated_at']);
//    }
     public function getCreatedby() {
        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'created_by']);
    }
    public function getUpdatedby() {
        return $this->hasOne(\mdm\admin\models\User::className(), ['id' => 'updated_by']);
    }
}
