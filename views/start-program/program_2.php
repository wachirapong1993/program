<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scan Joid Part';
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
}');
$this->registerJs('$(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 30000);
});

function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
}');
?>
<style>
    .green {
        color:green;

    }
    .red {
        color:red;
    }
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}
</style>
<?php Pjax::begin(); ?>
<meta http-equiv="refresh" content="30" />
<div class="container-fluid" style="overflow-x:auto;">
    <button onclick="myFunction()" class="btn btn-warning">Refresh</button>

    <script>
        function myFunction() {
            location.reload();
        }
    </script>
    <h1><?= Html::encode($this->title) ?></h1>
    <input class="form-control" type="text" id="searchTerm" onkeyup="doSearch()" placeholder="Search for Part No..." title="Type in a Part No."autofocus>
    <table id="dataTable" class="table table-striped table-bordered">



        <thead>
        <!--<th class="text-center">ID</th>-->
        <th class="text-center"style="max-width: 150px;" >Feeder</th>
        <th class="text-center"style="max-width: 150px;" >Scan Feeder</th>
        <th class="text-center"style="max-width: 150px;" >Status</th>
        <th class="text-center"style="max-width: 150px;" >Celco_Item</th>
        <th class="text-center"style="max-width: 150px;" >Part No.</th>
        <th class="text-center"style="max-width: 150px;" >Scan Part No.</th>
        <th class="text-center"style="max-width: 150px;" >Status</th>
        <th class="text-center"style="max-width: 150px;" >Input Lotno.</th>
        <th class="text-center"style="max-width: 150px;" >Input Qulity</th>
        <th class="text-center"style="max-width: 150px;" >Qc  Confirm</th>
<!--        <th class="text-center">Action</th>-->
        </thead>
        <?php
        //$model = $id;
        // $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
        //   print_r($model);
        foreach ($model as $data):
        //    $dataid = $data->id;
        ?>
        <tbody  id="table" >
            <tr >
                <!--<td class="text-center"><?= $data->id ?></td>-->
                <td class="text-center"style="max-width: 150px;"  ><?= $data->feeder->barcode_feeder ?></td>
                <td class="text-center"style="max-width: 150px;" >
                    <?php if ($data->check_feeder == 1): ?> 
                        <?= Html::beginForm(['start-program/joid-check-feeder'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('stfring'), ['class' => 'form-control','style'=>'width:100px']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                    <?php else: ?>
                    <?php endif; ?>
                </td>
                <td class="text-center"style="max-width: 150px;" ><?= $data->check_feeder == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>
                <td class="text-center"style="max-width: 150px;" ><?= $data->item->celco_code ?></td>
                <td class="text-center"style="max-width: 150px;" ><?= $data->item_id ?></td>

                <td class="text-center"style="max-width: 150px;" >
                    <?php if ($data->check_part == 1): ?> 
                        <?= Html::beginForm(['start-program/joid-check-part'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control','style'=>'width:100px']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                    <?php else: ?>
                    <?php endif; ?>
                </td>
                <td class="text-center"style="max-width: 150px;" ><?= $data->check_part == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>
                <td class="text-center"style="max-width: 150px;" >
                    <?php if ($data->lot_no == null): ?> 
                        <?= Html::beginForm(['start-program/joid-add-lot'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control','style'=>'width:100px']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                    <?php else: ?>
                        <?= $data->lot_no ?>
                    <?php endif; ?>
                </td>

                <td class="text-center"style="max-width: 150px;" >
                    <?php if ($data->total == null): ?> 
                        <?= Html::beginForm(['start-program/joid-add-total'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control','style'=>'width:100px']) ?>
                        <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                        <?= Html::endForm() ?>
                    <?php else: ?>
                        <?= $data->total ?>
                    <?php endif; ?>
                </td>
                <td class="text-center"style="max-width: 150px;" ><?= $data->qc_status_id == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>

            </tr>
        </tbody>
        
        <?php  endforeach; ?>
    </table>
      <?= Html::a('Back', ['/start-main/index'], ['class' => 'btn btn-danger']) ?>
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