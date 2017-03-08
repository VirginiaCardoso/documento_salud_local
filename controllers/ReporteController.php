<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\CajaDiariaFiltro;
use documento_salud\models\ResumenMensual;
use documento_salud\models\ResumenRecaudacion;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * ReportesController implements the CRUD actions for Eventos model.
 */
class ReporteController extends Controller
{
      public $CodController="008";
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
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionCajadiaria()
    {
        $searchModel = new CajaDiariaFiltro();
       
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if  ($searchModel->load(Yii::$app->request->get())){
            $filtro = false;
        }else{
            $filtro = true;
        }
      

        return $this->render('cajadiaria', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filtro' => $filtro,

        ]);
    }

        /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionResumenmensual()
    {
        $searchModel = new ResumenMensual();
       
      //  $resultados = $searchModel->search(Yii::$app->request->queryParams);
      //  $dataProvider = $resultados['dataProvider'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if  ($searchModel->load(Yii::$app->request->get())){
            $filtro = false;
        }else{
            $filtro = true;
        }
      

        return $this->render('resumenmensual', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         //   'dataProvider2' => $dataProvider2,
            'filtro' => $filtro,
         /*   'cantConv' => $resultados['cantConv'],
            'cantPart' => $resultados['cantPart'],
            'recauConv' => $resultados['recauConv'],
            'recauPart' => $resultados['recauPart'],
            'recauTot' => $resultados['recauTot'],*/

        ]);
    }

            /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionResumenrecaudacion()
    {
        $searchModel = new ResumenRecaudacion();
       
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $searchModel->desde =date ( 'd-m-Y' , strtotime ( '-1 month' , strtotime ( date('d-m-Y') ) ) );//'2016-08-11';
        $searchModel->hasta = date('d-m-Y');// '2016-08-24';

        
        if  ($searchModel->load(Yii::$app->request->get())){
            $filtro = false;
        }else{
            $filtro = true;
        }
        

        $nuevas_part = $searchModel->calcularValores(05);
        $nuevas_conv = $searchModel->calcularValores(01);
        $nuevas_anul = $searchModel->calcularAnuladasNuevas();
        $renov_part = $searchModel->calcularValores(06);
        $renov_conv = $searchModel->calcularValores(02);
        $renov_anul = $searchModel->calcularAnuladasRenov();  
        $vencidas_part = $searchModel->calcularValores(07);
        $vencidas_conv = $searchModel->calcularValores(03);
        $vencidas_anul = $searchModel->calcularAnuladasVencidas();       

        return $this->render('resumenrecaudacion', [
            'searchModel' => $searchModel,
            'filtro' => $filtro,
            'nuevas_part' => $nuevas_part,
            'nuevas_conv' => $nuevas_conv,
            'nuevas_anul'=> $nuevas_anul,
            'renov_part' => $renov_part,
            'renov_conv' => $renov_conv,
            'renov_anul'=> $renov_anul,
            'vencidas_part' => $vencidas_part,
            'vencidas_conv' => $vencidas_conv,
            'vencidas_anul'=> $vencidas_anul,

        ]);

    }

    
    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventos the loaded model
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


    public function actionReportcajadiaria($nombre) {
        $time = strtotime($nombre);

       $nomb = date('Y-m-d',$time);
    $filename = $nomb.".pdf";
  //  $filepath = Yii::$app->params['local_path']['path_documento_salud']
    $filepath = Yii::$app->params['path_documento_salud'].'/caja_diaria/'.$filename;
      if(file_exists($filepath))
      {
          // Set up PDF headers
          header('Content-type: application/pdf');
          header('Content-Disposition: inline; filename="' . $filename . '"');
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: ' . filesize($filepath));
          header('Accept-Ranges: bytes');

          // Render the file
         readfile($filepath);
      }
      else
      {
         // PDF doesn't exist so throw an error or something
        print_r("No existe el archivo PDF.");
      }
    }


    public function actionImprimircajadiaria($nombre) {

      $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        try {
          $this->generarPdfCajaDiaria($nombre);  
          $transaction->commit();
          
          return \yii\helpers\Json::encode( $model->errors );

        }
        catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    
            return \yii\helpers\Json::encode( $e->getMessage());
        }
      
    }

     private function generarPdfCajaDiaria($nomb){
      header('Content-Type: application/pdf');
      //----------------------------------------------------
      $searchModel = new CajaDiariaFiltro();

      $time = strtotime($nomb);
       $searchModel->dia = date('Y-m-d',$time);
       $dataProvider = $searchModel->buscarFecha(date('Y-m-d',$time));

        $content =  $this->renderPartial('cajadiariaimprimir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    $filename = $nomb.".pdf";
    $filepath = Yii::$app->params['path_documento_salud'].'/caja_diaria/';

      if (!file_exists($filepath)) {
          mkdir($filepath, 0777, true);
      }

      $nombre = $filepath."/".$filename;

      $pdf = new Pdf([
          'mode' => Pdf::MODE_UTF8,
          'format' => Pdf::FORMAT_A4, 
          'orientation' => Pdf::ORIENT_PORTRAIT, 
          'filename' => $nombre,
          'destination' => Pdf::DEST_FILE, 
          'content' => $content,
          'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
          'cssInline' => ' .kv-grid-table tr th {font-size:10px}, .kv-grid-table tr td {font-size:11px}', 
          'options' => ['title' => 'Documento Salud Laboral'],
      ]);//.kv-grid-table  thead tr th
      
     return $pdf->render();

    }

    public function actionReportmensual($nombre) {
     
    $filename = $nombre.".pdf";

  //  $filepath = Yii::$app->params['local_path']['path_documento_salud']
    $filepath = Yii::$app->params['path_documento_salud'].'/resumen_mensual/'.$filename;

    var_dump($filename);
      if(file_exists($filepath))
      {
          // Set up PDF headers
          header('Content-type: application/pdf');
          header('Content-Disposition: inline; filename="' . $filename . '"');
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: ' . filesize($filepath));
          header('Accept-Ranges: bytes');

          // Render the file
         readfile($filepath);
      }
      else
      {
         // PDF doesn't exist so throw an error or something
        print_r("No existe el archivo PDF.");
      }
    }


    public function actionImprimirreportemensual($mes,$anio) {

      $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        try {

          $this->generarPdfReporteMensual($mes,$anio);  
          $transaction->commit();
          
          return \yii\helpers\Json::encode( $model->errors );

        }
        catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    
            return \yii\helpers\Json::encode( $e->getMessage());
        }
      
    }

     private function generarPdfReporteMensual($mes,$anio){
      header('Content-Type: application/pdf');
      //----------------------------------------------------
      $searchModel = new ResumenMensual();
      //var_dump($nomb);
      $nomb = $anio."_".$mes;
     // $time = strtotime($nomb);
      
       $searchModel->mes = $anio."/".$mes."/01";//date('Y-m-d',$time);
       $dataProvider = $searchModel->buscarMes($mes,$anio);

        $content =  $this->renderPartial('resumenmensualimprimir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    $filename = $nomb.".pdf";
    $filepath = Yii::$app->params['path_documento_salud'].'/resumen_mensual/';

      if (!file_exists($filepath)) {
          mkdir($filepath, 0777, true);
      }

      $nombre = $filepath."/".$filename;

      $pdf = new Pdf([
          'mode' => Pdf::MODE_UTF8,
          'format' => Pdf::FORMAT_A4, 
          'orientation' => Pdf::ORIENT_PORTRAIT, 
          'filename' => $nombre,
          'destination' => Pdf::DEST_FILE, 
          'content' => $content,
          'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
          'cssInline' => ' .kv-grid-table tr th {font-size:10px}, .kv-grid-table tr td {font-size:11px}', 
          'options' => ['title' => 'Documento Salud Laboral'],
      ]);//.kv-grid-table  thead tr th
      
     return $pdf->render();

    }

    public function actionReportrecaudacion($nombre) {
     
    $filename = $nombre.".pdf";

  //  $filepath = Yii::$app->params['local_path']['path_documento_salud']
    $filepath = Yii::$app->params['path_documento_salud'].'/resumen_recaudacion/'.$filename;

  //  var_dump($filename);
      if(file_exists($filepath))
      {
          // Set up PDF headers
          header('Content-type: application/pdf');
          header('Content-Disposition: inline; filename="' . $filename . '"');
          header('Content-Transfer-Encoding: binary');
          header('Content-Length: ' . filesize($filepath));
          header('Accept-Ranges: bytes');

          // Render the file
         readfile($filepath);
      }
      else
      {
         // PDF doesn't exist so throw an error or something
        print_r("No existe el archivo PDF.");
      }
    }


    public function actionImprimirreporterecaudacion($desde,$hasta) {

      $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        try {

          $this->generarPdfReporteRecaudacion($desde,$hasta);  
          $transaction->commit();
          
          return \yii\helpers\Json::encode( $model->errors );

        }
        catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    
            return \yii\helpers\Json::encode( $e->getMessage());
        }
      
    }

     private function generarPdfReporteRecaudacion($desde,$hasta){
      header('Content-Type: application/pdf');
      //----------------------------------------------------
     
      //var_dump($nomb);
      $nomb = $desde."_".$hasta;
     // $time = strtotime($nomb);
      
        $searchModel = new ResumenRecaudacion();
       
        $searchModel->desde =$desde;//'2016-08-11';
        $searchModel->hasta = $hasta;// '2016-08-24';
      
        $nuevas_part = $searchModel->calcularValores(05);
        $nuevas_conv = $searchModel->calcularValores(01);
        $nuevas_anul = $searchModel->calcularAnuladasNuevas();
        $renov_part = $searchModel->calcularValores(06);
        $renov_conv = $searchModel->calcularValores(02);
        $renov_anul = $searchModel->calcularAnuladasRenov();  
        $vencidas_part = $searchModel->calcularValores(07);
        $vencidas_conv = $searchModel->calcularValores(03);
        $vencidas_anul = $searchModel->calcularAnuladasVencidas();       
 
         $content =  $this->renderPartial('resumenrecaudacionimprimir', [
            'searchModel' => $searchModel,
            'nuevas_part' => $nuevas_part,
            'nuevas_conv' => $nuevas_conv,
            'nuevas_anul'=> $nuevas_anul,
            'renov_part' => $renov_part,
            'renov_conv' => $renov_conv,
            'renov_anul'=> $renov_anul,
            'vencidas_part' => $vencidas_part,
            'vencidas_conv' => $vencidas_conv,
            'vencidas_anul'=> $vencidas_anul,

        ]);

    $filename = $nomb.".pdf";
   
    $filepath = Yii::$app->params['path_documento_salud'].'/resumen_recaudacion/';

      if (!file_exists($filepath)) {
          mkdir($filepath, 0777, true);
      }

      $nombre = $filepath."/".$filename;

      $pdf = new Pdf([
          'mode' => Pdf::MODE_UTF8,
          'format' => Pdf::FORMAT_A4, 
          'orientation' => Pdf::ORIENT_PORTRAIT, 
          'filename' => $nombre,
          'destination' => Pdf::DEST_FILE, 
          'content' => $content,
          'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
          'cssInline' => ' .kv-grid-table tr th {font-size:10px}, .kv-grid-table tr td {font-size:11px}, .table-borde2 tr td {
    border: 0px  #f9f9f9;
}', 
          'options' => ['title' => 'Documento Salud Laboral'],
      ]);//.kv-grid-table  thead tr th
      
     return $pdf->render();

    }


}
