<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartType */

$this->title = 'Create Part Type';
$this->params['breadcrumbs'][] = ['label' => 'Part Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
