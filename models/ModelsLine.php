<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "models_line".
 *
 * @property int $id
 * @property string $title
 * @property int $models_p_id
 * @property int $Line_id
 *
 * @property Line $line
 * @property ModelsP $modelsP
 */
class ModelsLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['models_p_id', 'Line_id'], 'required'],
            [['models_p_id', 'Line_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['Line_id'], 'exist', 'skipOnError' => true, 'targetClass' => Line::className(), 'targetAttribute' => ['Line_id' => 'id']],
            [['models_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsP::className(), 'targetAttribute' => ['models_p_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'models_p_id' => 'Models P ID',
            'Line_id' => 'Line ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLine()
    {
        return $this->hasOne(Line::className(), ['id' => 'Line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelsP()
    {
        return $this->hasOne(ModelsP::className(), ['id' => 'models_p_id']);
    }
}
