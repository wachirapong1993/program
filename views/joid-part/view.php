<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JoidPart */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Joid Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joid-part-view">

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
            'lot_no',
            'total',
            'qc_status_id',
            'feeder_id',
            'item_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'start_detail_id',
        ],
    ]) ?>

</div>
