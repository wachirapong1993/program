<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProgramItem;

/**
 * ProgramItemSearch represents the model behind the search form of `app\models\ProgramItem`.
 */
class ProgramItemSearch extends ProgramItem {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'program_detail_id', 'feeder_id', 'amount', 'directiion', 'program', 'tbl', 'customer', 'part_type'], 'integer'],
            [['comment', 'part_no', 'size'], 'safe'],
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
        $query = ProgramItem::find()->joinWith('programDetail');

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
//$query->andWhere(['programDetail.program_id', $this->program,]);
        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'program_detail_id' => $this->program_detail_id,
//            'feeder_id' => $this->feeder_id,
            'table_machine_id' => $this->tbl,
            'program_id' => $this->program,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
                ->andFilterWhere(['like', 'part_type', $this->part_type])
                ->andFilterWhere(['like', 'part_no', $this->part_no]);

        return $dataProvider;
    }

}
