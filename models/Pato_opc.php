<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "pato_opc".
 *
 * @property string $TIPO
 * @property string $TEXTO
 * @property string $OPC_ID
 * @property string $ID
 * @property string $TITULO
 * @property string $ANCHO
 * @property integer $PA_MASNIV
 */
class Pato_opc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pato_opc';
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
}
