<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model smu\models\GrupoIntranet */

$this->title = 'Nuevo Grupo de permisos';
$this->params['breadcrumbs'][] = ['label' => 'Grupos Intranet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-intranet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
