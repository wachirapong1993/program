<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*'celco_code',
            'part_no',
            'part_name',*/
             [
                'label'=>'Part No',
                'attribute'=>'part_no',
                'value'=>'part_no',
            ],
             [
                'label'=>'Part Name',
                'attribute'=>'part_name',
                'value'=>'part_name',
            ],
            [
                'label'=>'Celco code',
                'attribute'=>'celco_code',
                'value'=>'celco_code',
            ],
            [
                'label'=>'Description',
                'attribute'=>'description',
                'value'=>'description',
            ],
            [
                'label'=>'Part Size',
                'attribute'=>'part_size',
                'value'=>'part_size',
            ],
          /*  [
                'label'=>'Position',
                'attribute'=>'position',
                'value'=>'position',
            ],*/
          //  'part_type',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
