<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Doclab;
use documento_salud\models\Doclabau;
use documento_salud\models\DoclabauSearch;
use documento_salud\models\Libretas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoclabauController implements the CRUD actions for Doclabau model.
 */
class DoclabauController extends Controller
{
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
     * Lists all Doclabau models.
     * @return mixed
     */
    public function actionIndex($codcli)
    {
        $searchModel = new DoclabauSearch();
        $dataProvider = $searchModel->searchHistorial(Yii::$app->request->queryParams, $codcli);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doclabau model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Doclabau model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    { //$id nro de libreta
       $lib = Libretas::findOne($id);
       $cli = $lib->LI_COCLI;

       $model = Doclabau::findOne($id);
       if ( !$model){
        $model = new Doclabau();
        $model->DO_CODLIB = $id;
        //$model->DO_PESO = 0;
        }

        $model->DO_VISITA = date('Y-m-d');
        $model->diferencia = 0;

        $doc = Doclab::findOne($cli);
        if ($doc){
            $model->talla = $doc->DO_TALLA;
        }
       /* else {
             $model->talla = 0;   
        }
*/
       $codanterior = Doclabau::getLastDoclabau($cli, $id);
       if ($codanterior){
        $anterior = Doclabau::findOne($codanterior);
       }
       else {
            $anterior = null;
       }
   
        if ($model->DO_PESO){
            if ($anterior) {
                $model->diferencia = $model->DO_PESO - $anterior->DO_PESO;
            }
            if($model->talla){
                $mt = $model->talla/100;
                $mtcuad = $mt *$mt;
                $imc = $model->DO_PESO/$mtcuad;
                
                $model->DO_IMC =  substr((string)$imc,0,4);
            }
        }

        

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('exito', 'Visita guardada correctamente, Nro Doc Lab: '.$model->DO_CODLIB);
            return $this->redirect(['view', 'id' => $model->DO_CODLIB]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'lib' => $lib,
                'anterior' => $anterior,
            ]);
        }
    }

    /**
     * Updates an existing Doclabau model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DO_CODLIB]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doclabau model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Doclabau model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Doclabau the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doclabau::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
