<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pcb */

$this->title = 'Create Pcb';
$this->params['breadcrumbs'][] = ['label' => 'Pcbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
