<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qc_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property StartDetail[] $startDetails
 */
class QcStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qc_status';
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
    public function getStartDetails()
    {
        return $this->hasMany(StartDetail::className(), ['qc_status_id' => 'id']);
    }
}
