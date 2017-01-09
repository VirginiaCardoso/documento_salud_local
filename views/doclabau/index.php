<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\DoclabauSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doclabaus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclabau-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doclabau', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DO_CODLIB',
            'DO_VISITA',
            'DO_PESO',
            'DO_TENAR1',
            'DO_TENAR2',
            // 'DO_COLEST',
            // 'DO_GLUCO',
            // 'DO_PAP',
            // 'DO_MAM',
            // 'DO_OBS',
            // 'DO_CINTURA',
            // 'DO_TRIPLI',
            // 'DO_HDL',
            // 'DO_IMC',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
