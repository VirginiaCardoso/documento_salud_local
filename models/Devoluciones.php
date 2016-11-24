<?php

namespace documento_salud\models;

use Yii;

/**
 * This is the model class for table "devolu".
 *
 * @property integer $DE_COD
 * @property string $DE_NROTRA
 * @property string $DE_IMPORT
 * @property string $DE_FECHA
 *
 * @property Libretas $dENROTRA
 */
class Devoluciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devolu';
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
            [['DE_NROTRA', 'DE_IMPORT', 'DE_FECHA'], 'required'],
            [['DE_IMPORT'], 'number'],
            [['DE_FECHA'], 'safe'],
            [['DE_NROTRA'], 'string', 'max' => 12],
            [['DE_NROTRA'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DE_NROTRA' => 'LI_NRO']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DE_COD' => 'Código',
            'DE_NROTRA' => 'Nro. Doc. Laboral',
            'DE_IMPORT' => 'Importe Devolución',
            'DE_FECHA' => 'Fecha Devolución',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDENROTRA()
    {
        return $this->hasOne(Libretas::className(), ['LI_NRO' => 'DE_NROTRA']);
    }
}
