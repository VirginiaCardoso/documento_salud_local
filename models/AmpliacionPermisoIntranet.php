<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "sessions_intranet_ampliaciones".
 *
 * @property string $legajo
 * @property string $privilegio
 */
class AmpliacionPermisoIntranet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions_intranet_ampliaciones';
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
            [['legajo'], 'string', 'max' => 6],
            [['privilegio'], 'string', 'max' => 20],
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
