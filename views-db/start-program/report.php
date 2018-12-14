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
/* @var $searchModel app\models\JoidPartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function myFunction() {
        location.reload();
    }
</script>
<div class="joid-part-index">
    <button style="position:relative; right:auto" onclick="myFunction()" class="btn btn-warning">Refresh</button>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>



    <?=
    // $dt = date();
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        //  'panel' => ['type' => 'primary'],
        'panel' => ['type' => 'primary', 'heading' => 'Report',],
        'rowOptions' => function($model) {
            if ($model->qc_status_id == 1) {
                return ['class' => 'danger'];
            } elseif ($model->qc_status_id == 3) {
                return ['class' => 'warning'];
            } elseif ($model->qc_status_id == 4) {
                return ['class' => 'success'];
            } elseif ($model->qc_status_id == 2) {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Scan Employee',
                'attribute' => 'created_by',
                'value' => 'userc.username',
                'hAlign' => 'center',
                'vAlign' => 'center',
                'width' => '100px',
               // 'htmlOptions'=>['width'=>'30px','height'=>'30px'],
                //'htmlOptions'=>array('width'=>'30px','height'=>'30px'),

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(dektrium\user\models\User::find()->asArray()->all(), 'id', 'username'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
            ],
            [
                'label' => Yii::t('app', "Date"),
                'attribute' => 'created_at',
                'value' => 'created_at',
                'format' => 'datetime',
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
                'label' => 'Line',
                'attribute' => 'line',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.feeder.line.name',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(\app\models\Line::find()->asArray()->all(), 'id', 'name'),
//                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
            ],
            [
                'label' => 'Program',
                'attribute' => 'program',
                'hAlign' => 'center',
                'vAlign' => 'center',
                'value' => 'startDetail.startProgram.programDetail.program.name',
                'group' => true, // enable grouping
            ],
            [
                'label' => 'Table',
                'attribute' => 'program',
                'vAlign' => 'center',
                'hAlign' => 'center',
              //  'width' => '80px',
                'value' => 'startDetail.startProgram.programDetail.tableMachine.table.name',
                'group' => true, // enable grouping
            ],
            [
                'label' => 'P',
                'attribute' => 'feederP1',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.feeder.feederPoint.id',
            //  'group' => true, // enable grouping
            ],
            [
                'label' => 'D',
                'attribute' => 'direction1',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.feeder.direction.name',
            //  'group' => true, // enable grouping
            ],
            [
                'label' => 'Size',
                'attribute' => 'size1',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.startProgram.programDetail.programItem.size',
            //   'group' => true, // enable grouping
            ],
            [
                'label' => 'Celco Code',
                'attribute' => 'part_no',
                'value' => 'startDetail.item.celco_code',
                'hAlign' => 'center',
                'vAlign' => 'center',
              //  'width' => '60px',
                'group' => true, // enable grouping
            ],
            [
                'label' => 'UpPart',
                'attribute' => 'part1',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.part_no',
                'group' => true, // enable grouping
            ],
            [
                'label' => 'Lot No.',
                'attribute' => 'lot1',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.lot_no',
                'group' => true, // enable grouping
            ],
            [
                'label' => 'Amout',
                'attribute' => 'amount',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'value' => 'startDetail.total',
                'group' => true, // enable grouping
            ],
            // 'id',
//            'check_feeder',
//            'check_part',
//            [
//                'label' => 'ID',
//                'attribute' => 'start_detail_id',
//                'value' => 'startDetail.id',
//                'hAlign' => 'center',
////                'filterType' => GridView::FILTER_SELECT2,
////                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
////                'filterWidgetOptions' => [
////                    'pluginOptions' => ['allowClear' => true],
////                ],
//                // 'filterInputOptions' => ['placeholder' => 'Program'],
//                'group' => true, // enable grouping
//            //
//            // 'vAlign' => 'middle',
//            ],
//            [
//                'label' => 'Program',
//                'attribute' => 'program',
//                'value' => 'startDetail.startProgram.programDetail.title',
////                'filterType' => GridView::FILTER_SELECT2,
////                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
////                'filterWidgetOptions' => [
////                    'pluginOptions' => ['allowClear' => true],
////                ],
//                // 'filterInputOptions' => ['placeholder' => 'Program'],
//                'group' => true, // enable grouping
//            //
//            // 'vAlign' => 'middle',
//            ],
//            [
//                'label' => 'Feeder',
//                'attribute' => 'start_detail_id',
//                'value' => 'startDetail.feeder.barcode_feeder',
//                'vAlign' => 'center',
//                'hAlign' => 'center',
////                'filterType' => GridView::FILTER_SELECT2,
////                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
////                'filterWidgetOptions' => [
////                    'pluginOptions' => ['allowClear' => true],
////                ],
//                // 'filterInputOptions' => ['placeholder' => 'Program'],
//              //  'group' => true, // enable grouping
//            //
//            // 'vAlign' => 'middle',
//            ],
//            [
//                'label' => 'Feeder',
//                'attribute' => 'start_detail_id',
//                'value' => 'startDetail.item.part_no',
//                'vAlign' => 'center',
//                'hAlign' => 'center',
////                'filterType' => GridView::FILTER_SELECT2,
////                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
////                'filterWidgetOptions' => [
////                    'pluginOptions' => ['allowClear' => true],
////                ],
//                // 'filterInputOptions' => ['placeholder' => 'Program'],
//              //  'group' => true, // enable grouping
//            //
//            // 'vAlign' => 'middle',
//            ],
            //  'start_detail_id',
            //   'feeder_id',
//            [
//                'label' => 'Feeder ',
//                'attribute' => 'feeder_id',
//                'value' => 'feeder.barcode_feeder',
//                'hAlign' => 'center',
//                // 'vAlign' => 'middle',
//                'width' => '80px',
//            ],
            [
                'label' => 'JoidPart',
                'attribute' => 'part2',
                'value' => 'item.celco_code',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //'width' => '60px',
            ],
            [
                'label' => 'JoidPart',
                'attribute' => 'part2',
                'value' => 'item.part_no',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //   'width' => '80px',
            ],
            [
                'label' => 'Lot No.',
                'attribute' => 'lot2',
                'value' => 'lot_no',
                'hAlign' => 'center',
                'vAlign' => 'center',
             //   'width' => '80px',
            ],
            [
                'label' => 'Amount',
                'attribute' => 'amount2',
                'value' => 'total',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
             //   'width' => '80px',
            ],
            // 'item_id',
            //  'lot_no',
            //
      //            'total',
            [
                'label' => 'Status',
                'attribute' => 'qc_status_id',
                'value' => 'qcStatus.name',
                'hAlign' => 'center',
                'vAlign' => 'center',
             //   'width' => '100px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\QcStatus::find()->asArray()->all(), 'id', 'name'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Status'],
            //  'group' => true, // enable grouping
            ],
        // 'qc_status_id',
//            [
//                'label' => 'Date Time Create',
//                'attribute' => 'created_at',
//                'format' => 'html',
//                'vAlign' => 'center',
//                'hAlign' => 'center',
//                'width' => '150px',
//                'value' => function($model, $key, $index, $column) {
//                    return
//                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
//                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
//                    //'hAlign' => 'center',
//                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
//                }],
        //  'created_at',
        // 'created_by',
//            [
//                'label' => 'Created Employee',
//                'attribute' => 'created_by',
//                'value' => 'userc.username',
//                'hAlign' => 'center',
//                // 'vAlign' => 'middle',
//                'width' => '100px',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(dektrium\user\models\User::find()->asArray()->all(), 'id', 'username'),
//                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Program'],
//            ],
//            'updated_at',
//            'updated_by',
        //s  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
