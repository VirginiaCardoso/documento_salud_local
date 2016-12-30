<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Doclab;

/**
 * DoclabSearch represents the model behind the search form about `documento_salud\models\Doclab`.
 */
class DoclabSearch extends Doclab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DO_NRO', 'DO_CODCLI', 'DO_OCU', 'DO_RUBRO', 'DO_RUBTIP', 'DO_ESCOL', 'DO_INGRES', 'DO_FUMA', 'DO_FASTAB', 'DO_ALCOH', 'DO_CAGE', 'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_TRATHI', 'DO_COLEST', 'DO_TRATCO', 'DO_DIABET', 'DO_TRATDI', 'DO_ANTQUI', 'DO_ONCO', 'DO_EMBARA', 'DO_ANOVU', 'DO_MENOP', 'DO_TRH', 'DO_ASMAEP', 'DO_PROSTA', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_VENER', 'DO_DOLLUM', 'DO_FADI', 'DO_FAHIPE', 'DO_FACARD', 'DO_FAONCO', 'DO_PAENOM', 'DO_MAENOM', 'DO_HEENON', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB', 'DO_TALLA', 'DO_DATOS', 'DO_DATINT'], 'safe'],
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
        $query = Doclab::find();

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
        $query->andFilterWhere(['like', 'DO_NRO', $this->DO_NRO])
            ->andFilterWhere(['like', 'DO_CODCLI', $this->DO_CODCLI])
            ->andFilterWhere(['like', 'DO_OCU', $this->DO_OCU])
            ->andFilterWhere(['like', 'DO_RUBRO', $this->DO_RUBRO])
            ->andFilterWhere(['like', 'DO_RUBTIP', $this->DO_RUBTIP])
            ->andFilterWhere(['like', 'DO_ESCOL', $this->DO_ESCOL])
            ->andFilterWhere(['like', 'DO_INGRES', $this->DO_INGRES])
            ->andFilterWhere(['like', 'DO_FUMA', $this->DO_FUMA])
            ->andFilterWhere(['like', 'DO_FASTAB', $this->DO_FASTAB])
            ->andFilterWhere(['like', 'DO_ALCOH', $this->DO_ALCOH])
            ->andFilterWhere(['like', 'DO_CAGE', $this->DO_CAGE])
            ->andFilterWhere(['like', 'DO_SEDAN', $this->DO_SEDAN])
            ->andFilterWhere(['like', 'DO_DEPOR', $this->DO_DEPOR])
            ->andFilterWhere(['like', 'DO_SUENIO', $this->DO_SUENIO])
            ->andFilterWhere(['like', 'DO_EAC', $this->DO_EAC])
            ->andFilterWhere(['like', 'DO_HIPERT', $this->DO_HIPERT])
            ->andFilterWhere(['like', 'DO_TRATHI', $this->DO_TRATHI])
            ->andFilterWhere(['like', 'DO_COLEST', $this->DO_COLEST])
            ->andFilterWhere(['like', 'DO_TRATCO', $this->DO_TRATCO])
            ->andFilterWhere(['like', 'DO_DIABET', $this->DO_DIABET])
            ->andFilterWhere(['like', 'DO_TRATDI', $this->DO_TRATDI])
            ->andFilterWhere(['like', 'DO_ANTQUI', $this->DO_ANTQUI])
            ->andFilterWhere(['like', 'DO_ONCO', $this->DO_ONCO])
            ->andFilterWhere(['like', 'DO_EMBARA', $this->DO_EMBARA])
            ->andFilterWhere(['like', 'DO_ANOVU', $this->DO_ANOVU])
            ->andFilterWhere(['like', 'DO_MENOP', $this->DO_MENOP])
            ->andFilterWhere(['like', 'DO_TRH', $this->DO_TRH])
            ->andFilterWhere(['like', 'DO_ASMAEP', $this->DO_ASMAEP])
            ->andFilterWhere(['like', 'DO_PROSTA', $this->DO_PROSTA])
            ->andFilterWhere(['like', 'DO_RUBEO', $this->DO_RUBEO])
            ->andFilterWhere(['like', 'DO_TETANO', $this->DO_TETANO])
            ->andFilterWhere(['like', 'DO_ANTIGR', $this->DO_ANTIGR])
            ->andFilterWhere(['like', 'DO_ANTIHE', $this->DO_ANTIHE])
            ->andFilterWhere(['like', 'DO_TRANSF', $this->DO_TRANSF])
            ->andFilterWhere(['like', 'DO_VENER', $this->DO_VENER])
            ->andFilterWhere(['like', 'DO_DOLLUM', $this->DO_DOLLUM])
            ->andFilterWhere(['like', 'DO_FADI', $this->DO_FADI])
            ->andFilterWhere(['like', 'DO_FAHIPE', $this->DO_FAHIPE])
            ->andFilterWhere(['like', 'DO_FACARD', $this->DO_FACARD])
            ->andFilterWhere(['like', 'DO_FAONCO', $this->DO_FAONCO])
            ->andFilterWhere(['like', 'DO_PAENOM', $this->DO_PAENOM])
            ->andFilterWhere(['like', 'DO_MAENOM', $this->DO_MAENOM])
            ->andFilterWhere(['like', 'DO_HEENON', $this->DO_HEENON])
            ->andFilterWhere(['like', 'DO_NEVOS', $this->DO_NEVOS])
            ->andFilterWhere(['like', 'DO_NODMAN', $this->DO_NODMAN])
            ->andFilterWhere(['like', 'DO_SOPLOS', $this->DO_SOPLOS])
            ->andFilterWhere(['like', 'DO_TUMAB', $this->DO_TUMAB])
            ->andFilterWhere(['like', 'DO_TALLA', $this->DO_TALLA])
            ->andFilterWhere(['like', 'DO_DATOS', $this->DO_DATOS])
            ->andFilterWhere(['like', 'DO_DATINT', $this->DO_DATINT]);

        return $dataProvider;
    }
}
