<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Libretas;
use documento_salud\models\LibretasSearch;
use documento_salud\models\Clientes;
use documento_salud\controllers\DiasNoLaborablesController;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LibretasController implements the CRUD actions for Libretas model.
 */
class LibretasController extends Controller
{

    const ANULADOS = '#C0C0C0'; //color gris para los anulados
     

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
     * Lists all Libretas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LibretasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libretas model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id='000000000003';
       // $id = Yii::$app->request->post('fila');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Libretas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Libretas();

       if ($model->load(Yii::$app->request->post())) {

            try {
                $connection = Yii::$app->dbdocsl;
                $transaction = $connection->beginTransaction();
                    
                $ultId = Libretas::getLastCod();
                
                $model->LI_NRO = str_pad($ultId+1, 12, "0", STR_PAD_LEFT);

                if ($model->save()){
                    Yii::$app->getSession()->setFlash('exito', 'Libreta  guardada correctamente. Número: '.$model->LI_NRO);
                     
                }
                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->LI_NRO]);     
            }
            catch (ErrorException $e) {
                $transaction->rollback();
                echo($e->getMessage());

            }


        } else {

            $model->LI_FECPED = date('Y-m-d');
            $model->LI_HORA=  date('H:i:s');
            $model->LI_CONSULT = false;
            $model->LI_ESTUD = false;
            $model->LI_IMPR = false;
            $model->LI_FECRET = null;
            $model->LI_FECIMP = null;
            $model->LI_FECVTO = null;
            $model->LI_COMP = "000";//ver
            $model->LI_ANULADA =false;
            $model->LI_ADIC = null;
            $model->LI_IMPADI = 0;
            $model->LI_REIMPR = false;
            $model->LI_SELECT = false;


            if (isset($_GET['codcli'])) {
                $cliente = Clientes::findOne($_GET['codcli']);
                $model->LI_COCLI = $cliente->CL_COD;
            }
            else {    

                $cliente = new Clientes();
            }


            return $this->render('create', [
                'model' => $model,
                'cliente' => $cliente,
            ]);
        }
        
       
    }

    /**
     * Updates an existing Libretas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LI_NRO]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Libretas model.
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
     * Finds the Libretas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Libretas the loaded model
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

    /**
     * Finds the Libretas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Libretas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findUltimoTramite($codcli)
    {
        $model = Libretas::find()
                    ->where(['LI_COCLI' => $codcli])
                    ->andWhere(['not', ['LI_FECVTO' => null]])
                    ->orderBy(['LI_FECPED' => SORT_DESC])
                    ->one();
       /* if (( $model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }*/
        return $model;
    }

    public function vencimiento($fechavenc){

        $nuevafecha = strtotime ( '+'.Yii::$app->params['TOLERANCIA_TRAMITE'].' day' , strtotime ( $fechavenc ) ) ;
        $dianuevo= date ('w', $nuevafecha);
        $nuevafecha = date ('Y-m-j' , $nuevafecha );


        if (DiasNoLaborablesController::esDiaLaborable($nuevafecha)){
           // return $nuevafecha." Día Laborable";
           $fecha2 = $nuevafecha;
        }
        else {
            //$proximo = DiasNoLaborablesController::proximoLaborable($nuevafecha);
            //return $nuevafecha."  Día No Laborable - proximo: ".$proximo;
            $fecha2 = DiasNoLaborablesController::proximoLaborable($nuevafecha);
        }

        return $fecha2;

      /*  $hoy = date('Y-m-d');

        $fecha2=strtotime($fecha2);
        $hoy=strtotime($hoy);

        $diastrasnc   = ($fecha2-$hoy)/86400;
        $diastrasnc   = abs($diastrasnc); 
        $diastrasnc = floor($diastrasnc); 

        if($fecha2 < $hoy){
           // return "<label class='label_venc_no'>".$diastrasnc." días vencida </label>";
           return 0;
        }
        else {
           // return "<label class='label_venc_ok'>".$diastrasnc." días para su vencimiento  </label>";
           return 1;

        }*/


       

    }

    public function actionVer() {
        var_dump(Yii::$app->request->post());
        if (isset($_POST['fila'])) {
            $model = Libretas::findOne($_POST['fila']);

           // $model->practicas = $model->practicasTurno;
            return $this->renderAjax('_formLibretas', [
                'model' => $model,
            ]);
        } else {
            return '<div class="alert alert-danger">No existe información!</div>';
        }
    }
}
