<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use kartik\daterange\DateRangeBehavior;

class Report extends \yii\db\ActiveRecord {

    public $customer_id;
    public $models;
    public $line;
    public $machine;
    public $program;
    public $tblmc;
    public $program_detail_id;
    //public $program;
    public $start_program;
    public $start_detail;
    public $joid_part;
    public $qc_confirm;
    public $qc_con_joid;
    public $feeder;
    public $feeder_joid;
    public $part_no;
    public $part_no_j;
    public $created;
    public $updated;
    public $end_date;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }

    public function rules() {
        return [
            // [['name'], 'required'],
            [['program_detail_id','createTimeStart','$createTimeEnd'], 'integer', 'max' => 45],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function tableName() {
        return 'report';
    }

    public function getStartProgram() {
        return $this->hasOne(StartProgram::className(), ['id' => 'start_program']);
    }

    public function getStartDetail() {
        return $this->hasOne(StartDetail::className(), ['id' => 'start_detail']);
    }

    public function getJoidPart() {
        return $this->hasOne(JoidPart::className(), ['id' => 'joid_part']);
    }

}
