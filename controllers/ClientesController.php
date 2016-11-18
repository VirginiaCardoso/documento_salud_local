<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Clientes;
use documento_salud\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\db\Query;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex2()
    {
        $searchModel = new ClientesSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (!($searchModel->CL_TIPDOC || $searchModel->CL_NUMDOC || $searchModel->CL_APENOM))
            $searchModel->CL_TIPDOC = Yii::$app->params['TIPODOC_DEFAULT'];
           


        return $this->renderAjax('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clientes model.
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
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($origen)
    {
        $model = new Clientes();

        if ($model->load(Yii::$app->request->post())) {

            try {
                    $connection = Yii::$app->dbdocsl;
                    $transaction = $connection->beginTransaction();
                    
                    $ultId = Clientes::getLastCod();
                
                    $model->CL_COD = str_pad($ultId+1, 6, "0", STR_PAD_LEFT);

                   // $model->CL_TIPDOC = 'DNI';
                   // 
                    if ($model->save()){
                         Yii::$app->getSession()->setFlash('exito', 'Cliente guardado   correctamente, código: '.$model->CL_COD);
                         
                        //else
                           // return $this->render('create', ['model' => $model]);
                        
                    }
                  /*  else {
                        
                        return $this->render('create', ['model' => $model]);
                    }*/
            
                    $transaction->commit();

                    if($origen==1)
                            return $this->redirect(['libretas/create', 'codcli' => $model->CL_COD]);
                    else   
                        return $this->redirect(['view', 'id' => $model->CL_COD]);     
                 }
                catch (ErrorException $e) {
                    $transaction->rollback();
                    echo($e->getMessage());

                }
            
        } else {

                $model->CL_TIPDOC = Yii::$app->params['TIPODOC_DEFAULT'];
                $model->CL_TEL = Yii::$app->params['TELEFONO_DEFAULT'];
                $model->CL_CODLOC = Yii::$app->params['LOCALIDAD_DEFAULT'];

            
                return $this->render('create', [
                        'model' => $model,
                    ]);     
         
        }
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CL_COD]);
        } else {





            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate2($CL_COD)
    {
        $model = $this->findModel($CL_COD);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->CL_COD]);
             return $this->redirect(['libretas/create', 'codcli' => $model->CL_COD]);
        } else {





            return $this->render('update2', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Clientes model.
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
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   public function buscarCliente($id){
        return ClientesController::findModel($id);
   }



}
