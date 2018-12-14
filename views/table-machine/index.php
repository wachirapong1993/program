<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TableMachineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Table Machines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-machine-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('Create Table Machine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'showPageSummary' => true,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
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
                'group' => true, // enable grouping
            ],
            [
                'label' => 'Machine',
                'attribute' => 'machine_id',
                'value' => 'machine.name',
            ],
            [
                'label' => 'Table',
                'attribute' => 'table_id',
                'value' => 'table.name',
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
