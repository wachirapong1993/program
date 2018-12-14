<?php

namespace app\controllers;

use Yii;
use app\models\Feeder;
use app\models\FeederSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * FeederController implements the CRUD actions for Feeder model.
 */
class FeederController extends Controller {

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
     * Lists all Feeder models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FeederSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feeder model.
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
     * Creates a new Feeder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Feeder();

        if ($model->load(Yii::$app->request->post())) {
            
          //  $model->id = $model->Line_id . $model->machine_id . $model->table_machine_id . $model->feeder_point_id . $model->direction_id;
            $model->name = $model->tableMachine->name . ' ' . $model->feeder_point_id . ' ' . $model->direction->name;
            $model->barcode_feeder = $model->Line_id . $model->machine_id . $model->table_machine_id . $model->feeder_point_id . $model->direction->name;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionImport() {

        // $model = $this->findModel($id);
        //  $modelD = new \app\models\ProgramDetail();
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);
        if ($modelImport->load(Yii::$app->request->post())) {

            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
            if ($modelImport->fileImport && $modelImport->validate()) {
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $baseRow = 2;
               // $i =1 ;
                while (!empty($sheetData[$baseRow]['A'])) {
                    $modelI = new \app\models\Feeder;
                    // $modelI->Line_id = $modelD->id;
                    $modelI->Line_id = $sheetData[$baseRow]['A'];
                    $modelI->machine_id = $sheetData[$baseRow]['B'];
                    $modelI->table_machine_id = $sheetData[$baseRow]['C'];
                    $modelI->direction_id =  $sheetData[$baseRow]['D'];
                    $modelI->feeder_point_id = $sheetData[$baseRow]['E'];
                    $modelI->name = $modelI->tableMachine->name.$modelI->feeder_point_id->$modelI->direction->name;
                    $modelI->barcode_feeder = $modelI->Line_id.$modelI->machine_id.$modelI->table_machine_id.$modelI->feeder_point_id.$modelI->direction->name;
                   // $modelI->id =  $i;
                    $modelI->save();

                    $baseRow++;
                   // $i++;
                }
                Yii::$app->getSession()->setFlash('success', 'Success');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
            }
            // return $this->redirect(['import', 'id' => $modelD->program_id]);
        }
        return $this->render('import', [
                    //'model' => $model,
                    //'modelD' => $modelD,
                    'modelImport' => $modelImport,
        ]);
    }

    /**
     * Updates an existing Feeder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * Deletes an existing Feeder model.
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
     * Finds the Feeder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feeder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /////////////////////////////////////////////////
    public function actionGetMachine() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $line_id = $parents[0];
                $out = $this->getMachine($line_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetMachinetable() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $line_id = empty($ids[0]) ? null : $ids[0];
            $machine_id = empty($ids[1]) ? null : $ids[1];
            if ($line_id != null) {
                $data = $this->getMachinetable($machine_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getMachine($id) {
        $datas = \app\models\Machine::find()->where(['line_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getMachinetable($id) {
        $datas = \app\models\TableMachine::find()->where(['machine_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    /////////////////////////////////////////////////
    protected function findModel($id) {
        if (($model = Feeder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
