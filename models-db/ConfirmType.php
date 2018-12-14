<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirm_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property QcConfirm[] $qcConfirms
 */
class ConfirmType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirm_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
    public function getQcConfirms()
    {
        return $this->hasMany(QcConfirm::className(), ['confirm_type_id' => 'id']);
    }
}
