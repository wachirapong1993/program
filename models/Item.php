<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $part_no
 * @property string $part_name
 * @property string $celco_code
 * @property string $description
 * @property string $part_size
 * @property string $position
 *
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
           
            [['part_no', 'part_name','description','part_size'], 'string', 'max' => 100],
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
            'description' => 'Description',
            'part_size' => 'Part Size',
            // 'position' => 'Position',
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
    
    /*  public function getPartType()
    {
        return $this->hasOne(PartType::className(), ['id' => 'part_type']);
    }*/

}
