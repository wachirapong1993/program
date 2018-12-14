<?php

namespace app\controllers;

use Yii;
use app\models\QcConfirm;
use app\models\QcConfirmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QcConfirmController implements the CRUD actions for QcConfirm model.
 */
class QcConfirmController extends Controller {

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
     * Lists all QcConfirm models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new \app\models\StartDetailSearchbyqc();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('indexbyqc', [
                    //  'modelS' => $modelS,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCheck($id) {
        $modelS = QcConfirm::findOne($id);
//        $model = \app\models\StartDetail::findOne($id);
//        $modelS = new \app\models\QcConfirm;
//        $modelS->start_detail_id = $model->id;
//        $modelS->check_feeder = 1;
//        $modelS->check_part = 1;
//        $modelS->confirm_type_id = 1;
//        $modelS->qc_status = 1;
//        $modelS->feeder = $model->feeder->barcode_feeder;
//        $modelS->part_no = $model->part_no;
//
//        $modelS->save();

        return $this->render('indexs', [
                    'modelS' => $modelS->id,
        ]);
    }

    /**
     * Displays a single QcConfirm model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShow() {
        $searchModel = new QcConfirmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index_1', [
//                    'modelS' => $modelS,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

//    public function actionCheck($id) {
//
//
//        $model = \app\models\QcConfirm::findOne($id);
//         echo $model->id;
//        echo $model->start_detail_id;
//        die();
//        return $this->render('index', [
//                //    'modelS' => $modelS,
////            'searchModel' => $searchModel,
////            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QcConfirm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {

        //$model = \app\models\StartDetail::find->where(['id'=>$id])->all();
        $model = \app\models\QcConfirm::find()->where(['start_detail_id' => $id])->all();
        foreach ($model as $data) {
            $modelS = $data->id;

            return $this->render('indexs', [
                        'modelS' => $modelS,
            ]);
        }
    }

    /**
     * Updates an existing QcConfirm model.
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
     * Deletes an existing QcConfirm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//        $model = \app\models\StartDetail::findOne($id);
        $model->delete();
        //die();
        //$sd = $id;
//        $this->findModels($id)->delete();

        return $this->redirect('index');
    }

    public function actionCheckFeeder() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_feeder = \app\models\QcConfirm::findOne($id);

        // echo $check_part->feeder_id.'='.$string;
        $feeder = $check_feeder->feeder;
        $feeder_check = $string;
        //echo ;
        if ($feeder != $feeder_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->render(['check',
                        'id' => $check_feeder->id]);
        } else {
            $check_feeder->check_feeder = 2;
            //$check_feeder->check_feeder = 2;
            $check_feeder->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['check',
                        'id' => $check_feeder->id]);
        }

        // $model = '';


        return $this->render('index', [
                        //'stringHash' => $stringHash,
        ]);
    }

    public function actionCheckPart() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_part = \app\models\QcConfirm::findOne($id);
        // echo $check_part->part_no . '=' . $string;
        $part_no = $check_part->part_no;
        $part_check = $string;
        //echo ;
        //die();

        if ($part_no != $part_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['index',
                        'id' => $check_part->id]);
        } else {
            $check_part->check_part = 2;
            $check_part->qc_status = 2;
            $check_part->save();

            $detail = \app\models\StartDetail::findOne($check_part->start_detail_id);
            $detail->qc_status_id = 2;
            $detail->save();
//            $start = \app\models\StartProgram::findOne($detail->start_program_id);
//            $start->program_status_id = 2 ;
//            $start->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['index',
                        'id' => $check_part->id]);
        }

        // $model = '';
    }

    /**
     * Finds the QcConfirm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QcConfirm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = QcConfirm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModels($id) {
        if (($model = \app\models\StartDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
