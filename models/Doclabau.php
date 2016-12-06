<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "doclabau".
 *
 * @property string $DO_CODCLI
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
            [[ 'DO_CODLIB', 'DO_VISITA', 'DO_PESO', 'DO_TENAR1', 'DO_TENAR2', 'DO_COLEST', 'DO_GLUCO', 'DO_PAP', 'DO_MAM', 'DO_OBS', 'DO_CINTURA', 'DO_TRIPLI', 'DO_HDL', 'DO_IMC'], 'required'],
            [['DO_VISITA'], 'safe'],
            [['DO_CODLIB'], 'string', 'max' => 12],
            [['DO_PESO'], 'string', 'max' => 7],
            [['DO_TENAR1', 'DO_TENAR2', 'DO_COLEST', 'DO_GLUCO', 'DO_CINTURA'], 'string', 'max' => 3],
            [['DO_PAP', 'DO_MAM'], 'string', 'max' => 25],
            [['DO_OBS'], 'string', 'max' => 120],
            [['DO_TRIPLI', 'DO_HDL', 'DO_IMC'], 'string', 'max' => 4],
            
            [['DO_CODLIB'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DO_CODLIB' => 'LI_NRO']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DO_CODLIB' => 'N° Libreta',
            'DO_VISITA' => 'Do  Visita',
            'DO_PESO' => 'Do  Peso',
            'DO_TENAR1' => 'Do  Tenar1',
            'DO_TENAR2' => 'Do  Tenar2',
            'DO_COLEST' => 'Colesterol',
            'DO_GLUCO' => 'Glucosa',
            'DO_PAP' => 'Do  Pap',
            'DO_MAM' => 'Do  Mam',
            'DO_OBS' => 'Do  Obs',
            'DO_CINTURA' => 'Do  Cintura',
            'DO_TRIPLI' => 'Do  Tripli',
            'DO_HDL' => 'Do  Hdl',
            'DO_IMC' => 'Do  Imc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     
    public function getDOCODCLI()
    {
        return $this->hasOne(Clientes::className(), ['CL_COD' => 'DO_CODCLI']);
    }
*/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOCODLIB()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'DO_CODLIB']);
    }
}
