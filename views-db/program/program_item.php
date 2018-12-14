<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\StartDetailSearch;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Program Items';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-item-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            //   'program_detail_id',
            [
                'label' => 'TBL',
                'attribute' => 'tbl',
                'value' => 'programDetail.program.name',
                'hAlign' => 'center',
                'group' => true, // enable grouping
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'Feeder Point',
                'attribute' => 'feeder_id',
                'value' => 'feeder.feeder_point_id',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'Direction',
                'attribute' => 'feeder_id',
                'value' => 'feeder.direction.name',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
            [
                'label' => 'Celco_code',
                'attribute' => 'part_no',
                'value' => 'partNo.celco_code',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
            [
                'label' => 'Part_no',
                'attribute' => 'part_no',
                'value' => 'part_no',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //'width' => '100px',
            ],
            [
                'label' => 'comment',
                'attribute' => 'comment',
                'value' => 'comment',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            //   'width' => '100px',
            ],
            [
                'label' => 'Amount',
                'attribute' => 'amount',
                'value' => 'amount',
                'hAlign' => 'center',
            // 'vAlign' => 'middle',
            // 'width' => '100px',
            ],
//        'feeder.barcode_feeder',
//        'comment:ntext',
//        'amount',
//        'part_no',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
