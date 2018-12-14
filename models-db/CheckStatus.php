<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "check_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property ConfirmDetail[] $confirmDetails
 * @property ConfirmDetail[] $confirmDetails0
 * @property StartDetail[] $startDetails
 * @property StartDetail[] $startDetails0
 */
class CheckStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmDetails()
    {
        return $this->hasMany(ConfirmDetail::className(), ['check_part' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmDetails0()
    {
        return $this->hasMany(ConfirmDetail::className(), ['check_feeder' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartDetails()
    {
        return $this->hasMany(StartDetail::className(), ['check_feeder' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartDetails0()
    {
        return $this->hasMany(StartDetail::className(), ['check_part' => 'id']);
    }
}
