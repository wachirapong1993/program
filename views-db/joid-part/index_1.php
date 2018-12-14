<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\StartDetailSearch_1;
use yii\helpers\Url;
//use yii\
/* @var $this yii\web\View */
/* @var $searchModel app\models\StartProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Joid Part';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    

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
            } elseif ($model->program_status_id == 2) {
                return ['class' => 'success'];
            } elseif ($model->program_status_id == 3) {
                return ['class' => 'warning'];
//            } elseif ($model->Status == 4) {
//                return ['class' => 'success'];
            }
        },
        //
        //  'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        // 'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        //   'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                  //  echo $model->id.'<br>';

                    $searchModel = new StartDetailSearch_1();
                    $searchModel->start_program_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    // $modelsum = new \app\models\BomSum();
                    return Yii::$app->controller->renderPartial('index_start', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                    //           'modelsum' => $modelsum,
                    ]);
                },
            ],
            //      ['class' => 'yii\grid\SerialColumn'],
            //'id',
//            [
//                'label' => 'Employee_Code',
//                'attribute' => 'emp_code',
//                'value' => 'emp_code'
//            ],
            [
                'label' => 'Employee',
                'attribute' => 'emp_code',
                'value' => 'user.username',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '100px',
            ],
            [
                'label' => 'Program TBL',
                'attribute' => 'program_detail_id',
                'value' => 'programDetail.title',
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
                'label' => 'Status',
                'attribute' => 'program_status_id',
                'value' => 'programStatus.name',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '250px',
                'filter' => ArrayHelper::map(app\models\ProgramStatus::find()->asArray()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'vAlign' => 'middle',
                'width' => '250px',
                'value' => function($model, $key, $index, $column) {
                    return Yii::$app->formatter->asDate($model->created_at, 'long'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            //  'emp_code',
            //    'program_detail_id',
            //  'program_status_id',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttonOptions' => ['class' => 'btn btn-default'],
//                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{program1}</div>',
//                'options' => ['style' => 'width:150px;'],
//                'buttons' => [
//                    'program1' => function($url, $model, $key) {
//                        return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
//                    }
//                ]
//            ],
        ],
    ]);
    ?>
</div>
