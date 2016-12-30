<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\DoclabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doclabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doclab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DO_NRO',
            'DO_CODCLI',
            'DO_OCU',
            'DO_RUBRO',
            'DO_RUBTIP',
            // 'DO_ESCOL',
            // 'DO_INGRES',
            // 'DO_FUMA',
            // 'DO_FASTAB',
            // 'DO_ALCOH',
            // 'DO_CAGE',
            // 'DO_SEDAN',
            // 'DO_DEPOR',
            // 'DO_SUENIO',
            // 'DO_EAC',
            // 'DO_HIPERT',
            // 'DO_TRATHI',
            // 'DO_COLEST',
            // 'DO_TRATCO',
            // 'DO_DIABET',
            // 'DO_TRATDI',
            // 'DO_ANTQUI',
            // 'DO_ONCO',
            // 'DO_EMBARA',
            // 'DO_ANOVU',
            // 'DO_MENOP',
            // 'DO_TRH',
            // 'DO_ASMAEP',
            // 'DO_PROSTA',
            // 'DO_RUBEO',
            // 'DO_TETANO',
            // 'DO_ANTIGR',
            // 'DO_ANTIHE',
            // 'DO_TRANSF',
            // 'DO_VENER',
            // 'DO_DOLLUM',
            // 'DO_FADI',
            // 'DO_FAHIPE',
            // 'DO_FACARD',
            // 'DO_FAONCO',
            // 'DO_PAENOM',
            // 'DO_MAENOM',
            // 'DO_HEENON',
            // 'DO_NEVOS',
            // 'DO_NODMAN',
            // 'DO_SOPLOS',
            // 'DO_TUMAB',
            // 'DO_TALLA',
            // 'DO_DATOS',
            // 'DO_DATINT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
