<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "vacunaci".
 *
 * @property string $TIPO
 * @property string $ID
 */
class Vacunaci extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacunaci';
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
            [['TIPO'], 'string', 'max' => 40],
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

    public function codigoRubeola(){
        $fum = Vacunaci::find()->where(['TIPO' => 'RUBEÓLA'])->one();
        return $fum->ID;
    }

    public function codigoTetanos(){
        $fum = Vacunaci::find()->where(['TIPO' => 'TÉTANOS'])->one();
        return $fum->ID;
    }

    public function codigoAntigripal(){
        $fum = Vacunaci::find()->where(['TIPO' => 'ANTIGRIPAL'])->one();
        return $fum->ID;
    }

    public function codigoAntihepatitis(){
        $fum = Vacunaci::find()->where(['TIPO' => 'ANTIHEPATITIS B'])->one();
        return $fum->ID;
    }

    public function codigoTransfusiones(){
        $fum = Vacunaci::find()->where(['TIPO' => 'TRANSFUSIONES'])->one();
        return $fum->ID;
    }

    public function codigoVenereas(){
        $fum = Vacunaci::find()->where(['TIPO' => 'VENÉREAS'])->one();
        return $fum->ID;
    }

    public function codigoLumbar(){
        $fum = Vacunaci::find()->where(['TIPO' => 'DOLOR LUMBAR (OCASIONÓ FALTA AL TRABAJO)'])->one();
        return $fum->ID;
    }
    

}
