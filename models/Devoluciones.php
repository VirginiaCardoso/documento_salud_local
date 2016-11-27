<?php

namespace documento_salud\models;

use Yii;
use documento_salud\models\Libretas;

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
            [['DE_IMPORT'], 'validarImporte'],
            [['DE_FECHA'], 'safe'],
            [['DE_NROTRA'], 'string', 'max' => 12],
            [['DE_NROTRA'], 'exist', 'skipOnError' => true, 'targetClass' => Libretas::className(), 'targetAttribute' => ['DE_NROTRA' => 'LI_NRO']],
        ];
    }

    public function validarImporte($attribute,$params)
{
    $model = Libretas::findOne($this->DE_NROTRA);

    if($model->LI_IMPORTE < $this->attribute){
         $this->addError($attribute, 'El importe de la devolución no puede ser menor al importe de trámite');
    }
    else {
        $this->addError($attribute, 'El importe de la devolución no puede ser menor al importe de trámite');
    }
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
