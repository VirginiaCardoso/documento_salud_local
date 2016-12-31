<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Ocupa_3;

/**
 * Ocupa_3Search represents the model behind the search form about `documento_salud\models\Ocupa_3`.
 */
class Ocupa_3Search extends Ocupa_3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIPO', 'PADRE_ID', 'ID'], 'safe'],
            [['MAS_NIVEL'], 'integer'],
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
        $query = Ocupa_3::find();

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
            'MAS_NIVEL' => $this->MAS_NIVEL,
        ]);

        $query->andFilterWhere(['like', 'TIPO', $this->TIPO])
            ->andFilterWhere(['like', 'PADRE_ID', $this->PADRE_ID])
            ->andFilterWhere(['like', 'ID', $this->ID]);

        return $dataProvider;
    }
}
