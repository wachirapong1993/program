<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Arrangement;

/**
 * ArrangementSearch represents the model behind the search form of `app\models\Arrangement`.
 */
class ArrangementSearch extends Arrangement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pcb_id', 'program_detail_id', 'rev', 'Line_id', 'machine_id', 'table_machine_id'], 'integer'],
            [['created_date', 'solder_paste'], 'safe'],
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
        $query = Arrangement::find();

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
            'pcb_id' => $this->pcb_id,
            'program_detail_id' => $this->program_detail_id,
            'rev' => $this->rev,
            'Line_id' => $this->Line_id,
            'machine_id' => $this->machine_id,
            'table_machine_id' => $this->table_machine_id,
        ]);

        $query->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'solder_paste', $this->solder_paste]);

        return $dataProvider;
    }
}
