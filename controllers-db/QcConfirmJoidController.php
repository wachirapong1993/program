<?php

namespace app\controllers;

use Yii;
use app\models\QcConfirmJoid;
use app\models\QcConfirmJoidSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QcConfirmJoidController implements the CRUD actions for QcConfirmJoid model.
 */
class QcConfirmJoidController extends Controller {

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
     * Lists all QcConfirmJoid models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new \app\models\JoidPartSearch_1();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QcConfirmJoid model.
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
     * Creates a new QcConfirmJoid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new QcConfirmJoid();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing QcConfirmJoid model.
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
     * Deletes an existing QcConfirmJoid model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheck($id) {

        $model = \app\models\JoidPart::find()->where(['id' => $id])->all();
        foreach ($model as $value) {
            $qc_joid = new QcConfirmJoid();
            $qc_joid->joid_part_id = $value->id;
            $qc_joid->check_feeder = 1;
            $qc_joid->check_part = 1;
            $qc_joid->qc_status = 1;
            $qc_joid->save();
            //echo $value->id;
        }
        //  print_r($model);
        // die();
//        foreach ($model as $model){
//            echo $model->id;
//        }
//       //print_r($model);
//        die();
        // $model = QcConfirmJoid::findOne($id);

        return $this->render('_confirm', ['data' => $qc_joid->id]);
    }

    public function actionChecks($id) {



        $model = \app\models\QcConfirmJoid::findOne($id);



        return $this->render('_confirm', ['data' => $model->id]);
    }

    public function actionCheckFeeder() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_feeder = \app\models\QcConfirmJoid::findOne($id);
        $feeder = $check_feeder->joidPart->feeder->barcode_feeder;
        // die();
        // echo $check_part->feeder_id.'='.$string;
        //$feeder = $check_feeder->feeder;
        $feeder_check = $string;
        //echo ;
        if ($feeder != $feeder_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['qc-confirm-joid/checks',
                        'id' => $check_feeder->id]);
        } else {
            $check_feeder->check_feeder = 2;
            //$check_feeder->check_feeder = 2;
            $check_feeder->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['qc-confirm-joid/checks',
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

        $check_part = \app\models\QcConfirmJoid::findOne($id);
        // echo $check_part->part_no . '=' . $string;
        $part_no = $check_part->joidPart->item->part_no;
        $part_check = $string;
        //echo ;
        //die();

        if ($part_no != $part_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['qc-confirm-joid/checks',
                        'id' => $check_part->id]);
        } else {
            $check_part->check_part = 2;
            $check_part->qc_status = 2;
            $check_part->save();

            $detail = \app\models\JoidPart::findOne($check_part->joid_part_id);
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
     * Finds the QcConfirmJoid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QcConfirmJoid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = QcConfirmJoid::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
