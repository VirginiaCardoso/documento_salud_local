<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\DiasNoLaborablesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Días No Laborables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dias-no-laborables-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Día No Laborable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'DI_FEC',
            [
                'attribute' => 'DI_FEC',
                'format' => 'date',
                'value' => 'DI_FEC',
                'filter' => DateControl::widget([
                    'model'=>$searchModel,
                    'attribute'=>'DI_FEC',
                    'type'=>DateControl::FORMAT_DATE,
                    'ajaxConversion'=>false,
                    'options' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]
                ]),
            ],
            'DI_DESCRI',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
