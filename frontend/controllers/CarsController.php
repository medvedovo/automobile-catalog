<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Brand;
use common\models\CarModel;
use common\models\BodyType;
use common\models\CarPicture;
use common\models\BuyingRequest;
use frontend\models\RequestForm;

class CarsController extends Controller
{
    public function actionBrands()
    {
        $brands = Brand::find()->all();
        return $this->render('brands', [
            'model' => $brands,
        ]);
    }

    public function actionModels($id = 0)
    {
        if ($id == 0) {
            return $this->goBack();
        }

        $brand = Brand::findOne(['id' => $id]);
        $models = CarModel::find()->where(['brand_id' => $id])->orderBy('name')->all();
        return $this->render('models', [
            'brand' => $brand,
            'models' => $models,
        ]);
    }

    public function actionDetails($id = 0, $requested = false)
    {
        if ($id == 0) {
            return $this->goBack();
        }

        $model = CarModel::findOne(['id' => $id]);

        if($model == NULL) {
            return $this->goBack();
        }

        $brand = Brand::findOne(['id' => $model->brand_id]);
        $bodyType = BodyType::findOne(['id' => $model->body_type_id]);
        $carPictures = CarPicture::find()->where(['car_model_id' => $model->id])->all();

        $request = new RequestForm();
        $request->brand_id = $brand->id;
        $request->car_model_id = $model->id;
        
        return $this->render('details', [
            'model' => $model,
            'brand' => $brand,
            'body_type' => $bodyType,
            'pictures' => $carPictures,
            'request' => $request,
            'requested' => $requested
        ]);
    }

    public function actionRequest()
    {
        $model = new RequestForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($request = $model->request()) {
                return $this->redirect(['cars/details', 'id' => $model->car_model_id, 'requested' => true]);
            }
        } else {
            return $this->goHome();
        }
    }
}
