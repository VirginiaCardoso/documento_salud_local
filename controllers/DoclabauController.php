<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Doclab;
use documento_salud\models\Doclabau;
use documento_salud\models\DoclabauSearch;
use documento_salud\models\Libretas;
use documento_salud\models\Clientes;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoclabauController implements the CRUD actions for Doclabau model.
 */
class DoclabauController extends Controller
{
    public $CodController = '006'; 
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
        $ultima = $searchModel->searchSincompletar($codcli);

        $cli = Clientes::findOne($codcli);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cli' => $cli,
            'ultima' =>$ultima,
        ]);
    }

    /**
     * Displays a single Doclabau model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $lib = Libretas::findOne($id);
        $cocli = $lib->LI_COCLI;
        $client = Clientes::findOne($cocli);
        $model = Doclabau::findOne($id);
        $doc = Doclab::findOne($cocli);
        if ($doc){
            $model->talla = $doc->DO_TALLA;
        }

        return $this->render('view', [
            'model' => $model,
            'client' => $client,
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
       $cocli = $lib->LI_COCLI;

       $client = Clientes::findOne($cocli);

       $model = Doclabau::findOne($id);

       if ( !$model){
        $model = new Doclabau();
        $model->DO_CODLIB = $id;
        //$model->DO_PESO = 0;
        }

        $model->DO_VISITA = date('Y-m-d');
        $model->diferencia = 0;

        $doc = Doclab::findOne($cocli);

        if ($doc){
            $model->talla = $doc->DO_TALLA;
        }
       /* else {
             $model->talla = 0;   
        }
*/
       $codanterior = Doclabau::getLastDoclabau($cocli, $id);
       if ($codanterior){
        $anterior = Doclabau::findOne($codanterior);
        $anterior->tension=$anterior->DO_TENAR1."/".$anterior->DO_TENAR2;
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
        

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $ten = explode("/", $model->tension);
                $model->DO_TENAR1 = $ten[0];
                $model->DO_TENAR2 = $ten[1];

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('exito', 'Visita guardada correctamente, Nro Doc Lab: '.$model->DO_CODLIB);
                    return $this->redirect(['view', 'id' => $model->DO_CODLIB]);
                }
                else {
                    return $this->render('create', [
                        'model' => $model,
                        'lib' => $lib,
                        'anterior' => $anterior,
                        'doc' => $doc,
                        'client' => $client,
                    ]);
                }
            }//validate
             else {
                 Yii::$app->getSession()->setFlash('error', 'Error validación'.$model->DO_CODLIB);
                return $this->render('create', [
                    'model' => $model,
                    'lib' => $lib,
                    'anterior' => $anterior,
                    'doc' => $doc,
                    'client' => $client,
                ]);
            }
        }//load
        else {
            return $this->render('create', [
                'model' => $model,
                'lib' => $lib,
                'anterior' => $anterior,
                'doc' => $doc,
                'client' => $client,
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
        $model->DO_VISITA = date('Y-m-d');//actualizo la fecha de la visita si es que se realiza una modificacion
        $lib = Libretas::findOne($id);
        $cocli = $lib->LI_COCLI;
        $client = Clientes::findOne($cocli);
        $codanterior = Doclabau::getLastDoclabau($cocli, $id);
           if ($codanterior){
            $anterior = Doclabau::findOne($codanterior);
            $anterior->tension=$anterior->DO_TENAR1."/".$anterior->DO_TENAR2;
           }
           else {
                $anterior = null;
           }
        $doc = Doclab::findOne($cocli);
        if ($doc){
            $model->talla = $doc->DO_TALLA;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'lib' => $lib,
                'anterior' => $anterior,
                'doc' => $doc,
                'client' => $client,
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
