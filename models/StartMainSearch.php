<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StartMain;

/**
 * StartMainSearch represents the model behind the search form of `app\models\StartMain`.
 */
class StartMainSearch extends StartMain {

    public $lines;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'customer_id', 'Line_id', 'program_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'lines', 'program_status_id','amount'], 'integer'],
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
        $query = StartMain::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    // 'id' => SORT_DESC,
                   // 
                    'program_status_id'=> SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            //   $query->joinWith(['lines'=> $this->Line_id]);
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'Line_id' => $this->Line_id,
            'program_id' => $this->program_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'program_status_id' => $this->program_status_id,
            'amount'=> $this->amount,
        ]);

        return $dataProvider;
    }

}
