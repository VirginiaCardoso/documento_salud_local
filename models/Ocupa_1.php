<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "ocupa_1".
 *
 * @property string $TIPO
 * @property integer $MAS_NIVEL
 * @property string $ID
 */
class Ocupa_1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupa_1';
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
            [['TIPO', 'MAS_NIVEL', 'ID'], 'required'],
            [['MAS_NIVEL'], 'integer'],
            [['TIPO'], 'string', 'max' => 50],
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
            'MAS_NIVEL' => 'Mas  Nivel',
            'ID' => 'ID',
        ];
    }
}
