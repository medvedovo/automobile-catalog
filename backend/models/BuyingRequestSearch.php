<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BuyingRequest;

/**
 * BuyingRequestSearch represents the model behind the search form about `common\models\BuyingRequest`.
 */
class BuyingRequestSearch extends BuyingRequest
{
    public $brand;
    public $carModel;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'brand_id', 'car_model_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone', 'brand', 'carModel'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = BuyingRequest::find();

        $query->joinWith(['brand', 'carModel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['brand'] = [
            'asc' => ['brand.name' => SORT_ASC],
            'desc' => ['brand.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['carModel'] = [
            'asc' => ['car_model.name' => SORT_ASC],
            'desc' => ['car_model.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'car_model_id' => $this->car_model_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'brand.name', $this->brand])
            ->andFilterWhere(['like', 'car_model.name', $this->carModel]);

        return $dataProvider;
    }
}
