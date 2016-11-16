<?php

namespace documento_salud\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tpo_ser".
 *
 * @property string $TS_COD
 * @property string $TS_DESC
 * @property string $TS_IMP
 * @property string $TS_CLASE
 *
 * @property Libretas[] $libretas
 * @property Clases $tSCLASE
 */
class TpoSer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tpo_ser';
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
            [['TS_COD','TS_DESC','TS_CLASE','TS_IMP'], 'required'],
            [['TS_COD'],'unique'],
            [['TS_COD'], 'string','length' => [2], 'max' => 2, 'min' => 2, 'tooShort' => 'El código debe tener 2 caracteres. Ejemplo: "01"'],
            [['TS_IMP'], 'number'],
            [['TS_CLASE'], 'string', 'max' => 2],
            [['TS_DESC'], 'string', 'max' => 20],
            [['TS_CLASE'], 'exist', 'skipOnError' => true, 'targetClass' => Clases::className(), 'targetAttribute' => ['TS_CLASE' => 'CL_COD']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TS_COD' => 'Código',
            'TS_DESC' => 'Descripción',
            'TS_IMP' => 'Importe',
            'TS_CLASE' => 'Clase',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibretas()
    {
        return $this->hasMany(Libretas::className(), ['LI_TPOSER' => 'TS_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSCLASE()
    {
        return $this->hasOne(Clases::className(), ['CL_COD' => 'TS_CLASE']);
    }

    public static function getListaTipoRenovacionNormal()
    {
        $opciones = TpoSer::find()
        ->where(['TS_COD'=>'02'])
        ->orWhere(['TS_COD'=>'06'])
        ->orWhere(['TS_COD'=>'10'])
        ->orWhere(['TS_COD'=>'14'])
        ->asArray()->all();
        return ArrayHelper::map($opciones, 'TS_COD', 'TS_DESC');
    }

    public static function getListaTipoRenovacionVencida()
    {
        $opciones = TpoSer::find()
        ->where(['TS_COD'=>'03'])
        ->orWhere(['TS_COD'=>'07'])
        ->orWhere(['TS_COD'=>'11'])
        ->orWhere(['TS_COD'=>'15'])
        ->asArray()->all();
        return ArrayHelper::map($opciones, 'TS_COD', 'TS_DESC');
    }

    public static function getListaTipoNueva()
    {
        $opciones = TpoSer::find()
        ->where(['TS_COD'=>'01'])
        ->orWhere(['TS_COD'=>'05'])
        ->orWhere(['TS_COD'=>'09'])
        ->orWhere(['TS_COD'=>'13'])
        ->asArray()->all();
        return ArrayHelper::map($opciones, 'TS_COD', 'TS_DESC');
    }

    public function getImporte($cod)
    {
       $serv = TpoSer::findOne(['TS_COD'=>$cod]);
       return $serv['TS_IMP'];
    }

   
}
