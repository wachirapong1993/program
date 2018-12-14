<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Feeder;

/**
 * FeederSearch represents the model behind the search form of `app\models\Feeder`.
 */
class FeederSearch extends Feeder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'direction_id', 'table_machine_id', 'machine_id', 'Line_id', 'feeder_point_id'], 'integer'],
            [['name', 'size'], 'safe'],
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
        $query = Feeder::find();

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
            'direction_id' => $this->direction_id,
            'table_machine_id' => $this->table_machine_id,
            'machine_id' => $this->machine_id,
            'Line_id' => $this->Line_id,
            'feeder_point_id' => $this->feeder_point_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
