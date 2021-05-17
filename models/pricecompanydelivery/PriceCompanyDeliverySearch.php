<?php

namespace app\models\pricecompanydelivery;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pricecompanydelivery\PriceCompanyDelivery;

/**
 * PriceCompanyDeliverySearch represents the model behind the search form of `app\models\pricecompanydelivery\PriceCompanyDelivery`.
 */
class PriceCompanyDeliverySearch extends PriceCompanyDelivery
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'company_delivery_id'], 'integer'],
            [['price'], 'number'],
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
        $query = PriceCompanyDelivery::find();

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
            'region_id' => $this->region_id,
            'company_delivery_id' => $this->company_delivery_id,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
