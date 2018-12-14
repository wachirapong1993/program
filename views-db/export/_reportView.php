<?php

use yii\helpers\Html;

//print_r($model);
//
//die();
//print_r($model);
//echo $modelS->id;
?>

<div style="border: 2px solid โค้ตสีกรอบ; overflow: auto; width: 100%; height: auto; text-align: center;" >
    <body>
        <table  width="100%" border="1">
            <tr>
                <td   align="center" rowspan="3" ><b>ใบบันทึกการใส่ Part SMT/ RADIAL / AXIAL ( Up Part )</td>


                </td>
            </tr>

            <tr>
                <td align="center" colspan="1">Approved <br>OP Sup.</td>
                <td  align="center"  colspan="1">Checked <br>QC</td>
                <td align="center" colspan="1">Checked <br>OP Leader</td>
                <td align="center" colspan="1">Prepared <br>OP</td>

            </tr>
            <tr>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1" >&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</td>

            </tr>
            <tr>
                <td colspan="5"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Day: &nbsp;&nbsp;<?= Yii::$app->formatter->asDateTime($modelS->created_at, 'php:d') ?> &nbsp;&nbsp;
                    Month: &nbsp;&nbsp;<?= Yii::$app->formatter->asDateTime($modelS->created_at, 'php:m') ?> &nbsp;&nbsp;
                    Year: &nbsp;&nbsp;<?= Yii::$app->formatter->asDateTime($modelS->created_at, 'php:Y') ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    <?= $modelS->startMain->line->line->name ?>&nbsp;&nbsp; Model: <?= $modelS->startMain->program->modelsP->name ?> &nbsp;&nbsp;
                    Machine: <?= $modelS->programDetail->tableMachine->machine->name ?>&nbsp;&nbsp;   <?= $modelS->programDetail->tableMachine->table->name ?>
                    &nbsp;&nbsp;Page: 

                </td>


            </tr>


        </table>
        <table  width="100%" border="1">
            <tr>
                <th align="center">No.</th>
                <th  align="center">Exsample <br>Part</th>
                <th align="center">Feeder No.</th>
                <th align="center">Part No.</th>
                <th align="center">Item Celco</th>

                <th align="center">Lot No.</th>
                <th align="center">Body code<br>Number</th>
                <th align="center">Part Value</th>
                <th align="center">ROHS</th>
                <th align="center">Board No.</th>
                <th align="center">Change Time</th>
                <th align="center">OP</th>
                <th align="center">QC</th>
                <th align="center">Status</th>

            </tr>
            <?php
            $i = 1;
            foreach ($model as $data):
                ?>
                <tr>
                    <td  align="center" style="height: 30px;"><?= $i ?></td>
                    <td align="center" style="width: 150px;"></td>
                    <td align="center" style="width: 10px;"><?= $data->feeder->feederPoint->id ?><?= $data->feeder->direction->name ?></td>
                    <td align="center" style=""><?= $data->item->part_no ?></td>
                    <td align="center" style=""><?= $data->item->celco_code ?></td>
                    <td align="center" style="width: 100px;"><?= $data->lot_no ?></td>
                    <td align="center"><?= $data->startProgram->programDetail->programItem->comment ?></td>
                    <td align="center" style="width: 50px;"></td>

                    <td align="center" style="width: 10px;">OK</td>

                    <td align="center"style="width: 20px;" ></td>
                    <td align="center"><?= Yii::$app->formatter->asDateTime($data->updated_at, 'php:h:i:s') ?></td>
                    <td align="center" style="width: 100px;"  ><?= $data->userCreated->profile->name ?></td>
                    <td align="center" style="width: 100px;"> <?= $data->userUpdated->profile->name ?></td>
                    <td align="center" style="width: 50px;"><?= $data->qcStatus->name?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </table>

    </body>
    <table width="100%" border="1" >
        <tr>
            <th><font size="3"><u>ข้อควรปฎิบัติก่อนทำการต่อ Part</u></font></th>
            <th><font size="3"><u>ข้อควรปฎิบติในการตรวจสอบ Part ที่จะนำมาใส่(ตรวจสอบร่วมกับ QC)</u></font></th>
            <th><font size="3"><u>ข้อควรปฎิบัติในการตรวจสอบ Part ที่ทำการต่อแล้ว</u></font></th>
        </tr>
        <tr>
            <td>
                <font size="2">
                1.ทำการตรวจสอบชื่อ Part จาก Label ของ maker<br>
                2.นำ part ม้วนใหม่เทียบกับ Part ม้วนเก่าเพื่อตรวจสอบว่า นำ Part มาใช้ถูก<br>
                3.นำ Part ม้วนใหม่ เทียบกับ Arrengement Table โดยตรวจสอบชื่อ Part จาก Label ของ Maker ว่าตรงกับ Arrengement Table ทุกตัวอักษร<br>
                4.Part ที่เหลือในม้วนเก่าจะต้องเหลือไม่เกิน 5 รอบ<br>
                5.ทำการตรวจสอบชื่อ Item จาก Label ของ celco ม้วนใหม่กับม้วนเก่าต้องตรงกัน
                </font>
            </td>
            <td> 
                <font size="2">
                6.ทำการตรวจสอบชื่อ Part โดยพนักงานประจำ Line จาก Label ของ Maker
                ด้วยการอ่านตัวอักษรบนม้วน Part ทีละตัวอักษร พร้อมกับพนักงาน QC และตรวจสอบ Body code
                โดยตรวจสอบเทียบกับ Arrengement table <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* ชื่อ Part จะต้องตรงกับ Arrengemet Table ทุกตัวอักษร *<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* ชื่อ Part จะต้องตรงกับ Arrengemet Table ทุกตัวอักษร *
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>

                </font>
            </td>
            <td>
                <font size="2"><p>
                    7.พนักงาน QC ทำการตรวจสอบหมายเลข Feeder โดยไล่ตามสาย Part ลงมา หาม้วน Part ที่จะทำการเปลี่ยน <br>
                    8.ทำการตรวจสอบที่ม้วน Part โดยพนักงาน QC อ่านที่ชื่อ Part ทีละตัวอักษร และพนักงาน OP ตรวจสอบชื่อตาม Arrengement Table ไปพร้อมกัน เมื่อถูกต้องแล้วพนักงาน OP 
                    บันทึกให้ครบถ้วยเพื่อยินยันความถูกต้องให้ครบถ้วน <br>
                    9.ทำการตรวจสอบ Body Code บนตัว Part ว่าตรงตาม Arrengement Table และลงบันทึก<br>
                    10. Axial, Radial เมื่อร่วม Start เครื่องให้ตรวจสอบความถูกต้องทิศทางขั้ว Part บน Board
                    </font>
            </td>
        </tr>
    </table>
    <!--<div style="border: 2px solid โค้ตสีกรอบ; overflow: auto; width: 100%; height: auto; text-align: center;" >-->
    <p align = "left" valign="top" >
        <font size = "2"> 
        <b>
            **ข้อควรระวัง : เพื่อป้องกันการต่อ Part ผิด**            
        </b>
        <br>
        1.ห้ามนำ Part ที่ไม่ได้ใช้ในการต่อ Part มาวางหรือจัดเก็บบนรถต่อ Part และบริเวณต่อ Part โดยเด็ดขาด <br>
        2.ห้ามเก็บ Part ไว้ใน Feeder Gang Support เด็ดขาด
        </font>

    </p>



