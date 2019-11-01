<?php

namespace app\modules\admin\models\search;

use app\models\Link;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LinkSearch represents the model behind the search form of `app\models\Link`.
 */
class LinkSearch extends Link
{
    public $type;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'pos'], 'integer'],
            [['name', 'href'], 'safe'],
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
        $query = Link::find();

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
            'type' => $this->type,
            'pos' => $this->pos
        ]);

        /*if($this->type == 3 ){
            $query->orFilterWhere(['type' => 1])->orFilterWhere(['type' => 2])->orFilterWhere(['type' => 3]);
        }*/

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'pos', $this->pos]);
        $query->orderBy('pos');
        return $dataProvider;
    }
}
