<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
