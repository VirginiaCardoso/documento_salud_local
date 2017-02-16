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
class CajaDiariaFiltro extends \yii\db\ActiveRecord
{
   public  $dia;
    
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
           [['dia'], 'required'],

            
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
                ->joinWith('devolu');

        // add conditions that should always apply here
         
        $this->load($params);
/*
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

         if (isset($this->dia)) {
            // $nvodia = \DateTime::createFromFormat('Y-m-d',  $this->dia);
            // $fecha_inicio_format = $nueva_inicio->format('Y-m-d');  
         //   $nvodia =  $nvodia->format('Y-m-d');      
             $query->andFilterWhere(['=', 'LI_FECPED',$this->dia]);
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

    

      
}
