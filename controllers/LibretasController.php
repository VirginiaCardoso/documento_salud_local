<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Libretas;
use documento_salud\models\LibretasSearch;
use documento_salud\models\Clientes;
use documento_salud\models\ClientesSearch;
use documento_salud\models\TpoSer;
use documento_salud\models\PoolLab;
use documento_salud\controllers\DiasNoLaborablesController;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;


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
     * Lists all Libretas models.
     * @return mixed
     */
    public function actionConsultaMedica()
    {
        $searchModel = new LibretasSearch();
        $dataProvider = $searchModel->searchConsulta(Yii::$app->request->queryParams);

        return $this->render('consultamedica', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Libretas models.
     * @return mixed
     */
    public function actionRegistrarConsultaMedica()
    {
        $searchModel = new LibretasSearch();
        $dataProvider = $searchModel->searchMenores(Yii::$app->request->queryParams);

        return $this->render('registrarconsultamedica', [
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
       // 
        $model = $this->findModel($id);
        $cliente = ClientesController::buscarCliente($model->LI_COCLI);
        return $this->render('view', [
            'model' => $model,
            'cliente' => $cliente,

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
                $model->LI_FECPED = date('Y-m-d');
                $model->LI_HORA=  date('H:i:s');
                $model->LI_CONSULT = 0;
                $model->LI_ESTUD = 0;
                $model->LI_IMPR = 0;
                $model->LI_FECRET = null;
                $model->LI_FECIMP = null;
                $model->LI_FECVTO = null;
                $model->LI_COMP = "000";//ver
                $model->LI_ANULADA =0;
                $model->LI_ADIC = 0;
                $model->LI_IMPADI = 0;
                $model->LI_REIMPR = 0;
                $model->LI_SELECT = 0;

                if ($model->save(false)){
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
          /*  $model->LI_CONSULT = 0;
            $model->LI_ESTUD = 0;
            $model->LI_IMPR = 0;
            $model->LI_FECRET = null;
            $model->LI_FECIMP = null;
            $model->LI_FECVTO = null;
            $model->LI_COMP = "000";//ver
            $model->LI_ANULADA =false;
            $model->LI_ADIC = null;
            $model->LI_IMPADI = 0;
            $model->LI_REIMPR = 0;
            $model->LI_SELECT = 0;*/
          //  $model->LI_IMPORTE= 0;


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
     * Updates an existing Libretas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionVistaAnular()
    {
        $model = new Libretas();

        return $this->render('anular', [
                'model' => $model,
                
            ]);
     
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionAnular($LI_NRO=null)
    {
        if ($LI_NRO==null) {
                Yii::$app->getSession()->setFlash('error', 'Seleccionar Nro. de Trámite que desea anular.');
                return $this->redirect(['libretas/vista-anular']);
            }
            else {

            $model = $this->findModel($LI_NRO);

            if ($model!=null){

                if($model->LI_ANULADA==0){

                    $model->LI_ANULADA=1;
                    $model->save(false);
                    Yii::$app->getSession()->setFlash('exito', 'Trámite Nro. '.$LI_NRO.' anulado.');
                    return $this->redirect(['libretas/vista-anular']);
                }
                else
                {
                    Yii::$app->getSession()->setFlash('error', 'Trámite ya se encuentra anulado.'); 
                    return $this->redirect(['libretas/vista-anular']);  
                }
               
            }else {

                    return $this->redirect(['libretas/vista-anular']);
                
              //  return $this->render('anular', [
               //     'model' => $model,
               // ]);
            }
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
     * Busca la Libreta que corresponde a un trámite en proceso, si es que existe.
     * @param string $id
     * @return Libretas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findtramiteProceso($codcli)
    {
        $model = Libretas::find()
                    ->where(['LI_COCLI' => $codcli])
                    ->andWhere(['LI_FECVTO' => null]) //fecha vencimiento nulo, esta en trámite
                    ->orderBy(['LI_FECPED' => SORT_DESC])
                    ->one();
       return $model;
    }

    /**
     * Busca la Libreta que corresponde al último trámite, si es que existe.
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
        return $model;
    }

    /**
     * Calcula la fecha del próximo día habil, en base al vencimiento más la tolerancia
     * @param  date $fechavenc Fecha vencimiento del trámite
     * @return date            Fecha del próximo día habil
     */
    public function vencimiento($fechavenc){

        $nuevafecha = strtotime ( '+'.Yii::$app->params['TOLERANCIA_TRAMITE'].' day' , strtotime ( $fechavenc ) ) ;
        $dianuevo= date ('w', $nuevafecha);
        $nuevafecha = date ('Y-m-j' , $nuevafecha );

        if (DiasNoLaborablesController::esDiaLaborable($nuevafecha)){
           $fecha2 = $nuevafecha;
        }
        else {
            $fecha2 = DiasNoLaborablesController::proximoLaborable($nuevafecha);
        }

        return $fecha2;

     
    }

 
    public function actionQuery($q = null) {
        try {

            $datab = Libretas::databaseName();

          $query = new Query;
            $query->select([Libretas::tableName().'.LI_NRO', Libretas::tableName().'.LI_COCLI',  Clientes::tableName().'.CL_APENOM'] )
                ->from($datab.'.'.Libretas::tableName())
                ->join(  'INNER JOIN',
                    $datab.'.'.Clientes::tableName(),
                    $datab.'.'.Clientes::tableName().'.CL_COD ='.$datab.'.'.Libretas::tableName().'.LI_COCLI')
                ->join(  'INNER JOIN',
                    $datab.'.'.TpoSer::tableName(),
                    $datab.'.'.TpoSer::tableName().'.TS_COD ='.$datab.'.'.Libretas::tableName().'.LI_TPOSER')
                ; 
            $query->where('LI_NRO LIKE "%' . $q .'%"');
            $query->orderBy('LI_NRO');
            $command = $query->createCommand();
            
           
       /*
            var_dump($command);*/
            $data = $command->queryAll();
            $out = [];
            foreach ($data as $d) {
                $out[] = ['value' => $d['LI_NRO'].' - '.$d['CL_APENOM'], 'cod' => $d['LI_NRO']];
            }
            echo Json::encode($out);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

        //búsqueda de trámites de libretas que no esten anulados
        public function actionQuery2($q = null) {
        try {

            $datab = Libretas::databaseName();

          $query = new Query;
            $query->select([Libretas::tableName().'.LI_NRO', Libretas::tableName().'.LI_COCLI',  Clientes::tableName().'.CL_NUMDOC',  Clientes::tableName().'.CL_APENOM'] )
                ->from($datab.'.'.Libretas::tableName())
                ->join(  'INNER JOIN',
                    $datab.'.'.Clientes::tableName(),
                    $datab.'.'.Clientes::tableName().'.CL_COD ='.$datab.'.'.Libretas::tableName().'.LI_COCLI')
                ->join(  'INNER JOIN',
                    $datab.'.'.TpoSer::tableName(),
                    $datab.'.'.TpoSer::tableName().'.TS_COD ='.$datab.'.'.Libretas::tableName().'.LI_TPOSER')
                ; 
                 $query->where('CL_COD LIKE "%' . $q .'%" OR CL_NUMDOC LIKE "%' . $q .'%" OR CL_APENOM LIKE "%' . $q .'%"');
            $query->where($datab.'.'.Libretas::tableName().'.LI_NRO LIKE "%'. $q .'%" OR CL_NUMDOC LIKE "%' . $q .'%" OR CL_APENOM LIKE "%' . $q .'%"');//OR '.$datab.'.'.Clientes::tableName().'.CL_APENOM LIKE "%' . $q .'%'.$datab.'.'.Clientes::tableName().'CL_NUMDOC LIKE "%' . $q ."%'");
            $query->andWhere($datab.'.'.Libretas::tableName().'.LI_ANULADA = 0');
            $query->orderBy($datab.'.'.Libretas::tableName().'.LI_NRO');
            $command = $query->createCommand();
            
           
       /*
            var_dump($command);*/
            $data = $command->queryAll();
            $out = [];
            foreach ($data as $d) {
                $out[] = ['value' => $d['LI_NRO'].' - '.$d['CL_NUMDOC'].' - '.$d['CL_APENOM'], 'cod' => $d['LI_NRO']];
            }
            echo Json::encode($out);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

   //búsqueda de trámites de libretas por nuemero de dni
   
   public function actionQuery3($q = null) {
        try {

            $datab = Clientes::databaseName();

          $query = new Query;
            $query->select([Clientes::tableName().'.CL_NUMDOC', Clientes::tableName().'.CL_COD',  Clientes::tableName().'.CL_APENOM'] )
                //
                ->from($datab.'.'.Clientes::tableName())
                ->join(  'INNER JOIN',
                    $datab.'.'.Libretas::tableName(),
                    $datab.'.'.Clientes::tableName().'.CL_COD ='.$datab.'.'.Libretas::tableName().'.LI_COCLI')
                ->distinct()
                ; 
                //
            $query->where('CL_COD LIKE "%' . $q .'%" OR CL_NUMDOC LIKE "%' . $q .'%" OR CL_APENOM LIKE "%' . $q .'%"');
            $query->orderBy('CL_COD');
            $command = $query->createCommand();
            
           
       /*
            var_dump($command);*/
            $data = $command->queryAll();
            $out = [];
            foreach ($data as $d) { // 
                $out[] = ['value' => $d['CL_COD'].' - '.$d['CL_NUMDOC'].' - '.$d['CL_APENOM'], 'cod' => $d['CL_COD']];
            }
            echo Json::encode($out);

        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionBuscar_libreta() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            $p=Libretas::findOne(["LI_NRO" => $post["LI_NRO"]]);
            $fech = $p->LI_FECPED;
            $p->LI_FECPED = Yii::$app->formatter->asDate($fech, 'php:d-m-Y');
           /* $p->PA_DESC_ADEU = "error";
            */
           // $p->save(false);

           return \yii\helpers\Json::encode($p->attributes);
        }
    }

        /**
     * Displays a single Libretas model.
     * @param string $id
     * @return mixed
     */
 /*   public function actionEmision()
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
*/
    public function actionQrcode() {
    $vcard = new BookMark(['title' => 'nombre', 'url'  => 'http://localhost/www/intranet/modulos/documento_salud/web/index.php?r=libretas%2Fview&id=000000000252']);
    return QrCode::png($vcard->getText());
    // you could also use the following
    // return return QrCode::png($mailTo);
}


public function actionRegistraratenc() {
      
    $selection = (array)Yii::$app->request->post('selection');
    //var_dump($selection);
    if (count($selection)!=0) {
        try {
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();

                foreach($selection as $id){
                    $lib = Libretas::findOne($id);
                    if ($lib != null) {

                        $lib->LI_CONSULT = 1;
                        if ($lib->save(false)) {
                        
                            $pool = PoolLab::findOne($id);
                            if ($pool == null) {
                                $pool = new PoolLab();
                                $pool->PO_NROLIB = $id;
                            }
                            $pool->PO_FEC = date('Y-m-d');
                            $pool->PO_HORA =  date('H:i:s');
                            $pool->PO_MUESTRA = 0;
                            $pool->PO_LISTO = 0;
                            if( $pool->save(false)){
                               //  Yii::$app->getSession()->setFlash('exito', 'Atenciones registradas correctamente.');
                            }
                            else {
                                Yii::$app->getSession()->setFlash('error', 'No se pudo registrar  la atención para la libreta N° '.$id.'.');  
                        
                            }
             
                        
                        }
                        else {
                            Yii::$app->getSession()->setFlash('error', 'No se pudo registrar  la atención para la libreta N° '.$id.'.');  
                            
                        }

                    }
                    else {
                        Yii::$app->getSession()->setFlash('error', 'No se pudo registrar la atención para la libreta N° '.$id.'.');  
                        
                    }
                }

                $transaction->commit();

                Yii::$app->getSession()->setFlash('exito', 'Atenciones registradas correctamente.');

               // return "ok";

            }
                catch (ErrorException $e) {
                    $transaction->rollback();
                    echo($e->getMessage());

                }
            }
            else {
                //return "cero";
                Yii::$app->getSession()->setFlash('error', 'Debe selecionar alguna libreta para registrar su atención.');
            }
            return $this->redirect(['/libretas/registrar-consulta-medica']);

    
}

public function actionEstado(){

  $model = new Libretas();
 return $this->render('estado', [
            
            'model' => $model,
       ]);
}


public function actionBuscar_estado() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            $p = Libretas::find()
                    ->where(['LI_COCLI' => $post["CL_COD"]])
                    //->andWhere(['not', ['LI_FECVTO' => null]])
                    ->orderBy(['LI_FECPED' => SORT_DESC])
                    ->one();
         //   $p=Libretas::findOne(["LI_COCLI" => $post["CL_COD"]]);
            
            if ($p->LI_FECVTO!= null) {
              $fech = $p->LI_FECVTO;
              $p->LI_FECVTO = Yii::$app->formatter->asDate($fech, 'php:d-m-Y');
            }
           /* $p->PA_DESC_ADEU = "error";
            */
           // $p->save(false);

           return \yii\helpers\Json::encode($p->attributes);
        }
}

/**
     * Ver si existe determinada historia clinica
     * @param  [type] $hiscli [description]
     * @return [type]         [description]
     */
     public function actionVerestado($li_nro)
    {
        //$res = null;
        $resultado = Libretas::findOne(["LI_NRO" => $li_nro]);
        if ($resultado!= null){
          if ($resultado->LI_ANULADA){
            $res['cartel'] = "Trámite Documento laboral anulado";
            $res['clase'] = "label_venc_no"; 

          }
          else {
              $fechaLab = LibretasController::vencimiento($resultado->LI_FECVTO);
              $hoy = date('Y-m-d');

              $fechaLab=strtotime($fechaLab);
              $hoy=strtotime($hoy);

              $diastrasnc   = ($fechaLab-$hoy)/86400;
              $diastrasnc   = abs($diastrasnc); 
              $diastrasnc = floor($diastrasnc); 

              $res = array();

              if($fechaLab < $hoy){
                $res['cartel'] = "Documento laboral vencido ".$diastrasnc." días";
                $res['clase'] = "label_venc_no"; 
              }
              else{
                $res['cartel'] = "Documento laboral válido, ".$diastrasnc." días para su vencimiento";
                $res['clase'] = "label_venc_ok";  
              } 
            }
            $cliente = Clientes::findOne(["CL_COD" => $resultado->LI_COCLI]);
            if($cliente != null){
              $res['apenom'] = $cliente->CL_APENOM;  
            }            
          
        }
        else {
            $res = null;
        }
        echo Json::encode($res);
    }

    /**
     * Displays a single Libretas model.
     * @param string $id
     * @return mixed
     */
  /*  public function actionEditar($id)
    {
        
        $model = $this->findModel($id);
        $cliente = ClientesController::buscarCliente($model->LI_COCLI);
        return $this->render('editardocumento', [
            'model' => $model,
            'cliente' => $cliente,

        ]);
    }
    */

}