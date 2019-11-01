<?php

namespace app\modules\admin\models\search;

use app\models\auth\AuthForm;
use app\models\user\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * search represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'username','f_name', 'l_name', 'email'], 'safe'],
            [['is_confirmed'], 'safe'],
            [['role'], 'safe'],
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
        $query = User::find();

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

        $query->andFilterWhere(['like', 'f_name', $this->f_name])
            ->orFilterWhere(['like', 'l_name', $this->l_name])
            ->orFilterWhere(['like', 'p_name', $this->p_name])
            ->orFilterWhere(['like', 'username', $this->username]);
            //->orFilterWhere(['like', 'company_name', $this->company_name]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_confirmed' => $this->is_confirmed,
            //'created_at' => $this->created_at,
        ]);
        $query
            ->andFilterWhere(['like', 'email', $this->email]);

        $query->leftJoin('auth_assignment as asg','asg.user_id = user.id')
            ->andFilterWhere(['asg.item_name' => $this->role]);

        return $dataProvider;
    }

		public function searchByGroup($groupId) {

            $query = User::find()->where(['is_confirmed' => true])
                ->andWhere(['group_id' => $groupId]);

            $query->leftJoin('auth_assignment as asg','asg.user_id = user.id')
                ->andFilterWhere(['asg.item_name' => User::ROLE_USER]);


            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $dataProvider;
		}

}
