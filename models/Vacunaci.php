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
        $fum = Habitos::find()->where(['TIPO' => 'RUBEOLA'])->one();
        return $fum->ID;
    }

    public function codigoTetanos(){
        $fum = Habitos::find()->where(['TIPO' => 'TETANOS'])->one();
        return $fum->ID;
    }

    public function codigoAntigripal(){
        $fum = Habitos::find()->where(['TIPO' => 'ANTIGRIPAL'])->one();
        return $fum->ID;
    }

    public function codigoAntihepatitis(){
        $fum = Habitos::find()->where(['TIPO' => 'ANTIHEPATITIS'])->one();
        return $fum->ID;
    }

    public function codigoSueño(){
        $fum = Habitos::find()->where(['TIPO' => 'TRASTOR. DEL SUEÑO'])->one();
        return $fum->ID;
    }

}
