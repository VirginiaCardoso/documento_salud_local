<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "convenio".
 *
 * @property string $CO_COD
 * @property string $CO_DESC
 *
 * @property Libretas[] $libretas
 */
class Convenios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'convenio';
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
            [['CO_COD','CO_DESC'], 'required'],
            [['CO_COD'],'unique'],
            [['CO_COD'], 'string','length' => [2], 'max' => 2, 'min' => 2, 'tooShort' => 'El código debe tener 2 caracteres. Ejemplo: "01"'],
            [['CO_DESC'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CO_COD' => 'Código',
            'CO_DESC' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibretas()
    {
        return $this->hasMany(Libretas::className(), ['LI_CONVEN' => 'CO_COD']);
    }

    public static function getListaConvenios()
    {
        $opciones = Convenios::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'CO_COD', 'CO_DESC');
    }
}
