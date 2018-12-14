<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArrangementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arrangements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arrangement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Arrangement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pcb_id',
            'program_detail_id',
            'created_date',
            'solder_paste',
            //'rev',
            //'Line_id',
            //'machine_id',
            //'table_machine_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
