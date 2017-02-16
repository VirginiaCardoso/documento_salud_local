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
    public $sexo;
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


    public static function databaseName()
    {
        return 'docsl';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [ //
            [['DO_NRO', 'DO_CODCLI', 'DO_OCU', 'DO_ESCOL', 'DO_INGRES',  'DO_ALCOH',  'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_COLEST', 'DO_DIABET', 'DO_ANTQUI', 'DO_ONCO', 'DO_TRH', 'DO_ASMAEP', 'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF',  'DO_DOLLUM',  'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB', 'DO_TALLA','diabfam','hiperfam','cardfam','oncofam', 'fumador','vener'], 'required'],
             ['cuanto', 'required', 'when' => function($model) { return $model->fumador =="07";},'whenClient' => "function (attribute, value) { return $('#doclab-fumador').val() == '07';}", 'message' => 'Cuántos no puede estar vacío.' ],
            ['DO_FASTAB', 'required', 'when' => function($model) { return ($model->fumador !="06"); },'whenClient' => "function (attribute, value) { return $('#doclab-fumador').val() != '06';}", 'message' => 'Fase de Tabaquista no puede estar vacío.'],
            ['emb', 'required', 'when' => function($model) { return $model->sexo == 'F'; }, 'message' => 'Embarazos no puede estar vacío.'],
            ['cuantosemb', 'required', 'when' => function($model) { return $model->emb == '29'; },'whenClient' => "function (attribute, value) { return $('#doclab-emb').val() == '29';}", 'message' => 'Cuántos no puede estar vacío.'],
            ['DO_ANOVU', 'required', 'when' => function($model) { return $model->sexo == 'F'; }],
            ['menop', 'required', 'when' => function($model) { return $model->sexo == 'F'; }],
            ['edadmenop', 'required','when' => function($model) { return $model->DO_MENOP == '34'; },'whenClient' => "function (attribute, value) { return $('#doclab-menop').val() == '34';}"],
            ['DO_PROSTA', 'required', 'when' => function($model) { return $model->sexo == 'M'; }],
            ['cual', 'required', 'when' => function($model) { return $model->vener == '16'; },'whenClient' => "function (attribute, value) { return $('#doclab-vener').val() == '16';}"],
            ['DO_TRATHI', 'required', 'when' => function($model) { return $model->DO_HIPERT == '04'; },'whenClient' => "function (attribute, value) { return $('#trat-id').val() == '04';}"],
            ['DO_TRATCO', 'required', 'when' => function($model) { return $model->DO_COLEST == '10'; },'whenClient' => "function (attribute, value) { return $('#trat2-id').val() == '10';}"],
            ['DO_TRATDI', 'required', 'when' => function($model) { return $model->DO_DIABET == '16'; },'whenClient' => "function (attribute, value) { return $('#trat3-id').val() == '16';}"],
            [['DO_NRO'], 'string', 'max' => 12],

            [['DO_CODCLI',  'DO_TALLA',], 'string', 'max' => 6],
            [['DO_OCU', 'DO_RUBRO', 'DO_RUBTIP', 'DO_ESCOL', 'DO_FASTAB', 'DO_ALCOH', 'DO_SEDAN', 'DO_DEPOR', 'DO_SUENIO', 'DO_EAC', 'DO_HIPERT', 'DO_TRATHI', 'DO_COLEST', 'DO_TRATCO', 'DO_DIABET', 'DO_TRATDI', 'DO_ANOVU', 'DO_TRH', 'DO_ASMAEP',  'DO_RUBEO', 'DO_TETANO', 'DO_ANTIGR', 'DO_ANTIHE', 'DO_TRANSF', 'DO_DOLLUM', 'DO_NEVOS', 'DO_NODMAN', 'DO_SOPLOS', 'DO_TUMAB','fumador','cuanto','vener','diabfam','hiperfam','cardfam','oncofam','cuantosemb'], 'string', 'max' => 2],
            
            [['DO_INGRES'], 'string', 'max' => 2],
            [['emb','menop'], 'string', 'max' => 2 ,'when' => function($model) { return $model->sexo == 'F'; },'whenClient' => "function (attribute, value) { return $('#doclab-sexo').val() == 'F';}"],
            [['DO_PROSTA'], 'string', 'max' => 2 ,'when' => function($model) { return $model->sexo == 'M'; },'whenClient' => "function (attribute, value) { return $('#doclab-sexo').val() == 'F';}"],

            [['DO_FUMA'], 'string', 'max' => 7],
            [['DO_CAGE'], 'string', 'max' => 8],
            [['DO_ANTQUI', 'DO_ONCO', 'DO_VENER','cual'], 'string', 'max' => 102],
            [['DO_EMBARA'], 'string', 'max' => 4,'when' => function($model) { return $model->sexo == 'F'; },'whenClient' => "function (attribute, value) { return $('#doclab-sexo').val() == 'F';}"],
            [['edadmenop'], 'string', 'max' => 3,'when' => function($model) { return $model->DO_MENOP == '34'; },'whenClient' => "function (attribute, value) { return $('#doclab-menop').val() == '34';}"],
            [['DO_MENOP'], 'string', 'max' => 5,'when' => function($model) { return $model->sexo == 'F'; },'whenClient' => "function (attribute, value) { return $('#doclab-sexo').val() == 'F';}"],
            [['DO_PAENOM', 'DO_MAENOM', 'DO_HEENON'], 'string', 'max' => 94],
            [['DO_DATOS', 'DO_DATINT'], 'string', 'max' => 254],
            [['DO_CODCLI'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['DO_CODCLI' => 'CL_COD']],
            [['DO_ESCOL'], 'exist', 'skipOnError' => true, 'targetClass' => Escolari::className(), 'targetAttribute' => ['DO_ESCOL' => 'ID']],
            [['DO_INGRES'], 'exist', 'skipOnError' => true, 'targetClass' => NivelIn::className(), 'targetAttribute' => ['DO_INGRES' => 'NI_CODIGO']],
            [['DO_NRO'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DO_NRO' => 'LI_NRO']],
            [['DO_OCU'], 'exist', 'skipOnError' => true, 'targetClass' => Ocupa_1::className(), 'targetAttribute' => ['DO_OCU' => 'ID']],
            [['DO_RUBRO'], 'exist', 'skipOnError' => true, 'targetClass' => Ocupa_2::className(), 'targetAttribute' => ['DO_RUBRO' => 'ID']],
            [['DO_RUBTIP'], 'exist', 'skipOnError' => true, 'targetClass' => Ocupa_3::className(), 'targetAttribute' => ['DO_RUBTIP' => 'ID']],
            // [['diabquienes'], 'validateDiabetes'],
        ];
    }

 
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
            'fumador' =>'Fumador ',
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
            'vener' => 'Enfermedades Venéreas',
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
            'DO_TALLA' => 'Talla (cm.)',
            'DO_DATOS' => 'Otros Datos del Examen Físico',
            'DO_DATINT' => 'Notas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOCODCLI()
    {
        return $this->hasOne(Clientes::className(), ['CL_COD' => 'DO_CODCLI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOESCOL()
    {
        return $this->hasOne(Escolari::className(), ['ID' => 'DO_ESCOL']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOINGRES()
    {
        return $this->hasOne(NivelIn::className(), ['NI_CODIGO' => 'DO_INGRES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDONRO()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'DO_NRO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOOCU()
    {
        return $this->hasOne(Ocupa_1::className(), ['ID' => 'DO_OCU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDORUBRO()
    {
        return $this->hasOne(Ocupa_2::className(), ['ID' => 'DO_RUBRO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDORUBTIP()
    {
        return $this->hasOne(Ocupa_3::className(), ['ID' => 'DO_RUBTIP']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFUMADOR()
    {
        return $this->hasOne(Habi_opc::className(), ['ID' => 'fumador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOFASTAB()
    {
        return $this->hasOne(Habi_fat::className(), ['ID' => 'DO_FASTAB']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOALCOH()
    {
        return $this->hasOne(Habi_opc::className(), ['ID' => 'DO_ALCOH']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOCAGE()
    {
        return $this->hasOne(AlcCage::className(), ['ID' => 'DO_CAGE']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSEDAN()
    {
        return $this->hasOne(Habi_opc::className(), ['ID' => 'DO_SEDAN']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDODEPOR()
    {
        return $this->hasOne(Habi_opc::className(), ['ID' => 'DO_DEPOR']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSUENIO()
    {
        return $this->hasOne(Habi_opc::className(), ['ID' => 'DO_SUENIO']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDORUBEO()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_RUBEO']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTETANO()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_TETANO']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOANTIGR()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_ANTIGR']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOANTIHE()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_ANTIHE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTRANSF()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_TRANSF']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDODOLLUM()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'DO_DOLLUM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVENER()
    {
        return $this->hasOne(Vacu_opc::className(), ['ID' => 'vener']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOEAC()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_EAC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOHIPERT()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_HIPERT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTRATHI()
    {
        return $this->hasOne(Pato_op2::className(), ['ID' => 'DO_TRATHI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOCOLEST()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_COLEST']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTRATCO()
    {
        return $this->hasOne(Pato_op2::className(), ['ID' => 'DO_TRATCO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDODIABET()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_DIABET']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTRATDI()
    {
        return $this->hasOne(Pato_op2::className(), ['ID' => 'DO_TRATDI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOANTQUI()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_ANTQUI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOONCO()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_ONCO']);
    }


     /**
     * @return \yii\db\ActiveQuery
     */
    public function getEMB()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'emb']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOANOVU()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_ANOVU']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENOP()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'menop']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOTRH()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_TRH']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOASMAEP()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_ASMAEP']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOPROSTA()
    {
        return $this->hasOne(Pato_opc::className(), ['ID' => 'DO_PROSTA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExfiopc($id)
    {
        $m = Exfi_opc::findOne(['ID' => $id]);
        return $m->TIPO;
    }

    public function getPatoopc($id)
    {
        $m = Pato_opc::findOne(['ID' => $id]);
        return $m->TIPO;
    }

    public function imprimirFamHiper(){
        $cadena = "";
        foreach ($this->hiperquienes as $valor) {
            if ($valor=='01')
                $cadena .= "padre";
            if ($valor=='02')
                $cadena .= "madre";
            if ($valor=='03')
                $cadena .= "hermano";
        }
        return $cadena;
    }

    public function findDocLab($codcli,$nrodoc)
    {
        $model = Doclab::find()
                    ->where(['DO_CODCLI' => $codcli])
                    ->andWhere(['DO_NRO' =>$nrodoc]) 
                    ->one();
       return $model;
    }

}
