<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scan Details';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 




$this->registerJs("document.getElementById('grid-user').display = 'none';  //Hide the table");
        

?>

<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

<div class="container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>
    <!-- เรียก view _search.php -->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
<?= Html::beginForm(['pcb/test'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?=
    GridView::widget([
        'id' => 'grid-user',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        //  'pjax' => true, // pjax is set to always true for this demo
        //'responsive' => true,
        //      'hover' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // 'start_program_id',
            [
                'header' => 'Feeder',
                'attribute' => 'feeder_id',
//                'vAlign' => 'middle',
//                'hAlign' => 'right',
                'value' => 'feeder.name',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']
            ],
            //'sacn_feeder',
            ['header' => 'Scan Feeder',
                'attribute' => 'sacn_feeder',
                'value' => function($model) {
                    return 
       
        Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']);
                  
                },
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [// แสดงข้อมูลออกเป็น icon
                'attribute' => 'Status',
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model, $key, $index, $column) {
                    return $model->check_feeder == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                }
            ],
            [
                'header' => 'Part No.',
                'attribute' => 'part_no',
//                'vAlign' => 'middle',
//                'hAlign' => 'right',
                'value' => 'item.part_no',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            //'sacn_feeder',
            ['header' => 'Scan Part No.',
                'attribute' => 'sacn_part',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    return Html::textInput('', $model->scan_part);
                },
                'format' => 'raw'
            ],
            [// แสดงข้อมูลออกเป็น icon
                'attribute' => 'Status',
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model, $key, $index, $column) {
                    return $model->check_part == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                }
            ],
            // 'check_feeder',
            //'check_part',
            //  'lot_no',
            ['header' => 'Input Lotno.',
                'attribute' => 'lot_no',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    return Html::textInput('', $model->lot_no);
                },
                'format' => 'raw'
            ],
            //     'total',
            ['header' => 'Input Qulity',
                'attribute' => 'total',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    return Html::textInput('', $model->total);
                },
                'format' => 'raw'
            ],
            //'qc_status_id',
            [// แสดงข้อมูลออกเป็น icon
                'attribute' => 'QC Confirm',
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($model, $key, $index, $column) {
                    return $model->qc_status_id == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                }
            ],
            // 'part_no',
            // 'feeder_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:120px;'],
                'template' => '{copy}',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'contentOptions' => [
                    'noWrap' => true
                ],
                'buttons' => [
                    'copy' => function($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-zoom-in"></i>', $url, ['class' => 'btn btn-default']);
                    }
                ]
            ],
        ],
    ]);
    ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
