<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TableMachine */

$this->title = 'Create Table Machine';
$this->params['breadcrumbs'][] = ['label' => 'Table Machines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-machine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
