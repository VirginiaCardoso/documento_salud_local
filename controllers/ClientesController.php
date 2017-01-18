<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Clientes;
use documento_salud\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
//use yii\db\Query;
//

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

    public function actionCamera()
    {
        return $this->renderAjax('camera');
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
                        
                    
                  /* else {
                        
                        return $this->render('create', ['model' => $model]);
                    }*/
            
                    $transaction->commit();

                    if($origen==1)
                            return $this->redirect(['libretas/create', 'codcli' => $model->CL_COD]);
                    else   
                        return $this->redirect(['view', 'id' => $model->CL_COD]);  
                    } 
                     else {
                         $transaction->commit();
                        return $this->render('create', ['model' => $model]);
                    }  
                   
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

   public function actionBuscar_cliente() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            $p=Clientes::findOne(["CL_COD" => $post["CL_COD"]]);
           /* $p->PA_DESC_ADEU = "error";
            */
           // $p->save(false);

           return \yii\helpers\Json::encode($p->attributes);
        }
    }

    //búsqueda de trámites de libretas que no esten anulados
    public function actionQuery2($q = null) {
        try {

            $datab = Clientes::databaseName();

            $query = new Query;
            $query->select([Clientes::tableName().'.CL_NUMDOC',  Clientes::tableName().'.CL_APENOM'] )
                ->from($datab.'.'.Clientes::tableName()); 
            $query->where($datab.'.'.Clientes::tableName().'.CL_NUMDOC LIKE "%' . $q .'%"');//OR '.$datab.'.'.Clientes::tableName().'.CL_APENOM LIKE "%' . $q .'%'.$datab.'.'.Clientes::tableName().'CL_NUMDOC LIKE "%' . $q ."%'");
           // $query->andWhere($datab.'.'.Libretas::tableName().'.LI_ANULADA = 0');
            $query->orderBy($datab.'.'.Clientes::tableName().'.CL_NUMDOC');
            $command = $query->createCommand();
            
           
       
            //var_dump($query);
            $data = $command->queryAll();
            $out = [];
            foreach ($data as $d) {
                $out[] = ['value' => $d['CL_NUMDOC'].' - '.$d['CL_APENOM'], 'cod' => $d['CL_NUMDOC']];
            }
            echo Json::encode($out);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Ver si existe determinada historia clinica
     * @param  [type] $hiscli [description]
     * @return [type]         [description]
     */
     public function actionApellido($cl_cod)
    {
        $res = null;
        $resultado = Clientes::findOne(["CL_COD" => $cl_cod]);
        if ($resultado!= null){
            $res =$resultado->CL_APENOM;
        }
        else {
            $res = null;
        }
        echo Json::encode($res);
    }



}
