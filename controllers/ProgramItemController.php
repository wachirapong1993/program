<?php

namespace app\controllers;

use Yii;
use app\models\ProgramItem;
use app\models\ProgramItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;






use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;



use yii\helpers\Html;
use yii\helpers\Url;
/**
 * ProgramItemController implements the CRUD actions for ProgramItem model.
 */
class ProgramItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all ProgramItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProgramItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProgramItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProgramItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProgramItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProgramItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShowupdate()
    {
        $model = new ProgramItem();
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);
        if ($model->load(Yii::$app->request->post()))

        {
           /* echo $model->tblmc;
           die();*/

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
                        $modelI->program_detail_id = $model->tblmc;
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
            return $this->redirect(['program-item/index']);
        }
        return $this->render('updateform',[
            'model'=>$model,
            'modelImport'=>$modelImport,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_formupdate', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProgramItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*Depdop*/
    public function actionGetTable() {
        //die();
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $program_id = empty($parents[0]) ? null : $parents[0];
                $out = $this->getTable($program_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    protected function getTable($id) {
        $datas = \app\models\ProgramDetail::find()->where(['program_id' => $id])->all();
        return $this->MapData($datas, 'id', 'title');
    }
    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }










    /**
     * Finds the ProgramItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
