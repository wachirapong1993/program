<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use app\models\Line;
use app\models\Machine;
use app\models\TableMachine;
use app\models\Feeder;
use app\models\Program;
use app\models\ProgramSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use app\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\ModelsLine;
//การออกรายงาน excel จะเรียกใช้ Package 2 ตัวดังนี้
// Microsoft Excel
use PHPExcel;
use PHPExcel_IOFactory;
use kartik\mpdf\Pdf;

/**
 * ProgramController implements the CRUD actions for Program model.
 */
class ProgramController extends Controller {

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

    /**
     * Lists all Program models.
     * @return mixed
     */
    public function actionExport() {
        $model = new Program();

        if ($model->load(Yii::$app->request->post())) {
            $modelS = \app\models\ProgramDetail::findOne($model->name);
            $model = \app\models\ProgramItem::find()->where(['program_detail_id' => $modelS->id])->all();
            $content = $this->renderPartial('_reportView', [
                'model' => $model,
                'modelS' => $modelS,
            ]);


            Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;

            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8,
                // A4 paper format
                
                'filename' => 'Arrangement Table.pdf',
                //set file name
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
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
          //  $pdf->Output('yourFileName.pdf', 'I');
            return $pdf->render();
        }

        return $this->render('export', [
            'model' => $model,
        ]);
    }

    public function actionIndex() {
        $searchModel = new ProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSelect() {
        return $this->render('select');
    }
/**
     * Displays a single Program model.
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
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Program();
        $modelD = new \app\models\ProgramDetail();
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);
        // $modelP = new \app\models\ProgramItem();
        if ($model->load(Yii::$app->request->post()) &&
            $modelD->load(Yii::$app->request->post())
        //   && $modelI->load(Yii::$app->request->post())
        ) {
        
        $model->name = $model->modelsP->name;
        $model->program_status_id = 2;
        $model->save();
        $modelD->title = $model->name . ' ' . $modelD->tableMachine->table->name;
        $modelD->program_id = $model->id;
        $modelD->save();
            //$modelI->program_detail_id = $modelD->id;
            //  $modelI->save();
            // return $this->render(['create_programD', 'id' => $model->id]);
        $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
        if ($modelImport->fileImport && $modelImport->validate()) {
            $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $baseRow = 2;
            while (!empty($sheetData[$baseRow]['A'])) {


                    //   (string) $sheetData[$baseRow]['A'] . '<br>';
                $modelJ = \app\models\Feeder::find()
                ->where('barcode_feeder LIKE :query')
                ->addParams([':query' => (string) $sheetData[$baseRow]['A']])
                ->all();
                    // ->where(['barcode_feeder' => (string) $sheetData[$baseRow]['A'] ])->all();
                    // print_r($modelI);
                foreach ($modelJ as $data) {
                    $modelI = new \app\models\ProgramItem();
                    $modelI->program_detail_id = $modelD->id;
                    $modelI->feeder_id = $data->id;
                    $modelI->part_no = (string) $sheetData[$baseRow]['B'];
                    $modelI->comment = (string) $sheetData[$baseRow]['C'];
                    $modelI->amount = (string) $sheetData[$baseRow]['D'];
                    $modelI->size = (string) $sheetData[$baseRow]['E'];
                    $modelI->part_type = (string) $sheetData[$baseRow]['F'];

                    $modelI->save();
                        // $modelI = new \app\models\ProgramItem;
                }

                $baseRow++;
            }
                //      die();
            Yii::$app->getSession()->setFlash('success', 'Success');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Error');
        }
        return $this->redirect(['import', 'id' => $model->id,'machine'=> $model->Line_id,]);
    }
    return $this->render('create', [
        'id' => $id,
        'model' => $model,
        'modelD' => $modelD,
        'modelImport' => $modelImport,
    ]);
}

    /**
     * Updates an existing Program model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionImport($id,$line) {
       // echo $line;
          /*$modelL =  Line::findOne($line);
          echo $modelL->id;
          die();*/
          $model = $this->findModel($id);
          $modelL =  Line::findOne($line);
          $modelD = new \app\models\ProgramDetail();
          $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
          $modelImport->addRule(['fileImport'], 'required');
          $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);
          if (
            $modelD->load(Yii::$app->request->post())
        //   && $modelI->load(Yii::$app->request->post())
        ) {

            //  $model->program_status_id = 2;
            //   $model->save();
            $modelD->title = $model->name . ' ' . $modelD->tableMachine->table->name;

            $modelD->save();
            //$modelI->program_detail_id = $modelD->id;
            //  $modelI->save();
            // return $this->render(['create_programD', 'id' => $model->id]);
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
            if ($modelImport->fileImport && $modelImport->validate()) {
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $baseRow = 2;
                while (!empty($sheetData[$baseRow]['A'])) {
                    $modelJ = \app\models\Feeder::find()
                    ->where('barcode_feeder LIKE :query')
                    ->addParams([':query' => (string) $sheetData[$baseRow]['A']])
                    ->all();
                    // ->where(['barcode_feeder' => (string) $sheetData[$baseRow]['A'] ])->all();
                    // print_r($modelI);
                    foreach ($modelJ as $data) {
                        $modelI = new \app\models\ProgramItem();
                        $modelI->program_detail_id = $modelD->id;
                        $modelI->feeder_id = $data->id;
                        $modelI->part_no = (string) $sheetData[$baseRow]['B'];
                        $modelI->comment = (string) $sheetData[$baseRow]['C'];
                        $modelI->amount = (string) $sheetData[$baseRow]['D'];
                        $modelI->size = (string) $sheetData[$baseRow]['E'];
                        $modelI->part_type = (string) $sheetData[$baseRow]['F'];

                        $modelI->save();
                        // $modelI = new \app\models\ProgramItem;
                    }
                    // $feeder = $this->findFeeder($id);
                    //  echo $feeder->id;
                    //echo $a;
                    //die();
//                    $model->title = (string) $sheetData[$baseRow]['A'];
//                    $model->description = (string) $sheetData[$baseRow]['B'];
//                    $model->description = (string) $sheetData[$baseRow]['C'];
//                    $model->description = (string) $sheetData[$baseRow]['D'];
                    //$model->save();
                    $baseRow++;
                }
                Yii::$app->getSession()->setFlash('success', 'Success');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
            }
            return $this->redirect(['import', 'id' => $modelD->program_id]);
        }







