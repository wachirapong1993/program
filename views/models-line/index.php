<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelsLineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models Lines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-line-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Models Line', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
                'label'=>'Models',
                'attribute'=>'models_p_id',
                'value'=>'modelsP.name'
            ],
         //   'models_p_id',
            [
                'label'=>'Line',
                'attribute'=>'Line_id',
                'value'=>'line.name',
            ],
          //  'Line_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
