<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StartDetail */

$this->title = 'Create Start Detail';
$this->params['breadcrumbs'][] = ['label' => 'Start Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
