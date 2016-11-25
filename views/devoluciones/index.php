<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;


//use archivos_hc\assets\DevolucionesAsset;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\DevolucionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs(
   "$('document').ready(function(){ 
        //actualiza la pagina si no hay filas seleccionadas
        setInterval(function(){
            if( ($('#gridDev').yiiGridView('getSelectedRows')).length==0) {
               $.pjax.reload({container:'#pjax_devoluciones'}); 
            }
            else {
                //despues de que seleccionen algo, se refresca si pasan 10 min
                setTimeout(function(){
                     $.pjax.reload({container:'#pjax_devoluciones'}); 
                 },300000);
            }
            
        }, 20000);
    });"
);


$this->title = 'Devoluciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devoluciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Devolución', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php $form = ActiveForm::begin(['method' => 'post', 'id' => 'formPool']); ?> 

<?php Pjax::begin(['id'=>'pjax_devoluciones']); ?>    
    <?= GridView::widget([
        'id'=> 'gridDev',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'DE_COD',
            'DE_NROTRA',
            'DE_IMPORT',
            'DE_FECHA:date',

           ['class' => 'yii\grid\ActionColumn'],
           ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>
     <div class="col-md-offset-10">
    

        <button class="btn btn-primary pull-right" type="button" onclick="quitarDeCola();">Registrar Devolución</button>    

    </div>

<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?>

</div>
