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
            [['id', 'quantity', 'category_id', 'status', 'supplier_id', 'unit_id', 'warehouse_id','quantity_come'], 'integer'],
            [['name', 'thumbnail','video_url', 'description','created_at', 'updated_at'], 'safe'],
            [['purchasing_price', 'selling_price'], 'number'],
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
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity,
            'quantity_come'=> $this->quantity_come,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'supplier_id' => $this->supplier_id,
            'unit_id' => $this->unit_id,
            'warehouse_id' => $this->warehouse_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'video_url', $this->video_url])
            ->andFilterWhere(['like', 'description', $this->video_url])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail]);

        $query->orderBy(['id' => SORT_DESC]);;


        return $dataProvider;
    }
}
