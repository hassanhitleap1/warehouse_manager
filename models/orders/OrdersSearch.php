<?php

namespace app\models\orders;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\orders\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\orders\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'region_id', 'area_id', 'status_id','delivery_price','discount','total_price','amount_required'], 'integer'],
            [['order_id', 'delivery_date','user_id', 'delivery_time', 'address', 'phone','created_at', 'updated_at'], 'safe'],
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
        $query = Orders::find();

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
        $query->joinWith('user');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'delivery_date' => $this->delivery_date,
            'delivery_time' => $this->delivery_time,
            'orders.country_id' => $this->country_id,
            'orders.region_id' => $this->region_id,
            'orders.area_id' => $this->area_id,
            'delivery_price' => $this->delivery_price,
            'discount' => $this->discount,
            'total_price' => $this->total_price,
            'amount_required' => $this->amount_required,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'user.name', $this->user_id])
            ->andFilterWhere(['like', 'user.phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
