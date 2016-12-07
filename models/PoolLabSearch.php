<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\PoolLab;

/**
 * PoolLabSearch represents the model behind the search form about `documento_salud\models\PoolLab`.
 */
class PoolLabSearch extends PoolLab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PO_NROLIB', 'PO_FEC', 'PO_HORA', 'PO_COLEST', 'PO_GLUCOSA'], 'safe'],
            [['PO_MUESTRA', 'PO_LISTO'], 'integer'],
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
        $query = PoolLab::find();

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
            //'PO_FEC' => $this->PO_FEC,
           // 'PO_HORA' => $this->PO_HORA,
            'PO_MUESTRA' => $this->PO_MUESTRA,
            'PO_LISTO' => $this->PO_LISTO,
        ]);

        if (isset($this->PO_FEC) && !$this->PO_FEC=='') {
           //  $nueva_fin = \DateTime::createFromFormat('d-m-Y',  $this->PO_FEC);
            // $fecha_fin_format = $nueva_fin->format('Y-m-d');
           // $nuevohasta = $nueva_fin->format('Y-m-d'); 
             $query->andFilterWhere(['<=', 'PO_FEC', $this->PO_FEC]);
         }

        $query->andFilterWhere(['like', 'PO_NROLIB', $this->PO_NROLIB])
            ->andFilterWhere(['like', 'PO_COLEST', $this->PO_COLEST])
            ->andFilterWhere(['like', 'PO_GLUCOSA', $this->PO_GLUCOSA])
            ->andFilterWhere(['=', 'PO_LISTO', 0]);

        $query->orderBy([
            'PO_FEC' => SORT_DESC
        ]);

        return $dataProvider;
    }
}
