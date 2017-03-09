<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "sessions_intranet_restricciones".
 *
 * @property string $legajo
 * @property integer $privilegio
 */
class RestriccionPermisoIntranet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions_intranet_restricciones';
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
            [['legajo', 'privilegio'], 'required'],
            [['privilegio'], 'integer'],
            [['legajo'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'legajo' => 'Legajo',
            'privilegio' => 'Privilegio',
        ];
    }
}
