<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tip_doc".
 *
 * @property string $TI_COD
 * @property string $TI_NOM
 *
 * @property Clientes[] $clientes
 */
class TipDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tip_doc';
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
            [['TI_COD'], 'required'],
            [['TI_COD'], 'string', 'max' => 3],
            [['TI_NOM'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TI_COD' => 'Código Tipo Documento',
            'TI_NOM' => 'Tipo Documento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['CL_TIPDOC' => 'TI_COD']);
    }

    public static function getListaTipoDoc()
    {
        $opciones = TipDoc::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'TI_COD', 'TI_NOM');
    }
}
