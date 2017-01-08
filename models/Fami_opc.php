<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fami_opc".
 *
 * @property string $TIPO
 * @property string $ID
 */
class Fami_opc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fami_opc';
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
            [['TIPO', 'ID'], 'required'],
            [['TIPO'], 'string', 'max' => 10],
            [['ID'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIPO' => 'Tipo',
            'ID' => 'ID',
        ];
    }

    public static function getListaFamOpc()
    {
        $opciones = Fami_opc::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }
}
