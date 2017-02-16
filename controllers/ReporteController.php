<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\CajaDiariaFiltro;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;


/**
 * ReportesController implements the CRUD actions for Eventos model.
 */
class ReporteController extends Controller
{
      public $CodController="008";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
               'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionCajadiaria()
    {
        $searchModel = new CajaDiariaFiltro();
       
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if  ($searchModel->load(Yii::$app->request->get())){
            $filtro = false;
        }else{
            $filtro = true;
        }
      

        return $this->render('cajadiaria', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filtro' => $filtro,
        ]);
    }

    
    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libretas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
