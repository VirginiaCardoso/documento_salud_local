<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "ocupa_3".
 *
 * @property string $TIPO
 * @property string $PADRE_ID
 * @property integer $MAS_NIVEL
 * @property string $ID
 */
class Ocupa_3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupa_3';
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
}
