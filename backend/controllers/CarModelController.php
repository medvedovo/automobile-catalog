<?php

namespace backend\controllers;

use Yii;
use backend\models\CarModel;
use backend\models\CarModelSearch;
use common\models\CarPicture;
use yii\base\Security;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarModelController implements the CRUD actions for CarModel model.
 */
class CarModelController extends Controller
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
     * Lists all CarModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarModel model.
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
     * Creates a new CarModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CarModel();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = time();
            $model->updated_at = time();
            $model->save();

            $model->files = UploadedFile::getInstances($model, 'files');
            if (count($model->files) > 0) {
                foreach ($model->files as $file) {
                    $fileUrl = '/common/uploads/pictures/' . 'car_model-' . time() . '-' . substr(md5(rand()), 0, 7) . '.' . $file->extension;
                    $file->saveAs('../..' . $fileUrl);

                    $carPicture = new CarPicture();
                    $carPicture->car_picture_url = $fileUrl;
                    $carPicture->car_model_id = $model->id;
                    $carPicture->created_at = time();
                    $carPicture->updated_at = time();
                    $carPicture->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CarModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->files = UploadedFile::getInstances($model, 'files');
            if (count($model->files) > 0) {
                foreach ($model->files as $file) {
                    $fileUrl = '/common/uploads/pictures/' . 'car_model-' . time() . '-' . substr(md5(rand()), 0, 7) . '.' . $file->extension;
                    $file->saveAs('../..' . $fileUrl);

                    $carPicture = new CarPicture();
                    $carPicture->car_picture_url = $fileUrl;
                    $carPicture->car_model_id = $model->id;
                    $carPicture->created_at = time();
                    $carPicture->updated_at = time();
                    $carPicture->save();
                }
            }

            $model->updated_at = time();
            $model->files = null;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CarModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CarModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CarModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
