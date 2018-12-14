<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

//echo $detail;
//die();
/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'QC Confirm';
$this->params['breadcrumbs'][] = $this->title;
//print_r($id);
//die();
$this->registerCss("#myInput {
  background-image: url('../css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}");
$this->registerJs('function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}')
?>
<?php Pjax::begin(); ?>
<div class="container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>
<!--    <input class="form-control" type="text" id="searchTerm" onkeyup="doSearch()" placeholder="Search for Part No..." title="Type in a Part No."autofocus>-->
    <table id="dataTable" class="table table-striped table-bordered">

        <thead>
        <!--<th class="text-center">ID</th>-->
        <th class="text-center">Feeder</th>
        <th class="text-center">Scan Feeder</th>
        <th class="text-center">Status</th>
        <th class="text-center">Part No.</th>
        <th class="text-center">Scan Part No.</th>
        <th class="text-center">Status</th>
        <th class="text-center">Input Lotno.</th>
        <th class="text-center">Input Qulity</th>

        </thead>
<?php
//$model = $id;
$data = \app\models\QcConfirm::findOne($model);
$st_d = $data->id;
// echo $data->id;
//   die();
//   print_r($model);
// foreach ($model as $data):
//   $dataid = $data->id;
?>
        <tbody  id="table" >
            <tr >
                <!--<td class="text-center"><?= $data->id ?></td>-->
                <td class="text-center"><?= $data->startDetail->feeder->name ?></td>
                <td class="text-center">
                    <?= Html::beginForm(['start-program/qc-check-feeder'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                    <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
                    <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                     <?= Html::hiddenInput('detail', "$detail", Yii::$app->request->post('detail'), ['class' => 'form-control']) ?>  
                    <?= Html::endForm() ?>
                </td>
                <td class="text-center"><?= $data->check_feeder == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>"; ?></td>
                <td class="text-center"><?= $data->startDetail->part_no ?></td>
                <td class="text-center">
                    <?= Html::beginForm(['start-program/check-part'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                    <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
                    <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                    <?= Html::endForm() ?>
                </td>
                <td class="text-center"><?= $data->check_part == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>"; ?></td>
                <td class="text-center">
                        <?php if ($data->check_lot == 1): ?> 
                        <?= Html::beginForm(['start-program/add-lot'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                        <?php else: ?>
                        <?= $data->check_lot ?>
                        <?php endif; ?>
                </td>

                <td class="text-center">
<?php if ($data->check_total == 1): ?> 
                        <?= Html::beginForm(['start-program/add-total'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                    <?php else: ?>
                        <?= $data->check_total ?>
                    <?php endif; ?>
                </td>


            </tr>
        </tbody>
<?php // endforeach;  ?>
    </table>
</div>
<?php Pjax::end(); ?>


<script>
    function doSearch() {
        var searchText = document.getElementById('searchTerm').value;
        var targetTable = document.getElementById('dataTable');
        var targetTableColCount;

        //Loop through table rows
        for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
            var rowData = '';

            //Get column count from header row
            if (rowIndex == 0) {
                targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
                continue; //do not execute further code for header row.
            }

            //Process data rows. (rowIndex >= 1)
            for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
                rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
            }

            //If search term is not found in row data
            //then hide the row, else show
            if (rowData.indexOf(searchText) == -1)
                targetTable.rows.item(rowIndex).style.display = 'none';
            else
                targetTable.rows.item(rowIndex).style.display = 'table-row';
        }
    }

</script>