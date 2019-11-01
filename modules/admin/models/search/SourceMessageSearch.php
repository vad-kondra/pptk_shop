<?php

namespace app\modules\admin\models\search;

use app\modules\admin\models\translation\SourceMessage;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SourceMessageSearch represents the model behind the search form of `app\modules\admin\models\SourceMessage`.
 */
class SourceMessageSearch extends SourceMessage
{
    /**
     * {@inheritdoc}
     */
    public $msgEn;
    public $msgUk;
    public $msgTr;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message','msgEn', 'msgUk', 'msgTr'], 'safe'],
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
        $query = SourceMessage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 58]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->leftJoin("message as msg","msg.id = source_message.id");

        if(!empty($this->msgEn))
            $query->andFilterWhere(["like",'msg.translation', $this->msgEn])->andWhere(["msg.language"=>"en"]);

        if(!empty($this->msgUk))
            $query->andFilterWhere(["like",'msg.translation', $this->msgUk])->andWhere(["msg.language"=>"uk"]);

        if(!empty($this->msgTr))
            $query->andFilterWhere(["like",'msg.translation', $this->msgTr])->andWhere(["msg.language"=>"tr"]);

        $query->andFilterWhere(['like', 'category', $this->category]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
