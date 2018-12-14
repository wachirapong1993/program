<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//u//se app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QcConfirmJoidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qc Confirm Joids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-confirm-joid-index">
    <style>
        .green {
            color:green;

        }
        .red {
            color:red;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
//    $time = time();
//    echo Yii::$app->thaiFormatter->asDate($time, 'short') . "<br>"; // echo $this->render('_search', ['model' => $searchModel]); 
//    
    ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
         'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Program',],
        'rowOptions' => function($model) {
            if ($model->qc_status_id == 1) {
                return ['class' => 'danger'];
            } elseif ($model->qc_status_id == 2) {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            //  'start_program_id',
            [
                'label' => 'Feeder',
                'attribute' => 'feeder_id',
                'value' => 'feeder.barcode_feeder',
                'hAlign' => 'center',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Status',
                'attribute' => 'check_feeder',
                'format' => 'raw',
                'value' => function($model, $url) {
                    if ($model->check_feeder == 2) {
                        //return 'Yes';
                        return '<i class="glyphicon glyphicon-ok green"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove red"></span>';
                    }
                },
                'hAlign' => 'center',
            ],
            [
                'label' => 'Celco_Code',
                'attribute' => 'item_id',
                'value' => 'item.celco_code',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Part_No',
                'attribute' => 'item_id',
                'value' => 'item_id',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Part_Type',
                'attribute' => 'item_id',
                'value' => 'item.partType.name',
                'hAlign' => 'center',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Status',
                'attribute' => 'check_part',
                'format' => 'raw',
                'value' => function($model, $url) {
                    if ($model->check_part == 2) {
                        //return 'Yes';
                        return '<i class="glyphicon glyphicon-ok green"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove red"></span>';
                    }
                },
                'hAlign' => 'center',
            ],

            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Confirm_Status',
                'attribute' => 'qc_status_id',
                'format' => 'raw',
                'value' => function($model, $url) {
                    if ($model->qc_status_id == 2) {
                        //return 'Yes';
                        return '<i class="glyphicon glyphicon-ok green"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove red"></span>';
                    }
                },
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'width' => '50px',
                'options' => ['style' => 'background-color:'],
                'hAlign' => 'center',
            ],
            [
                'label' => 'CREATE_BY',
                'attribute' => 'created_by',
                'value' => 'createdby.username',
                'hAlign' => 'center',
              //  'vAlign' => 'middle',
                'width' => '100px'
            ],
            [
                'label' => 'Date Time',
                'attribute' => 'created_at',
                'format' => 'html',
                'vAlign' => 'center',
                'width' => '150px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
//            [
//                //'label' => 'Total',
//                'attribute' => 'use_status',
//                'value' => 'use_status',
//                'hAlign' => 'center',
//                'vAlign' => 'middle',
//                'width' => '100px'
//            ],
            //'use_status',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{check}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'check' => function($url, $model, $key) {
                        if ($model->qc_status_id == 1) {
                            return Html::a('<i class="glyphicon glyphicon-random"></i>', $url, ['class' => 'btn btn-info']);
                        } elseif ($model->qc_status_id == 2) {
                            //return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url, ['class' => 'btn btn-default']);
                        }
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
