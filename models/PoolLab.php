<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "pool_lab".
 *
 * @property string $PO_NROLIB
 * @property string $PO_FEC
 * @property string $PO_HORA
 * @property string $PO_COLEST
 * @property string $PO_GLUCOSA
 * @property integer $PO_MUESTRA
 * @property integer $PO_LISTO
 *
 * @property Libretas $pONROLIB
 */
class PoolLab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pool_lab';
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
            [['PO_NROLIB', 'PO_FEC', 'PO_HORA', 'PO_MUESTRA', 'PO_LISTO'], 'required'],
            [['PO_FEC', 'PO_HORA'], 'safe'],
            [['PO_MUESTRA', 'PO_LISTO'], 'integer'],
            [['PO_NROLIB'], 'string', 'max' => 12],
            [['PO_COLEST', 'PO_GLUCOSA'], 'string', 'max' => 10],
            [['PO_NROLIB'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['PO_NROLIB' => 'LI_NRO']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PO_NROLIB' => 'Nro. Doc Salud Laboral',
            'PO_FEC' => 'Fecha',
            'PO_HORA' => 'Hora',
            'PO_COLEST' => 'Colesterol',
            'PO_GLUCOSA' => 'Glucosa',
            'PO_MUESTRA' => 'Muestra',
            'PO_LISTO' => 'Listo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPONROLIB()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'PO_NROLIB']);
    }
}
