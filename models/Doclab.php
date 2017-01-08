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
    public $emb;
    public $cuantosemb;
    public $menop;
    public $edadmenop;
    public $diabfam;
    public $diabquienes;
    public $hiperfam;
    public $hiperquienes;
    public $cardfam;
    public $cardquienes;
    public $oncofam;
    public $oncoquienes;

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
        return [ //
            [['DO_NRO', 'DO_CODCLI', 'DO_OCU', 'DO_ESCOL', 'DO_INGRES', 'DO_FUMA', 'DO_ALCOH', 'DO_CAGE', 'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_COLEST', 'DO_DIABET', 'DO_ANTQUI', 'DO_ONCO', 'DO_TRH', 'DO_ASMAEP', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_VENER', 'DO_DOLLUM', 'DO_FADI', 'DO_FAHIPE', 'DO_FACARD', 'DO_FAONCO', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB', 'DO_TALLA','fumador','vener','emb','menop','diabfam','hiperfam','cardfam','oncofam'], 'required'], /* , 'DO_DATOS', 'DO_DATINT', 'DO_TRATHI', 'DO_TRATCO', 'DO_TRATDI', 'DO_PROSTA', 'DO_EMBARA', 'DO_ANOVU', 'DO_MENOP', 'DO_PAENOM', 'DO_MAENOM', 'DO_HEENON','vener','emb','diabetesFam','menop','diabfam','hiperfam','cardfam','oncofam'*/
            [['DO_NRO'], 'string', 'max' => 12],
            [['DO_CODCLI', 'DO_FADI', 'DO_FAHIPE', 'DO_FACARD', 'DO_FAONCO', 'DO_TALLA',], 'string', 'max' => 6], /*'hiperquienes','cardquienes','oncoquienes'*/
            [['DO_OCU', 'DO_RUBRO', 'DO_RUBTIP', 'DO_ESCOL', 'DO_FASTAB', 'DO_ALCOH', 'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_TRATHI', 'DO_COLEST', 'DO_TRATCO', 'DO_DIABET', 'DO_TRATDI', 'DO_ANOVU', 'DO_TRH', 'DO_ASMAEP', 'DO_PROSTA', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_DOLLUM', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB','fumador','cuanto','vener','emb','cuantosemb','menop','diabfam','hiperfam','cardfam','oncofam'], 'string', 'max' => 2],
            [['DO_INGRES'], 'string', 'max' => 2],
            [['DO_FUMA'], 'string', 'max' => 7],
            [['DO_CAGE'], 'string', 'max' => 8],
            [['DO_ANTQUI', 'DO_ONCO', 'DO_VENER','cual'], 'string', 'max' => 102],
            [['DO_EMBARA'], 'string', 'max' => 4],
            [['edadmenop'], 'string', 'max' => 3],
            [['DO_MENOP'], 'string', 'max' => 5],
            [['DO_PAENOM', 'DO_MAENOM', 'DO_HEENON'], 'string', 'max' => 94],
            [['DO_DATOS', 'DO_DATINT'], 'string', 'max' => 254],
            [['DO_NRO'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DO_NRO' => 'LI_NRO']],
            // [['diabquienes'], 'validateDiabetes'],
        ];
    }

  /*  public function validateDiabetes($attribute, $params)
    {
        $codigos  = [];
        foreach($this->$attribute as $i) {
            $codpra = $practica['PI_CODPRA'];

            // verificar que la práctica no esté informada en un informe previo
            if(NULL!=($p=PracticaTurno::find()
                ->where(['PI_CODPRA' => $codpra])
                ->andWhere(['PI_ID' => $this->IN_TURNO])
                ->andWhere(['NOT', ['PI_IDINFORME' => NULL]])
                ->andWhere(['NOT', ['PI_IDINFORME' => $this->IN_ID]])
                ->one())) {

                $key = $attribute . '[' . $index . '][PI_CODPRA]';
                $this->addError($key, 'La práctica elegida ya fue informada');
            }
            elseif(in_array($codpra, $codigos_practicas)) {
                $key = $attribute . '[' . $index . '][PI_CODPRA]';
                $this->addError($key, 'La práctica elegida ya fue agregada al informe');
            }
            else{
                $codigos_practicas[] = $codpra;
            }
        }
    }
*/
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DO_NRO' => 'N° Documento Laboral',
            'DO_CODCLI' => 'Código Cliente',
            'DO_OCU' => 'Ocupación',
            'DO_RUBRO' => 'Ocup. Especif.', //ocupacion más especifico
            'DO_RUBTIP' => 'Ocup. Más Especif.', //ocupacion más especifico que rubro
            'DO_ESCOL' => 'Escolaridad',
            'DO_INGRES' => 'Nivel Ingresos',
            'DO_FUMA' => 'Fumador',
            'fumador' =>'Fumador',
            'cuanto'=> '¿Cuántos Años?',
            'DO_FASTAB' => 'Fase de Tabaquista',
            'DO_ALCOH' => 'Alcohol',
            'DO_CAGE' => 'CAGE',
            'DO_SEDAN' => 'Sedantes',
            'DO_DEPOR' => 'Deporte',
            'DO_SUENIO' => 'Trastorno de Sueño',
            'DO_EAC' => 'E.A.C.',
            'DO_HIPERT' => 'Hipertensión',
            'DO_TRATHI' => 'Tratamiento Hipertensión',
            'DO_COLEST' => 'Colesterol',
            'DO_TRATCO' => 'Tratamiento Colesterol',
            'DO_DIABET' => 'Diabetes',

            'DO_TRATDI' => 'Tratamiento Diabetes',
            'DO_ANTQUI' => 'Antecedentes Quirúrgicos',
            'DO_ONCO' => 'Oncológicos',
            'DO_EMBARA' => 'Embarazos',
            'emb' => 'Embarazos',
            'cuantosemb' => '¿Cuántos?',
            'DO_ANOVU' => 'Anovulatorios',
            'DO_MENOP' => 'Menopausia',
            'menop' => 'Menopausia',
            'edadmenop' => '¿Edad?',
            'DO_TRH' => 'TRH',
            'DO_ASMAEP' => 'Asma/EPOC',
            'DO_PROSTA' => 'Prostatismo',
            'DO_RUBEO' => 'Rubeóla',
            'DO_TETANO' => 'Tétanos',
            'DO_ANTIGR' => 'Antigripal',
            'DO_ANTIHE' => 'Antihepatitis B',
            'DO_TRANSF' =>  'Transfusiones',
            'DO_VENER' => 'Enfermedades Venéreas',
            'cual' => '¿Cuál?',
            'DO_DOLLUM' => 'Dolor Lumbar (ocasionó falta trab)',
            //antecedentes familiares
            'DO_FADI' => 'Diabetes',
            'DO_FAHIPE' => 'Hipertensión',
            'DO_FACARD' => 'Enfermedad Cardíaca',
            'DO_FAONCO' => 'Oncológico',
            'diabfam' => 'Diabetes',
            'hiperfam' => 'Hipertensión',
            'cardfam' => 'Enfermedad Cardíaca',
            'oncofam' => 'Oncológico',
            'diabquienes' => '¿Quienes?',
            'hiperquienes' => '¿Quienes?',
            'cardquienes' => '¿Quienes?',
            'oncoquienes' => '¿Quienes?',

            'DO_PAENOM' => '¿Enfermedad Padre?',
            'DO_MAENOM' => '¿Enfermedad Madre?',
            'DO_HEENON' => '¿Enfermedad Hermano?',
            'DO_NEVOS' => 'Nevos',
            'DO_NODMAN' => 'Nódulos de Mama',
            'DO_SOPLOS' => 'Soplos',
            'DO_TUMAB' => 'Tumor Abdominal',
            'DO_TALLA' => 'Talla',
            'DO_DATOS' => 'Otros Datos',
            'DO_DATINT' => 'Notas',
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
