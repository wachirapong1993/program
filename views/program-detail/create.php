<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProgramDetail */

$this->title = 'Create Program Detail';
$this->params['breadcrumbs'][] = ['label' => 'Program Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
