<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QcConfirmJoid */

$this->title = 'Create Qc Confirm Joid';
$this->params['breadcrumbs'][] = ['label' => 'Qc Confirm Joids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qc-confirm-joid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
