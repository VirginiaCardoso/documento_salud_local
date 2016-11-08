<?php

namespace documento_salud\models;

use Yii;

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
}
