<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sessions_permisos_intranet".
 *
 * @property string $id_grupo
 * @property string $privilegio
 */
class PermisoPorGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions_permisos_intranet';
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
            [['id_grupo', 'privilegio'], 'required'],
            [['id_grupo'], 'string', 'max' => 25],
            [['privilegio'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => 'ID Grupo',
            'privilegio' => 'Privilegio',
        ];
    }

    public static function primaryKey()
    {
        return ['id_grupo', 'privilegio'];
    }

    public function getDetalle()
    {
        return $this->hasOne(PermisoIntranet::className(), ['cod' => 'privilegio']);
    }
}
