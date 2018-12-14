<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Arrangement */

$this->title = 'Create Arrangement';
$this->params['breadcrumbs'][] = ['label' => 'Arrangements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arrangement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        //  'model' => $model,
        'model' => $model,
        'modela'=>$modela,
        'models' =>  $models,
    ])
    ?>

</div>
