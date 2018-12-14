<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JoidPart;
use kartik\daterange\DateRangeBehavior;

/**
 * JoidPartSearch represents the model behind the search form of `app\models\JoidPart`.
 */
class JoidPartSearch_1_1 extends JoidPart {

    public $min_price;
    public $max_price;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

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

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'line', 'check_feeder', 'check_part', 'lot_no', 'total', 'qc_status_id', 'feeder_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'start_detail_id', 'use_status'], 'integer'],
            [['min_price', 'max_price', 'item_id'], 'safe'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
                //  [[], 'date', 'format' => 'yyyy-mm-dd h:i:s'],
                //  [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d']
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


//        $query = JoidPart::find();
        $query = JoidPart::find();

        // $query->leftJoin('user', 'user.id=created_by');
//        $query->joinWith(['userc']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    // 'id' => SORT_DESC,

                    'qc_status_id' => SORT_DESC,
                    'created_at' => SORT_ASC,
                // 'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//        if (!empty($params['ClickSearch']['created_at'])) {
//
//           
//        }
        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'check_feeder' => $this->check_feeder,
//            'check_part' => $this->check_part,
//            'lot_no' => $this->lot_no,
//            'total' => $this->total,
            'qc_status_id' => $this->qc_status_id,
            'feeder_id' => $this->feeder_id,
          //  'line.id' => $this->line,
            //  'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
//            'start_detail_id' => $this->start_detail_id,
        ]);

        $query->andFilterWhere(['like', 'item_id', $this->item_id]);
        $query->andFilterWhere(['>=', 'created_at', $this->createTimeStart])
                ->andFilterWhere(['<', 'created_at', $this->createTimeEnd]);


        //$query->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }

}
