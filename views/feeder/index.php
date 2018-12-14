<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feeders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feeder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Feeder', ['import'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Feeder'],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // 'name',
            [
                'label' => 'Line',
                'attribute' => 'Line_id',
                'value' => 'line.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Line::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any supplier'],
            //     'group' => true, // enable grouping
            ],
            [
                'label' => 'Machine',
                'attribute' => 'machine_id',
                'value' => 'machine.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Machine::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any supplier'],
            //'group' => true, // enable grouping
            ],
            [
                'label' => 'TBL/MC',
                'attribute' => 'table_machine_id',
                'value' => 'tableMachine.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\TableMachine::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any supplier'],
                //  'group' => true, // enable grouping
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
            ],
            [
                'label' => 'Feeder Point',
                'attribute' => 'feeder_point_id',
                'value' => 'feederPoint.id',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
            ],
            [
                'label' => 'Direction',
                'attribute' => 'direction_id',
                'value' => 'direction.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Direction::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any supplier'],
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
            //   'group' => true, // enable grouping
            ],
            [
                'label' => 'Barcode Feeder',
                'attribute' => 'barcode_feeder',
                'value' => 'barcode_feeder',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px'
            ],
//            'Line_id',
//            'machine_id',
//            'table_machine_id',
//            'feeder_point_id',
//            'direction_id',
//            'size',
            //    'barcode_feeder',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
