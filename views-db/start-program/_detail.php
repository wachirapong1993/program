<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id' => "pjax-{$id}", 'enablePushState' => false]); ?>

<?= GridView::widget([
    // ....
]) ?>

<?php Pjax::end(); ?>