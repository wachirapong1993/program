<?php

namespace app\models;

use Yii;

class Post extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
        ];
    }
}
