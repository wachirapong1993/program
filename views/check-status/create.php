<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CheckStatus */

$this->title = 'Create Check Status';
$this->params['breadcrumbs'][] = ['label' => 'Check Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
