<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */


$this->title = 'Editar Documento Laboral: '.$model->DO_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Documento Salud Laboral', 'url' => ['/libretas/consulta-medica/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclab-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'lib'=> $lib,
        'client' =>$client,
        'docaux' => $docaux,
    ]) ?>

</div>
