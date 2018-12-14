<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property int $id
 * @property string $name
 *
 * @property TableMachine[] $tableMachines
 */
class Tables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tables';
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
    public function getTableMachines()
    {
        return $this->hasMany(TableMachine::className(), ['table_id' => 'id']);
    }
}
