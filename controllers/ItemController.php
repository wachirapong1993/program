<?php

namespace app\controllers;

use Yii;
use app\models\Item;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param string $id
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
                //echo $df;

               // print_r($objPHPExcel->getActiveSheet()->freezePane('A1'));
            $baseRow = 2;
            while (!empty($sheetData[$baseRow]['A'])) {

                $ch1 =  $sheetData[$baseRow]['A'];
                $check = Item::find()->where(['part_no' => $ch1])->one();

                if($check)
                {

                    echo '----------------------';
                    echo '<br>';
                    echo $check->celco_code.'<br>';
                    echo '----------------------';
                    echo '<br>';
                }
                else
                {
                 $modelI = new \app\models\Item;
                 $modelI->part_no = (string) $sheetData[$baseRow]['A'];
                 $modelI->part_name = (string) $sheetData[$baseRow]['B'];
                 $modelI->celco_code = (string) $sheetData[$baseRow]['C'];
                 $modelI->description = (string) $sheetData[$baseRow]['D'];
                 $modelI->part_size = (string) $sheetData[$baseRow]['E'];
                 $modelI->save();
               //  echo 'Null'.'<br>';
             }
               /* foreach ($check as  $value) {
                    if($value->part_no == 0){
                        echo '=='.'<br>';

                    }else{
                        echo '!='.'<br>';
                    }

                    # code...
                }*/
                
                
                

                    //$modelI->program_detail_id = $modelD->id;

                // $modelI->position = (string) $sheetData[$baseRow]['F'];
                    // $modelI->part_type = (string) $sheetData[$baseRow]['D'];
                    //
            //   echo $modelI->part_no;
                 //  echo $ff;
                $baseRow++;
            }
            //die();
            Yii::$app->getSession()->setFlash('success', 'Success');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Error');
        }
            // return $this->redirect(['import', 'id' => $model->id]);
        return $this->redirect(['index', 'id' => $model->part_no]);
    }

    return $this->render('create', [
        'modelImport' => $modelImport,
    ]);
}

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->part_no]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
