<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $part_no
 * @property string $part_name
 * @property int $part_type
 * @property string $celco_code
 *
 * @property PartType $part_type
 * @property ProgramItem[] $programItems
 * @property StartDetail[] $startDetails
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_no'], 'required'],
            [['part_type'], 'integer'],
            [['part_no', 'part_name'], 'string', 'max' => 100],
            [['celco_code'], 'string', 'max' => 50],
            [['part_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'part_no' => 'Part No',
            'part_name' => 'Part Name',
            'part_type' => 'Part Type',
            'celco_code' => 'Celco Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramItems()
    {
        return $this->hasMany(ProgramItem::className(), ['part_no' => 'part_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartDetails()
    {
        return $this->hasMany(StartDetail::className(), ['part_no' => 'part_no']);
    }
    
      public function getPartType()
    {
        return $this->hasOne(PartType::className(), ['id' => 'part_type']);
    }

}
