<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Program Details';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-detail-index">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    //  echo $model->id.'<br>';

                    $searchModel = new app\models\ProgramItemSearch();
                    $searchModel->program_detail_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    // $modelsum = new \app\models\BomSum();
                    return Yii::$app->controller->renderPartial('program_item', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                    //           'modelsum' => $modelsum,
                    ]);
                },
            ],
            //'id',
            'title',
            //  'barcode',
        //    'program_id',
            'solder_paste:ntext',
            //'table_machine_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
