<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Feeder */

$this->title = 'Create Feeder';
$this->params['breadcrumbs'][] = ['label' => 'Feeders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feeder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
      //  'modelImport' => $modelImport,
    ]) ?>

</div>
