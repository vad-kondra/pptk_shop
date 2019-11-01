<?php

namespace app\models;

use app\helpers\OrderHelper;
use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\order\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\order\Order`.
 */
class OrderSearch extends Order
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'current_status'], 'integer'],
            [['cost'], 'number'],
            [['comment', 'f_name', 'l_name', 'p_name', 'phone', 'email', 'city', 'post_index', 'address', 'created_at', 'updated_at'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
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
            'current_status' => $this->current_status,
            'cost' => $this->cost,
        ]);
        $query
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'post_index', $this->post_index])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return OrderHelper::statusList();
    }
}
