<?php

namespace app\models;

use Yii;






class CheckProgram extends \yii\db\ActiveRecord
{
    public $feeder;
    public $item;
    
    
    
    
    public function getFeeder()
    {
        return $this->hasOne(Feeder::className(), ['id' => 'feeder']);
    }
    
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item']);
    }
    
}
 