<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Start Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Start Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start_program_id',
            'check_feeder',
            'check_part',
            'lot_no',
            //'total',
            //'qc_status_id',
            //'part_no',
            //'feeder_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
