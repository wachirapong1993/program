<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\QcConfirmJoid;

/**
 * QcConfirmJoidSearch represents the model behind the search form of `app\models\QcConfirmJoid`.
 */
class QcConfirmJoidSearch extends QcConfirmJoid
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'check_feeder', 'check_part', 'joid_part_id', 'qc_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
        $query = QcConfirmJoid::find();

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
            'check_feeder' => $this->check_feeder,
            'check_part' => $this->check_part,
            'joid_part_id' => $this->joid_part_id,
            'qc_status' => $this->qc_status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
