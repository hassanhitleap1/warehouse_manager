<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\products\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'category_id', 'status', 'supplier_id', 'unit_id', 'warehouse_id'], 'integer'],
            [['name', 'thumbnail', 'created_at', 'updated_at'], 'safe'],
            [['purchasing_price', 'selling price'], 'number'],
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
        $query = Products::find();

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
            'purchasing_price' => $this->purchasing_price,
            'selling price' => $this->selling price,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'supplier_id' => $this->supplier_id,
            'unit_id' => $this->unit_id,
            'warehouse_id' => $this->warehouse_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail]);

        return $dataProvider;
    }
}
