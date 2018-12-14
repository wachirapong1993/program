<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirm_start".
 *
 * @property int $id
 * @property int $start_program_id
 * @property int $qc_emp

 *
 * @property ConfirmDetail[] $confirmDetails
 * @property StartProgram $startProgram
 */
class ConfirmStart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirm_start';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_program_id', 'qc_emp', 'user_id'], 'required'],
            [['start_program_id', 'qc_emp', 'user_id'], 'integer'],
           
            [['start_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => StartProgram::className(), 'targetAttribute' => ['start_program_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_program_id' => 'Start Program ID',
            'qc_emp' => 'Qc Emp',
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmDetails()
    {
        return $this->hasMany(ConfirmDetail::className(), ['qc_confirm_idqc_confirm' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartProgram()
    {
        return $this->hasOne(StartProgram::className(), ['id' => 'start_program_id']);
    }
}
