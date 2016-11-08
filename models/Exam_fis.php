<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "exam_fis".
 *
 * @property string $TIPO
 * @property string $ID
 * @property string $ANCHO
 */
class Exam_fis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_fis';
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
            [['TIPO', 'ID', 'ANCHO'], 'required'],
            [['TIPO'], 'string', 'max' => 50],
            [['ID'], 'string', 'max' => 2],
            [['ANCHO'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TIPO' => 'Tipo',
            'ID' => 'ID',
            'ANCHO' => 'Ancho',
        ];
    }
}
