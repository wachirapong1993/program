<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StartDetail */



$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Start Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <?php foreach ($model as $model) : ?>
        <?=
        DetailView::widget([
            'model' => $model,
            'condensed' => true,
            'hover' => true,
            'mode' => DetailView::MODE_VIEW,
            'panel' => [
                'heading' => 'Book # ' . $model->id,
                'type' => DetailView::TYPE_INFO,
            ],
            'attributes' => [
                // 'id',
                // 'startProgram.emp_code',
                //   'feeder.name',
                [
                    'attribute' => 'sacn_feeder',
                    'updateMarkup' => function($form, $widget) {
                        $model = $widget->model;
                        return $form->field($model, 'sacn_feeder', [
                                    'addon' => [
                                        'append' => [
                                            'content' => Html::button('Go', ['class' => 'btn btn-primary']),
                                            'asButton' => true
                                        ]
                                    ]
                        ]);
                    }
                ],
                //  'sacn_feeder',
                'check_feeder',
                'check_part',
                'part_no',
                'qc_status_id',
                'lot_no',
                'total',
            ],
        ])
        ?>
    <?php endforeach; ?>
</div>
