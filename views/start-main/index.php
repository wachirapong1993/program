<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\StartDetailSearch;
use yii\helpers\Url;
use app\models\StartProgramSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Running';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <script>
            function myFunction() {
                location.reload();
            }
        </script>
        <button onclick="myFunction()" class="btn btn-success">Refresh</button>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'rowOptions' => function($model) {
            if ($model->program_status_id == 1) {
                return ['class' => 'danger'];
            } elseif ($model->program_status_id == 3) {
                return ['class' => 'danger'];
            } elseif ($model->program_status_id == 4) {
                return ['class' => 'success'];
//            } elseif ($model->Status == 4) {
//                return ['class' => 'success'];
            }
        },
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    //  echo $model->id.'<br>';

                    $searchModel = new StartProgramSearch();
                    $searchModel->start_main_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    // $modelsum = new \app\models\BomSum();
                    return Yii::$app->controller->renderPartial('start_program', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                    //           'modelsum' => $modelsum,
                    ]);
                },
            ],
            // 'id',
            [
                'label' => 'Customer',
                'attribute' => 'customer_id',
                'value' => 'customer.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\Customer::find()->asArray()->all(), 'id', 'name'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Program'],
            ],
            // 'customer_id',
            [
                'label' => 'Model',
                'attribute' => 'Line_id',
                'value' => 'line.line.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '200px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\ModelsLine::find()->asArray()->all(), 'id', 'title', 'line.name'),
                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Line'],
            ],
//            [
//                'label' => 'Program',
//                'attribute' => 'program_id',
//                'value' => 'program.name',
//                'hAlign' => 'center',
//                'vAlign' => 'middle',
//                'width' => '150px',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ArrayHelper::map(app\models\Program::find()->asArray()->all(), 'id', 'name'),
//                //'filter'=>ArrayHelper::map(app\models\ProductModels::find()->all(), 'models_id'), 
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Line'],
//            ],
            //'Line_id',
            //'program_id',
            [
                'label' => 'Start By',
                'attribute' => 'created_by',
                'value' => 'userCreated.username',
                'hAlign' => 'center',
                'vAlign' => 'middle',
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
                'label' => 'Create Date:Time',
                'attribute' => 'created_at',
                'format' => 'html',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '200px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            [
                'label' => 'End By',
                'attribute' => 'updated_at',
                'value' => 'userUpdate.username',
                'hAlign' => 'center',
                'vAlign' => 'middle',
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
                'label' => 'Update Date:Time',
                'attribute' => 'updated_at',
                'format' => 'html',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '200px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            // 'created_at',
//            'updated_at',
//           // 'created_by',
//            'updated_by',
            [
                'label' => 'Status',
                'attribute' => 'program_status_id',
                'value' => 'programStatus.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '150px',
                'filter' => ArrayHelper::map(app\models\ProgramStatus::find()->asArray()->where(['between', 'id', 2, 4])->all(), 'id', 'name'),
            ],
            [
                'label' => 'Production',
                'attribute' => 'amount',
                'value' => 'amount',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '150px',
              //  'filter' => ArrayHelper::map(app\models\ProgramStatus::find()->asArray()->where(['between', 'id', 2, 4])->all(), 'id', 'name'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{export/word}{update}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'export/word' => function($url, $model, $key) {
                        //  if ($model->qc_status_id == 2) {
                        return Html::a('<i class="glyphicon glyphicon-export"></i>', $url, ['class' => 'btn btn-default', 'data-pjax' => 0, 'target' => "_blank"]);
                        //  }
                    },
                    'update' => function($url, $model, $key) {
                         if ($model->program_status_id == 3) {
                        return Html::a('<i class="glyphicon glyphicon-off"></i>', $url, ['class' => 'btn btn-default', 'data-pjax' => 0,]);
                         }
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
