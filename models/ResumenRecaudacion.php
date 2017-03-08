<?php

namespace documento_salud\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
//use yii\db\Query;

use documento_salud\models\Libretas;
use documento_salud\models\Devoluciones;

/**
 *
 */
class ResumenRecaudacion extends \yii\db\ActiveRecord
{
   public  $desde;
   public  $hasta;
   public  $rango;
    
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
           [['desde', 'hasta'], 'required'],

            
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

   
    public function calcularValores($tposerv){
       // var_dump("serv ".$tposerv);

        /*SELECT COUNT(*) as cant, sum(libretas.LI_IMPORTE) as recau  FROM libretas WHERE libretas.LI_TPOSER = 05  AND (libretas.LI_FECPED BETWEEN '2017-01-01' AND '2017-02-25' ) AND libretas.LI_ANULADA=0
            */
        $des =   date('Y-m-d', strtotime($this->desde));
        $has =   date('Y-m-d', strtotime($this->hasta));
        $query = Libretas::find();
        $query->sql =  "SELECT COUNT(*) as cant, sum(libretas.LI_IMPORTE) as recau  FROM libretas WHERE libretas.LI_TPOSER = ".$tposerv."  AND (libretas.LI_FECPED BETWEEN '".$des."' AND '".$has."' ) AND libretas.LI_ANULADA=0"; 
        $result= $query->asArray()->all();

        $cant = 0;
        $recau = 0;

        foreach ($result as $fila){
            $cant= $cant + $fila['cant'];
            $recau= $recau + $fila['recau'];
        }

        /*SELECT sum(devolu.DE_IMPORT) as dev FROM devolu INNER JOIN libretas ON libretas.LI_NRO = devolu.DE_NROTRA WHERE libretas.LI_TPOSER = 05 AND (libretas.LI_FECPED BETWEEN '2017-01-01' AND '2017-02-25' )*/
        $query2 = Devoluciones::find();
        $query2->sql =  "SELECT sum(devolu.DE_IMPORT) as dev FROM devolu INNER JOIN libretas ON libretas.LI_NRO = devolu.DE_NROTRA WHERE libretas.LI_TPOSER = ".$tposerv."  AND (libretas.LI_FECPED BETWEEN '".$this->desde."' AND '".$this->hasta."' )AND libretas.LI_ANULADA=0"; 

        $result2= $query2->asArray()->all();

        $dev = 0;
        foreach ($result2 as $fila2){
            $dev= $dev + $fila2['dev'];
        }

        return [
            'cant' => $cant,
            'recau' => $recau,
            'dev' =>$dev,

        ];

    }

        public function calcularAnuladasNuevas(){

     
        /*
        SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE libretas.LI_TPOSER = 03  AND (libretas.LI_FECPED BETWEEN '2017-01-01' AND '2017-02-25' )AND libretas.LI_ANULADA=1
         */
        $des =   date('Y-m-d', strtotime($this->desde));
        $has =   date('Y-m-d', strtotime($this->hasta));
        $query3 = Libretas::find();
        $query3->sql =  "SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE (libretas.LI_TPOSER = 05 OR libretas.LI_TPOSER = 01)  AND (libretas.LI_FECPED BETWEEN '".$des."' AND '".$has."' ) AND libretas.LI_ANULADA=1"; 

        $result3= $query3->asArray()->all();

        $cantanul = 0;
        $recauanul = 0;

        foreach ($result3 as $fila3){
            $cantanul= $cantanul + $fila3['cantanul'];
            $recauanul= $recauanul + $fila3['recauanul'];
        }

        return [
            'cantanul' =>$cantanul,
            'recauanul' => $recauanul,
        ];

    }
        public function calcularAnuladasRenov(){

     
        /*
        SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE libretas.LI_TPOSER = 03  AND (libretas.LI_FECPED BETWEEN '2017-01-01' AND '2017-02-25' )AND libretas.LI_ANULADA=1
         */
        $des =   date('Y-m-d', strtotime($this->desde));
        $has =   date('Y-m-d', strtotime($this->hasta));
        $query3 = Libretas::find();
        $query3->sql =  "SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE (libretas.LI_TPOSER = 06 OR libretas.LI_TPOSER = 02)  AND (libretas.LI_FECPED BETWEEN '".$des."' AND '".$has."' ) AND libretas.LI_ANULADA=1"; 

        $result3= $query3->asArray()->all();

        $cantanul = 0;
        $recauanul = 0;

        foreach ($result3 as $fila3){
            $cantanul= $cantanul + $fila3['cantanul'];
            $recauanul= $recauanul + $fila3['recauanul'];
        }

        return [
            'cantanul' =>$cantanul,
            'recauanul' => $recauanul,
        ];

    }

        public function calcularAnuladasVencidas(){

     
        /*
        SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE libretas.LI_TPOSER = 03  AND (libretas.LI_FECPED BETWEEN '2017-01-01' AND '2017-02-25' )AND libretas.LI_ANULADA=1
         */
        $des =   date('Y-m-d', strtotime($this->desde));
        $has =   date('Y-m-d', strtotime($this->hasta));
        $query3 = Libretas::find();
        $query3->sql =  "SELECT COUNT(*) as cantanul, sum(libretas.LI_IMPORTE) as recauanul  FROM libretas WHERE (libretas.LI_TPOSER = 07 OR libretas.LI_TPOSER = 03)  AND (libretas.LI_FECPED BETWEEN '".$des."' AND '".$has."' ) AND libretas.LI_ANULADA=1"; 

        $result3= $query3->asArray()->all();

        $cantanul = 0;
        $recauanul = 0;

        foreach ($result3 as $fila3){
            $cantanul= $cantanul + $fila3['cantanul'];
            $recauanul= $recauanul + $fila3['recauanul'];
        }

        return [
            'cantanul' =>$cantanul,
            'recauanul' => $recauanul,
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rango' => 'Fecha',
            ];
    }

    

      
}
