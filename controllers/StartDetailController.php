<?php

namespace app\controllers;

use Yii;
use app\models\StartDetail;
use app\models\StartDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StartDetailController implements the CRUD actions for StartDetail model.
 */
class StartDetailController extends Controller {

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
     * Lists all StartDetail models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StartDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSetProgram() {
        $model = new \app\models\StartDetail();
        if ($model->load(Yii::$app->request->post())) {
            
            die();
           // return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('set', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single StartDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = StartDetail::find()->where(['start_program_id' => $id])->all();
        //$model = $this->getStartprogram($id);
        //$model = $this->Startprogram($id);
        return $this->render('view', [
                    'model' => $model,
                        //'model' => $this->findModel($id),
        ]);
    }

    public function actionViewProgram($id) {
        $model = StartDetail::find()->where(['start_program_id' => $id])->all();
        //$model = $this->getStartprogram($id);
        //$model = $this->Startprogram($id);
        return $this->render('viewprogram', [
                    'model' => $model,
                        //'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StartDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StartDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing StartDetail model.
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
     * Deletes an existing StartDetail model.
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
     * Finds the StartDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StartDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StartDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    protected function getStartprogram($id) {
//        $datas = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
//        return $this->MapData($datas, 'id','id');
//    }
//    protected function MapData($datas, $fieldId, $fieldName) {
//        $obj = [];
//        foreach ($datas as $key => $value) {
//            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
//        }
//        return $obj;
//    }
}
