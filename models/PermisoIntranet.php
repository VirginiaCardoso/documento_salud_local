<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "sessions_intranet_privilegios".
 *
 * @property string $cod
 * @property string $descri
 */
class PermisoIntranet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions_intranet_privilegios';
    }
    
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
 /*   public static function getDb()
    {
        return Yii::$app->get('dbdocsl');
    }
*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cod', 'descri'], 'unique'],
            [['cod', 'descri'], 'required'],
            [['cod'], 'string', 'max' => 50],
            [['descri'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cod' => 'Código',
            'descri' => 'Descripción',
        ];
    }
    
    public static function primaryKey()
    {
        return ['cod'];
    }
}
