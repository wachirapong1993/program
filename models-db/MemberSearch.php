<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;

/**
 * MemberSearch represents the model behind the search form of `app\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MemberID'], 'integer'],
            [['Username', 'Password', 'Name', 'Tel', 'Email'], 'safe'],
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
        $query = Member::find();

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
            'MemberID' => $this->MemberID,
        ]);

        $query->andFilterWhere(['like', 'Username', $this->Username])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Tel', $this->Tel])
            ->andFilterWhere(['like', 'Email', $this->Email]);

        return $dataProvider;
    }
}
