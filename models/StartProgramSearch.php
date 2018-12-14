<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StartProgram;

/**
 * StartProgramSearch represents the model behind the search form of `app\models\StartProgram`.
 */
class StartProgramSearch extends StartProgram {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'emp_code', 'program_detail_id', 'program_status_id','created_by'], 'integer'],
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
        $query = StartProgram::find();


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           'sort' => [
                'defaultOrder' => [
                   // 'id' => SORT_DESC,
                    'id'=> SORT_DESC,
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
            'id' => $this->id,
            'emp_code' => $this->emp_code,
            'program_detail_id' => $this->program_detail_id,
            'program_status_id' => $this->program_status_id,
            'start_main_id'=> $this->start_main_id,
            'created_by'=> $this->created_by,
        ]);

        return $dataProvider;
    }

}
