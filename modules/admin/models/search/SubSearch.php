<?php

namespace app\modules\admin\models\search;

use app\models\news\SubscribeNews;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SubSearch represents the model behind the search form of `app\models\SubscribeNews`.
 */
class SubSearch extends SubscribeNews
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'email', 'message' => getRuleMessage('email')],
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
        $query = SubscribeNews::find();

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
            'email' => $this->email,
        ]);
        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
