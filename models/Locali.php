<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "locali".
 *
 * @property string $LO_COD
 * @property string $LO_DETALLE
 *
 * @property Clientes[] $clientes
 */
class Locali extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locali';
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
            [['LO_COD'], 'required'],
            [['LO_COD'], 'string', 'max' => 3],
            [['LO_DETALLE'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LO_COD' => 'Lo  Cod',
            'LO_DETALLE' => 'Lo  Detalle',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['CL_CODLOC' => 'LO_COD']);
    }

    public static function getListaLocalidades()
    {
        $opciones = Locali::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'LO_COD', 'LO_DETALLE');
    }
}
