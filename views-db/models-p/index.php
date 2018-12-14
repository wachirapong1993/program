<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModelsPSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models Ps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-p-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Models P', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            [
                'label'=>'Model',
                'attribute'=>'name',
                'value'=>'name',
            ],
            [
                'label'=>'Customer',
                'attribute'=>'customer_id',
                'value'=>'customer.name',
            ],
            //'customer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
