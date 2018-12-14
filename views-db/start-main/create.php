<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StartMain */

$this->title = 'CREATE UP PART';
$this->params['breadcrumbs'][] = ['label' => 'Start Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
