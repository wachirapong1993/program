<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModelsLine */

$this->title = 'Create Models Line';
$this->params['breadcrumbs'][] = ['label' => 'Models Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
