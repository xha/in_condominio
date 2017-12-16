<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Ccomercial;
use frontend\models\CcomercialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CcomercialController implements the CRUD actions for Ccomercial model.
 */
class CcomercialController extends Controller
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
     * Lists all Ccomercial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CcomercialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ccomercial model.
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
     * Creates a new Ccomercial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ccomercial();

        if ($model->load(Yii::$app->request->post())) {
            $model->ID3=$model->CodVend;
            if ($model->validate()) {
                $connection = \Yii::$app->db;
                $query = "SELECT count(*) as conteo FROM SAVEND WHERE CodVend='".$model->CodVend."'";
                $conteo = $connection->createCommand($query)->queryOne();
                /******************************************* GUARDO ************************************************/
                if ($conteo['conteo']==0) {
                    $model->save();
                    
                    return $this->redirect(['view', 'id' => $model->CodVend]);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ccomercial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->ID3=$model->CodVend;
            $model->save();
            return $this->redirect(['view', 'id' => $model->CodVend]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ccomercial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $query = "UPDATE SAVEND SET Activo=0 WHERE CodVend='".$id."'";
        $connection->createCommand($query)->query();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ccomercial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Ccomercial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ccomercial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
