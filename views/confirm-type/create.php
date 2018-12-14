<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConfirmType */

$this->title = 'Create Confirm Type';
$this->params['breadcrumbs'][] = ['label' => 'Confirm Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirm-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
