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

/**
 * StartProgramController implements the CRUD actions for StartProgram model.
 */
class StartProgramController extends Controller {

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
     * Lists all StartProgram models.
     * @return mixed
     */
    public function actionReport() {
        $searchModel = new \app\models\JoidPartSearch_1_1();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//  The key (or keyField) must be filled, if the key is not equal to primary key.        
        // $dataProvider->key = 'startDetail'; // for ActiveDataProvider 
//  $dataProvider->keyField = 'uuid';// for ArrayDataProvider 

        return $this->render('report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportUppart() {
        $searchModel = new \app\models\StartDetailSearch_1();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//  The key (or keyField) must be filled, if the key is not equal to primary key.        
        //   $dataProvider->key = 'startDetail'; // for ActiveDataProvider 
//  $dataProvider->keyField = 'uuid';// for ArrayDataProvider 

        return $this->render('report-uppart', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetail($id, $advanced = false) {
        $model = $this->findModel($id);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->id,
        ]);

        return $this->renderAjax('_detail', [
                    'dataProvider' => $dataProvider,
                    'advanced' => $advanced,
                    'id' => $id,
        ]);
    }

    public function actionIndex() {
        $searchModel = new StartProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StartProgram model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewprogram($id) {
        return $this->render('viewprogram', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StartProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $main_start) {


        $check = \app\models\ProgramDetail::find()->where(['program_id' => $id])->all();
        foreach ($check as $check) {
            $model = new StartProgram();
            $model->start_main_id = $main_start;
            $model->program_detail_id = $check->id;
          //  $model->program_status_id = 3;
            $model->save();
            $check_pro = \app\models\ProgramItem::find()->where(['program_detail_id' => $check->id])->all();
            foreach ($check_pro as $program) {
                if (!empty($check_pro)) {
                    $s_d = new \app\models\StartDetail();
                    $s_d->start_program_id = $model->id;
                    $s_d->check_feeder = 1;
                    $s_d->check_part = 1;
                    $s_d->qc_status_id = 1;
                    $s_d->part_no = $program->part_no;
                    $s_d->feeder_id = $program->feeder_id;
                    $s_d->save();
                    $modelS = new \app\models\QcConfirm;
                    $modelS->start_detail_id = $s_d->id;
                    $modelS->check_feeder = 1;
                    $modelS->check_part = 1;
                    $modelS->confirm_type_id = 1;
                    $modelS->qc_status = 1;
                    $modelS->feeder = $s_d->feeder->barcode_feeder;
                    $modelS->part_no = $s_d->part_no;
                    $modelS->save();
                }
            }
        }
        Yii::$app->getSession()->setFlash('success', 'Pass');
        return $this->redirect(['start-main/index',
                        // 'id' => $model->start_main_id,
                        // 'id' => $modelSD->id,
        ]);


        Yii::$app->getSession()->setFlash('Not mach', 'Error');
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionProgramSearch() {
        $model = new StartProgram();


        if ($model->load(Yii::$app->request->post())) {

            $check = \app\models\ProgramDetail::find()->where(['barcode' => $model->program_search])->all();
            foreach ($check as $check) {

                $check_pro = \app\models\ProgramItem::find()->where(['program_detail_id' => $check->id])->where(['part_no' => $model->part_no])->all();

                if (!empty($check_pro)) {

                    $model->program_detail_id = $check->id;
                    $model->program_status_id = 1;
                    if ($model->save()) {
                        //die();
                        foreach ($check_pro as $program) {
                            $s_d = new \app\models\StartDetail();
                            $s_d->start_program_id = $model->id;
                            $s_d->check_feeder = 1;
                            $s_d->check_part = 1;
                            $s_d->qc_status_id = 1;
                            $s_d->part_no = $program->part_no;
                            $s_d->feeder_id = $program->feeder->barcode_feeder;
                            $s_d->save();
                            Yii::$app->getSession()->setFlash('success', 'Pass');
                            return $this->redirect(['program1',
                                        'id' => $model->id,
                                            // 'id' => $modelSD->id,
                            ]);
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('Not mach', 'Error');
                    return $this->render('program-search', [
                                'model' => $model,
                    ]);
                }
                // print_r($check_pro);
//                $model->program_detail_id = $data->id;
//                $model->program_status_id = 1;
            }
        }

        return $this->render('program-search', [
                    'model' => $model,
        ]);
    }

    public function actionJoid($id) {
        $model = new \app\models\JoidPart();
        $modelST = \app\models\StartDetail::findOne($id);
        $feeder_id = $modelST->feeder_id;
        $details = $modelST->startProgram->programDetail->id;
        //    echo $details;
        //  die();
        $feeder = $modelST->feeder_id;
        // $pi = \app\models\ProgramItem::find()->where(['program_detail_id' => $details])->all();

        if ($model->load(Yii::$app->request->post())) {
            // $id = Yii::$app->request->post('st_id');
//            echo $model->scanpart;
//            echo '<br>';
//            ECHO $model->st_id;
//            die();
//            
            $modelST = \app\models\StartDetail::findOne($model->st_id);

            $model->start_detail_id = $model->st_id;
            $model->check_feeder = 1;
            $model->check_part = 1;
            $model->qc_status_id = 1;
            $model->feeder_id = $modelST->feeder->barcode_feeder;
            $model->item_id = $model->item_id;
            $model->save();
            //$model->item_id = 
//            $joidP = new \app\models\JoidPart();
//            $joidP->check_feeder = 1;
//            $joidP->check_part = 1;
//            $joidP->qc_status_id = 1;
//            $joidP->item_id = $model->scanpart;
//            $joidP->feeder_id = $modelST->feeder->barcode_feeder;
//            $joidP->start_detail_id = $modelST->id;
//            $joidP->save();
            //echo $joidP->item_id;
            //  echo '<br>';
            //   echo $joidP->feeder_id;
//            echo $model->scanpart;
//            echo '<br>';
//            echo $id;
            //die();
            return $this->redirect(['program2',
                        'id' => $model->id,
            ]);
        }
//        return $this->render('_part', [
//                    'model' => $model,
//                    'modelST' => $modelST->id,
//        ]);










        return $this->render('_part', [
                    'model' => $model,
                    'modelST' => $modelST->id,
                    'details' => $details,
                    'feeder_id' => $feeder_id,
                        // 'modelST' => $modelST->id,
        ]);



        // die();
        //////////////////////////////////////////////////////  |
//        foreach ($modelI as $value) {                         //|
//            $joid = new \app\models\JoidPart();               //|
//            $joid->start_detail_id = $model->id;
//            $joid->check_feeder = 1;
//            $joid->check_part = 1;
//            $joid->qc_status_id = 1;
//            $joid->feeder_id = $value->feeder->barcode_feeder;
//            $joid->item_id = $value->part_no;
//            $joid->use_status = 1;
//            if ($joid->save()) {
//                $qc_con = new \app\models\QcConfirmJoid();
//                $qc_con->check_feeder = 1;
//                $qc_con->check_part = 1; 
//                $qc_con->joid_part_id = $joid->id;
//                $qc_con->qc_status = 1;
//                $qc_con->save();
//            }
//        }
//
//        return $this->redirect(['_part',
//                    'id' => $model->id,
//        ]);
        ///////////////////////////////////////////////////////
    }

/////////////////////////////////////////////////////////////
    /**
     * Program 
     *
     *   
     * * */
//    public function actionProgram2() {
////         if ($model->load(Yii::$app->request->post())) {
//        echo $model->itemSearch;
//        die();
//        // return $this->redirect(['view', 'id' => $model->id]);
////        }
//    }

    public function actionProgram1($id) {
        //   echo $id->startProgram->id;
        $id = \app\models\StartProgram::findOne($id);

        return $this->render('startdetail', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//                  'modelstart' => $modelstart,
                    'id' => $id->id,
        ]);

        return $this->render('program_1', [
                    'model' => $model,
        ]);
    }

    public function actionProgram2($id) {

        //  print_r($id);
        $model = \app\models\JoidPart::find()->where(['id' => $id])->all();


        //echo $model->id;
        // die();
        //   print_r($model);
//        $searchModel = new \app\models\StartDetailSearch();
//        $searchModel->start_program_id = $id;
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $modelstart = new \app\models\StartDetail();
        return $this->render('program_2', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//                  'modelstart' => $modelstart,
                    'model' => $model,
                        //'id' => $id,
        ]);

        return $this->render('program_2', [
                    'model' => $model,
        ]);
    }

////////////////////////////next function///////////////////////////////////
    public function actionNexts($id) {

        $programD = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
        // print_r($programD);
        foreach ($programD as $value) {
            if ($value->check_feeder == 1) {
               // echo 'start' . $value->id . '<br>';

                $qc_confirm = \app\models\QcConfirm::find()->where(['start_detail_id' => $value->id])->all();
                foreach ($qc_confirm as $qc_confirm) {
                    // echo 'QC_CON' . $qc_confirm->id . '<br>';
                    $qc_confirm->delete();
                }
                $value->delete();
            }
            //  echo $value->id;
            //echo $value->id.'<br>';
//            if ($value->total = 0) {
//                echo '=0' . $value->id . '<br>';
//                die();
//            } else {
//                echo '!=' . $value->id . '<br>';
//                die();
//            }
        }

        return $this->redirect(['start-main/index',
                        //  'searchModel' => $searchModel,
                        //  'dataProvider' => $dataProvider,
//                  'modelstart' => $modelstart,
                        //    'id' => $id,
        ]);
        //      die();
//        print_r($id);
//        echo $id;
    }

////////////////////////////////////////////////////////////////////////////////////////// scan user 1 ///////////////////////////////////////////////////
    public function actionCheckFeeder() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_feeder = \app\models\StartDetail::findOne($id);
        // echo $check_part->feeder_id.'='.$string;
        $feeder = $check_feeder->feeder->barcode_feeder;
        $feeder_check = $string;
        //echo ;
        if ($feeder != $feeder_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['program1',
                        'id' => $check_feeder->start_program_id]);
        } else {
            $check_feeder->check_feeder = 2;
            $check_feeder->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['program1',
                        'id' => $check_feeder->start_program_id]);
        }

        // $model = '';


        return $this->render('startdetail', [
                        //'stringHash' => $stringHash,
        ]);
    }

    public function actionCheckPart() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_part = \app\models\StartDetail::findOne($id);



        // echo $check_part->feeder_id;
        //$pd = \app\models\StartDetail::find()->where(['feeder'=>$check_part->feeder_id])->andWhere('check_part')
        /// print_r($check_part);
//         echo $check_part->part_no . '=' . $string;
        $part_no = $check_part->part_no;
        $part_check = $string;
        //echo ;
        //die();

        if ($part_no != $part_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['program1',
                        'id' => $check_part->start_program_id]);
        } else {
            $check_part->check_part = 2;
            $check_part->save();
             $demodel = \app\models\StartDetail::find()->where(['feeder_id'=>$check_part->feeder_id])->andWhere('check_part=1')->all();
                
                foreach ($demodel as $dvalue){
                    $dqc = \app\models\QcConfirm::find()->where(['start_detail_id'=>$dvalue->id])->all();
                    foreach ($dqc as $qcvalue){
                        $qcvalue->delete();
                    }
                    $dvalue->delete();
                }
            // die();
//            foreach ($ps as $delete) {
//                //  echo $sps->id;
//                // die();
//            //    $delete->delete();
//            }
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['program1',
                        'id' => $check_part->start_program_id]);
        }

        // $model = '';
    }

