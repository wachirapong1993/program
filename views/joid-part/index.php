<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JoidPartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joid-part-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Report',],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            [
                'label' => 'Program',
                'attribute' => 'program',
                'value' => 'startDetail.startProgram.programDetail.title',
                'vAlign' => 'center',
                'hAlign' => 'center',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
                // 'filterInputOptions' => ['placeholder' => 'Program'],
                'group' => true, // enable grouping
            //
            // 'vAlign' => 'middle',
            ],
            [
                'label' => 'Feeder',
                'attribute' => 'start_detail_id',
                'value' => 'startDetail.feeder.barcode_feeder',
                'vAlign' => 'center',
                'hAlign' => 'center',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
                // 'filterInputOptions' => ['placeholder' => 'Program'],
              //  'group' => true, // enable grouping
            //
            // 'vAlign' => 'middle',
            ],
            [
                'label' => 'Feeder',
                'attribute' => 'start_detail_id',
                'value' => 'startDetail.item.part_no',
                'vAlign' => 'center',
                'hAlign' => 'center',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(\app\models\Program::find()->asArray()->all(), 'id', 'name'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
                // 'filterInputOptions' => ['placeholder' => 'Program'],
              //  'group' => true, // enable grouping
            //
            // 'vAlign' => 'middle',
            ],
            //  'start_detail_id',
            //   'feeder_id',
            [
                'label' => 'Feeder ',
                'attribute' => 'feeder_id',
                'value' => 'feeder.barcode_feeder',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '80px',
            ],
            [
                'label' => 'Part No',
                'attribute' => 'item_id',
                'value' => 'item.part_no',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '80px',
            ],
            [
                'label' => 'Lot No',
                'attribute' => 'lot_no',
                'value' => 'lot_no',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '80px',
            ],
            [
                'label' => 'Total',
                'attribute' => 'total',
                'value' => 'total',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '80px',
            ],
            // 'item_id',
            //  'lot_no',
            //
      //            'total',
            //'qc_status_id',
            [
                'label' => 'Date Time Create',
                'attribute' => 'created_at',
                'format' => 'html',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            [
                'label' => 'Date Time Update',
                'attribute' => 'updated_at',
                'format' => 'html',
                'vAlign' => 'center',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->updated_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            //  'created_at',
            // 'created_by',
            [
                'label' => 'Created Employee',
                'attribute' => 'created_by',
                'value' => 'userc.username',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '100px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(dektrium\user\models\User::find()->asArray()->all(), 'id', 'username'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
            ],
            [
                'label' => 'Scan Employee',
                'attribute' => 'updated_by',
                'value' => 'useru.username',
                'hAlign' => 'center',
                // 'vAlign' => 'middle',
                'width' => '100px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(dektrium\user\models\User::find()->asArray()->all(), 'id', 'username'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
            ],
//            'updated_at',
//            'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
