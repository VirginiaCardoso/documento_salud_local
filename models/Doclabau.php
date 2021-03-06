<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "doclabau".
 *
 * 
 * @property string $DO_CODLIB
 * @property string $DO_VISITA
 * @property string $DO_PESO
 * @property string $DO_TENAR1
 * @property string $DO_TENAR2
 * @property string $DO_COLEST
 * @property string $DO_GLUCO
 * @property string $DO_PAP
 * @property string $DO_MAM
 * @property string $DO_OBS
 * @property string $DO_CINTURA
 * @property string $DO_TRIPLI
 * @property string $DO_HDL
 * @property string $DO_IMC
 *
 * @property Clientes $dOCODCLI
 * @property Libretas $dOCODLIB
 */
class Doclabau extends \yii\db\ActiveRecord
{
    public $diferencia;
    public $talla;
    public $tension;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doclabau';
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
           [['DO_CODCLI', 'DO_CODLIB','tension','DO_PESO', 'DO_COLEST', 'DO_GLUCO', 'DO_PAP', 'DO_CINTURA', 'DO_TRIGLI', 'DO_HDL'], 'required'],
            [['DO_VISITA'], 'safe'],
            [['DO_CODCLI'], 'string', 'max' => 6],
            [['DO_CODLIB', 'DO_OBS'], 'string', 'max' => 12],
            [['DO_PESO'], 'string', 'max' => 7],
            [['tension'],'match', 'pattern' => '/[0-9]+\/[0-9]+/',
            'message' => 'Ingrese Tensión Arterial Baja/Alta'],
            [['DO_TENAR1', 'DO_TENAR2', 'DO_COLEST', 'DO_GLUCO', 'DO_CINTURA'], 'string', 'max' => 3],
            [['DO_PAP', 'DO_MAM'], 'string', 'max' => 25],
            [['DO_TRIGLI', 'DO_HDL', 'DO_IMC'], 'string', 'max' => 4],
            [['DO_CODLIB'], 'unique'],
            [['DO_CODCLI'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['DO_CODCLI' => 'CL_COD']],
            [['DO_CODLIB'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DO_CODLIB' => 'LI_NRO']],
        ];
    }

    /**
     * 

---------------------------------------------------------------
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DO_CODLIB' => 'N° Documento Laboral',
            'DO_CODCLI' => 'Código Cliente',
            'DO_VISITA' => 'Fecha',
            'DO_PESO' => 'Peso',
            'DO_TENAR1' => 'Tensión Arterial Baja', //baja
            'DO_TENAR2' => 'Tensión Arterial Alta', //alta 
            'DO_COLEST' => 'Colesterol',
            'DO_GLUCO' => 'Glucosa',
            'DO_PAP' => 'Paps',
            'DO_MAM' => 'Mamografía',
            'DO_OBS' => 'Observaciones',
            'DO_CINTURA' => 'Cintura',
            'DO_TRIGLI' => 'Trigliceridos',
            'DO_HDL' => 'HDL',
            'DO_IMC' => 'IMC',
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
    public function getDOCODLIB()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'DO_CODLIB']);
    }

    public static function getLastDoclabau($codcli, $id){

    try {// 'SELECT CL_COD FROM clientes order by CL_COD desc limit 1
          $data = Doclabau::getDb()->createCommand('SELECT DO_CODLIB FROM doclabau WHERE DO_CODCLI =:codcli AND DO_CODLIB !=:id order by DO_VISITA desc limit 1 ')
          ->bindValue(':codcli', $codcli)
          ->bindValue(':id', $id)
          ->queryOne();
        return $data['DO_CODLIB'];
         }
        catch(Exception $e) {
            echo $e->getMessage();
        }
   }

    public function getDocumento()
    {
        return $this->hasOne(Doclab::className(), ['DO_CODCLI' => 'DO_CODCLI']);
    }

    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['CL_COD' => 'DO_CODCLI']);
    }


}
