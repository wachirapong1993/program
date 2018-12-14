<?php

namespace app\controllers;

use Yii;
use app\models\StartMain;
use app\models\StartMainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use app\models\Customer;
use app\models\ModelsP;
use app\models\Program;
use kartik\mpdf\Pdf;
use mPDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

//use PhpOffice\PhpWord\IOFactory;

/**
 * StartMainController implements the CRUD actions for StartMain model.
 */
class StartMainController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionWord($id) {
        $model = StartMain::findOne($id);
      
        // \PhpOffice\PhpWord\Writer\Word2007\Part\Settings::setTempDir(Yii::getAlias('@webroot').'/temp/');
        Settings::setTempDir(Yii::getAlias('@webroot') . '/temp/'); //กำหนด folder temp สำหรับ windows server ที่ permission denied temp (อย่ายลืมสร้างใน project ล่ะ)
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . '/msword/template_in.docx');
        //      $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . '/msword/template_in.docx'); //เลือกไฟล์ template ที่เราสร้างไว้
        //  $templateProcessor->setValue('doc_department', 'สำนักเทคโนโลยีสารสนเทศ');//อัดตัวแปร รายตัว
        $templateProcessor->setValue(
                [
            'model',
            'customer',
            'rev',
            'date',
            'line',
            'time',
            'program',
                // 'emp_job'
                ], [
            $model->modelsP->name,
            $model->modelsP->customer->name,
            $model->program->rev,
            Yii::$app->formatter->asDateTime($model->created_at, 'php:d-m-Y'),
            // $model->lastName,
            $model->line->line->name,
            Yii::$app->formatter->asDateTime($model->created_at, 'php:h:i:s'),
            $model->program->name,
        ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน
        //$templateProcessor->setValue('emp_employeeNumber', '1002'); การ setValue ทีล่ะตัว
        $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/msword/ms_word_result.docx'); //สั่งให้บันทึกข้อมูลลงไฟล์ใหม่


        echo '<p>';
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']); //สร้าง link download
        echo '</p>';
        //ลองให้ google doc viewer แสดงข้อมูลไฟล์ให้เห็นผ่าน iframe (อาจเพี้ยนๆ บ้าง)
        echo '<iframe src="http://docs.google.com/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
    
        
    }

    // show in browser                        
//   public function actionPds(){
//        $mpdf=new mPDF();
//        $mpdf->WriteHTML($this->renderPartial('pdf_1'));
//        $mpdf->Output('MyPDF.pdf', 'D');
//        exit;
//    }
// 
//    // download     
//    public function actionForceDownloadPdf(){
//        $mpdf=new mPDF();
//        $mpdf->WriteHTML($this->renderPartial('pdf_1'));
//        $mpdf->Output('MyPDF.pdf', 'D');
//        exit;
//    }

    /**
     * Lists all StartMain models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StartMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StartMain model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StartMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StartMain();

        if ($model->load(Yii::$app->request->post())) {
//            if ($model->save()) {
//                $programD = \app\models\ProgramDetail::find()->where(['program_id' => $model->program_id])->all();
//            }
            $model->program_status_id = 3;
            $model->save();


            //  die();
            return $this->redirect(['start-program/create',
                        'id' => $model->program_id,
                        'main_start' => $model->id,
            ]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing StartMain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('_formupdate', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StartMain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StartMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StartMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StartMain::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    ///////////////////////////////////////depdop Program_1//////////////////////////////////////////////

    public function actionGetModels() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $customer_id = $parents[0];
                $out = $this->getModels($customer_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetLine() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models = empty($ids[1]) ? null : $ids[1];
            //$line = empty($ids[2]) ? null : $ids[2];
            if ($customer_id != null) {
                $data = $this->getLine($models);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetProgram() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models = empty($ids[1]) ? null : $ids[1];
            $line = empty($ids[2]) ? null : $ids[2];
            if ($customer_id != null) {
                $data = $this->getProgram($line);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

//    public function actionGetProgram() {
//        $out = [];
//        if (isset($_POST['depdrop_parents'])) {
//            $ids = $_POST['depdrop_parents'];
//            $customer_id = empty($ids[0]) ? null : $ids[0];
//            $models = empty($ids[1]) ? null : $ids[1];
//            $line = empty($ids[2]) ? null : $ids[2];
//            $machine = empty($ids[3]) ? null : $ids[3];
//            if ($customer_id != null) {
//                $data = $this->getprogram($machine);
//                echo Json::encode(['output' => $data, 'selected' => '']);
//                return;
//            }
//        }
//        echo Json::encode(['output' => '', 'selected' => '']);
//    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////QUERY MODEL DEPDOP//////////////////////////////////////////////////
    protected function getModels($id) {
        $datas = \app\models\ModelsP::find()->where(['customer_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getLine($id) {
        $datas = \app\models\ModelsLine::find()->where(['models_p_id' => $id])->all();
        return $this->MapData($datas, 'id', 'title');
    }

    protected function getProgram($id) {
        $datas = \app\models\Program::find()->where(['Line_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

//    protected function getProgram($id) {
//        $datas = \app\models\Program::find()->where(['machine_id' => $id])->all();
//        return $this->MapData($datas, 'id', 'name');
//    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// MAP DEPDOP/////////////////////////////////////////////////////

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
