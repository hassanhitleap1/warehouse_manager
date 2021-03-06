<?php

namespace app\models\subproductcount;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\subproductcount\SubProductCount;

/**
 * SubProductCountSearch represents the model behind the search form of `app\models\subproductcount\SubProductCount`.
 */
class SubProductCountSearch extends SubProductCount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'count'], 'integer'],
            [['type', 'product_id','created_at', 'updated_at'], 'safe'],
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
        $query = SubProductCount::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

  
        $this->load($params);
        $query->joinWith('product');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($_GET['product_id'])){
            $query->andWhere(['product_id'=>$_GET['product_id']]); 
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'count' => $this->count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'products.name', $this->product_id]);

        return $dataProvider;
    }
}
