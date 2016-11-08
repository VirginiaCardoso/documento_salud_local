<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Convenios;

/**
 * ConveniosSearch represents the model behind the search form about `documento_salud\models\Convenios`.
 */
class ConveniosSearch extends Convenios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CO_COD', 'CO_DESC'], 'safe'],
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
        $query = Convenios::find();

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
        $query->andFilterWhere(['like', 'CO_COD', $this->CO_COD])
            ->andFilterWhere(['like', 'CO_DESC', $this->CO_DESC]);

        return $dataProvider;
    }
}
