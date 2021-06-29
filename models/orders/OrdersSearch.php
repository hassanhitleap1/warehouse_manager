<?php

namespace app\models\orders;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\orders\Orders;
use kartik\daterange\DateRangeBehavior;

/**
 * OrdersSearch represents the model behind the search form of `app\models\orders\Orders`.
 */
class OrdersSearch extends Orders
{

    public $search_string;
    public $products_id ;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'region_id','area_id', 'status_id','delivery_price','discount','total_price','amount_required'], 'integer'],
            [['order_id', 'search_string','delivery_date','user_id', 'delivery_time', 'address', 'phone','created_at', 'updated_at','products_id'], 'safe'],

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
//        var_dump($this->products_id);
//        exit();
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

        if(isset($_GET['string_id'])){
            $string_id=$_GET['string_id'];
           $ides = explode(",", $string_id);
           $query->where(['in','orders.id',$ides]);
        }



        $query->joinWith('user');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'orders.order_id' => $this->order_id,
            'orders.delivery_date' => $this->delivery_date,
            'orders.delivery_time' => $this->delivery_time,
            'orders.country_id' => $this->country_id,
            'orders.region_id' => $this->region_id,
            // 'orders.area_id' => $this->area_id,
            'orders.delivery_price' => $this->delivery_price,
            'orders.discount' => $this->discount,
            'orders.total_price' => $this->total_price,
            'orders.amount_required' => $this->amount_required,
            'orders.status_id' => $this->status_id,
//            'DATE(orders.created_at)' => $this->created_at,
//            'orders.updated_at' => $this->updated_at,
        ]);
      
      
        if(!is_null($this->created_at) && $this->created_at !=''){
            $arr_date=explode(' - ',$this->created_at);
            $query->andFilterWhere(['>=', 'DATE(orders.created_at)', $arr_date[0]])
            ->andFilterWhere(['<=', 'DATE(orders.created_at)', $arr_date[1]]);
        }
       

        $query->andFilterWhere ( [ 'OR' ,
            [ 'like' , 'user.name' , $this->search_string ],
            [ 'like' , 'user.phone' , $this->search_string ],
            [ 'like' , 'orders.address' , $this->search_string ],
        ]);
        

        $query->andFilterWhere(['like', 'user.name', $this->user_id])
            ->andFilterWhere(['like', 'user.phone', $this->phone])
            ->andFilterWhere(['like', 'orders.address', $this->address]);
            $query->orderBy(['orders.id' => SORT_DESC]);;

        // echo $query->createCommand()->getRawSql();
        // exit;
        return $dataProvider;
    }
}
