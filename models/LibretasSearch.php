<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Libretas;

/**
 * LibretasSearch represents the model behind the search form about `documento_salud\models\Libretas`.
 */
class LibretasSearch extends Libretas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LI_NRO', 'LI_COCLI', 'LI_FECPED', 'LI_TPOSER', 'LI_CONVEN', 'LI_FECRET','LI_FECIMP', 'LI_FECVTO', 'LI_COMP', 'LI_ADIC', 'LI_HORA'], 'safe'],
            [['LI_CONSULT', 'LI_ESTUD', 'LI_IMPR', 'LI_ANULADA', 'LI_REIMPR', 'LI_SELECT'], 'integer'],
            [['LI_IMPORTE', 'LI_IMPADI'], 'number'],
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
        $query = Libretas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['LI_NRO' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'LI_FECPED' => $this->LI_FECPED,
            'LI_CONSULT' => $this->LI_CONSULT,
            'LI_ESTUD' => $this->LI_ESTUD,
            'LI_IMPR' => $this->LI_IMPR,
            'LI_FECRET' => $this->LI_FECRET,
            'LI_IMPORTE' => $this->LI_IMPORTE,
            'LI_FECIMP' => $this->LI_FECIMP,
            'LI_FECVTO' => $this->LI_FECVTO,
            'LI_ANULADA' => $this->LI_ANULADA,
            'LI_IMPADI' => $this->LI_IMPADI,
            'LI_REIMPR' => $this->LI_REIMPR,
            'LI_SELECT' => $this->LI_SELECT,
            'LI_HORA' => $this->LI_HORA,
        ]);

        $query->andFilterWhere(['like', 'LI_NRO', $this->LI_NRO])
            ->andFilterWhere(['like', 'LI_COCLI', $this->LI_COCLI])
            ->andFilterWhere(['like', 'LI_TPOSER', $this->LI_TPOSER])
            ->andFilterWhere(['like', 'LI_CONVEN', $this->LI_CONVEN])
            ->andFilterWhere(['like', 'LI_COMP', $this->LI_COMP])
            ->andFilterWhere(['like', 'LI_ADIC', $this->LI_ADIC]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchMenores($params)
    {
        $query = Libretas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['LI_FECPED' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (isset($this->LI_FECPED) && !$this->LI_FECPED=='') {
           //  $nueva_fin = \DateTime::createFromFormat('d-m-Y',  $this->PO_FEC);
            // $fecha_fin_format = $nueva_fin->format('Y-m-d');
           // $nuevohasta = $nueva_fin->format('Y-m-d'); 
             $query->andFilterWhere(['<=', 'LI_FECPED', $this->LI_FECPED]);
        }

        $query->andFilterWhere(['=', 'LI_CONSULT', 0])
            ->andFilterWhere(['=', 'LI_ANULADA', 0]);

        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchConsulta($params)
    {
        $query = Libretas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => [
                'LI_FECPED' => SORT_DESC,
                //related columns
             ],
        ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

      /*  if (isset($this->LI_FECPED) && !$this->LI_FECPED=='') {
           //  $nueva_fin = \DateTime::createFromFormat('d-m-Y',  $this->PO_FEC);
            // $fecha_fin_format = $nueva_fin->format('Y-m-d');
           // $nuevohasta = $nueva_fin->format('Y-m-d'); 
             $query->andFilterWhere(['<=', 'LI_FECPED', $this->LI_FECPED]);
        }
*/      
        $query->andFilterWhere([
            'LI_NRO' => $this->LI_NRO,
            'LI_COCLI' => $this->LI_COCLI,
            'LI_FECPED' => $this->LI_FECPED,
        ]);

       $query->andFilterWhere(['=', 'LI_CONSULT', 1])
            ->andFilterWhere(['=', 'LI_ANULADA', 0]);

//var_dump($query);
        return $dataProvider;
    }

     /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
  /*  public function searchUltimoTramite($codcli)
    {
        $query = Libretas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => ['attributes' => ['DE_HISCLI']],
        ]);

        //$this->load($params);

       

        // grid filtering conditions

        
        $query->andFilterWhere([
            'LI_COCLI' => $codcli,
        ]);

        $query->andFilterWhere(['IS', 'LI_ANULADA', 0]); 
         
            
        $query->orderBy([
            'DE_FECHA' => SORT_DESC, 'DE_HORA' => SORT_DESC
        ]);

        var_dump($query);
    return $dataProvider['LI_FECPED'];

    }*/
}
