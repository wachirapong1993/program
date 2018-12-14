<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProgramItem */

$this->title = 'Create Program Item';
$this->params['breadcrumbs'][] = ['label' => 'Program Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
