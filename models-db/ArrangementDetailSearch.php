<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ArrangementDetail;

/**
 * ArrangementDetailSearch represents the model behind the search form of `app\models\ArrangementDetail`.
 */
class ArrangementDetailSearch extends ArrangementDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'arrangement_id', 'feeder_id', 'amount'], 'integer'],
            [['item_celco_code', 'comment'], 'safe'],
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
        $query = ArrangementDetail::find();

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
            'arrangement_id' => $this->arrangement_id,
            'feeder_id' => $this->feeder_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'item_celco_code', $this->item_celco_code])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
