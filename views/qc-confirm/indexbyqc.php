<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'QC Check Programs';
$this->params['breadcrumbs'][] = $this->title;
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
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
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
//            'start_program_id',
            [
                'label' => 'Feeder',
                'attribute' => 'feeder_id',
                'value' => 'feeder.barcode_feeder',
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
                'label' => 'QC Confirm_Status',
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
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{create}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'create' => function($url, $model, $key) {
                        if ($model->qc_status_id == 1) {
                            return Html::a('<i class="glyphicon glyphicon-plus"></i>', $url, ['class' => 'btn btn-default']);
                        }
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
