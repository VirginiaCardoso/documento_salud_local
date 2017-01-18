<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use documento_salud\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form about `documento_salud\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CL_COD', 'CL_TIPDOC', 'CL_NUMDOC', 'CL_APENOM', 'CL_FECNAC', 'CL_CODLOC', 'CL_DOMICI', 'CL_TEL', 'CL_LUGTRA', 'CL_NROHAB', 'CL_SEXO', 'CL_ESTCIV', 'CL_IMG', 'CL_EMAIL'], 'safe'],
             
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
        $query = Clientes::find();

        // add conditions that should always apply here
         $pagina = 0;
        if (isset($_POST['pagina']))
            $pagina = $_POST['pagina'];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => [
                'pageSize' => 10,
                'page' => $pagina,
            ]
        ]);

        //$this->load($params);
        
        if (isset ($_POST['ClientesSearch'])) {
            $this->load(Yii::$app->request->post());
        }
        else {
            // si no se reciben parámetros, no se retorna ningún resultado
            //$query->where('0=1');
            return $dataProvider;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'CL_FECNAC' => $this->CL_FECNAC,
        ]);

        $query->andFilterWhere(['like', 'CL_COD', $this->CL_COD])
            ->andFilterWhere(['like', 'CL_TIPDOC', $this->CL_TIPDOC])
            ->andFilterWhere(['like', 'CL_NUMDOC', $this->CL_NUMDOC]);
            //->andFilterWhere(['like', 'CL_APENOM', $this->CL_APENOM])
           // ->andFilterWhere(['like', 'CL_CODLOC', $this->CL_CODLOC])
          //  ->andFilterWhere(['like', 'CL_DOMICI', $this->CL_DOMICI])
           // ->andFilterWhere(['like', 'CL_TEL', $this->CL_TEL])
           // ->andFilterWhere(['like', 'CL_LUGTRA', $this->CL_LUGTRA])
            //->andFilterWhere(['like', 'CL_NROHAB', $this->CL_NROHAB])
          //  ->andFilterWhere(['like', 'CL_SEXO', $this->CL_SEXO])
           // ->andFilterWhere(['like', 'CL_ESTCIV', $this->CL_ESTCIV])
          //  ->andFilterWhere(['like', 'CL_IMG', $this->CL_IMG])
          //  ->andFilterWhere(['like', 'CL_EMAIL', $this->CL_EMAIL]);

        $nombres = explode(" ", $this->CL_APENOM);
        foreach ($nombres as $nombre) {
            $query->andFilterWhere(['like', 'CL_APENOM', $nombre]);
        }

        return $dataProvider;
    }

    public function buscar($params)
    {
        $query = Clientes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        $this->load($params);

        if (empty($this->CL_COD) && empty($this->CL_NUMDOC) && empty($this->CL_APENOM)) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'CL_COD' => $this->CL_COD,
            'CL_TIPDOC' => $this->CL_TIPDOC,
            'CL_NUMDOC' => $this->CL_NUMDOC,
        ]);

        // Se busca por cada nombre y cada apellido, por si aparecen en otro orden. Así, encontrará si se busca "Juan Pérez" o "Pérez Juan"
        $nombres = explode(" ", $this->CL_APENOM);
        foreach ($nombres as $nombre) {
            $query->andFilterWhere(['like', 'CL_APENOM', $nombre]);
        }

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params)
    {
        $query = Clientes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['CL_COD' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'CL_FECNAC' => $this->CL_FECNAC,
        ]);

        $query->andFilterWhere(['like', 'CL_COD', $this->CL_COD])
            ->andFilterWhere(['like', 'CL_TIPDOC', $this->CL_TIPDOC])
            ->andFilterWhere(['like', 'CL_NUMDOC', $this->CL_NUMDOC])
            ->andFilterWhere(['like', 'CL_APENOM', $this->CL_APENOM])
            ->andFilterWhere(['like', 'CL_CODLOC', $this->CL_CODLOC])
            ->andFilterWhere(['like', 'CL_DOMICI', $this->CL_DOMICI])
            ->andFilterWhere(['like', 'CL_TEL', $this->CL_TEL])
            ->andFilterWhere(['like', 'CL_LUGTRA', $this->CL_LUGTRA])
            ->andFilterWhere(['like', 'CL_NROHAB', $this->CL_NROHAB])
            ->andFilterWhere(['like', 'CL_SEXO', $this->CL_SEXO])
            ->andFilterWhere(['like', 'CL_ESTCIV', $this->CL_ESTCIV])
            ->andFilterWhere(['like', 'CL_IMG', $this->CL_IMG])
            ->andFilterWhere(['like', 'CL_EMAIL', $this->CL_EMAIL]);

        return $dataProvider;
    }
}
