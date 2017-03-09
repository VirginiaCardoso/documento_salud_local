<?php
use documento_salud\models\Legajo;
use documento_salud\models\GrupoIntranet;
use documento_salud\models\PermisoIntranet;
use documento_salud\models\PermisoPorGrupo;
use documento_salud\models\AmpliacionPermisoIntranet;
use documento_salud\models\RestriccionPermisoIntranet;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
use kartik\select2\Select2;

use documento_salud\assets\LargeLayoutAsset;
use documento_salud\assets\PermisosAsset;

//LargeLayoutAsset::register($this);
PermisosAsset::register($this);

echo Dialog::widget();

/* @var $this yii\web\View */
/* @var $searchModel farmacia\models\Movimientos_diariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de Grupos a Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-grupos">
    <h3><?= Html::encode($this->title) ?></h3>
    
    <?php $form = ActiveForm::begin([
        'id' => 'form-usuarios-grupos',
        'layout' => 'horizontal',
    ]); ?>
    
    <div class="row">
        <div class="col-md-4">
            <h4>Usuario:</h4>
            <?= Select2::widget([
                'name' => 'usuario',
                'id' => 'selectUsuarios',
                'data' => Legajo::getListaPersonal(),
                'options' => [
                    'placeholder' => 'Buscar usuario ...',
                ],
                'pluginEvents' => [
                    'select2:select' => 'function() { verGrupoParaUsuario(); }',
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h4>Grupo:</h4>
            <?= Select2::widget([
                'name' => 'grupo',
                'id' => 'selectGrupos',
                'data' => GrupoIntranet::getListaGruposIntranet(),
                'options' => [
                    'placeholder' => 'Buscar grupo ...',
                ],
            ]);
            ?>
        </div>
    </div>

    <div class="row"><div class="col-md-8"><div class="botones-form pull-right">
        <button type="button" class="btn btn-danger" onclick="">Cancelar</button>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div></div></div>
    
    <?php ActiveForm::end(); ?>
</div>

