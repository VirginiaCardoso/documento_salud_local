<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\DiasNoLaborables;
use documento_salud\models\DiasNoLaborablesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiasNoLaborablesController implements the CRUD actions for DiasNoLaborables model.
 */
class DiasNoLaborablesController extends Controller
{
    public $CodController = '005'; 
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
     * Lists all DiasNoLaborables models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiasNoLaborablesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DiasNoLaborables model.
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
     * Creates a new DiasNoLaborables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DiasNoLaborables();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DI_FEC]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DiasNoLaborables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DI_FEC]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DiasNoLaborables model.
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
     * Finds the DiasNoLaborables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DiasNoLaborables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DiasNoLaborables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function esDiaLaborable($fecha){

        if (($model = DiasNoLaborables::findOne($fecha)) == null) {

            $dia= date ('w', strtotime ($fecha));

            if ((strcmp($dia, '0') == 0) || (strcmp($dia, '6') == 0))
                return false;
            else

                return true;
        } else {
            return false;
        }   
    }

    public function proximoLaborable($fechano){

        $encontro = false;
        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fechano ) ) ;

        while($encontro==false){
            
            $dia= date ('w', $nuevafecha);

            $nuevafecha = date ('Y-m-j' , $nuevafecha );

            if (((DiasNoLaborables::findOne($nuevafecha)) == null) && (strcmp($dia, '0') !== 0) && (strcmp($dia, '6') !== 0)){
                $encontro = true;
            }
            else {
                $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
            }

        }
        return $nuevafecha;

    }
}
