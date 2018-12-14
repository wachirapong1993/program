<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StartDetail;
use kartik\daterange\DateRangeBehavior;

/**
 * StartDetailSearch represents the model behind the search form of `app\models\StartDetail`.
 */
class StartDetailSearchbyqc extends StartDetail {

//    public $itemSearch;
//    public $created_at;
//    public $createTimeRange;
//    public $createTimeStart;
//    public $createTimeEnd;

//    public function behaviors() {
//        return [
//            [
//                'class' => DateRangeBehavior::className(),
//                'attribute' => 'createTimeRange',
//                'dateStartAttribute' => 'createTimeStart',
//                'dateEndAttribute' => 'createTimeEnd',
//            ]
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'start_program_id', 'check_feeder', 'check_part', 'total', 'qc_status_id', 'feeder_id'], 'integer'],
            [['lot_no', 'part_no', 'itemSearch'], 'safe'],
//            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = StartDetail::find()->where('qc_status_id=1');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
           // 'start_program_id' => $this->start_program_id,
            'check_feeder' => $this->check_feeder,
            'check_part' => $this->check_part,
            'total' => $this->total,
            'qc_status_id' => $this->qc_status_id,
            'feeder_id' => $this->feeder_id,
        ]);

        $query 
                ->andFilterWhere(['not', ['lot_no' => not]])
                ->andFilterWhere(['not', ['total' => not]])
                  ;
//         $query->andFilterWhere(['>=', 'created_at', $this->createTimeStart])
//                ->andFilterWhere(['<', 'created_at', $this->createTimeEnd]);

        return $dataProvider;
    }

}
