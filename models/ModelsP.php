<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "models_p".
 *
 * @property int $id
 * @property string $name
 * @property int $customer_id
 *
 * @property Customer $customer
 * @property ProgramDetail[] $programDetails
 */
class ModelsP extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models_p';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramDetails()
    {
        return $this->hasMany(ProgramDetail::className(), ['models_p_id' => 'id']);
    }
}
