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
 * @property integer $LI_IMPR
 * @property string $LI_FECRET
 * @property string $LI_IMPORTE
 * @property string $LI_FECVTO
 * @property string $LI_COMP
 * @property integer $LI_ANULADA
 * @property string $LI_ADIC
 * @property string $LI_IMPADI
 * @property integer $LI_REIMPR
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
            [['LI_NRO'], 'required'],
            [['LI_FECPED', 'LI_FECRET','LI_FEIMP', 'LI_FECVTO', 'LI_HORA'], 'safe'],
            [['LI_CONSULT', 'LI_ESTUD', 'LI_IMPR', 'LI_ANULADA', 'LI_REIMPR', 'LI_SELECT'], 'integer'],
            [['LI_IMPORTE', 'LI_IMPADI'], 'number'],
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
            'LI_NRO' => 'N° Doc. Salud Laboral',
            'LI_COCLI' => 'Cliente',
            'LI_FECPED' => 'Fecha',
            'LI_TPOSER' => 'Tipo de trámite', //tpo_ser
            'LI_CONVEN' => 'Convenio',//convenio
            'LI_CONSULT' => 'Consulta Médica', // si hizo la consulta médica
            'LI_ESTUD' => 'Resultados Laboratorio',
            'LI_IMPR' => 'Impresión Credencial',
            'LI_FECRET' => 'Fecha de Retiro',
            'LI_IMPORTE' => 'Importe',//importe recaudado en este trámite
            'LI_FECIMP' => 'Fecha Impresión Credencial',
            'LI_FECVTO' => 'Fecha Vencimiento',//se calcula suamndo 365
            
            'LI_COMP' => 'N° Comprobante Impresión',
            'LI_ANULADA' => 'Anulada',
            'LI_ADIC' => 'Adicional ',//determina si se cobra adicional
            'LI_IMPADI' => 'Importe Adicional',
            'LI_REIMPR' => 'Reimpresión',
            'LI_SELECT' => 'Seleccionado',
            'LI_HORA' => 'Hora',
            
        ];
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
