<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Line */

$this->title = 'Create Line';
$this->params['breadcrumbs'][] = ['label' => 'Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
