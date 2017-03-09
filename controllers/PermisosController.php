<?php

namespace documento_salud\controllers;

use Yii;
use documento_salud\models\Legajo;
use documento_salud\models\GrupoIntranet;
use documento_salud\models\PermisoIntranet;
use documento_salud\models\PermisoPorGrupo;
use documento_salud\models\AmpliacionPermisoIntranet;
use documento_salud\models\RestriccionPermisoIntranet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class PermisosController extends Controller
{
    public $CodController = '014';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
       /* return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        // acciones publicos para las cuales definimos permisos en las tablas
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['administrar-usuarios', 'permisos-grupos', 'restricciones', 'permisos-extra'],
                        'matchCallback' => 
                            function ($rule, $action) {
                                return Yii::$app->user->identity->habilitado($action);
                            }
                    ],
                    // Estos son todos las acciones secundarias
                    [
                        // acciones via ajax
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => [ 'get-grupo-usuario', 'get-permisos-por-grupo', 'get-permisos-no-asignados-por-grupo',
                        ]
                    ]
                ]
            ]
        ];*/
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionPermisosGrupos()
    {
        if (isset($_POST['asignados']) && isset($_POST['grupo']))
        {
            $idGrupo = $_POST['grupo'];
            $grupo = GrupoIntranet::findOne($idGrupo);
            $permisosAnteriores = ArrayHelper::getColumn($grupo->getPermisosGrupo()->asArray()->all(), 'privilegio');
            $permisosNuevos = (array) $_POST['asignados'];

            $insertar = array_diff($permisosNuevos, $permisosAnteriores);
            $eliminar = array_diff($permisosAnteriores, $permisosNuevos);

            $dbTrans = \Yii::$app->dbdocsl->beginTransaction();
            $validateOK = true;
            // Inserción de permisos
            foreach ($insertar as $privilegio) {
                $permisoNuevo = new PermisoPorGrupo();
                $permisoNuevo->id_grupo = $idGrupo;
                $permisoNuevo->privilegio = $privilegio;
                $validateOK = $validateOK && $permisoNuevo->save();
            }

            // Borrado de permisos
            foreach ($eliminar as $privilegio) {
                PermisoPorGrupo::deleteAll(['id_grupo' => $idGrupo, 'privilegio' => $privilegio]);
            }

            if ($validateOK)
            {
                $dbTrans->commit();
                Yii::$app->session->setFlash('success', 'Los cambios han sido guardados.');
            }
            else
            {
                $dbTrans->rollback();
                Yii::$app->session->setFlash('error', 'Error al guardar los datos.');
            }

            return $this->render('permisos-grupos');
        }
        else
        {
            return $this->render('permisos-grupos');
        }
    }

    public function actionAdministrarUsuarios()
    {
        return $this->render('permisos-usuarios');
    }

    public function actionRestricciones()
    {
        return $this->render('restricciones', [
            
        ]);
    }

    public function actionPermisosExtra()
    {
        return $this->render('permisos-extra', [
            
        ]);
    }

    public function actionGetPermisosPorGrupo($id)
    {
        $grupo = GrupoIntranet::findOne($id);
        $permisos = $grupo->permisosGrupo;
        
        $out = [];
        foreach ($permisos as $d) {
            $out[] = ['value' => $d->privilegio, 'option' => $d->detalle ? $d->detalle->descri : $d->privilegio];
        }
        return Json::encode($out);
    }

    public function actionGetPermisosNoAsignadosPorGrupo($id)
    {
        $grupo = GrupoIntranet::findOne($id);
        $permisos = $grupo->permisosRestantes;
        
        $out = [];
        foreach ($permisos as $d) {
            $out[] = ['value' => $d->cod, 'option' => $d->descri ? $d->descri : $d->cod];
        }
        return Json::encode($out);
    }

    public function actionGetGrupoUsuario($id)
    {
        $legajo = Legajo::findOne($id);
        return Json::encode($legajo->grupoIntranet);
    }
}
