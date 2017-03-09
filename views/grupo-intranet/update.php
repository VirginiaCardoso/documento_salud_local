<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model smu\models\GrupoIntranet */

$this->title = 'Modificar Grupo: [' . $model->id_grupo . '] ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Grupos Intranet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo, 'url' => ['view', 'id' => $model->id_grupo]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="grupo-intranet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
