<?php

namespace app\controllers;

use Yii;
use app\models\StartProgram;
use app\models\StartProgramSearch;
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
use kartik\daterange\DateRangeBehavior;

//use app\models\Customer;
//use app\models\ModelsP;
//use app\models\Program;

/**
 * StartProgramController implements the CRUD actions for StartProgram model.
 */
class ReportController extends Controller {

//
    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }

    public function actionReport() {
        //$model = \app\models\Report::find()->all();
        $model = new \app\models\Report();

        if ($model->load(Yii::$app->request->post())) {
            // print_r($model);
            //echo $_POST['ddl-mainprogram'];
            // echo $model->models;
            echo $model->program_detail_id;
            echo $model->createTimeStart;
            $createTimeStart = $model->createTimeStart;
            $exp = explode(" ", $datetime);
            $t = explode(":", $exp[1]);
            $d = explode("-", $exp[0]);
            $timestamp = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);
            echo $timestamp;
            $searchModel = \app\models\StartProgram::find()->where(['program_detail_id' => $model->program_detail_id])->where(['between', 'created_at', "2015-06-21", "2015-06-27"])
//                    ->andwhere(['>=', 'created_at', $model->createTimeStart])
//                    ->andwhere(['<', 'created_at', $model->createTimeEnd])
                    ->all();
//
//            $query->andFilterWhere(['>=', 'created_at', $this->createTimeStart])
//                    ->andFilterWhere(['<', 'created_at', $this->createTimeEnd]);
            print_r($searchModel);
            die();
            return $this->render('report', ['model' => $model]);
        }

        return $this->render('report', ['model' => $model]);
    }

    /**
     *  DepdopProgra, implements the CRUD actions for StartProgram model.
     */
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

    public function actionGetMachine() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models = empty($ids[1]) ? null : $ids[1];
            $line = empty($ids[2]) ? null : $ids[2];
            if ($customer_id != null) {
                $data = $this->getMachine($line);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetTblmc() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models = empty($ids[1]) ? null : $ids[1];
            $line = empty($ids[2]) ? null : $ids[2];
            $machine = empty($ids[3]) ? null : $ids[3];
            if ($customer_id != null) {
                $data = $this->getTblmc($machine);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetMainprogram() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models = empty($ids[1]) ? null : $ids[1];
            $line = empty($ids[2]) ? null : $ids[2];
            $machine = empty($ids[3]) ? null : $ids[3];
            $tblcm = empty($ids[4]) ? null : $ids[4];

            if ($customer_id != null) {
                $data = $this->getMainprogram($tblcm, $models);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getModels($id) {
        $datas = ModelsP::find()->where(['customer_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getLine($id) {
        $datas = \app\models\ModelsLine::find()->where(['models_p_id' => $id])->all();
        return $this->MapData($datas, 'Line_id', 'title');
    }

    protected function getMachine($id) {
        $datas = \app\models\Machine::find()->where(['Line_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getTblmc($id) {
        $datas = \app\models\TableMachine::find()->where(['machine_id' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    protected function getMainprogram($id, $ids) {
        $datas = \app\models\ProgramDetail::find()->where(['table_machine_id' => $id])->joinWith('program')->andWhere(['models_p_id' => $ids])->all();
        return $this->MapData($datas, 'id', 'title');
    }

//    protected function getSubprogram($id) {
//        $datas = \app\models\ProgramDetail::find()->where(['program_id' => $id])->all();
//        return $this->MapData($datas, 'id', 'title');
//    }
    //////////////////////////////////// map///////////////////////////////

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

}
