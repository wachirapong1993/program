<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JoidPart;

/**
 * JoidPartSearch represents the model behind the search form of `app\models\JoidPart`.
 */
class JoidPartSearch_1 extends JoidPart {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'check_feeder', 'check_part', 'lot_no', 'total', 'qc_status_id', 'feeder_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'start_detail_id', 'use_status'], 'integer'],
            [['item_id'], 'safe'],
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
        $query = JoidPart::find()->Where(['not', ['lot_no' => not]])->andWhere(['not', ['total' => not]]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    // 'id' => SORT_DESC,
                    'id' => SORT_DESC,
                    'qc_status_id' => SORT_DESC,
                    'created_at' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'check_feeder' => $this->check_feeder,
//            'check_part' => $this->check_part,
//            'lot_no' => $this->lot_no,
//            'total' => $this->total,
//            'qc_status_id' => $this->qc_status_id,
//            'feeder_id' => $this->feeder_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
//            'start_detail_id' => $this->start_detail_id,
        ]);

        $query->andFilterWhere(['like', 'item_id', $this->item_id]);

        return $dataProvider;
    }

}
