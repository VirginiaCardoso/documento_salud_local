<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "habi_fat".
 *
 * @property string $TIPO
 * @property string $TEXTO
 * @property string $OPC_ID
 * @property string $MENSAJE
 * @property string $ID
 */
class Habi_fat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'habi_fat';
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
            [['TIPO', 'TEXTO', 'OPC_ID', 'MENSAJE', 'ID'], 'required'],
            [['TIPO'], 'string', 'max' => 30],
            [['TEXTO', 'OPC_ID', 'ID'], 'string', 'max' => 2],
            [['MENSAJE'], 'string', 'max' => 60],
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
            'MENSAJE' => 'Mensaje',
            'ID' => 'ID',
        ];
    }

    public static function getListaFaseTab()
    {
        $opciones = Habi_fat::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }

}
