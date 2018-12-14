<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "arrangement_detail".
 *
 * @property int $id
 * @property int $arrangement_id
 * @property string $item_celco_code
 * @property int $feeder_id
 * @property string $comment
 * @property int $amount
 *
 * @property Arrangement $arrangement
 * @property Feeder $feeder
 * @property Item $itemCelcoCode
 */
class ArrangementDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arrangement_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_celco_code', 'feeder_id', 'comment', 'amount'], 'required'],
            [['arrangement_id', 'feeder_id', 'amount'], 'integer'],
            [['item_celco_code'], 'string', 'max' => 50],
            [['comment'], 'string', 'max' => 45],
            [['arrangement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Arrangement::className(), 'targetAttribute' => ['arrangement_id' => 'id']],
            [['feeder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feeder::className(), 'targetAttribute' => ['feeder_id' => 'id']],
            [['item_celco_code'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_celco_code' => 'celco_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arrangement_id' => 'Arrangement ID',
            'item_celco_code' => 'Item Celco Code',
            'feeder_id' => 'Feeder ID',
            'comment' => 'Comment',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArrangement()
    {
        return $this->hasOne(Arrangement::className(), ['id' => 'arrangement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeder()
    {
        return $this->hasOne(Feeder::className(), ['id' => 'feeder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCelcoCode()
    {
        return $this->hasOne(Item::className(), ['celco_code' => 'item_celco_code']);
    }
}
