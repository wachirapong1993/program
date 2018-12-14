<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
//                    //  echo $model->id.'<br>';
//
//                    $searchModel = new app\models\ProgramDetailSearch();
//                    $searchModel->program_id = $model->id;
//                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                    // $modelsum = new \app\models\BomSum();
//                    return Yii::$app->controller->renderPartial('program_detail', [
//                                'searchModel' => $searchModel,
//                                'dataProvider' => $dataProvider,
//                                    //           'modelsum' => $modelsum,
//                    ]);
//                },
//            ],
            //'id',
            [
                'label' => 'Program',
                'attribute' => 'name',
                'value' => 'name'
            ],
//            [
//                'label' => 'Program_detail',
//                'attribute' => 'pcb_id',
//                'value' => 'pcb.name'
//            ],
//            'name',
//            'pcb_id',
            'rev',
           // 'program_status_id',
            //'models_p_id',
          [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{excel}</div>',
                'options' => ['style' => 'width:150px;'],
                'buttons' => [
                    'joid-part/update' => function($url, $model, $key) {
                    if ($model->qc_status_id == 1) {
                        return Html::a('<i class="glyphicon glyphicon-random"></i>', $url, ['class' => 'btn btn-default']);
                    }
                          
//                        } elseif ($model->use_status == 1) {
//                            return Html::a('<i class="glyphicon glyphicon-ok"></i>', $url, ['class' => 'btn btn-default']);
//                        } elseif ($model->use_status == 2) {
//                            return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, ['class' => 'btn btn-default']);
//                        }
                    },
                      'excel' => function($url, $model, $key) {
                  
                        return Html::a('<i class="glyphicon glyphicon-save-file"></i>', $url, ['class' => 'btn btn-default xl']);
            
                    }
                ]
            ],
        ],
    ]);
    ?>
</div>
