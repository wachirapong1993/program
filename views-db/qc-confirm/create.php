<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QcConfirm */

$this->title = 'Create Qc Confirm';
$this->params['breadcrumbs'][] = ['label' => 'Qc Confirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-confirm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
