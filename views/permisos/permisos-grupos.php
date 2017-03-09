<?php
use smu\models\GrupoIntranet;
use smu\models\PermisoIntranet;
use smu\models\PermisoPorGrupo;
use smu\models\AmpliacionPermisoIntranet;
use smu\models\RestriccionPermisoIntranet;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
use kartik\select2\Select2;

use smu\assets\LargeLayoutAsset;
use smu\assets\PermisosAsset;

LargeLayoutAsset::register($this);
PermisosAsset::register($this);

echo Dialog::widget();

/* @var $this yii\web\View */
/* @var $searchModel farmacia\models\Movimientos_diariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administración de permisos de Grupos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permisos-grupos">
    <h3><?= Html::encode($this->title) ?></h3>
    
    <?php $form = ActiveForm::begin([
        'id' => 'form-permisos',
        'layout' => 'horizontal',
    ]); ?>
    
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-10">
                    <h4>Grupo:</h4>
                    <?= Select2::widget([
                        'name' => 'grupo',
                        'id' => 'selectGrupos',
                        'data' => GrupoIntranet::getListaGruposIntranet(),
                        'options' => [
                            'placeholder' => 'Buscar grupo ...',
                        ],
                        'pluginEvents' => [
                            'select2:select' => 'function() { verPermisosParaGrupo(); }',
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Permisos Existentes:</h4>
            <?= Html::listBox(
                'posibles',
                null,
                [],
                [
                    'id' => 'posibles',
                    'multiple' => true,
                    'size' => 30,
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
        <div class="col-md-1" align="center">
            <h4>Acciones:</h4>
            <div class="btn-group-lg btn-group-vertical">
                <?= Html::button('<span class="glyphicon glyphicon-backward" style="color:white;"></span>', 
                    [
                        'class' => 'btn_volver btn btn-danger',
                        'onclick' => 'quitarPermiso()',
                    ]) ?>
                <?= Html::button('<span class="glyphicon glyphicon-forward" style="color:white;"></span>', 
                    [
                        'class' => 'btn_volver btn btn-success',
                        'onclick' => 'agregarPermiso()',
                    ]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Permisos Asignados:</h4>
            <?= Html::listBox(
                'asignados',
                null,
                [],
                [
                    'id' => 'asignados',
                    'multiple' => true,
                    'size' => 30,
                    'class' => 'form-control',
                ]
            ) ?>
        </div>
    </div>

    <div class="row"><div class="col-md-12"><div class="botones-form pull-right">
        <button type="button" class="btn btn-danger" onclick="">Cancelar</button>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div></div></div>
    

    <?php ActiveForm::end(); ?>



</div>

