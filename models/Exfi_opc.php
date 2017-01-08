<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "exfi_opc".
 *
 * @property string $TIPO
 * @property string $TEXTO
 * @property string $OPC_ID
 * @property string $ID
 * @property string $TITULO
 */
class Exfi_opc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exfi_opc';
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
            [['TIPO', 'TEXTO', 'OPC_ID', 'ID', 'TITULO'], 'required'],
            [['TIPO'], 'string', 'max' => 20],
            [['TEXTO'], 'string', 'max' => 1],
            [['OPC_ID', 'ID'], 'string', 'max' => 2],
            [['TITULO'], 'string', 'max' => 10],
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
        ];
    }

    public static function getListaExfiOpc($codhab)
    {
        $opciones = Exfi_opc::find()->where(['OPC_ID'=>$codhab])->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }
}
