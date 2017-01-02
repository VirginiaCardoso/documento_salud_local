<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "doclab".
 *
 * @property string $DO_NRO
 * @property string $DO_CODCLI
 * @property string $DO_OCU
 * @property string $DO_RUBRO
 * @property string $DO_RUBTIP
 * @property string $DO_ESCOL
 * @property string $DO_INGRES
 * @property string $DO_FUMA
 * @property string $DO_FASTAB
 * @property string $DO_ALCOH
 * @property string $DO_CAGE
 * @property string $DO_SEDAN
 * @property string $DO_DEPOR
 * @property string $DO_SUENIO
 * @property string $DO_EAC
 * @property string $DO_HIPERT
 * @property string $DO_TRATHI
 * @property string $DO_COLEST
 * @property string $DO_TRATCO
 * @property string $DO_DIABET
 * @property string $DO_TRATDI
 * @property string $DO_ANTQUI
 * @property string $DO_ONCO
 * @property string $DO_EMBARA
 * @property string $DO_ANOVU
 * @property string $DO_MENOP
 * @property string $DO_TRH
 * @property string $DO_ASMAEP
 * @property string $DO_PROSTA
 * @property string $DO_RUBEO
 * @property string $DO_TETANO
 * @property string $DO_ANTIGR
 * @property string $DO_ANTIHE
 * @property string $DO_TRANSF
 * @property string $DO_VENER
 * @property string $DO_DOLLUM
 * @property string $DO_FADI
 * @property string $DO_FAHIPE
 * @property string $DO_FACARD
 * @property string $DO_FAONCO
 * @property string $DO_PAENOM
 * @property string $DO_MAENOM
 * @property string $DO_HEENON
 * @property string $DO_NEVOS
 * @property string $DO_NODMAN
 * @property string $DO_SOPLOS
 * @property string $DO_TUMAB
 * @property string $DO_TALLA
 * @property string $DO_DATOS
 * @property string $DO_DATINT
 *
 * @property Libretas $dONRO
 */
class Doclab extends \yii\db\ActiveRecord
{
    public $fumador;
    public $cuanto;
    public $vener;
    public $cual;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doclab';
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
        return [ //'DO_CAGE',
            [['DO_NRO', 'DO_CODCLI', 'DO_OCU', 'DO_ESCOL', 'DO_INGRES', 'DO_FUMA', 'DO_ALCOH',  'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_TRATHI', 'DO_COLEST', 'DO_TRATCO', 'DO_DIABET', 'DO_TRATDI', 'DO_ANTQUI', 'DO_ONCO', 'DO_EMBARA', 'DO_ANOVU', 'DO_MENOP', 'DO_TRH', 'DO_ASMAEP', 'DO_PROSTA', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_VENER', 'DO_DOLLUM', 'DO_FADI', 'DO_FAHIPE', 'DO_FACARD', 'DO_FAONCO', 'DO_PAENOM', 'DO_MAENOM', 'DO_HEENON', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB', 'DO_TALLA', 'DO_DATOS', 'DO_DATINT','fumador','vener'], 'required'],
            [['DO_NRO'], 'string', 'max' => 12],
            [['DO_CODCLI', 'DO_FADI', 'DO_FAHIPE', 'DO_FACARD', 'DO_FAONCO', 'DO_TALLA'], 'string', 'max' => 6],
            [['DO_OCU', 'DO_RUBRO', 'DO_RUBTIP', 'DO_ESCOL', 'DO_FASTAB', 'DO_ALCOH', 'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_TRATHI', 'DO_COLEST', 'DO_TRATCO', 'DO_DIABET', 'DO_TRATDI', 'DO_ANOVU', 'DO_TRH', 'DO_ASMAEP', 'DO_PROSTA', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_DOLLUM', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB'], 'string', 'max' => 2],
            [['DO_INGRES'], 'string', 'max' => 2],
            [['DO_FUMA'], 'string', 'max' => 7],
            [['DO_CAGE'], 'string', 'max' => 8],
            [['DO_ANTQUI', 'DO_ONCO', 'DO_VENER'], 'string', 'max' => 102],
            [['DO_EMBARA'], 'string', 'max' => 4],
            [['DO_MENOP'], 'string', 'max' => 5],
            [['DO_PAENOM', 'DO_MAENOM', 'DO_HEENON'], 'string', 'max' => 94],
            [['DO_DATOS', 'DO_DATINT'], 'string', 'max' => 254],
            [['DO_NRO'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DO_NRO' => 'LI_NRO']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DO_NRO' => 'Nro Documento Laboral',
            'DO_CODCLI' => 'Código Cliente',
            'DO_OCU' => 'Ocupación',
            'DO_RUBRO' => 'Ocup. Especif.', //ocupacion más especifico
            'DO_RUBTIP' => 'Ocup. Más Especif.', //ocupacion más especifico que rubro
            'DO_ESCOL' => 'Escolaridad',
            'DO_INGRES' => 'Nivel Ingresos',
            'DO_FUMA' => 'Fumador',
            'DO_FASTAB' => 'Fase de Tabaquista',
            'DO_ALCOH' => 'Alcohol',
            'DO_CAGE' => 'CAGE',
            'DO_SEDAN' => 'Sedantes',
            'DO_DEPOR' => 'Deporte',
            'DO_SUENIO' => 'Trastorno de sueño',
            'DO_EAC' => 'Do  Eac',
            'DO_HIPERT' => 'Do  Hipert',
            'DO_TRATHI' => 'Do  Trathi',
            'DO_COLEST' => 'Do  Colest',
            'DO_TRATCO' => 'Do  Tratco',
            'DO_DIABET' => 'Do  Diabet',
            'DO_TRATDI' => 'Do  Tratdi',
            'DO_ANTQUI' => 'Do  Antqui',
            'DO_ONCO' => 'Do  Onco',
            'DO_EMBARA' => 'Do  Embara',
            'DO_ANOVU' => 'Do  Anovu',
            'DO_MENOP' => 'Do  Menop',
            'DO_TRH' => 'Do  Trh',
            'DO_ASMAEP' => 'Do  Asmaep',
            'DO_PROSTA' => 'Do  Prosta',
            'DO_RUBEO' => 'Rubeóla',
            'DO_TETANO' => 'Tétanos',
            'DO_ANTIGR' => 'Antigripal',
            'DO_ANTIHE' => 'Antihepatitis B',
            'DO_TRANSF' =>  'Transfusiones',
            'DO_VENER' => 'Enfermedades Venéreas',
            'DO_DOLLUM' => 'Dolor Lumbar (ocasionó falta trab)',
            'DO_FADI' => 'Do  Fadi',
            'DO_FAHIPE' => 'Do  Fahipe',
            'DO_FACARD' => 'Do  Facard',
            'DO_FAONCO' => 'Do  Faonco',
            'DO_PAENOM' => 'Do  Paenom',
            'DO_MAENOM' => 'Do  Maenom',
            'DO_HEENON' => 'Do  Heenon',
            'DO_NEVOS' => 'Do  Nevos',
            'DO_NODMAN' => 'Do  Nodman',
            'DO_SOPLOS' => 'Do  Soplos',
            'DO_TUMAB' => 'Do  Tumab',
            'DO_TALLA' => 'Do  Talla',
            'DO_DATOS' => 'Do  Datos',
            'DO_DATINT' => 'Do  Datint',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDONRO()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'DO_NRO']);
    }
}
