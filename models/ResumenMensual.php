<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use documento_salud\models\Libretas;

/**
 *
 */
class ResumenMensual extends \yii\db\ActiveRecord
{
   public  $mes;
   public  $anio;
    
     public static function tableName()
    {
        return 'libretas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
           [['mes', 'anio'], 'required'],

            
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
        $query = Libretas::find()
        ->select('*, COUNT(*) as cant, sum(LI_IMPORTE) as recau')

                ->joinWith('devolu')//;
              //  ->select(['COUNT(*) AS cnt'])
              ->groupBy(['LI_FECPED','LI_TPOSER']);

        // add conditions that should always apply here
         
        $this->load($params);
/*
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

         if (isset($this->mes)) {
            // $nvodia = \DateTime::createFromFormat('Y-m-d',  $this->dia);
            // $fecha_inicio_format = $nueva_inicio->format('Y-m-d');  
             //   $nvodia =  $nvodia->format('Y-m-d'); 
             //   
             //   // First day of the month.
           // $nmonth = date('m',strtotime($this->mes));  
           // $query_date = $this->anio+'-'+$nmonth+'-01';
            $start_date= date('Y-m-01', strtotime($this->mes));//$query_date));

            // Last day of the month.
            $end_date = date('Y-m-t', strtotime($this->mes));//$query_date));

             $query->andFilterWhere(['between', 'LI_FECPED', $start_date, $end_date]);
            // $query->andWhere("'YEAR(`LI_FECPED`)'", $this->anio);
         }

        $query->orderBy([
            'LI_NRO' => SORT_DESC
        ]);

       $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }

    public function calcularImporte($fecha){
        $result = Libretas::find()
        ->select(['libretas.LI_NRO','libretas.LI_IMPORTE', 'devolu.DE_IMPORT'])

                ->joinWith('devolu');
        $result->andFilterWhere(['=', 'LI_FECPED',$fecha]);  

        $result= $result->asArray()->all();

        $subimporte = 0;
        $subdevol = 0;

        foreach ($result as $fila){
            $subimporte= $subimporte + $fila['LI_IMPORTE'];
            $subdevol= $subdevol + $fila['DE_IMPORT'];
        }

        return [
            'subimporte' => $subimporte,
            'subdevol' => $subdevol,
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dia' => 'Fecha',
            ];
    }


    public function buscarFecha($fecha)
    {
        $query = Libretas::find()
                ->joinWith('devolu');

        // add conditions that should always apply here
         
      if (isset($fecha)) {
            // $nvodia = \DateTime::createFromFormat('Y-m-d',  $this->dia);
            // $fecha_inicio_format = $nueva_inicio->format('Y-m-d');  
         //   $nvodia =  $nvodia->format('Y-m-d');      
             $query->andFilterWhere(['=', 'LI_FECPED',$fecha]);
         }

        $query->orderBy([
            'LI_NRO' => SORT_DESC
        ]);

       $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }
    

      
}
