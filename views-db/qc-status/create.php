<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QcStatus */

$this->title = 'Create Qc Status';
$this->params['breadcrumbs'][] = ['label' => 'Qc Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
