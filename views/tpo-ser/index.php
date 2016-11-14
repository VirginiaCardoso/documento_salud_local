<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\TpoSerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos Trámites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpo-ser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Tipo Trámite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'TS_COD',
            'TS_DESC',
            'TS_IMP',
            //'TS_CLASE',
             [
                'label' => 'Clase',
                'value'=> function($model) {
                    if ($model->tSCLASE!=null)
                        return $model->tSCLASE->CL_DESC;
                    else
                        return "";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
