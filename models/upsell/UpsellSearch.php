<?php

namespace app\models\upsell;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\upsell\Upsell;

/**
 * UpsellSearch represents the model behind the search form of `app\models\upsell\Upsell`.
 */
class UpsellSearch extends Upsell
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id','upsell_product_id'], 'integer'],
            [[ 'created_at', 'updated_at'], 'safe'],
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
        $query = Upsell::find();

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
        if(isset($_GET['product_id']) && $_GET['product_id'] !=-1){

            $query->andWhere(['product_id' => $_GET['product_id']]) ;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'upsell_product_id'=> $this->upsell_product_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);


        return $dataProvider;
    }
}
