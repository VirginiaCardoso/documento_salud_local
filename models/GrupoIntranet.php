<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sessions_intranet_grupos".
 *
 * @property string $id_grupo
 * @property string $nombre
 */
class GrupoIntranet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions_intranet_grupos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
  /*  public static function getDb()
    {
        return Yii::$app->get('dbdocsl');
    }

     
    public static function databaseName()
    {
        return 'docsl';
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo', 'nombre'], 'unique'],
            [['id_grupo', 'nombre'], 'required'],
            [['id_grupo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => 'ID Grupo',
            'nombre' => 'Nombre',
        ];
    }
    
    public static function primaryKey()
    {
        return ['id_grupo'];
    }
    
    public static function getListaGruposIntranet()
    {
        return ArrayHelper::map(GrupoIntranet::find()->asArray()->orderBy(['id_grupo' => SORT_ASC])->all(), 'id_grupo', 'nombre');
    }
    
    public function getPermisosGrupo()
    {
        return $this->hasMany(PermisoPorGrupo::className(), ['id_grupo' => 'id_grupo']);
    }

    public function getPermisosRestantes()
    {
        $query = PermisoIntranet::find();

        $subQuery = PermisoPorGrupo::find()->where(['=', PermisoPorGrupo::tableName() . '.id_grupo', $this->id_grupo]);
        //$query->leftJoin(['T' => $subQuery], 'T.fk_id = parentTable.id');


        /*$query->leftJoin(PermisoPorGrupo::tableName(), PermisoPorGrupo::tableName() . '.privilegio = ' . PermisoIntranet::tableName() .'.cod')
            ->select(['sessions_intranet_privilegios.*'])->where(['=', 'id_grupo', null])->andWhere(['=', PermisoPorGrupo::tableName() . '.id_grupo', $this->id_grupo]);*/
        $query->leftJoin(['pg' => $subQuery], 'pg.privilegio = ' . PermisoIntranet::tableName() .'.cod')->where('id_grupo IS NULL');

        return $query->all();
    }
}
