<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirm_detail".
 *
 * @property int $id
 * @property int $qc_confirm_idqc_confirm
 * @property int $check_feeder
 * @property int $check_part
 * @property string $lot_no
 * @property int $total
 *
 * @property CheckStatus $checkPart
 * @property CheckStatus $checkFeeder
 * @property ConfirmStart $qcConfirmIdqcConfirm
 */
class ConfirmDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirm_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qc_confirm_idqc_confirm', 'check_feeder', 'check_part', 'lot_no', 'total'], 'required'],
            [['qc_confirm_idqc_confirm', 'check_feeder', 'check_part', 'total'], 'integer'],
            [['lot_no'], 'string', 'max' => 50],
            [['check_part'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_part' => 'id']],
            [['check_feeder'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_feeder' => 'id']],
            [['qc_confirm_idqc_confirm'], 'exist', 'skipOnError' => true, 'targetClass' => ConfirmStart::className(), 'targetAttribute' => ['qc_confirm_idqc_confirm' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qc_confirm_idqc_confirm' => 'Qc Confirm Idqc Confirm',
            'check_feeder' => 'Check Feeder',
            'check_part' => 'Check Part',
            'lot_no' => 'Lot No',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckPart()
    {
        return $this->hasOne(CheckStatus::className(), ['id' => 'check_part']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckFeeder()
    {
        return $this->hasOne(CheckStatus::className(), ['id' => 'check_feeder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQcConfirmIdqcConfirm()
    {
        return $this->hasOne(ConfirmStart::className(), ['id' => 'qc_confirm_idqc_confirm']);
    }
}
