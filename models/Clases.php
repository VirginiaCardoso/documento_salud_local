<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "clases".
 *
 * @property string $CL_COD
 * @property string $CL_DESC
 */
class Clases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clases';
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
            [['CL_COD', 'CL_DESC'], 'required'],
            [['CL_COD'],'unique'],
            [['CL_COD'], 'string','length' => [2], 'max' => 2, 'min' => 2, 'tooShort' => 'El código debe tener 2 caracteres. Ejemplo: "01"'],
            [['CL_DESC'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CL_COD' => 'Código',
            'CL_DESC' => 'Descripción',
        ];
    }

      public static function getLista()
    {
        $opciones = Clases::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'CL_COD', 'CL_DESC');
    }

}