//    public function actionQ1($id) {
//        //die();
//        $datas = \app\models\ModelsP::find()->where(['customer_id' => $id])->all();
//        return $this->MapData($datas, 'id', 'name');
//    }

    public function actionAddLot() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
        $check_part = \app\models\StartDetail::findOne($id);
        if ($string != null) {
            $check_part = \app\models\StartDetail::findOne($id);
            // echo $check_part->part_no . '=' . $string;
//        $part_no = $check_part->part_no;
//        $part_check = $string;
            //echo ;

            $check_part->lot_no = $string;
            if ($check_part->save()) {
                Yii::$app->getSession()->setFlash('success', 'Pass');

                return $this->redirect(['program1',
                            'id' => $check_part->start_program_id]);
            } else {
                //$check_part->check_part = 2;]
                //   $check_part->lot_no = $string;

                Yii::$app->getSession()->setFlash('error', 'Error');
                return $this->redirect(['program1',
                            'id' => $check_part->start_program_id]);
            }
        }
        //die();
        return $this->redirect(['program1',
                    'id' => $check_part->start_program_id]);
        // $model = '';
    }

    public function actionAddTotal() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
        $check_part = \app\models\StartDetail::findOne($id);
        if ($string != null) {
            $check_part = \app\models\StartDetail::findOne($id);
            // echo $check_part->part_no . '=' . $string;
//        $part_no = $check_part->part_no;
//        $part_check = $string;
            //echo ;

            $check_part->total = $string;
            if ($check_part->save()) {
               
               
                
                
                Yii::$app->getSession()->setFlash('success', 'Pass');

                return $this->redirect(['program1',
                            'id' => $check_part->start_program_id]);
            } else {
                //$check_part->check_part = 2;]
                //   $check_part->lot_no = $string;

                Yii::$app->getSession()->setFlash('error', 'Error');
                return $this->redirect(['program1',
                            'id' => $check_part->start_program_id]);
            }
        }
        //die();
        return $this->redirect(['program1',
                    'id' => $check_part->start_program_id]);
        // $model = '';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////Joid scan User ///////////////////////////////////////////////////
    public function actionJoidCheckFeeder() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
