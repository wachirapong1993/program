<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//echo $id;
//$main;
//$table = \app\models\StartProgram::find()->where(['start_main_id' => $id])->all();
////print_r($main);
//foreach ($table as $value) {
//    echo 'Program: ' . $value->startMain->program->name . '<br>';
//    echo 'Main: ' . $value->programDetail->tableMachine->table->name . '<br>';
//    $detail = app\models\StartDetail::find()->where(['start_program_id' => $value->id])->all();
//    foreach ($detail as $values) {
//        echo '<table class="table">';
//        echo '  <thead>';
//        echo '    <tr>';
//        echo '  <th scope = "col">ID</th>';
//        echo '  <th scope = "col">Feeder</th>';
//        echo '  <th scope = "col">part_no</th>';
//        echo '  <th scope = "col">Lot</th>';
//        echo '  <th scope = "col">Total</th>';
//        echo '  </thead>';
//        echo '    </tr>';
//
//        echo ' <tbody>';
//        echo '<tr>';
//        echo '<th scope = ".">' . $values->id . '</th>';
//        echo '<td>' . $values->feeder->barcode_feeder . '</td>';
//        echo '<td>' . $values->part_no . '</td>';
//        echo ' <td>' . $values->lot_no . '</td>';
//        echo ' <td>' . $values->total . '</td>';
//       // echo ' <td>' . $values->lot_no . '</td>';
//        echo '</tr>';
//        echo '</table>';
//        //  echo $values->feeder->barcode_feeder . ' ' . $values->part_no . ' < br>';
//    }
//}
//die();
$this->title = 'Scan Details';
$this->params['breadcrumbs'][] = $this->title;
//print_r($id);
//die();p
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
                for(i = 0;
                i < tr.length;
                i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if(td) {
                if(td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                } else {
                tr[i].style.display = "none";
                }
                }
                }
                }');
?>
<style>
    .green {
        color:green;

    }
    .red {
        color:red;
    }
</style>

<?php Pjax::begin(); ?>

<div class="container-fluid"style="overflow-x:auto;">

    <script>
//        function myFunction() {
//            location.reload();
//        }
    </script>
    <?php $stp = \app\models\StartProgram::findOne($id); ?>
    <div class="alert alert-success" role="alert"> <h1><?= Html::encode($this->title) ?></h1> Program : <?= $stp->programDetail->program->name ?><br>TBL : <?= $stp->programDetail->tableMachine->table->name ?></div>

    <input class="form-control" type="text" id="searchTerm" onkeyup="doSearch()" placeholder="Search for Part No..." title="Type in a Part No."autofocus>
    <table id="dataTable" class="table table-striped table-bordered">



        <thead>
        <!--<th class="text-center">ID</th>-->
        <!--<th class="text-center" >ID</th>-->

        <th class="text-center">Celco_Item</th>
        <th class="text-center">Part No.</th>
        <th class="text-center">Scan Part No.</th>
        <th class="text-center">Status</th>
        <th class="text-center" >Feeder</th>
        <th class="text-center">Scan Feeder</th>
        <th class="text-center">Status</th>
        <th class="text-center">Input Lotno.</th>
        <th class="text-center">Input Qulity</th>
        <th class="text-center">Qc  Confirm</th>
        <!--<th class="text-center">Action</th>-->
<!--        <th class="text-center">Action</th>-->
        </thead>
        <?php
//$model = $id;

        $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
//   print_r($model);
        foreach ($model as $data):
            //           if ($data->total != 0 and $data->item->partType->id = 1):
//                $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->Where('feeder_id')->all();
//                foreach ($model as $data){
//                    echo $data->id.'<br>';
//                }
//                echo '555';
            //  $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
            //   die();
            $dataid = $data->id;
            ?>
            <tbody  id="table" >
                <tr >
                    <!--<td class="text-center"><?= $data->id ?></td>-->
                    <td class="text-center"><?= $data->item->celco_code ?></td>
                    <td class="text-center"><?= $data->part_no ?></td>

                    <td class="text-center">
                        <?php if ($data->check_part == 1): ?> 
                            <?= Html::beginForm(['start-program/check-part'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                            <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control', 'style' => 'width:100px']) ?>
                            <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                            <?= Html::endForm() ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= $data->check_part == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>

                    <td class="text-center" ><?= $data->feeder->barcode_feeder ?></td>
                    <td class="text-center">
                        <?php if ($data->check_feeder == 1): ?> 
                            <?= Html::beginForm(['start-program/check-feeder'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                            <?= Html::input('text', 'string', Yii::$app->request->post('stfring'), ['class' => 'form-control', 'style' => 'width:100px']) ?>
                            <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                            <?= Html::endForm() ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= $data->check_feeder == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>
                    <td class="text-center">
                        <?php if ($data->lot_no == null): ?> 
                            <?= Html::beginForm(['start-program/add-lot'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                            <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control', 'style' => 'width:100px']) ?>
                            <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                            <?= Html::endForm() ?>
                        <?php else: ?>
                            <?= $data->lot_no ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($data->total == null): ?> 
                            <?= Html::beginForm(['start-program/add-total'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                            <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control', 'style' => 'width:100px']) ?>
                            <?= Html::hiddenInput('id', "$data->id", Yii::$app->request->post('id'), ['class' => 'form-control']) ?>  
                            <?= Html::endForm() ?>
                        <?php else: ?>
                            <?= $data->total ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= $data->qc_status_id == 2 ? "<i class=\"glyphicon glyphicon-ok green\"></i>" : "<i class=\"glyphicon glyphicon-remove red\"></i>"; ?></td>
<!--                    <td class="text-center">
                        <?php if ($data->total == null): ?> 

                            <?= Html::a("<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>", ['qc-confirm/delete', 'id' => $data->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
                        <?php endif; ?>           

                    </td>-->
                </tr>
            </tbody>



        <?php endforeach; ?>
    </table>
    <?= Html::a('Back', ['/start-main/index'], ['class' => 'btn btn-danger']) ?>
    <button onclick="myFunction()" class="btn btn-warning">Refresh</button>
    <?php
    echo Html::a('<i class = "glyphicon glyphicon-save-file"></i> Next', ['/start-program/nexts', 'id' => $stp->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to Next this item?',
            'method' => 'post',
        ],
        //   'target' => '_blank',
        //a 'data-toggle' => 'tooltip',
        'title' => 'Will open the generated PDF file in a new window'
    ]);
    ?>

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
                targetTable.rows.item(rowIndex).style.display = 'table-row                                                    ';
        }
    }

</script>