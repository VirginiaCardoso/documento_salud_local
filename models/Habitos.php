<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "habitos".
 *
 * @property string $TIPO
 * @property string $ID
 */
class Habitos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'habitos';
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
            [['TIPO'], 'string', 'max' => 20],
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

    public function codigoFumador(){
        $fum = Habitos::find()->where(['TIPO' => 'FUMADOR'])->one();
        return $fum->ID;
    }

    public function codigoAlcohol(){
        $fum = Habitos::find()->where(['TIPO' => 'ALCOHOL'])->one();
        return $fum->ID;
    }

    public function codigoSedantes(){
        $fum = Habitos::find()->where(['TIPO' => 'SEDANTES'])->one();
        return $fum->ID;
    }

    public function codigoDeportes(){
        $fum = Habitos::find()->where(['TIPO' => 'DEPORTES'])->one();
        return $fum->ID;
    }

    public function codigoSueño(){
        $fum = Habitos::find()->where(['TIPO' => 'TRASTOR. DEL SUEÑO'])->one();
        return $fum->ID;
    }
}
