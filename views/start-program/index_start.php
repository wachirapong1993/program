<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="start-detail-index">
    <style>
        .green {
            color:green;

        }
        .red {
            color:red;
        }
    </style>
    <!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'rowOptions' => function($model) {
            if ($model->qc_status_id == 1) {
                return ['class' => 'danger'];
            } elseif ($model->qc_status_id == 2) {
                return ['class' => 'success'];
//            } elseif ($model->Status == 3) {
//                return ['class' => 'warning'];
//            } elseif ($model->Status == 4) {
//                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new app\models\JoidPartSearch();
                    $searchModel->start_detail_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                     //print_r($dataProvider);
                  //  die();
                   //  $modelsum = new \app\models\BomSum();
                    return Yii::$app->controller->renderPartial('index_joid', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                        //'modelsum' => $modelsum,
                    ]);
                },
            ],
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
                'label' => 'Part_No',
                'attribute' => 'part_no',
                'value' => 'item.celco_code',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Part_No',
                'attribute' => 'part_no',
                'value' => 'part_no',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Part_Type',
                'attribute' => 'part_no',
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
                'label' => 'Lot_No',
                'attribute' => 'lot_no',
                'value' => 'lot_no',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
            ],
            [
                'label' => 'Total',
                'attribute' => 'total',
                'value' => 'total',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
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
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{joid}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'joid' => function($url, $model, $key) {
                        if ($model->qc_status_id == 2) {
                            return Html::a('<i class="glyphicon glyphicon-plus"></i>', $url, ['class' => 'btn btn-default']);
                        }
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
