<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\typeahead\Typeahead;
use kartik\typeahead\Bloodhound;
/*use dosamigos\qrcode\formats\BookMark;
use dosamigos\qrcode\QrCode;*/

use documento_salud\models\Clientes;
use documento_salud\models\TpoSer;
use documento_salud\models\Convenios;
use documento_salud\controllers\LibretasController;
//use documento_salud\assets\EmisionAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
//EmisionAsset::register($this);

Pjax::begin(); 

$this->title = ' Documento Laboral';
$this->params['breadcrumbs'][] = ['label' => 'Administración'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">
 
     <?php $form = ActiveForm::begin([   'id' => 'formEmision', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        
     <!--    <img src="<?= Url::to(['route/qrcode'])?>" /> -->
   <div style="text-align: center;">
        <h3> Certificado Documento Salud Laboral </h3>
        <h4>  Hospital Municipal de Agudos Dr. Leónidas Lucero </h4>
    </div>
 
    <br>
    <table class="texto" style="width:100%" border="0">
        <tr>
            <td> 
                <table class="texto" style="width:100%" border="0">
                <tr >
                    <td><b>N° Documento Salud Laboral </b> <?= $model->DO_NRO ?></td>
                </tr>
                    <tr>
                        <td><b>Apellido y Nombre </b> <?= $client->CL_APENOM ?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo Documento </b><?= $client->cLTIPDOC->TI_NOM ?></td>
                    </tr>
                    <tr>
                        <td><b>N° Documento </b> <?= $client->CL_NUMDOC ?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Fecha Vencimiento  </b><?= Yii::$app->formatter->asDate($lib->LI_FECVTO, 'php:d-m-Y') ?>
                        </td>
                    </tr>
                    >
                </table>
            </td>
            <td>
                <?php 
                    
                        $src = Yii::$app->params['path_clientes'].$client->CL_COD.'/'.$client->CL_IMG;
                        echo Html::img( $src, $options = ['title' => $client->CL_IMG,
                        'alt' => 'No se encontro foto', 'width'=>Yii::$app->params['anchopic']-200 , 'id'=> 'pic'] );
                        
                    ?>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div style="text-align:right">
        Bahía Blanca, <?= date('d/m/Y H:i:s'); ?>
    </div>
    <?php 
        $link = Yii::$app->urlManager->createAbsoluteUrl(['doclab/view', 'id' => $client->CL_COD]);//Url::toRoute(['doclab/view', 'id' => $client->CL_COD]);
        $urlcode = Url::toRoute(['doclab/qrcode', 'link' => $link]);
    ?>
    <img src="<?= $urlcode?>" />
    <br>
    <?= $link ?>
    <br>
    <?= //$urlcode ?>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
