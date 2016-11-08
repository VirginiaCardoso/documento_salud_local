<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Clases;

/**
 * ClasesSearch represents the model behind the search form about `documento_salud\models\Clases`.
 */
class ClasesSearch extends Clases
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CL_COD', 'CL_DESC'], 'safe'],
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
        $query = Clases::find();

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
        $query->andFilterWhere(['like', 'CL_COD', $this->CL_COD])
            ->andFilterWhere(['like', 'CL_DESC', $this->CL_DESC]);

        return $dataProvider;
    }
}
