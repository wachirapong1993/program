<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModelsP */

$this->title = 'Create Models P';
$this->params['breadcrumbs'][] = ['label' => 'Models Ps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-p-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
