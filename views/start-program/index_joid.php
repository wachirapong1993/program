<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JoidPartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Joid Parts';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joid-part-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>



</div>
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
<?php // echo $this->render('_search', ['model' => $searchModel]);    ?>


    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>
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
//            [
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
//                    $searchModel = new app\models\JoidPartSearch();
//                    $searchModel->start_detail_id = $model->id;
//                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                     //print_r($dataProvider);
//                  //  die();
//                   //  $modelsum = new \app\models\BomSum();
//                    return Yii::$app->controller->renderPartial('index_joid', [
//                                'searchModel' => $searchModel,
//                                'dataProvider' => $dataProvider,
//                        //'modelsum' => $modelsum,
//                    ]);
//                },
//            ],
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
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{joid-part/update}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'joid-part/update' => function($url, $model, $key) {
                    if ($model->qc_status_id == 1) {
                        return Html::a('<i class="glyphicon glyphicon-random"></i>', $url, ['class' => 'btn btn-default']);
                    }
                          
//                        } elseif ($model->use_status == 1) {
//                            return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url, ['class' => 'btn btn-default']);
//                        } elseif ($model->use_status == 2) {
//                            return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, ['class' => 'btn btn-default']);
//                        }
                    }
                ]
            ],
        ],
    ]);
    ?>
    <?php yii\widgets\Pjax::end() ?>    
</div>

