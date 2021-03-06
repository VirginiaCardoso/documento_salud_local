<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "dias_no".
 *
 * @property string $DI_FEC
 * @property string $DI_DESCRI
 */
class DiasNoLaborables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dias_no';
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
            [['DI_FEC', 'DI_DESCRI'], 'required'],
            //[['DI_FEC'], 'safe'],
             [['DI_FEC'],'unique' , 'message' => 'Error. Ya existe un Día No Laborable definido para esa fecha.'],
            [['DI_DESCRI'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DI_FEC' => 'Fecha ',
            'DI_DESCRI' => 'Descripción',
        ];
    }
}