        return $this->render('import', [
            'modelL'=>$modelL->id,
            'model' => $model,
            'modelD' => $modelD,
            'modelImport' => $modelImport,
        ]);
    }

    public function actionShow() {
        $model = Program::find()->all();
        return $this->render('show', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Program model.
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
     * Finds the Program model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Program the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Program::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*protected function findMachine($id) {
        if (($model = Machine::find($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function actionGetLine() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $models_id = empty($parents[0]) ? null : $parents[0];
                $out = $this->getLine($models_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetMachine() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $models_id = empty($ids[0]) ? null : $ids[0];
            $line_id = empty($ids[1]) ? null : $ids[1];
            //$line = empty($ids[2]) ? null : $ids[2];
            if ($models_id != null) {
                $data = $this->getMachine($line_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetMachinetable() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $models_id = empty($ids[0]) ? null : $ids[0];
            $line_id = empty($ids[1]) ? null : $ids[1];
            $machine_id = empty($ids[2]) ? null : $ids[2];
            if ($line_id != null) {
                $data = $this->getMachinetable($machine_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

//
//    public function actionGetFeeder() {
//        $out = [];
//        if (isset($_POST['depdrop_parents'])) {
//
//            //     die();
//            $ids = $_POST['depdrop_parents'];
//            $line_id = empty($ids[0]) ? null : $ids[0];
//            $machine_id = empty($ids[1]) ? null : $ids[1];
//            $table_machine_id = empty($ids[2]) ? null : $ids[2];
//            if ($line_id != null) {
//                $data = $this->getFeeder($table_machine_id);
//                echo Json::encode(['output' => $data, 'selected' => '']);
//                return;
//                //$line_id,$machine_id,
//            }
//        }
//        echo Json::encode(['output' => '', 'selected' => '']);
//    }

    protected function getLine($id) {
        $datas = \app\models\ModelsLine::find()->where(['models_p_id' => $id])->all();
        return $this->MapData($datas, 'Line_id', 'title');
    }

    protected function getMachine($id) {
        $datas = Machine::find()->where(['Line_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getMachinetable($id) {
        $datas = TableMachine::find()->where(['machine_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getFeeder($id) {
        $datas = \app\models\Feeder::find()->where(['table_machine_id' => $id])->all();

        return $this->MapData($datas, 'id', 'name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    ////////////////////////////////////////////////////////////////////////
}
