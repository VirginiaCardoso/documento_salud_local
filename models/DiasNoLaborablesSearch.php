<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\DiasNoLaborables;

/**
 * DiasNoLaborablesSearch represents the model behind the search form about `documento_salud\models\DiasNoLaborables`.
 */
class DiasNoLaborablesSearch extends DiasNoLaborables
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DI_FEC', 'DI_DESCRI'], 'safe'],
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
        $query = DiasNoLaborables::find();

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
            'DI_FEC' => $this->DI_FEC,
        ]);

        $query->andFilterWhere(['like', 'DI_DESCRI', $this->DI_DESCRI]);

        return $dataProvider;
    }
}
