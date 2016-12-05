<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

$this->title = 'Create Pool Lab';
$this->params['breadcrumbs'][] = ['label' => 'Pool Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pool-lab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
