<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\QcConfirm;

/**
 * QcConfirmSearch represents the model behind the search form of `app\models\QcConfirm`.
 */
class QcConfirmSearch extends QcConfirm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'check_feeder', 'check_part', 'qc_emp', 'start_detail_id', 'created_at', 'qc_status', 'created_by','updated_at','updated_by'], 'integer'],
            [['feeder', 'part_no'], 'safe'],
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
        $query = QcConfirm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                   // 'id' => SORT_DESC,
                    'qc_status'=>SORT_ASC,
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
            'check_feeder' => $this->check_feeder,
            'check_part' => $this->check_part,
            'qc_emp' => $this->qc_emp,
            'start_detail_id' => $this->start_detail_id,
            'created_at' => $this->created_at,
            'qc_status' => $this->qc_status,
        ]);

        $query->andFilterWhere(['like', 'feeder', $this->feeder])
            ->andFilterWhere(['like', 'part_no', $this->part_no]);

        return $dataProvider;
    }
}
