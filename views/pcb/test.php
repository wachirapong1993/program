<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
?>

<?php Pjax::begin(); ?>
<?= Html::beginForm(['pcb/test'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
<?= Html::submitButton('Hash String', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
<?= Html::endForm() ?>
<h3><?= $stringHash ?></h3>
<?php Pjax::end(); ?>

