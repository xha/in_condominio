<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Local;

/**
 * LocalSearch represents the model behind the search form about `app\models\Local`.
 */
class LocalSearch extends Local
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_local', 'id_ubicacion', 'id_piso', 'alquiler', 'activo', 'tipo_alquiler'], 'integer'],
            [['CodClie', 'descripcion'], 'safe'],
            [['CodVend'], 'string'],
            [['porcentaje_alicuota','metro', 'monto_alquiler', 'porcentaje_alquiler'], 'number'],
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
        $query = Local::find();

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
            'id_local' => $this->id_local,
            'id_ubicacion' => $this->id_ubicacion,
            'id_piso' => $this->id_piso,
            'porcentaje_alicuota' => $this->porcentaje_alicuota,
            'metro' => $this->metro,
            'alquiler' => $this->alquiler,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'CodClie', $this->CodClie])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
