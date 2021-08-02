<?php

namespace app\models\historystatus;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\historystatus\HistoryStatus;

/**
 * HistoryStatusSearch represents the model behind the search form of `app\models\historystatus\HistoryStatus`.
 */
class HistoryStatusSearch extends HistoryStatus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'order_id'], 'integer'],
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
        $query = HistoryStatus::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('status');
        $query->joinWith('order');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if(isset($_GET["order_id"]) && $_GET["order_id"] !=""){
            $query->andWhere(["history_status.order_id" ,$_GET["order_id"] ]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'history_status.id' => $this->id,
            'history_status.status_id' => $this->status_id,
            'history_status.order_id' => $this->order_id,
            'history_status.created_at' => $this->created_at,
            'history_status.updated_at' => $this->updated_at,
        ]);

        $query->orderBy(['history_status.id' => SORT_DESC]);;

        return $dataProvider;
    }
}
