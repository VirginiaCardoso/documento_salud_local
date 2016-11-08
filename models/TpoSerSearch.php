<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\TpoSer;

/**
 * TpoSerSearch represents the model behind the search form about `documento_salud\models\TpoSer`.
 */
class TpoSerSearch extends TpoSer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TS_COD', 'TS_DESC', 'TS_CLASE'], 'safe'],
            [['TS_IMP'], 'number'],
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
        $query = TpoSer::find();

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
            'TS_IMP' => $this->TS_IMP,
        ]);

        $query->andFilterWhere(['like', 'TS_COD', $this->TS_COD])
            ->andFilterWhere(['like', 'TS_DESC', $this->TS_DESC])
            ->andFilterWhere(['like', 'TS_CLASE', $this->TS_CLASE]);

        return $dataProvider;
    }
}
