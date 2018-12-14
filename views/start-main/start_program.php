<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Table Program';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>


    </p>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'rowOptions' => function($model) {
            if ($model->startMain->program_status_id == 1) {
                return ['class' => 'danger'];
            } elseif ($model->startMain->program_status_id == 3) {
                return ['class' => 'warning'];
            } elseif ($model->startMain->program_status_id == 4) {
                return ['class' => 'success'];
//            } elseif ($model->Status == 4) {
//                return ['class' => 'success'];
            }
        },
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    //  echo $model->id.'<br>';

                    $searchModel = new StartDetailSearch();
                    $searchModel->start_program_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    // $modelsum = new \app\models\BomSum();
                    return Yii::$app->controller->renderPartial('start_detail', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                    //           'modelsum' => $modelsum,
                    ]);
                },
            ],
            [
                'label' => 'Line',
                'attribute' => 'line',
                'value' => 'programDetail.tableMachine.line.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '150px',
                'filter' => ArrayHelper::map(app\models\ProgramStatus::find()->asArray()->where(['between', 'id', 2, 4])->all(), 'id', 'name'),
            ],
            [
                'label' => 'Machine',
                'attribute' => 'program_detail_id',
                'value' => 'programDetail.tableMachine.machine.name',
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
                'label' => 'Table',
                'attribute' => 'program_detail_id',
                'value' => 'programDetail.tableMachine.table.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\ProgramDetail::find()->asArray()->all(), 'id', 'title'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
                // 'group' => true, // enable grouping
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '250px',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{start-program/program1}{/export/detail}{/export/joid}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'start-program/program1' => function($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
                        // return Html::a('<i class="glyphicon glyphicon-save-file"></i>', $url, ['class' => 'btn btn-default']);
                    },
                    '/export/detail' => function($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
                        return Html::a('<i class="glyphicon glyphicon-save-file"></i>', $url, ['class' => 'btn btn-default', 'data-pjax' => 0, 'target' => "_blank"]);
                    },
                    '/export/joid' => function($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
                        return Html::a('<i class="glyphicon glyphicon-floppy-save"></i>', $url, ['class' => 'btn btn-default',
                                    'data-pjax' => 0, 'target' => "_blank"
                        ]);
                    },
//                    'export' => function($url, $model, $key) {
//                       glyphicon glyphicon-floppy-save
//                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
