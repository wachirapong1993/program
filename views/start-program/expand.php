<?php
use dimmitri\grid\ExpandRowColumn;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => SerialColumn::class],
        // simple example
//        [
//            'class' => ExpandRowColumn::class,
//            'attribute' => 'id',
//            'column_id' => 'column-info',
//            'url' => Url::to(['info']),
//        ],
        // advanced example
        [
            'class' => ExpandRowColumn::class,
            'attribute' => 'id',
            'column_id' => 'column-status',
            'ajaxErrorMessage' => 'Oops',
            'ajaxMethod' => 'GET',
            'url' => Url::to(['detail']),
            'submitData' => function ($model, $key, $index) {
                return ['id' => $model->id, 'advanced' => true];
            },
            'enableCache' => false,
            'afterValue' => function ($model, $key, $index) {
                return ' ' . Html::a(
                    Html::tag('span', '', ['class' => 'glyphicon glyphicon-download', 'aria-hidden' => 'true']),
                    ['view', 'ref' => $model->id],
                    ['title' => 'Download event history in csv format.']
                );
            },
            'format' => 'raw',
            'expandableOptions' => [
                'title' => 'Click me!',
                'class' => 'my-expand',
            ],
            'contentOptions' => [
                'style' => 'display: flex; justify-content: space-between;',
            ],
        ],
        ['class' => ActionColumn::class],
    ],
]) ?>