<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property string $CL_COD
 * @property integer $CL_HC
 * @property string $CL_TIPDOC
 * @property string $CL_NUMDOC
 * @property string $CL_APENOM
 * @property string $CL_FECNAC
 * @property string $CL_CODLOC
 * @property string $CL_DOMICI
 * @property string $CL_TEL
 * @property string $CL_LUGTRA
 * @property string $CL_NROHAB
 * @property string $CL_SEXO
 * @property string $CL_ESTCIV
 * @property string $CL_IMG
 * @property string $CL_EMAIL
 *
 * @property Locali $cLCODLOC
 * @property Estciv $cLESTCIV
 * @property TipDoc $cLTIPDOC
 * @property Doclabau[] $doclabaus
 * @property Libretas[] $libretas
 */
class Clientes extends \yii\db\ActiveRecord
{
    public $edad;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
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
            [['CL_COD','CL_HC','CL_TIPDOC','CL_NUMDOC','CL_APENOM','CL_FECNAC', 'CL_CODLOC', 'CL_DOMICI','CL_ESTCIV', 'CL_TEL','CL_SEXO'], 'required'],
            [['CL_COD'],'unique'],
            [['CL_NUMDOC'],'unique'],
            [['CL_COD'], 'string','length' => [6], 'max' => 6, 'min' => 6, 'tooShort' => 'El código debe tener 6 caracteres. Ejemplo: "000001"'],
            [['CL_HC'], 'integer'],
            [['CL_FECNAC'], 'safe'],
            [['CL_COD'], 'string', 'max' => 6],
            [['CL_TIPDOC', 'CL_CODLOC'], 'string', 'max' => 3],
            [['CL_NUMDOC', 'CL_TEL'], 'string', 'max' => 14],
            [['CL_APENOM', 'CL_DOMICI', 'CL_LUGTRA'], 'string', 'max' => 45],
            [['CL_NROHAB'], 'string', 'max' => 10],
            [['CL_SEXO', 'CL_ESTCIV'], 'string', 'max' => 1],
            [['CL_IMG'], 'string', 'max' => 80],
            [['CL_EMAIL'], 'string', 'max' => 75],
            [['CL_CODLOC'], 'exist', 'skipOnError' => true, 'targetClass' => Locali::className(), 'targetAttribute' => ['CL_CODLOC' => 'LO_COD']],
            [['CL_ESTCIV'], 'exist', 'skipOnError' => true, 'targetClass' => Estciv::className(), 'targetAttribute' => ['CL_ESTCIV' => 'ES_COD']],
            [['CL_TIPDOC'], 'exist', 'skipOnError' => true, 'targetClass' => TipDoc::className(), 'targetAttribute' => ['CL_TIPDOC' => 'TI_COD']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CL_COD' => 'Código',
            'CL_HC' => 'N° Historia Clínica',
            'CL_TIPDOC' => 'Tipo Documento',
            'CL_NUMDOC' => 'N° Documento',
            'CL_APENOM' => 'Apellido y nombre',
            'CL_FECNAC' => 'Fecha Nacimiento',
            'CL_CODLOC' => 'Código Localidad',
            'CL_DOMICI' => 'Domicilio',
            'CL_TEL' => 'Télefono',
            'CL_LUGTRA' => 'Lugar de Trabajo',
            'CL_NROHAB' => 'N° Habilitación',
            'CL_SEXO' => 'Sexo',
            'CL_ESTCIV' => 'Estado Civil',
            'CL_IMG' => 'Imagen',
           'CL_EMAIL' => 'Correo electrónico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLCODLOC()
    {
        return $this->hasOne(Locali::className(), ['LO_COD' => 'CL_CODLOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLESTCIV()
    {
        return $this->hasOne(Estciv::className(), ['ES_COD' => 'CL_ESTCIV']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLTIPDOC()
    {
        return $this->hasOne(TipDoc::className(), ['TI_COD' => 'CL_TIPDOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoclabaus()
    {
        return $this->hasMany(Doclabau::className(), ['DO_CODCLI' => 'CL_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibretas()
    {
        return $this->hasMany(Libretas::className(), ['LI_COCLI' => 'CL_COD']);
    }

   /* public static function getLastId(){

    $connection = Yii::$app->dbdocsl;
    Yii::$app->dbdocsl->open();
    $last = $connection->lastInsertID;
    //Yii::$app->db->getLastInsertID('revista');
    return $last;
   }*/

   public function getLastCod()
   {
        //SELECT MAX(`CL_COD`) FROM `clientes` 
        $max =Clientes::find() // AQ instance
                ->select(["MAX(`CL_COD`) FROM `clientes`"]);
        return $max;
   }



  

}
