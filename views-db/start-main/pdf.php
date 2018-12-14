<?php

use yii\helpers\Html;
?>
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
<table  width="100%" border="1" >

    <tr>
        <td   align="center" rowspan="3" ><b>CELCO</b><br>CELCO(THAILAND)CO.,LTD</td>
        <td  align="center" colspan="5">Data Sheet Semple Part <br>Model Change</td>
    </tr>
    <tr>
        <td colspan="2">Model: <?= $model->modelsP->name ?></td>
        <td colspan="3">Total:</td>

    </tr>
    <tr>
        <td colspan="2">Customer: <?= $model->modelsP->customer->name ?></td>
        <td colspan="3">Rev. No:  <?= $model->program->rev ?></td>

    </tr>

</table>
<table  width="100%" border="1">
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
    
    

</table>
