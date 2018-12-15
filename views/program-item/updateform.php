<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DepDrop;


?>
<div class="program-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'layout' => 'horizontal']); ?>



	<?=

	$form->field($model, 'models')->widget(Select2::classname(), [
		
		//'name' => 'ddl-models',
		'language' => 'th',
		'data' => ArrayHelper::map(app\models\Program::find()->all(), 'id', 'name','modelsP.customer.name'),
		'options' => [
			'placeholder' => 'Select Program',
			'id'=>'ddl-models',
		],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);
		?>
		<?=
		$form->field($model, 'tblmc')->widget(DepDrop::classname(), [
			'options' => ['id' => 'ddl-line'],
			'data' => [],
			'pluginOptions' => [
				'depends' => ['ddl-models'],
				'placeholder' => 'Select Table...',
				'url' => Url::to(['/program-item/get-table'])
			]
		])->label('Table');
		?>
		<?= $form->field($modelImport, 'fileImport')->fileInput() ?>













		<div class="form-group">
			<div class="col-xs-4">

			</div>
			<div class="col-xs-4">
				<?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sx']) ?>
				<?= Html::a('Back', ['/program-item/index'], ['class' => 'btn btn-danger']) ?>
			</div>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>