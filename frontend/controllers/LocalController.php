<?php

namespace frontend\controllers;

use Yii;
use app\models\Local;
use frontend\models\LocalSearch;
use common\models\AccessHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * LocalController implements the CRUD actions for Local model.
 */
class LocalController extends Controller
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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return AccessHelpers::chequeo();
    }

    /**
     * Lists all Local models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Local model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Local model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Local();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->alquiler==0) {
                $model->monto_alquiler = 0;
                $model->porcentaje_alquiler = 0;
            }
            $model->save();

            $connection = \Yii::$app->db;
            $query = "SET ANSI_NULLS ON; SET ANSI_WARNINGS ON; SET NOCOUNT ON; EXEC ISCO_PROCESA_ALICUOTA";
            $connection->createCommand($query)->execute();
            
            return $this->redirect(['view', 'id' => $model->id_local]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'canon' => 0,
            ]);
        }
    }

    /**
     * Updates an existing Local model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $canon = $this->actionBuscaCanon($model->CodVend);

        if ($model->load(Yii::$app->request->post())) {
            $connection = \Yii::$app->db;

            $model->save();

            $connection = \Yii::$app->db;
            $query = "SET ANSI_NULLS ON; SET ANSI_WARNINGS ON; SET NOCOUNT ON; EXEC ISCO_PROCESA_ALICUOTA";
            $connection->createCommand($query)->execute();
            
            return $this->redirect(['view', 'id' => $model->id_local]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'canon' => $canon,
            ]);
        }
    }

    /**
     * Deletes an existing Local model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $query = "UPDATE ISCO_Local SET activo=0 WHERE id_local=".$id;
        $connection->createCommand($query)->query();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Local model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Local the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Local::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function actionBuscaCanon($CodVend) {
        $connection = \Yii::$app->db;
        $query = "SELECT top(1) canon FROM ISCO_Correl WHERE CodVend='".$CodVend."'";
        $rs = $connection->createCommand($query)->queryOne();

        if ($rs['canon']>0) {
            $canon = $rs['canon'];
        } else {
            $canon = 0;
        }

        return ($canon);
    }
}
