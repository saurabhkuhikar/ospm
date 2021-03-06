<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CylinderList;

/**
 * CylinderListSearch represents the model behind the search form of `app\models\CylinderList`.
 */
class CylinderListSearch extends CylinderList
{
    public $litre_quantity;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_id', 'cylinder_type_id', 'cylinder_quantity', 'selling_price', 'created', 'updated'], 'safe'],
            [['litre_quantity'],'string']
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
        $query = CylinderList::find();
        $query->joinWith(['cylinderTypes']);
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
            'user_id'=>\Yii::$app->user->identity->id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        //$query->andFilterWhere(['like', 'cylinder_type_id', $this->cylinder_type_id])
        $query->andFilterWhere(['like', 'cylinder_quantity', $this->cylinder_quantity])
        ->andFilterWhere(['like', 'selling_price', $this->selling_price]);

        $query->andFilterWhere(['=', 'cylinder_types.litre_quantity', $this->litre_quantity]);

        return $dataProvider;
    }
}
