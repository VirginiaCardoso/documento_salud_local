<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Doclab;
use documento_salud\models\DoclabSearch;
use documento_salud\models\Libretas;
use documento_salud\models\Doclabau;
use documento_salud\models\Clientes;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\helpers\Json;

/**
 * DoclabController implements the CRUD actions for Doclab model.
 */
class DoclabController extends Controller
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
     * Lists all Doclab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoclabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doclab model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = $this->findModel($id);
        $cliente = Clientes::findOne($model->DO_CODCLI);
        $lib = Libretas::findOne($model->DO_NRO);

        return $this->render('view', [
            'model' => $model,
            'client' => $cliente,
            'lib' => $lib,
        ]);
    }

    

    /**
     * Creates a new Doclab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {

           /* try {
                    $connection = Yii::$app->dbdocsl;
                    $transaction = $connection->beginTransaction();
                    */
        $lib = Libretas::findOne($id);
        $codcli = $lib->LI_COCLI;
        $client = Clientes::findOne($codcli);
       //  print_r($lib);
       // print_r($client);
        
        $model = Doclab::findOne($codcli);
        if ( $model==null){
            $model = new Doclab();
            $model->DO_NRO = $id;
            $model->DO_CODCLI = $codcli;
         //   $model->save(false);

        }
        else {
            //var_dump($model);
            if(substr($model->DO_FUMA,0,2)=="07"){
                 //$model->fumador="07";
                 $model->cuanto=  substr($model->DO_FUMA, 2,2);  
            }
            $model->fumador= substr($model->DO_FUMA, 0,2);
            if(substr($model->DO_VENER,0,2)=="16"){
                $model->cual = substr($model->DO_VENER, 2); 
            }
            $model->vener= substr($model->DO_VENER, 0,2);
            if(substr($model->DO_EMBARA,0,2)=="29"){
                $model->cuantosemb = substr($model->DO_EMBARA, 2); 
            }
            $model->emb= substr($model->DO_EMBARA, 0,2);

            if(substr($model->DO_MENOP,0,2)=="34"){
                $model->edadmenop = substr($model->DO_MENOP, 2); 
            }
            $model->menop= substr($model->DO_MENOP, 0,2);

            if ($model->DO_FADI == "00"){
                $model->diabfam="02"; 
                $model->DO_FADI=[];   
            }
            else {
                $model->diabfam="01";
                $cadenacoma = chunk_split($model->DO_FADI,2,',');
                $model->DO_FADI = explode(',', $cadenacoma);    
            }

            if ($model->DO_FAHIPE == "00"){
                $model->hiperfam="02";
                $model->DO_FAHIPE=[]; 
            }
            else {
                $model->hiperfam="01";  
                $cadenacoma = chunk_split($model->DO_FAHIPE,2,',');
                $model->DO_FAHIPE = explode(',', $cadenacoma);   
            }
           
           if ($model->DO_FACARD == "00"){
                $model->cardfam="02";
                $model->DO_FACARD=[]; 
            }
            else {
                $model->cardfam="01";  
                $cadenacoma = chunk_split($model->DO_FACARD,2,',');
                $model->DO_FACARD = explode(',', $cadenacoma);   
            }

            if ($model->DO_FAONCO == "00"){
                $model->oncofam="02";
                 $model->DO_FAONCO=[]; 
            }
            else {
                $model->oncofam="01";  
                $cadenacoma = chunk_split($model->DO_FAONCO,2,',');
                $model->DO_FAONCO = explode(',', $cadenacoma);   
            }
        }
        $docaux = Doclabau::findOne($id);
        if ( $docaux==null){
            $docaux = new Doclabau();
            $docaux->DO_CODLIB = $id;
            $docaux->DO_CODCLI = $codcli;
            $docaux->save(false);
        }
        if ($model->load(Yii::$app->request->post())){

          if ($model->validate() ){   
            $connection = Yii::$app->dbdocsl;
           $transaction = $connection->beginTransaction();

              try {
                  if ($model->diabfam=="01") {//diabetes
                    if (Yii::$app->request->post( 'Doclab' )['DO_FADI']!="")
                          $model->DO_FADI = implode(Yii::$app->request->post( 'Doclab' )['DO_FADI']);
                        else 
                           $model->DO_FADI = Yii::$app->request->post( 'Doclab' )['DO_FADI'];
                       
                      } //si diabetes fam
                      else
                          $model->DO_FADI = "00";
                    //----------------------------------------------------------
                      if ($model->hiperfam=="01") { //hipertensión
                        if (Yii::$app->request->post( 'Doclab' )['DO_FAHIPE']!="")
                          $model->DO_FAHIPE= implode(Yii::$app->request->post( 'Doclab' )['DO_FAHIPE']);
                        else 
                             $model->DO_FAHIPE = Yii::$app->request->post( 'Doclab' )['DO_FAHIPE'];
                      }
                      else
                          $model->DO_FAHIPE= "00";
                      //--------------------------------------------------
                      if ($model->cardfam=="01") { //cardio
                        if (Yii::$app->request->post( 'Doclab' )['DO_FACARD']!="")
                          $model->DO_FACARD = implode(Yii::$app->request->post( 'Doclab' )['DO_FACARD']);
                        else
                          $model->DO_FACARD = Yii::$app->request->post( 'Doclab' )['DO_FACARD'];
                      }
                      else
                          $model->DO_FACARD = "00";
                      //---------------------------------------------------
                      if ($model->oncofam=="01") { //oncologicas
                        if (Yii::$app->request->post( 'Doclab' )['DO_FAONCO']!="")
                          $model->DO_FAONCO = implode(Yii::$app->request->post( 'Doclab' )['DO_FAONCO']);
                          else 
                            $model->DO_FAONCO = Yii::$app->request->post( 'Doclab' )['DO_FAONCO'];
                        }
                      else
                          $model->DO_FAONCO= "00";

                      if ($model->save()) {
                        Yii::$app->getSession()->setFlash('exito', 'Consulta medica guardada   correctamente, Nro Doc Lab: '.$model->DO_NRO);

                        return $this->redirect(['libretas/consulta-medica/']);
                        
                      } 
                     else{
                        
                         $mensaje = ""; 
                        foreach ($model->getFirstErrors() as $key => $value) {
                          $mensaje .= "$value \\n\\r";
                        }
                        
                       // throw new ErrorException($mensaje);
                        Yii::$app->getSession()->setFlash('error', 'error');
                      }
                  } //try
              catch (\Exception $e) {
                  $transaction->rollBack();
                  
                  Yii::$app->getSession()->setFlash('error', $e->getMessage());

                  return $this->render('create', [
                    'model' => $model,
                    'lib'=> $lib,
                    'client' =>$client,
                    'docaux' => $docaux,
                  ]);
              }
           
            } 
            else {

              //Yii::$app->getSession()->setFlash('error', 'error validacion.'); 
              return $this->render('create', [
                    'model' => $model,
                    'lib'=> $lib,
                    'client' =>$client,
                    'docaux' => $docaux,
                ]);
            }
          } 
          else {

          //   Yii::$app->getSession()->setFlash('error', '.'); 
            return $this->render('create', [
                  'model' => $model,
                  'lib'=> $lib,
                  'client' =>$client,
                  'docaux' => $docaux,
              ]);
          }
    }

    /**
     * Updates an existing Doclab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DO_NRO]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doclab model.
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
     * Finds the Doclab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Doclab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doclab::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Doclab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  /*  public function actionEditar($id)
    {
        $lib = Libretas::findOne($id);
        $client = Clientes::findOne($lib->LI_COCLI);
       // print_r($lib);
      //  print_r($client);

        $model = Doclab::findOne($id);
        if ( $model==null){
            $model = new Doclab();
            $model->DO_NRO = $id;
            $model->DO_CODCLI = $lib->LI_COCLI;
         //   $model->save(false);

        }

       $docaux = Doclabau::findOne($id);
        if ( $docaux==null){
            $docaux = new Doclabau();
            $docaux->DO_CODLIB = $id;
            $docaux->save(false);
        }

        if ($model->load(Yii::$app->request->post())) {
                 if($model->save()){
                    return $this->redirect(['view', 'id' => $model->DO_NRO]);
                }
            }
            else {
                return $this->render('editardocumento', [
                    'model' => $model,
                    'lib'=> $lib,
                    'client' =>$client,
                    'docaux' => $docaux,
                ]);
          }
    }
*/


        /**
     * Displays a single Libretas model.
     * @param string $id
     * @return mixed
     */
    public function actionEmision()
    {
        //$id='000000000003';
       // $id = Yii::$app->request->post('fila');
       $model = new Libretas();
       $cliente = new Clientes();
      //  $model = $this->findModel($id);
      //  $cliente = ClientesController::buscarCliente($model->LI_COCLI);
        return $this->render('emisionvirtual', [
            'model' => $model,
            'cliente' => $cliente,

        ]);
    }


