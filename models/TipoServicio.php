<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tposer_2".
 *
 * @property integer $TP_COD
 * @property string $TP_DESC
 *
 * @property TpoSer[] $tpoSers
 */
class TipoServicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tposer_2';
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
            [['TP_COD','TP_DESC'], 'required'],
            [['TP_DESC'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TP_COD' => 'Código Tipo Servicio',
            'TP_DESC' => 'Tipo Servicio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTpoSers()
    {
        return $this->hasMany(TpoSer::className(), ['TS_TIPO' => 'TP_COD']);
    }


    public static function getLista()
    {
        $opciones = TipoServicio::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'TP_COD', 'TP_DESC');
    }
    
}
