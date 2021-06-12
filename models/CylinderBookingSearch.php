<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CylinderBooking;

/**
 * CylinderBookingSearch represents the model behind the search form of `app\models\CylinderBooking`.
 */
class CylinderBookingSearch extends CylinderBooking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'supplier_id','customer_id', 'covid_test_result', 'covid_test_date', 'cylinder_type', 'cylinder_quantity', 'total_amount', 'order_date', 'order_status', 'payment_id', 'payment_token', 'payment_status', 'created', 'updated'], 'safe'],
        
            [['id'], 'integer'],
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
        $query = CylinderBooking::find();

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
            'customer_id'=>\Yii::$app->user->identity->id,
            'supplier_id'=> $this->supplier_id, 
            'covid_test_date' => $this->covid_test_date,
            'order_date' => $this->order_date,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $orderStatus = $_GET['status'];
        if($orderStatus == "Pending" || $orderStatus == "Process" || $orderStatus == "Delivered"){
            $orderStatus = $orderStatus;
        }else{
            $orderStatus = Null;
        }

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'supplier_id', $this->supplier_id])
            ->andFilterWhere(['like', 'covid_test_result', $this->covid_test_result])
            ->andFilterWhere(['like', 'cylinder_type', $this->cylinder_type])
            ->andFilterWhere(['like', 'cylinder_quantity', $this->cylinder_quantity])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'order_status', $orderStatus])
            ->andFilterWhere(['like', 'payment_id', $this->payment_id])
            ->andFilterWhere(['like', 'payment_token', $this->payment_token])
            ->andFilterWhere(['like', 'payment_status', $this->payment_status]);

        return $dataProvider;
    }
}