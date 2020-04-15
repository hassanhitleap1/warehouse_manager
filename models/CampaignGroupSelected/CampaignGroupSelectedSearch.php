<?php

namespace app\models\CampaignGroupSelected;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CampaignGroupSelected\CampaignGroupSelected;

/**
 * CampaignGroupSelectedSearch represents the model behind the search form of `app\models\CampaignGroupSelected\CampaignGroupSelected`.
 */
class CampaignGroupSelectedSearch extends CampaignGroupSelected
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'campaign_id', 'groups_subscribe_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = CampaignGroupSelected::find();

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
            'campaign_id' => $this->campaign_id,
            'groups_subscribe_id' => $this->groups_subscribe_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
