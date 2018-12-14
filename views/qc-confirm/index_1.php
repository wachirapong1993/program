<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QcConfirmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qc Confirms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-confirm-index">
    <style>
        .green {
            color:green;

        }
        .red {
            color:red;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

<!--    <p>
    <?= Html::a('Create Qc Confirm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //    'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'rowOptions' => function($model) {
            if ($model->qc_status == 1) {
                return ['class' => 'danger'];
            } elseif ($model->qc_status == 2) {
                return ['class' => 'success'];
            } elseif ($model->qc_status == 3) {
                return ['class' => 'warning'];
//            } elseif ($model->Status == 4) {
//                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'label' => 'Feeder',
                'attribute' => 'feeder',
                'value' => 'feeder',
            ],
//            [
//               // 'class' => 'kartik\grid\EditableColumn',
//                'attribute' => 'check_feeder',
//                'pageSummary' => true,
//                
//               // 'editableOptions' => [
////                    'header' => 'Check Feeder',
////                    'format' => Editable::FORMAT_BUTTON,
////                    'inputType' => Editable::INPUT_TEXT,
////                    'data' => '',
//               // ]
//            ],
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
                'value' => 'part.celco_code',
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
                'value' => 'part.partType.name',
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
                'label' => 'QC_status',
                'attribute' => 'qc_status',
                'format' => 'raw',
                'value' => function($model, $url) {
                    if ($model->qc_status == 2) {
                        //return 'Yes';
                        return '<i class="glyphicon glyphicon-ok green"></span>';
                    } else {
                        return '<span class="glyphicon glyphicon-remove red"></span>';
                    }
                },
                'hAlign' => 'center',
            ],
            [
                'label' => 'QC Comfirm Employee',
                'attribute' => 'created_by',
                'value' => 'user.username',
                'hAlign' => 'center',
            ],
            [
                'label' => 'Date Time',
                'attribute' => 'created_at',
                'format' => 'html',
                'vAlign' => 'middle',
                'width' => '250px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
        // 'qc_emp',
        // 'start_detail_id',
        //'created_at',
        //'feeder',
        //'part_no',
        //'qc_status',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttonOptions' => ['class' => 'btn btn-default'],
//                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{check}{update}</div>',
//                'options' => ['style' => 'width:150px;'],
//                'buttons' => [
//                    'check' => function($url, $model, $key) {
//                        return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
//                    }
//                ]
//            ],
        ],
    ]);
    ?>
</div>
