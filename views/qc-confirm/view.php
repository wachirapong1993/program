<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\QcConfirm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qc Confirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-confirm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'check_feeder',
            'check_part',
            'qc_emp',
            'start_detail_id',
            'created_at',
            'feeder',
            'part_no',
            'qc_status',
        ],
    ]) ?>

</div>
