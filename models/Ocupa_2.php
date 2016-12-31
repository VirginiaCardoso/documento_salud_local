<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ocupa_2".
 *
 * @property string $TIPO
 * @property string $PADRE_ID
 * @property integer $MAS_NIVEL
 * @property string $ID
 */
class Ocupa_2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupa_2';
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
            [['TIPO', 'PADRE_ID', 'MAS_NIVEL', 'ID'], 'required'],
            [['MAS_NIVEL'], 'integer'],
            [['TIPO'], 'string', 'max' => 50],
            [['PADRE_ID', 'ID'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIPO' => 'Tipo',
            'PADRE_ID' => 'Padre  ID',
            'MAS_NIVEL' => 'Mas  Nivel',
            'ID' => 'ID',
        ];
    }

    public static function getListaOcupa2()
    {
        $opciones = Ocupa_2::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }

    public static function getSuboculist($ocu_id)
    {
        $opciones = Ocupa_2::find()->where(['PADRE_ID' => $ocu_id])->asArray()->all();
        return ArrayHelper::map($opciones, 'ID', 'TIPO');
    }
}
