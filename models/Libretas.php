<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "libretas".
 *
 * @property string $LI_NRO
 * @property string $LI_COCLI
 * @property string $LI_FECPED
 * @property string $LI_TPOSER
 * @property string $LI_CONVEN
 * @property integer $LI_CONSULT
 * @property integer $LI_ESTUD
 * @property string $LI_IMPORTE
 * @property string $LI_FECVTO
 * @property integer $LI_ANULADA
 * @property integer $LI_SELECT
 * @property string $LI_HORA
 * @property string $LI_FHIMPOR
 *
 * @property Doclabau[] $doclabaus
 * @property Clientes $lICOCLI
 * @property Convenios $lICONVEN
 * @property TpoSer $lITPOSER
 */
class Libretas extends \yii\db\ActiveRecord
{
    public $descConvenio;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'libretas';
    }

    public static function databaseName()
    {
        return 'docsl';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbdocsl');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LI_CONVEN','LI_TPOSER','LI_IMPORTE','LI_FECPED','LI_HORA'], 'required'],
            [['LI_NRO'], 'unique'], 
            [['LI_FECPED',  'LI_FECVTO', 'LI_HORA'], 'safe'],
            [['LI_CONSULT', 'LI_ESTUD',  'LI_ANULADA',  'LI_SELECT'], 'integer'],
            [['LI_IMPORTE'], 'number'],
            [['LI_NRO', 'LI_COMP'], 'string', 'max' => 12],
            [['LI_COCLI'], 'string', 'max' => 6],
            [['LI_TPOSER', 'LI_CONVEN'], 'string', 'max' => 2],
            [['LI_ADIC'], 'string', 'max' => 1],
           // [['LI_FHIMPOR'], 'string', 'max' => 13],
            [['LI_COCLI'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['LI_COCLI' => 'CL_COD']],
            [['LI_CONVEN'], 'exist', 'skipOnError' => true, 'targetClass' => Convenios::className(), 'targetAttribute' => ['LI_CONVEN' => 'CO_COD']],
            [['LI_TPOSER'], 'exist', 'skipOnError' => true, 'targetClass' => TpoSer::className(), 'targetAttribute' => ['LI_TPOSER' => 'TS_COD']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LI_NRO' => 'N° Documento Laboral',
            'LI_COCLI' => 'Cliente',
            'LI_FECPED' => 'Fecha Inicio',
            'LI_TPOSER' => 'Tipo de trámite', //tpo_ser
            'LI_CONVEN' => 'Convenio',//convenio
            'LI_CONSULT' => 'Consulta Médica', // si hizo la consulta médica
            'LI_ESTUD' => 'Resultados Laboratorio ',
            'LI_IMPORTE' => 'Importe',//importe recaudado en este trámite
            'LI_FECVTO' => 'Fecha Vencimiento',//se calcula suamndo 365
            'LI_ANULADA' => 'Anulada',
            'LI_ADIC' => 'Adicional ',//determina si se cobra adicional
            'LI_SELECT' => 'Seleccionado',
            'LI_HORA' => 'Hora',
            
        ];
    }

    public static function getLastCod(){

    try {
          $data = Libretas::getDb()->createCommand('SELECT LI_NRO FROM libretas order by LI_NRO desc limit 1')->queryOne();
                   // print_r($data['CL_COD']);
                   // 
                   return $data['LI_NRO'];
           
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
   }

   public function getClientes()
    {
        return $this->hasOne(Clientes::className(), ['CL_COD' => 'LI_COCLI']);
    }

    public function getDevolu()
    {
        return $this->hasOne(Devoluciones::className(), ['DE_NROTRA' => 'LI_NRO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoclabaus()
    {
        return $this->hasMany(Doclabau::className(), ['DO_CODLIB' => 'LI_NRO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLICOCLI()
    {
        return $this->hasOne(Clientes::className(), ['CL_COD' => 'LI_COCLI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLICONVEN()
    {
        return $this->hasOne(Convenios::className(), ['CO_COD' => 'LI_CONVEN']);
    }

    public function getLICONVENDESCRIP()
    {
        $m = $this->hasOne(Convenios::className(), ['CO_COD' => 'LI_CONVEN']);
        if  ($m) {
            return $m->CO_DESC;

        }
        else {
            return "(no definido)";
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLITPOSER()
    {
        return $this->hasOne(TpoSer::className(), ['TS_COD' => 'LI_TPOSER']);
    }

 
}
