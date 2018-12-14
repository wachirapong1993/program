<?php

use yii\helpers\Html;

//print_r($model);
//
//die();
//print_r($model);
//echo $model->id;

$modelD = \app\models\ProgramDetail::findOne($model);

$favcolor = "blue";
?>

<div style="border: 2px solid โค้ตสีกรอบ; overflow: auto; width: 100%; height: auto; text-align: center;" >
    <body>
        <table  width="100%" border="1">
            <tr>
                <td align="center" colspan="1" ><b>Customer: <?= $modelS->program->modelsP->customer->name ?></td>
                <td align="center" colspan="4" ><b>Part Arrangement Table : <?= $modelS->tableMachine->line->name ?> </td>
                <td align="center" colspan="1">Approved <br>(QC)</td>
                <td align="center"  colspan="1">Checked <br>(OP)</td>
                <td align="center" colspan="1">Checked <br>(EN)</td>
                <td align="center" colspan="1">Prepared <br>(EN)</td>

            </tr>

            <tr>
                <td   align="center" colspan="1" ><b><?= $modelS->tableMachine->table->name ?></b> </td>
                <td   align="center" colspan="4" ><b>Name of Machine : <?= $modelS->tableMachine->machine->name ?> </b></td>
                <td rowspan="2"></td>
                <td rowspan="2" ></td>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
            </tr>
<!--            <tr>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1" >&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>

            </tr>-->
            <tr>
                <td   align="center" colspan="1" ><b>Date:<?php
                        $time = time();
                        Yii::$app->formatter->locale = 'th_TH';
                        echo Yii::$app->formatter->asDate($time, 'short');
                        ?> </td>
                <td   align="center" colspan="4" ><b>Name of Program: <?= $modelS->program->name ?> </td>


            </tr>
            <tr>
                <td   align="center" colspan="1" ><b>Name of PCB :<br><?= $modelS->program->pcb->name ?></td>
                        <td   align="center" colspan="4" ><b>MODEL NO: <BR><?= $modelS->program->modelsP->name ?></B></td>
                        <td   align="center" colspan="3" ><b>LOCTITE:</b><br><?= $modelS->solder_paste . '<br>' ?></td>
                        <td align="center" colspan="1">Rev. <br><?= $modelS->program->rev ?></td>
                        <!--//<td   align="center" colspan="1" ><b>Part Arrangement Table: </td>-->


            </tr>


        </table>
        <table  width="100%" border="1">
            <tr>
                <th align="center" colspan="2" >Z No.</th>
                <th align="center" colspan="1" >Feeder</th>
                <th align="center" colspan="1" >Part No.</th>
                <th align="center" colspan="1" >Celco code</th>
                <th align="center" colspan="1" >Polarity</th>
                <th align="center" colspan="1" >Body Code</th>
                <th align="center" colspan="1" >Amount</th>


            </tr>
            <?php
            $programItem = \app\models\ProgramItem::find()->where(['program_detail_id' => $modelS->id])->all();
            foreach ($programItem as $data):
                ?>
                <tr>
                    <td align="center" colspan="1" style="width: 50px;"><?= $data->feeder->feederPoint->id ?></td>
                    <td align="center" colspan="1" style="width: 50px;"><?= $data->feeder->direction->name ?></td>
                    <td align="center" colspan="1" style="width: 80px;"><?= $data->size ?></td>
                    <td align="center" colspan="1" style="width: 200px;"><?= $data->partNo->part_no ?></td>
                    <td align="center" colspan="1" style="width: 100px;"><?= $data->partNo->celco_code ?></td>
                    <td align="center" colspan="1"></td>
                    <td align="center" colspan="1"><?= $data->comment ?></td>
                    <td align="center" colspan="1"><?= $data->amount ?></td>
                </tr>
            <?php endforeach; ?>
        </table>


