<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vacu_opc".
 *
 * @property string $TIPO
 * @property string $TEXTO
 * @property string $OPC_ID
 * @property string $ID
 * @property string $TITULO
 * @property string $ANCHO
 */
class Vacu_opc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacu_opc';
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
            [['TIPO', 'TEXTO', 'OPC_ID', 'ID', 'TITULO', 'ANCHO'], 'required'],
            [['TIPO'], 'string', 'max' => 18],
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
        ];
    }

    public static function getListaVacuOpc($codvacu)
    {
        $opciones = Vacu_opc::find()->where(['OPC_ID'=>$codvacu])->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }

    public static function labelVen(){
         $opciones = Vacu_opc::find()->where(['ID'=>'16'])->one();
         return $opciones->TITULO;

    }
}
