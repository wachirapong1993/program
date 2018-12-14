<?php

namespace app\controllers;

//use PhpOffice\PhpWord\IOFactory;
//use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
//use PhpOffice\PhpWord\PhpWord;
//use PhpOffice\PhpWord\Settings;
use app\models\StartMain;
use yii\helpers\ArrayHelper;
use yii\web\Response;
//use moonland\phpexcel\Excel;
use kartik\mpdf\Pdf;

class ExportController extends \yii\web\Controller {

    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                    [
                        'class' => 'yii\filters\ContentNegotiator',
                        'only' => ['view', 'index'], // in a controller
                        // if in a module, use the following IDs for user actions
                        // 'only' => ['user/view', 'user/index']
                        'formats' => [
                            'application/json' => Response::FORMAT_JSON,
                        ],
                        'languages' => [
                            'en',
                            'de',
                        ],
                    ],
        ]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionWord($id) {
        $model = StartMain::findOne($id);

        $content = $this->renderPartial('pdf', [
            'model' => $model,
                // 'modelS' => $modelS,
        ]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@app/web/css/pdf.css',
//            @app\web\css\bootstrap.min.css
            // any css to be embedded if required
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['CELCO(THAILAND)CO.,LTD'],
                'SetFooter' => ['CT-AI-FM126'],
            ]
        ]);

        // return the pdf output as per the destination setting
        //$pdf = Yii::$app->pdf;
        // $pdf->content = $Content;
        return $pdf->render();
    }

    public function actionDetail($id) {
        $modelS = \app\models\StartProgram::findOne($id);
        $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
        $content = $this->renderPartial('_reportView', [
            'model' => $model,
            'modelS' => $modelS,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@app/web/css/pdf.css',
            // any css to be embedded if required
            //'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['CELCO(THAILAND)CO.,LTD'],
                'SetFooter' => ['CT-AI-FM126'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionJoid($id) {

        $modelS = \app\models\StartProgram::findOne($id);
        $modelI = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
        $content = $this->renderPartial('_reportView_1', [
            'modelI' => $modelI,
            'modelS' => $modelS,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@app/web/css/pdf.css',
            // any css to be embedded if required
            //'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['CELCO(THAILAND)CO.,LTD'],
                'SetFooter' => ['CT-AI-FM126'],
            ]
        ]);

        // return the pdf output as per the destination setting
//        $pdf->AddPage();
//        $pdf->TOCpagebreak();
        return $pdf->render();
    }

}
