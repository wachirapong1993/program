<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Program */

$this->title = 'Create Program Item';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_from_programD', [
        'model' => $model,
        'modelD' => $modelD,
    ]) ?>

</div>