public function actionQueryemision($q = null) {
        try {

          $datab = Doclab::databaseName();

          $query = new Query;
            $query->select([Doclab::tableName().'.DO_NRO', Doclab::tableName().'.DO_CODCLI',  Clientes::tableName().'.CL_COD',  Clientes::tableName().'.CL_NUMDOC',  Clientes::tableName().'.CL_APENOM'] )
                //
                ->from($datab.'.'.Doclab::tableName())
                ->join(  'INNER JOIN',
                    $datab.'.'.Clientes::tableName(),
                    $datab.'.'.Doclab::tableName().'.DO_CODCLI ='.$datab.'.'.Clientes::tableName().'.CL_COD')
                ->distinct()
                ; 
                //
            $query->where('DO_NRO LIKE "%' . $q .'%" OR CL_COD LIKE "%' . $q .'%" OR CL_NUMDOC LIKE "%' . $q .'%" OR CL_APENOM LIKE "%' . $q .'%"');
            $query->orderBy('DO_NRO');
            $command = $query->createCommand();
            
           
       /*
            var_dump($command);*/
            $data = $command->queryAll();
            $out = [];
            foreach ($data as $d) { // 
                $out[] = ['value' => $d['DO_NRO'].' - '.$d['CL_COD'].' - '.$d['CL_NUMDOC'].' - '.$d['CL_APENOM'], 'cod' => $d['DO_NRO']];
            }
            echo Json::encode($out);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}
