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
    public function actionCreate()
    {
        $model = new Doclab();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->DO_NRO]);
            } else {
                return $this->render('editardocumento', [
                    'model' => $model,
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
    public function actionEditar($id)
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
            $model->save(false);

        }

       $docaux = Doclabau::findOne($id);
        if ( $docaux==null){
            $docaux = new Doclabau();
            $docaux->DO_CODLIB = $id;
            $docaux->save(false);
        }

        if ($model->load(Yii::$app->request->post())) {
                 if($model->save(false)){
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

}
