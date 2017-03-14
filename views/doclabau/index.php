<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\DoclabauSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historial Visitas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclabau-index">

    <h1>Historial Visitas </h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);." (".$cli->CL_COD.")"  ?>
    <h3><?= $cli->CL_APENOM ?> </h3> 
    <br>
    <?php 
    //muestro el boton para nueva visita si es que ya se creo el nuevo doc lab 
    if (isset($ultima)){ ?>
        <p>
        <?= Html::a('Nueva Visita' , ['doclabau/create', 'id'=>$ultima->DO_CODLIB], ['class'=>'btn btn-primary']);?>
        </p>
        <?php
    }
    ?>
   
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DO_CODLIB',
            'DO_VISITA:date',
            'DO_PESO',
           [
                'label' => 'Tensión Art. (Baja/Alta)',
                'value'=> function($model) {
                    if (($model->DO_TENAR1!=null)&&($model->DO_TENAR2!=null))
                        return $model->DO_TENAR1."/".$model->DO_TENAR2;
                    
                },
            ],

           // 'DO_TENAR1',
           // 'DO_TENAR2',
             'DO_COLEST',
             'DO_GLUCO',
             'DO_PAP',
             'DO_MAM',
            //'DO_OBS',
            
             'DO_CINTURA',
             'DO_TRIGLI',
             'DO_HDL',
             'DO_IMC',

             [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {view} {update}',],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
