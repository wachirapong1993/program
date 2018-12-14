<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcb".
 *
 * @property int $id
 * @property string $name
 *
 * @property Arrangement[] $arrangements
 */
class Pcb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcb';
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
    public function getArrangements()
    {
        return $this->hasMany(Arrangement::className(), ['pcb_id' => 'id']);
    }
}
