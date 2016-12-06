<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

LibretasAsset::register($this);

$this->title = 'Datos muestras ';
$this->params['breadcrumbs'][] = ['label' => 'Estudios Complementarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PO_NROLIB, 'url' => ['view', 'id' => $model->PO_NROLIB]];
/*$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="pool-lab-update">

    <div class="pool-lab-form">
		<h1 ><?= Html::encode($this->title) ?></h1>

     	<?php $form = ActiveForm::begin([   'id' => 'formDatosMuestras', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title">Cargar Datos</h3>
	        </div>
	        <div class="panel-body">
			    <div class="row">
		        	<div class="col-md-6">
		    			<?= $form->field($model, 'PO_NROLIB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true, 'readonly' => true]) ?>
					</div>
		    	</div>

			    <div class="row">
			        <div class="col-md-6"> 
			    		<?= $form->field($model, 'PO_COLEST', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
					</div>
			    </div>

			    <div class="row">
			        <div class="col-md-6"> 
			    <?= $form->field($model, 'PO_GLUCOSA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
					</div>
			    </div>

			    <div class="form-group  pull-right">
			        <?= Html::submitButton('Guardar' , ['class' =>  'btn btn-success botonpanel' ]) ?>
			    </div>
			</div>
		</div>

    <?php ActiveForm::end(); ?>

</div>

</div>
