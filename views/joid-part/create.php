<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JoidPart */

$this->title = 'Create Joid Part';
$this->params['breadcrumbs'][] = ['label' => 'Joid Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joid-part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
