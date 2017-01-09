<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Doclabau;

/**
 * DoclabauSearch represents the model behind the search form about `documento_salud\models\Doclabau`.
 */
class DoclabauSearch extends Doclabau
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DO_CODLIB', 'DO_VISITA', 'DO_PESO', 'DO_TENAR1', 'DO_TENAR2', 'DO_COLEST', 'DO_GLUCO', 'DO_PAP', 'DO_MAM', 'DO_OBS', 'DO_CINTURA', 'DO_TRIPLI', 'DO_HDL', 'DO_IMC'], 'safe'],
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
        $query = Doclabau::find();

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
            'DO_VISITA' => $this->DO_VISITA,
        ]);

        $query->andFilterWhere(['like', 'DO_CODLIB', $this->DO_CODLIB])
            ->andFilterWhere(['like', 'DO_PESO', $this->DO_PESO])
            ->andFilterWhere(['like', 'DO_TENAR1', $this->DO_TENAR1])
            ->andFilterWhere(['like', 'DO_TENAR2', $this->DO_TENAR2])
            ->andFilterWhere(['like', 'DO_COLEST', $this->DO_COLEST])
            ->andFilterWhere(['like', 'DO_GLUCO', $this->DO_GLUCO])
            ->andFilterWhere(['like', 'DO_PAP', $this->DO_PAP])
            ->andFilterWhere(['like', 'DO_MAM', $this->DO_MAM])
            ->andFilterWhere(['like', 'DO_OBS', $this->DO_OBS])
            ->andFilterWhere(['like', 'DO_CINTURA', $this->DO_CINTURA])
            ->andFilterWhere(['like', 'DO_TRIPLI', $this->DO_TRIPLI])
            ->andFilterWhere(['like', 'DO_HDL', $this->DO_HDL])
            ->andFilterWhere(['like', 'DO_IMC', $this->DO_IMC]);

        return $dataProvider;
    }
}
