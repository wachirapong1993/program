<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StartDetail;

/**
 * StartDetailSearch represents the model behind the search form of `app\models\StartDetail`.
 */
class StartDetailSearch_2 extends StartDetail
{
    public $q;
    public $itemSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'start_program_id', 'check_feeder', 'check_part', 'total', 'qc_status_id', 'feeder_id'], 'integer'],
            [['lot_no', 'part_no','itemSearch','q'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = StartDetail::find()->joinWith('startProgram');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

      //  $this->load($params);

//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_program_id' => $this->start_program_id,
//            'check_feeder' => $this->check_feeder,
//            'check_part' => $this->check_part,
//            'total' => $this->total,
//            'qc_status_id' => $this->qc_status_id,
            'feeder_id' => $this->q,
        ]);

        $query->orFilterWhere(['like', 'lot_no', $this->q])
            ->orFilterWhere(['like', 'part_no', $this->q]);
       //  ->orFilterWhere(['like', 'part_no', $this->q])

        return $dataProvider;
    }
}
