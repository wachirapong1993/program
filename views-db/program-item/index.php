<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="program-item-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Program',],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            //   'program_detail_id',
//            [
//                'label' => 'Customer',
//                'attribute' => 'customer',
//                'contentOptions' => ['style' => 'width:50px;height: 10px;'], // not max-width
//                'value' => 'programDetail.program.modelsP.customer.name',
//                // 'hAlign' => '100px',
//                //'height'=>'20px',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Program'],
//            //    'group' => true, // enable grouping
//            //
//            // 'vAlign' => 'middle',
//            ],
            [
                'label' => 'Program',
                'attribute' => 'program',
                'value' => 'programDetail.program.name',
                'hAlign' => 'center',
                'width' => '200px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name', 'customer'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
            //
            // 'vAlign' => 'middle',
            ],
            [
                'label' => 'Table',
                'attribute' => 'tbl',
                'value' => 'programDetail.title',
                'hAlign' => 'center',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\TableMachine::find()->asArray()->all(), 'id', 'name', 'line.name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
            ],
//            [
//                'label' => 'Feeder ',
//                'attribute' => 'feeder_id',
//                'value' => 'feeder.barcode_feeder',
//                'hAlign' => 'center',
//            // 'vAlign' => 'middle',
//            //'width' => '100px',
//            ],
            [
                'label' => 'Feeder Point',
                'attribute' => 'feeder_id',
                'value' => 'feeder.feeder_point_id',
                'hAlign' => 'center',
                'width' => '50px',
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'Direction',
                'attribute' => 'feeder_id',
                'value' => 'feeder.direction.name',
                'hAlign' => 'center',
                'width' => '80px',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
            [
                'label' => 'Celco code',
                'attribute' => 'part_no',
                'value' => 'partNo.celco_code',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
            [
                'label' => 'Part No',
                'attribute' => 'part_no',
                'value' => 'part_no',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'Part Type',
                'attribute' => 'part_type',
                'value' => 'partNo.partType.name',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'comment',
                'attribute' => 'comment',
                'value' => 'comment',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '80px',
            ],
            [
                'label' => 'Amount',
                'attribute' => 'amount',
                'value' => 'amount',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
//        'feeder.barcode_feeder',
//        'comment:ntext',
//        'amount',
//        'part_no',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
