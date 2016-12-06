<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\PoolLab;
use documento_salud\models\PoolLabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PoolLabController implements the CRUD actions for PoolLab model.
 */
class PoolLabController extends Controller
{


     const SIN_EXTRACC = '#DB5653'; //color gris para los anulados
     const CON_EXTRACC = '#3C9DFF'; //color gris para los anulados
     

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
     * Lists all PoolLab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoolLabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PoolLab model.
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
     * Displays a single Convenios model.
     * @param string $id
     * @return mixed
     */
    public function actionSinMuestras($id)
    {
        return $this->render('sin-muestras', [
                'model' => $this->findModel($id),
            ]);
    }


    public function actionConfirmarMuestra($id){
        
         $model = $this->findModel($id);

            if ($model!=null){
                $model->PO_MUESTRA=1;
               if( $model->save(false)){
                Yii::$app->getSession()->setFlash('exito', 'Registrada correctamente la toma de muestras');
                }
                else {
                     Yii::$app->getSession()->setFlash('error', 'Error al registrar la toma de muestras'); 
                }



            }
            else {
                Yii::$app->getSession()->setFlash('error', 'Error al registrar la toma de muestras'); 
        
        }
        return $this->redirect(['index']);

    }

    /**
     * Creates a new PoolLab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PoolLab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PO_NROLIB]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PoolLab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PO_NROLIB]);
        } else {
            
        }
    }

    public function actionCargarDatos($id){
        $model = $this->findModel($id);
        $model->scenario = 'cargarDatos';
        // echo '<pre>',print_r($model),'</pre>';
        if ($model->load(Yii::$app->request->post())){
            $model->PO_LISTO = 1;
            if ($model->save(false)) {
                Yii::$app->getSession()->setFlash('exito', 'Registrada correctamente la carga de datos de las muestras');
            }
            else {
                 Yii::$app->getSession()->setFlash('error', 'Error al salvar los datos de las muestras'); 
            }
            return $this->redirect(['index']);
        }
            else {
                 return $this->render('update', [
                'model' => $model,
                ]);
            }
        
           
    }


    /**
     * Deletes an existing PoolLab model.
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
     * Finds the PoolLab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PoolLab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PoolLab::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}