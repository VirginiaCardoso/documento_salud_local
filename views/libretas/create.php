<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Nuevo Trámite';
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>

</div>
<?php
    Modal::begin([
        'header' => 'Buscar Cliente',
        'id' => 'modalBuscarCliente',
        'size' => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo "<div id='modalContent'>Por favor espere mientras se cargan los datos...</div>";
    Modal::end();
?>

