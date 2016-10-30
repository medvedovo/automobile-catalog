<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CarModel;

/**
 * CarModelSearch represents the model behind the search form about `common\models\CarModel`.
 */
class CarModelSearch extends CarModel
{
    public $brand;
    public $bodyType;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'body_type_id', 'brand_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug', 'description', 'brand', 'bodyType'], 'safe'],
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
        $query = CarModel::find();

        $query->joinWith(['brand', 'bodyType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['brand'] = [
            'asc' => ['brand.name' => SORT_ASC],
            'desc' => ['brand.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['bodyType'] = [
            'asc' => ['body_type.name' => SORT_ASC],
            'desc' => ['body_type.name' => SORT_DESC],
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
            'body_type_id' => $this->body_type_id,
            'brand_id' => $this->brand_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'brand.name', $this->brand])
            ->andFilterWhere(['like', 'body_type.name', $this->bodyType]);

        return $dataProvider;
    }
}
