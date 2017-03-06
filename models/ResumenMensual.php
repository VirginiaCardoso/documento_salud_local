<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
//use yii\db\Query;

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

        $this->load($params);

            
        $start_date= date('Y-m-01', strtotime($this->mes));
            // Last day of the month.
        $end_date = date('Y-m-t', strtotime($this->mes));

        $query = Libretas::find();
        $query->sql =  "SELECT libretas.LI_FECPED,libretas.LI_TPOSER,COUNT(*) as cant, sum(libretas.LI_IMPORTE) as recau, lib2.fecha2,lib2.tipo2, lib2.cant2, lib2.recau2, (sum(libretas.LI_IMPORTE)+lib2.recau2) as totalrecau  FROM libretas INNER JOIN ( SELECT LI_FECPED as fecha2 ,LI_TPOSER as tipo2 ,COUNT(*) as cant2, sum(LI_IMPORTE) as recau2 FROM libretas WHERE LI_TPOSER = 05 OR LI_TPOSER= 06 OR LI_TPOSER = 07 GROUP BY LI_FECPED) as lib2 ON libretas.LI_FECPED= lib2.fecha2 WHERE (libretas.LI_TPOSER = 01 OR libretas.LI_TPOSER = 02 OR libretas.LI_TPOSER = 03) AND (libretas.LI_FECPED BETWEEN '".$start_date."' AND '".$end_date."' )  GROUP BY libretas.LI_FECPED ";
  
     
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }

/**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function buscarMes($mesval,$anioval)
    {

      //  $this->load($params);
        //$mes = date('Y', strtotime($mes));
          var_dump("mes ".$mesval); 
          var_dump("año ".$anioval); 
          $mes = strtotime($anioval)."/".strtotime($mesval);
           var_dump("mes unid".$mes); 
        $start_date= date('Y-m-01', strtotime($mes));
        //  var_dump($start_date);
            // Last day of the month.
        $end_date = date('Y-m-t', strtotime($mes));
      //  var_dump($end_date);
        $query = Libretas::find();
        $query->sql =  "SELECT libretas.LI_FECPED,libretas.LI_TPOSER,COUNT(*) as cant, sum(libretas.LI_IMPORTE) as recau, lib2.fecha2,lib2.tipo2, lib2.cant2, lib2.recau2, (sum(libretas.LI_IMPORTE)+lib2.recau2) as totalrecau  FROM libretas INNER JOIN ( SELECT LI_FECPED as fecha2 ,LI_TPOSER as tipo2 ,COUNT(*) as cant2, sum(LI_IMPORTE) as recau2 FROM libretas WHERE LI_TPOSER = 05 OR LI_TPOSER= 06 OR LI_TPOSER = 07 GROUP BY LI_FECPED) as lib2 ON libretas.LI_FECPED= lib2.fecha2 WHERE (libretas.LI_TPOSER = 01 OR libretas.LI_TPOSER = 02 OR libretas.LI_TPOSER = 03) AND (libretas.LI_FECPED BETWEEN '".$start_date."' AND '".$end_date."' )  GROUP BY libretas.LI_FECPED ";
  
     
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }


/**
 * [calcularImporte description]
 * @param  [type] $fecha [description]
 * @return [type]        [description]
 */
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
