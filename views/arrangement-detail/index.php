<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArrangementDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arrangement Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arrangement-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Arrangement Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'arrangement_id',
            'item_celco_code',
            'feeder_id',
            'comment',
            //'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
