<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "estciv".
 *
 * @property string $ES_COD
 * @property string $ES_NOM
 *
 * @property Clientes[] $clientes
 */
class Estciv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estciv';
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
            [['ES_COD'], 'required'],
            [['ES_COD'], 'string', 'max' => 1],
            [['ES_NOM'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ES_COD' => 'Código Estado Civil',
            'ES_NOM' => 'Estado Civil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['CL_ESTCIV' => 'ES_COD']);
    }

    public static function getListaEstadoCivil()
    {
        $opciones = Estciv::find()->orderBy(['ES_NOM' => SORT_ASC])->asArray()->all();
        return ArrayHelper::map($opciones, 'ES_COD', 'ES_NOM');
    }
}
