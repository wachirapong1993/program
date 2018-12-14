<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
use trntv\yii\datetime\DateTimeWidget;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report UpPart';
$this->params['breadcrumbs'][] = $this->title;

?>
<script>
    function myFunction() {
        location.reload();
    }
</script>
<div class="start-detail-index">
     <button style="position:relative; right:auto" onclick="myFunction()" class="btn btn-warning">Refresh</button>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
            // 'id',
            [
                'label' => Yii::t('app', "Date"),
                'attribute' => 'created_at',
                'value' => 'startProgram.created_at',
                'format' => 'datetime',
                'width' => '150px',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'createTimeRange',
                    'convertFormat' => true,
                    'startAttribute' => 'createTimeStart',
                    'endAttribute' => 'createTimeEnd',
                    'pluginOptions' => [
                        'timePicker' => true,
                        'timePickerIncrement' => 30,
                        'locale' => [
                            'format' => 'Y-m-d h:i A'
                        ]
                    ]
                ]),
            ],
            [
                'label' => 'Program',
                'attribute' => 'program',
                'value' => 'startProgram.programDetail.program.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\ProgramDetail::find()->all(), 'program.id', 'program.name'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
                'width' => '150px',
            ],
//            [
//                'label' => 'Program',
//                'attribute' => 'start_program_id',
//                'value' => '',
//            ],
            [
                'label' => 'Table',
                'attribute' => 'table',
                'value' => 'feeder.tableMachine.table.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px',
            ],
            [
                'label' => 'P',
                'attribute' => 'feederP1',
                'value' => 'feeder.feederPoint.id',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '60px',
            ],
            [
                'label' => 'D',
                'attribute' => 'direction1',
                'value' => 'feeder.direction.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '60px',
            ],
            [
                'label' => 'Feeder',
                'attribute' => 'size1',
                'value' => 'startProgram.programDetail.programItem.size',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px',
            ],
//            [
//                'label' => 'Check',
//                'attribute' => 'size1',
//                'value' => 'checkFeeder.name',
//                'hAlign' => 'center',
//                'vAlign' => 'middle',
//            //   'width' => '60px',
//            ],
            // 'start_program_id',
            //   'check_feeder',
            [
                'label' => 'Celco Code',
                'attribute' => 'part_no',
                'value' => 'item.celco_code',
                'hAlign' => 'center',
                'vAlign' => 'middle',
            //     'width' => '60px',
            ],
            [
                'label' => 'Part',
                'attribute' => 'part_no',
                'value' => 'part_no',
                'hAlign' => 'center',
                'vAlign' => 'middle',
            //     'width' => '60px',
            ],
//            [
//                'label' => 'Check',
//                'attribute' => 'check_part',
//                'value' => 'checkPart.name',
//                'hAlign' => 'center',
//                'vAlign' => 'middle',
//            //  'width' => '60px',
//            ],
            //'check_part',
            [
                'label' => 'Lot No',
                'attribute' => 'lot_no',
                'value' => 'lot_no',
                'hAlign' => 'center',
                'vAlign' => 'middle',
            //   'width' => '60px',
            ],
            [
                'label' => 'Total',
                'attribute' => 'total',
                'value' => 'total',
                'hAlign' => 'center',
                'vAlign' => 'middle',
            //   'width' => '60px',
            ],
//            'lot_no',
//            'total',
            [
                'label' => 'QC Confirm',
                'attribute' => 'qc_status_id',
                'value' => 'qcStatus.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
            //   'width' => '60px',
            ],
//            [
//                'label' => 'Joid Feeder',
//                'attribute' => 'joid_feeder',
//                'value' => 'joids.id',
//                'hAlign' => 'center',
//                'vAlign' => 'middle',
//            //   'width' => '60px',
//            ],
            //  'qc_status_id',
            // 'part_no',
            // 'feeder_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
