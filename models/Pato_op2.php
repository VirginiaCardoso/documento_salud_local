<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pato_op2".
 *
 * @property string $TIPO
 * @property string $TEXTO
 * @property string $OPC_ID
 * @property string $ID
 * @property string $TITULO
 * @property string $ANCHO
 * @property integer $PA_MASNIV
 */
class Pato_op2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pato_op2';
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
            [['TIPO', 'TEXTO', 'OPC_ID', 'ID', 'TITULO', 'ANCHO', 'PA_MASNIV'], 'required'],
            [['PA_MASNIV'], 'integer'],
            [['TIPO'], 'string', 'max' => 20],
            [['TEXTO'], 'string', 'max' => 1],
            [['OPC_ID', 'ID'], 'string', 'max' => 2],
            [['TITULO'], 'string', 'max' => 10],
            [['ANCHO'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIPO' => 'Tipo',
            'TEXTO' => 'Texto',
            'OPC_ID' => 'Opc  ID',
            'ID' => 'ID',
            'TITULO' => 'Titulo',
            'ANCHO' => 'Ancho',
            'PA_MASNIV' => 'Pa  Masniv',
        ];
    }

    public static function getListaPatologiaOpc2($codhab)
    {
        $opciones = Pato_op2::find()->where(['OPC_ID'=>$codhab])->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }

    public static function getSubpatolist($ocu_id)
    {
        $opciones = Pato_op2::find()->where(['OPC_ID' => $ocu_id])->asArray()->all();
      // var_dump($opciones);
        $out = [];
        foreach ($opciones as $o) {
             # code...
                $out[] = ['id'=>$o['ID'], 'name'=>$o['TIPO']];
            
        }
        return $out;//ArrayHelper::map($opciones, 'id', 'name');
    }
    
}
