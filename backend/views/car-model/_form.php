<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Brand;
use common\models\BodyType;

/* @var $this yii\web\View */
/* @var $model common\models\CarModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-model-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'body_type_id')->dropDownList(ArrayHelper::map(BodyType::find()->all(), 'id', 'name')) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map(Brand::find()->all(), 'id', 'name')) ?>

    <?php if (count($pictures) > 0): ?>
    <div class="row">
        <?php foreach($pictures as $picture): ?>
        <div class="col-md-2">
            <div class="thumbnail">
                <img src=<?php echo $picture->car_picture_url ?> alt="" />
                <div class="caption">
                    <a href=<?php echo Url::to(['car-model/delete-picture']) ?> class="btn btn-danger m-delete-picture" data-picture-id=<?php echo $picture->id ?>>Remove</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <? endif ?>
    
    <?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
