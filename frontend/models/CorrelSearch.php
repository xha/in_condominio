<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Correl;

/**
 * CorrelSearch represents the model behind the search form about `frontend\models\Correl`.
 */
class CorrelSearch extends Correl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_correl'], 'safe'],
            [['canon', 'activo'], 'number'],
            ['CodVend', 'string'],
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
        $query = Correl::find();

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
            'id_correl' => $this->id_correl,
            'canon' => $this->canon,
            'CodVend' => $this->CodVend,
            'activo' => $this->activo,
        ]);

        return $dataProvider;
    }
}
