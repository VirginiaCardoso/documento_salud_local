<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Convenios */

$this->title = 'Nuevo Convenio';
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
