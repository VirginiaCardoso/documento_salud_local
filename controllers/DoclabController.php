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
use yii\filters\VerbFilter;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            }
            else {
                $model->diabfam="01";    
            }

            if ($model->DO_FAHIPE == "00"){
                $model->hiperfam="02";    
            }
            else {
                $model->hiperfam="01";    
            }
           
           if ($model->DO_FACARD == "00"){
                $model->cardfam="02";    
            }
            else {
                $model->cardfam="01";    
            }

            if ($model->DO_FAONCO == "00"){
                $model->oncofam="02";    
            }
            else {
                $model->oncofam="01";    
            }
           
           

        }
        $docaux = Doclabau::findOne($id);
        if ( $docaux==null){
            $docaux = new Doclabau();
            $docaux->DO_CODLIB = $id;
            $docaux->DO_CODCLI = $codcli;
            $docaux->save(false);
        }
    //   $model = new Doclab();

            if ($model->load(Yii::$app->request->post())){
                if ($model->fumador=="07"){ //es exfumador
                    $model->DO_FUMA=$model->fumador.$model->cuanto;
               }
                else {
                     $model->DO_FUMA=$model->fumador;
                }

                if ($model->vener=="16") //si en venereas
                    $model->DO_VENER=$model->vener.$model->cual;
                else
                    $model->DO_VENER=$model->vener;

                if ($model->emb=="29") //si en embarazos*/
                    $model->DO_EMBARA=$model->emb.$model->cuantosemb;
                else
                    $model->DO_EMBARA=$model->emb;

                if ($model->menop=="34") //si en menopausia
                    $model->DO_MENOP=$model->menop.$model->edadmenop;
                else
                    $model->DO_MENOP=$model->menop;


              //  print_r($model->diabquienes);
                if ($model->diabfam=="01") {

                 if($model->diabquienes)

                    $model->DO_FADI = implode($model->diabquienes);
                  else

                  $model->DO_FADI = "04";

                } //si diabetes fam
                   // 
                else
                    $model->DO_FADI = "00";
/*
                if ($model->hiperfam=="01") //si diabetes fam
                    $model->DO_FAHIPE= $model->hiperquienes;
                else
                    $model->DO_FAHIPE= "00";

                if ($model->cardfam=="01") //si diabetes fam
                    $model->DO_FACARD= $model->cardquienes;
                else
                    $model->DO_FACARD = "00";

                if ($model->oncofam=="01") //si diabetes fam
                    $model->DO_FAONCO= $model->oncoquienes;
                else
                    $model->DO_FAONCO= "00";
                */
                // guardar enfermedaddes familiares
              
             
                /* foreach ($model->diabquienes[] as $r) {
                    $model->DO_FADI .= $r;
       
                 } 
                
*/
                 if ($model->save(false)) {
                   // return $this->redirect(['view', 'id' => $model->DO_NRO]);
                    Yii::$app->getSession()->setFlash('exito', 'Consulta medica guardada   correctamente, Nro Doc Lab: '.$model->DO_NRO);

                    return $this->redirect(['libretas/consulta-medica/']);
                
                } else {
                return $this->render('create', [
                    'model' => $model,
                    'lib'=> $lib,
                    'client' =>$client,
                    'docaux' => $docaux,
                ]);
            }
            
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'lib'=> $lib,
                    'client' =>$client,
                    'docaux' => $docaux,
                ]);
            }
       /* }
                catch (ErrorException $e) {
                    $transaction->rollback();
                    echo($e->getMessage());

                }*/
        /*
       // print_r($lib);
      //  print_r($client);

        $model = Doclab::findOne($id);
        if ( $model==null){
            $model = new Doclab();
            $model->DO_NRO = $id;
            $model->DO_CODCLI = $lib->LI_COCLI;
            $model->save(false);

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
          }*/
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
}
