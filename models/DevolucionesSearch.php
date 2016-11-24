<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Devoluciones;

/**
 * DevolucionesSearch represents the model behind the search form about `documento_salud\models\Devoluciones`.
 */
class DevolucionesSearch extends Devoluciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DE_COD'], 'integer'],
            [['DE_NROTRA', 'DE_FECHA'], 'safe'],
            [['DE_IMPORT'], 'number'],
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
        $query = Devoluciones::find();

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
            'DE_COD' => $this->DE_COD,
            'DE_IMPORT' => $this->DE_IMPORT,
            'DE_FECHA' => $this->DE_FECHA,
        ]);

        $query->andFilterWhere(['like', 'DE_NROTRA', $this->DE_NROTRA]);

        return $dataProvider;
    }
}
