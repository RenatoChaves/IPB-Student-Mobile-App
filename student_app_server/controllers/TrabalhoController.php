<?php

namespace app\controllers;

use app\models\Trabalho;
use app\models\TrabalhoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrabalhoController implements the CRUD actions for Trabalho model.
 */
class TrabalhoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Trabalho models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrabalhoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trabalho model.
     * @param int $id_trabalho Id Trabalho
     * @param string $codigo_disciplina_fk Codigo Disciplina Fk
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_trabalho, $codigo_disciplina_fk)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_trabalho, $codigo_disciplina_fk),
        ]);
    }

    /**
     * Creates a new Trabalho model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Trabalho();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_trabalho' => $model->id_trabalho, 'codigo_disciplina_fk' => $model->codigo_disciplina_fk]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trabalho model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_trabalho Id Trabalho
     * @param string $codigo_disciplina_fk Codigo Disciplina Fk
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_trabalho, $codigo_disciplina_fk)
    {
        $model = $this->findModel($id_trabalho, $codigo_disciplina_fk);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_trabalho' => $model->id_trabalho, 'codigo_disciplina_fk' => $model->codigo_disciplina_fk]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trabalho model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_trabalho Id Trabalho
     * @param string $codigo_disciplina_fk Codigo Disciplina Fk
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_trabalho, $codigo_disciplina_fk)
    {
        $this->findModel($id_trabalho, $codigo_disciplina_fk)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trabalho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_trabalho Id Trabalho
     * @param string $codigo_disciplina_fk Codigo Disciplina Fk
     * @return Trabalho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_trabalho, $codigo_disciplina_fk)
    {
        if (($model = Trabalho::findOne(['id_trabalho' => $id_trabalho, 'codigo_disciplina_fk' => $codigo_disciplina_fk])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
