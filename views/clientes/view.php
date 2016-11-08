<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

use documento_salud\models\TipDoc;
use documento_salud\models\Estciv;
use documento_salud\models\Locali;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */

$this->title = 'Cliente:  '.$model->CL_COD;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->CL_COD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->CL_COD], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales',
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-2',
                                                                'wrapper' => 'col-md-10']
                                                            ],
                                            'layout' => 'horizontal']); ?>     

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_COD', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'CL_HC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>

<?= $form->field($model, 'CL_APENOM')->textInput(['readonly' => true,'maxlength' => true]) ?>

<div class="row">
    <div class="col-md-6">
 
        <?= $form->field($model->cLTIPDOC, 'TI_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
    <div class="col-md-4">

    <?= $form->field($model, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>

<div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'CL_FECNAC',  ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']]) ->textInput(['readonly' => 'true', 'value' => Yii::$app->formatter->asDate($model->CL_FECNAC, 'php:d-m-Y')])->label('Fecha') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'CL_SEXO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'value' => ($model->CL_SEXO=='F' ? 'Femenino': 'Masculino'), 'maxlength' => true]) ?>
        </div>
</div>

<div class="row">
        <div class="col-md-6">
<?= $form->field($model->cLESTCIV, 'ES_NOM', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
         </div>
</div>


<?= $form->field($model, 'CL_DOMICI')->textInput(['readonly' => true,'maxlength' => true]) ?>

<?= $form->field($model->cLCODLOC, 'LO_DETALLE', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])->textInput(['readonly' => true,'maxlength' => true]) ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_TEL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>

<?= $form->field($model, 'CL_LUGTRA')->textInput(['readonly' => true,'maxlength' => true]) ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_NROHAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>

    <?= $form->field($model, 'CL_EMAIL')->textInput(['readonly' => true,'maxlength' => true]) ?>

<br>
<div class="row">
    <div class="col-md-2">
        <?='<label class=" control-label" for="CL_IMG"> Imágen cliente </label>' ?>
    </div>
    <div class="col-md-2">
        <?php 
        if ($model->isNewRecord) { // echo $form->field($model, 'CL_IMG')->textInput(['maxlength' => true]);

           
          
                echo "Cargar nueva  imagen";

          
        }
        else {
            $src = Yii::$app->params['path_clientes'].'/'.$model->CL_COD.'/'.$model->CL_IMG;
            echo Html::img( $src, $options = ['title' => $model->CL_IMG,
            'alt' => 'No se encontro la imágen', 'height'=>'200', 'width'=>'200'] );
            }
        ?>
    </div>
</div>
<!--
<div id="cambox" >
    <div id="webcam"></div>
    <div id="tiktik">
        <span class="timer">3</span>
        <span class="click"><img alt="take photo" src="img/camera_icon.png" onclick="capturePic()" /></span>
    </div>
    <div id="nocamera">
        <div class="message">
            Video has not detected any available cameras on your system. Please connect a camera and try again.
        </div>
    </div>
    <div id="preview">
        <img id="previewImg" alt="preview Image" height="240" width="320" src="img/preload.gif" />
        <span class="close"></span>
    </div>
</div>
-->

<?php ActiveForm::end(); ?>

</div>