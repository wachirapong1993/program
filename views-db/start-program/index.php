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

$this->title = 'Start Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

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
                return ['class' => 'warning'];
            } elseif ($model->program_status_id == 4) {
                return ['class' => 'success'];
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

                    $searchModel = new StartDetailSearch();
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
                'attribute' => 'created_by',
                'value' => 'user.username',
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
                'filter' => ArrayHelper::map(app\models\ProgramStatus::find()->asArray()->where(['between', 'id', 2, 4 ])->all(), 'id', 'name'),
            // 'filterInputOptions' => ['placeholder' => 'Program'],
            ],
            [
                'label' => 'Date Time',
                'attribute' => 'created_at',
                'format' => 'html',
                'vAlign' => 'middle',
                'width' => '250px',
                'value' => function($model, $key, $index, $column) {
                    return
                            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y H:i:s');
                    //Yii::$app->formatter->asDate($model->created_at, 'short'); //short,medium,long,full
                    //'hAlign' => 'center',
                    //return Yii::$app->formatter->asDateTime($model->created_at,'medium');
                }],
            //  'emp_code',
            //    'program_detail_id',
            //  'program_status_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{program1}{update}{export}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'program1' => function($url, $model, $key) {
                            return Html::a('<i class="glyphicon glyphicon-triangle-right"></i>', $url, ['class' => 'btn btn-default']);
                    },
//                    'export' => function($url, $model, $key) {
//                        return Html::a('<i class="glyphicon glyphicon-save-file"></i>', $url, ['class' => 'btn btn-default']);
//                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