//        echo $string;
//        echo '<br>';
//        echo $id;
//        die();
        $check_feeder = \app\models\JoidPart::findOne($id);
        // echo $check_part->feeder_id.'='.$string;
        $feeder = $check_feeder->feeder_id;
        $feeder_check = $string;
        //echo ;
        if ($feeder != $feeder_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['program2',
                        'id' => $check_feeder->id]);
        } else {
            $check_feeder->check_feeder = 2;
            $check_feeder->use_status = 2;
            $check_feeder->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['program2',
                        'id' => $check_feeder->id]);
        }

        // $model = '';


        return $this->render('startdetail', [
                        //'stringHash' => $stringHash,
        ]);
    }

    public function actionJoidCheckPart() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');

        $check_part = \app\models\JoidPart::findOne($id);
        // echo $check_part->part_no . '=' . $string;
        $part_no = $check_part->item_id;
        $part_check = $string;
        //echo ;
        //die();

        if ($part_no != $part_check) {
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->redirect(['program2',
                        'id' => $check_part->id]);
        } else {
            $check_part->check_part = 2;
            $check_part->save();
            Yii::$app->getSession()->setFlash('success', 'Pass');
            return $this->redirect(['program2',
                        'id' => $check_part->id]);
        }

        // $model = '';
    }

    public function actionJoidAddLot() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
        $check_part = \app\models\JoidPart::findOne($id);
        if ($string != null) {
            $check_part = \app\models\JoidPart::findOne($id);
            // echo $check_part->part_no . '=' . $string;
//        $part_no = $check_part->part_no;
//        $part_check = $string;
            //echo ;

            $check_part->lot_no = $string;
            if ($check_part->save()) {
                Yii::$app->getSession()->setFlash('success', 'Pass');

                return $this->redirect(['program2',
                            'id' => $check_part->id]);
            } else {
                //$check_part->check_part = 2;]
                //   $check_part->lot_no = $string;

                Yii::$app->getSession()->setFlash('error', 'Error');
                return $this->redirect(['program2',
                            'id' => $check_part->id]);
            }
        }
        //die();
        return $this->redirect(['program2',
                    'id' => $check_part->id]);
        // $model = '';
    }

    public function actionJoidAddTotal() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
        $check_part = \app\models\JoidPart::findOne($id);
        if ($string != null) {
            $check_part = \app\models\JoidPart::findOne($id);
            // echo $check_part->part_no . '=' . $string;
//        $part_no = $check_part->part_no;
//        $part_check = $string;
            //echo ;

            $check_part->total = $string;
            if ($check_part->save()) {
                Yii::$app->getSession()->setFlash('success', 'Pass');

                return $this->redirect(['program2',
                            'id' => $check_part->id]
                );
            } else {
                //$check_part->check_part = 2;]
                //   $check_part->lot_no = $string;

                Yii::$app->getSession()->setFlash('error', 'Error');
                return $this->redirect(['program2',
                            'id' => $check_part->id]);
            }
        }
        //die();
        return $this->redirect(['program2',
                    'id' => $check_part->id]);
        // $model = '';
    }

    public function actionExport($id) {
        $model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all();
        // $model = $this->findModel($id);
//        \moonland\phpexcel\Excel::widget([
//            'models' => $model,
//            'mode' => 'export', //default value as 'export'
//            'columns' => ['id', 'check_feeder', 'check_part'], //without header working, because the header will be get label from attribute label. 
//            //'header' => ['A' => 'Header Column 1', 'B' => 'Header Column 2', 'C' => 'Header Column 3'],
//        ]);

        \moonland\phpexcel\Excel::export([
            'models' => $model,
            'columns' => ['id', 'check_feeder', 'check_part'], //without header working, because the header will be get label from attribute label. 
                //  'header' => ['column1' => 'Header Column 1', 'column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        ]);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////// scan Qc ///////////////////////////////////////////////////
    public function actionQcConfirm($id) {
        //  die();
        $model = new \app\models\QcConfirm();
        if ($model->load(Yii::$app->request->post())) {


            $detail = \app\models\StartDetail::findOne($model->start_detail_id);

            $model->check_feeder = 1;
            $model->check_part = 1;
            $model->check_lot = 1;
            $model->check_total = 1;
            $model->feeder = $detail->feeder->barcode_feeder;
            $model->part_no = $detail->part_no;
            $model->lot_no = $detail->lot_no;
            $model->total = $detail->total;
            $model->start_detail_id = $detail->id;
            $model->save();
            return $this->render('qc_form', [
                        'model' => $model->id,
                        'detail' => $model->start_detail_id,
            ]);
        }
//        $model = new \app\models\QcConfirm();

        return $this->render('_qcform', [
                    'model' => $model,
                    'id' => $id,
        ]);
// print_r($id);
        //$model_SD = \app\models\StartDetail::findOne()
        //die();
    }

    public function actionQcCheckFeeder() {
        //$security = new Security();
        $string = Yii::$app->request->post('string');
        $id = Yii::$app->request->post('id');
        $detail = Yii::$app->request->post('detail');

        // echo $detail_id;
        //  $qc_con = \app\models\QcConfirm::findOne($detail_id);
//        //echo $qc_con->start_detail_id;
        $st_d = \app\models\StartDetail::findOne($detail);
        //echo $st_d->feeder->barcode_feeder . '=' . $string;

        if ($st_d->feeder->barcode_feeder != $string) {
            $st_id = \app\models\StartDetail::findOne($detail);
            $qc_id = \app\models\QcConfirm::findOne($id);
            Yii::$app->getSession()->setFlash('error', 'Error');
            return $this->render('qc_form', ['model' => $qc_id->id,
                        'id' => $st_id->id,
            ]);
        } else {
            $qc_con = \app\models\QcConfirm::findOne($id);
            //$
            $qc_con->check_feeder = 2;
            $qc_con->save();
            Yii::$app->getSession()->setFlash('success', 'Success');
            return $this->redirect([
                        'qc_form',
                        'model' => $id,
                        'id' => $detail,]);
        }

//        echo $st_d->feeder->barcode;
//        $sd = \app\models\StartDetail::find()
//        $id_qc = Yii::$app->request->post('ids');
//        
//        
//        $start_detail = \app\models\StartDetail::findOne($detail_id);
//        $qc_check = \app\models\QcConfirm::findOne($id_qc);
//      
//       echo $start_detail->feeder->barcode.'='.$string;
        //die();
//        if ($feeder != $feeder_check) {
//            Yii::$app->getSession()->setFlash('error', 'Error');
//            return $this->redirect(['program1',
//                        'id' => $check_feeder->start_program_id]);
//        } else {
//           
//        }
        // $model = '';

        die();
        return $this->render('startdetail', [
                        //'stringHash' => $stringHash,
        ]);
    }

    /**
     * Updates an existing StartProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $model->program_status_id = 4;
        $model->save();
        return $this->redirect(['index', 'id' => $model->id]);
        if ($model->load(Yii::$app->request->post())) {
            
        }

//        return $this->render('update', [
//                    'model' => $model,
//        ]);
    }

    /**
     * Deletes an existing StartProgram model.
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
     * Finds the StartProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StartProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StartProgram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelDe($id) {
        if (($model = \app\models\StartDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModels($id) {
        if (($model = \app\models\StartDetail::find()->where(['start_program_id' => $id])->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findProgramD($modelSD) {
        if (($model = \app\models\StartDetail::find()->where(['id' => $modelSD])->all()) !== null) {
            return $this->MapData($model, 'id', 'total');
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /////////////////////////////////





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

//
//    protected function getFeeder($id) {
//        $datas = \app\models\Feeder::find()->where(['table_machine_id' => $id])->all();
//
//        return $this->MapData($datas, 'id', 'name');
//    }
//    public function actionGetAmphur() {
//        $out = [];
//        if (isset($_POST['depdrop_parents'])) {
//            $parents = $_POST['depdrop_parents'];
//            if ($parents != null) {
//                $customer_id = $parents[0];
//                $out = $this->getAmphur($customer_id);
//                echo Json::encode(['output' => $out, 'selected' => '']);
//                return;
//            }
//        }
//        echo Json::encode(['output' => '', 'selected' => '']);
//    }
//
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

    public function actionGetSubprogram() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $customer_id = empty($ids[0]) ? null : $ids[0];
            $models_id = empty($ids[1]) ? null : $ids[1];
            $mainprogram_id = empty($ids[2]) ? null : $ids[2];
            if ($customer_id != null) {
                $data = $this->getSubprogram($mainprogram_id, $models_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    ///////////////////////////////////////depdop Program_2 /////////////////////////////////////////////////


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

    //////////////////////////////////////////////////////////////////////////

    protected function getfindProgram($id) {
        $datas = \app\models\ProgramDetail::find()->where(['barcode' => $id])->all();
        return $this->MapData($datas, 'id', 'title');
    }

}
