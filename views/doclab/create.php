<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */

$this->title = 'Create Doclab';
$this->params['breadcrumbs'][] = ['label' => 'Doclabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
