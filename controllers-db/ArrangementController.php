<?php

namespace app\controllers;

use Yii;
use app\models\Arrangement;
use app\models\ArrangementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use app\models\Line;
use app\models\Machine;
use app\models\TableMachine;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\base\Model;

//use app\base\Controller;
/**
 * ArrangementController implements the CRUD actions for Arrangement model.
 */
class ArrangementController extends Controller {

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
     * Lists all Arrangement models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArrangementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Arrangement model.
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
     * Creates a new Arrangement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Arrangement;

        $modela = new \app\models\ArrangementDetail;
        $models = [new \app\models\ArrangementDetail];
        if ($model->load(Yii::$app->request->post())) {

            $models = Model::createMultiple(Address::classname());
            Model::loadMultiple($models, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                                ActiveForm::validateMultiple($models), ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($models) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($models as $models) {
                            $models->arrangement_id = $model->id;
                            if (!($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modela' => $modela,
                    'models' => (empty($models)) ? [new \app\models\ArrangementDetail] : $models
        ]);
    }

    /**
     * Updates an existing Arrangement model.
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
     * Deletes an existing Arrangement model.
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
     * Finds the Arrangement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Arrangement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Arrangement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    $form->field($model, 'line')->dropdownList(
//            ArrayHelper::map(Line::find()->all(), 'id', 'name'), [
//        'id' => 'ddl-line',
//        'prompt' => 'Select Line'
//    ]);

//    $form->field($model, 'machine')->widget(DepDrop::classname(), [
//        'options' => ['id' => 'ddl-machine'],
//        'data' => [],
//        'pluginOptions' => [
//            'depends' => ['ddl-line'],
//            'placeholder' => 'Select Machince...',
//            'url' => Url::to(['/arrangement/get-machine'])
//        ]
//    ]);

//    $form->field($model, 'table_machine')->widget(DepDrop::classname(), [
//        'options'=>['id'=>'ddl-table_machine_id'],
//        'data' => [],
//        'pluginOptions' => [
//            'depends' => ['ddl-line', 'ddl-machine'],
//            'placeholder' => 'Select MachineTable...',
//            'url' => Url::to(['/arrangement/get-machinetable'])
//        ]
//    ]);

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

    public function actionGetFeeder() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            
       //     die();
            $ids = $_POST['depdrop_parents'];
            $line_id = empty($ids[0]) ? null : $ids[0];
            $machine_id = empty($ids[1]) ? null : $ids[1];
            $table_machine_id = empty($ids[2]) ? null : $ids[2];
             if ($line_id != null) {
                $data = $this->getFeeder($table_machine_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
                //$line_id,$machine_id,
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getMachine($id) {
        $datas = Machine::find()->where(['line_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getMachinetable($id) {
        $datas = TableMachine::find()->where(['machine_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }
    
     protected function getFeeder($id) {
        $datas = \app\models\Feeder::find()->where(['table_machine_id'=>$id])->all();
       
        return $this->MapData($datas, 'id', 'name');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

}
