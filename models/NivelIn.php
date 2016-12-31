<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "nivel_in".
 *
 * @property string $NI_CODIGO
 * @property string $NI_DETALLE
 */
class NivelIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel_in';
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
            [['NI_CODIGO'], 'required'],
            [['NI_CODIGO'], 'string', 'max' => 2],
            [['NI_DETALLE'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NI_CODIGO' => 'Ni  Codigo',
            'NI_DETALLE' => 'Ni  Detalle',
        ];
    }

        public static function getListaNiveles()
    {
        $opciones = Ocupa_1::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'NI_CODIGO', 'NI_DETALLE');
    }

}
