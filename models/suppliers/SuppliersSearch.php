<?php

namespace app\models\suppliers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\suppliers\Suppliers;

/**
 * SuppliersSearch represents the model behind the search form of `app\models\suppliers\Suppliers`.
 */
class SuppliersSearch extends Suppliers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'region_id', 'area_id'], 'integer'],
            [['name', 'phone', 'other_phone', 'site', 'location', 'email', 'created_at', 'updated_at'], 'safe'],
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
        $query = Suppliers::find();

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
            'country_id' => $this->country_id,
            'region_id' => $this->region_id,
            'area_id' => $this->area_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'other_phone', $this->other_phone])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