</div>
<!--<table>
<tr>
    <td>
    
    </td>
    <td>
        <h4>Organization Name</h4>
        <strong><i>Subtitle Here</i></strong><br />
        <small>Address Tel and Email</small>
        <h3>What is this report</h3>
    </td>
</tr>
</table>-->
<!--<table  width="100%" border="1" >

    <tr>
        <td   align="center" rowspan="3" ><b>ใบบันทึกการใส่ Part SMT / RADIAL / ACIAL</b><br></td>

    </tr>



</table>
-->
<!--<table  width="100%" border="1">
  <tr>
      <td align="center" width="100%">HISTORY</td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
      <td style="width: 100px;" colspan="1">Date:</td>
      <td align="center" ><?= Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y'); ?></td>
      <td  align="center" >หมายเหตุ</td>
  </tr>
   <tr>
      <td  colspan="1">Shift:</td>
      <td align="center" ></td>
      <td  align="center" ></td>
  </tr>
   <tr>
      <td  colspan="1">Line:</td>
      <td align="center" ><?= $model->line->line->name ?></td>
      <td  align="center" ></td>
  </tr>
    <tr>
      <td  colspan="1">Time:</td>
      <td align="center" ><?= Yii::$app->formatter->asDateTime($model->created_at, 'php:h:i:s'); ?></td>
      <td  align="center" ></td>
  </tr>
    <tr>
      <td  colspan="1">Nume Of Program: </td>
      <td align="center" ><?= $model->program->name ?></td>
      <td  align="center" ></td>
  </tr>


</table>
<br>
<table  width="100%" border="1" >

  <tr>
      <td   align="center" >Prepared By<br>( OP )</td>
      <td   align="center" >Checked by <br>( Leader OP )</td>
      <td   align="center" >Approved by <br>( Sup OP )</td>
      
  </tr>
  <tr>
      <td style="height: 50px;"   align="center" ></td>
      <td   align="center" ></td>
      <td   align="center" ></td>
      
  </tr>
  
  

</table>-->
