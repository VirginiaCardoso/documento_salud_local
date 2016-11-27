<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Devoluciones;
use documento_salud\models\DevolucionesSearch;
use documento_salud\models\Libretas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DevolucionesController implements the CRUD actions for Devoluciones model.
 */
class DevolucionesController extends Controller
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
     * Lists all Devoluciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DevolucionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Devoluciones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Devoluciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Devoluciones();

        if ($model->load(Yii::$app->request->post()))   {
            try {
                $connection = Yii::$app->dbdocsl;
                $transaction = $connection->beginTransaction();
                $model->DE_FECHA = date('Y-m-d');

                $modelLib = Libretas::findOne($model->DE_NROTRA);

                if($modelLib->LI_IMPORTE > $model->DE_IMPORT){

                    if ($model->save(false)){
                      //  $modelLib->LI_IMPORTE = $modelLib->LI_IMPORTE - $model->DE_IMPORT;
                      //  if ($modelLib->save(false)){ 
                            Yii::$app->getSession()->setFlash('exito', 'Devolución  guardada correctamente. Número: '.$model->DE_COD);
                            $transaction->commit();   
                    return $this->redirect(['index']);
                      //  } 
                      //  else {
                       //     Yii::$app->getSession()->setFlash('error', 'Error al querer actualizar el trámite nro. '.$model->DE_NROTRA);
                      //      return $this->render('create', ['model' => $model, ]);
                       // }
                     
                    }
                    
                }
                else {
                    Yii::$app->getSession()->setFlash('error', 'Error. El importe a devolver ('.$model->DE_IMPORT.'$) debe ser menor que el registrado para el trámite ('.$modelLib->LI_IMPORTE.'$).');
                   return $this->render('create', [             'model' => $model,          ]);

                }
          //  return $this->redirect(['view', 'id' => $model->DE_COD]);
            }
            catch (ErrorException $e) {
                $transaction->rollback();
                echo($e->getMessage());

            }
        } else {
            $model->DE_FECHA = date('Y-m-d');

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Devoluciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post()))   {
            try {
                $connection = Yii::$app->dbdocsl;
                $transaction = $connection->beginTransaction();
                $model->DE_FECHA = date('Y-m-d');

                $modelLib = Libretas::findOne($model->DE_NROTRA);

                if($modelLib->LI_IMPORTE > $model->DE_IMPORT){

                    if ($model->save(false)){
                      //  $modelLib->LI_IMPORTE = $modelLib->LI_IMPORTE - $model->DE_IMPORT;
                      //  if ($modelLib->save(false)){ 
                        Yii::$app->getSession()->setFlash('exito', 'Devolución  modificada correctamente.');
                        $transaction->commit();   
                        // return $this->redirect(['view', 'id' => $model->DE_COD]);
                        return $this->redirect(['index']);
                      //  } 
                      //  else {
                       //     Yii::$app->getSession()->setFlash('error', 'Error al querer actualizar el trámite nro. '.$model->DE_NROTRA);
                      //      return $this->render('create', ['model' => $model, ]);
                       // }
                     
                    }
                    
                }
                else {
                    Yii::$app->getSession()->setFlash('error', 'Error. El importe a devolver ('.$model->DE_IMPORT.'$) debe ser menor que el registrado para el trámite ('.$modelLib->LI_IMPORTE.'$).');
                   return $this->render('update', [             'model' => $model,          ]);

                }
          //  return $this->redirect(['view', 'id' => $model->DE_COD]);
            }
            catch (ErrorException $e) {
                $transaction->rollback();
                echo($e->getMessage());

            }
           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Devoluciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Devoluciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Devoluciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Devoluciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



public function actionGuardardev() {
      
    $selection = (array)Yii::$app->request->post('selection');
    //var_dump($selection);
    if (count($selection)!=0) {
        try {
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();

                foreach($selection as $id){
                    $consulta = Devoluciones::findOne($id);
                    if ($consulta != null) {

                        $libreta = Libretas::findOne($consulta->DE_NROTRA);

                        if ($libreta != null) {
                            $libreta->LI_IMPORTE = $libreta->LI_IMPORTE - $consulta->DE_IMPORT;
                        }
                        //$consulta->save(false);
                        $libreta->save(false);
                        $consulta->delete();
                    }
                    else {
                        Yii::$app->getSession()->setFlash('error', 'No se pudo registrar la devolución N° '.$id.'.');  
                        
                    }
                }

                $transaction->commit();

                Yii::$app->getSession()->setFlash('exito', 'Devoluciones registradas correctamente.');

               // return "ok";

            }
                catch (ErrorException $e) {
                    $transaction->rollback();
                    echo($e->getMessage());

                }
            }
            else {
                //return "cero";
                Yii::$app->getSession()->setFlash('error', 'Debe selecionar alguna devolución para ser registrada.');
            }
            return $this->redirect(['index']);

    
}
}
