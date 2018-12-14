<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeederPoint */

$this->title = 'Create Feeder Point';
$this->params['breadcrumbs'][] = ['label' => 'Feeder Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feeder-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
