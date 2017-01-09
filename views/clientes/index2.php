<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\widgets\MaskedInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;

use documento_salud\models\TipDoc;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;


$dataProvider->prepare(); // 
$pagActual = $dataProvider->getPagination()->getPage();
$pagTotales = $dataProvider->getPagination()->getPageCount();

?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php $form = ActiveForm::begin([
        'id' => 'formBuscarCliente',
        'action' => Url::to(['/cliente/index2']),
        'method' => 'post',
        'layout' => 'horizontal',
    ]); ?>
        <div class="row">
            <input type="hidden" name="pagina" id="paginaClientes" value=<?php echo $pagActual; ?>>
            <div class="col-md-6">
                <?php 
                    $tiposDeDocumento = TipDoc::getListaTipoDoc();
                ?>
                <?= $form->field($searchModel, 'CL_TIPDOC', 
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
                    ->dropDownList($tiposDeDocumento, ['prompt' => '']); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'CL_NUMDOC', 
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
                ->widget(MaskedInput::className(), ['mask' => 'A{0,2}9{1,12}']) ?>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($searchModel, 'CL_APENOM', 
                ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-9']]) ?>
            </div>
        </div>


        <div class="row"><div class="col-md-offset-10">
            <button type="button" class="showModalButton btn btn-primary" id="btnBuscar" onclick="buscarCliente();">Buscar</button>
        </div></div>

    <?php ActiveForm::end(); ?>

    <div class="row">
        <div class="col-md-offset-1">
            <ul class="pagination">
                <li <?php echo ($pagActual === 0) ? 'class="prev disabled"' : 'class="prev"'; ?> onclick="cambiarPagina(-1);">
                    <span class="glyphicon glyphicon-triangle-left"></span>
                </li>
                <li><a>página <?php echo $pagActual+1; ?> de <?php echo $pagTotales; ?></a></li>
                <li <?php echo ($pagActual === ($pagTotales-1)) ? 'class="next disabled"' : 'next'; ?> onclick="cambiarPagina(1);">
                    <span class="glyphicon glyphicon-triangle-right"></span>
                </li>
            </ul>
        </div>
    </div>   
   

<?= GridView::widget([
        'layout' => "{summary}\n{items}",
        'options' => [
            'id' => 'gridClientes',
            ],
        'rowOptions' => function ($model, $key, $index, $grid) {
                $url = Url::to(['clientes/update2', 'CL_COD' => $model['CL_COD']]);

                return [
                    'id' => $model->CL_COD,
                    'style' => "cursor: pointer",
                    'onclick' => "window.location.href='{$url}'",
                ];
            },
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],

            'CL_COD',
           // 'CL_HC',
            'CL_TIPDOC',
            'CL_NUMDOC',
            'CL_APENOM',
            // 'CL_FECNAC',
            // 'CL_CODLOC',
            // 'CL_DOMICI',
            // 'CL_TEL',
            // 'CL_LUGTRA',
            // 'CL_NROHAB',
            // 'CL_SEXO',
            // 'CL_ESTCIV',
            // 'CL_IMG',
            // 'CL_DOMICILAB',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
