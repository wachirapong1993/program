<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StartProgram */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Start Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-program-view">

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
            'emp_code',
            'program_detail_id',
            'program_status_id',
       
        ],
    ]) ?>

</div>
