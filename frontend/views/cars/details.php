<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = $brand->name . ' ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['cars/models', 'id' => $brand->id]];
    $this->params['breadcrumbs'][] = $model->name;
?>
<?php if($requested): ?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Ваша заявка отправлена.
</div>
<?php endif ?>
<div class="row">
    <?php if(count($pictures) > 0): ?>
    <div class="col-md-5 car-pictures">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php foreach($pictures as $key => $picture): ?>
                <div class="item <?php echo $key == 0 ? 'active': '' ?>">
                    <img src=<?php echo $picture->car_picture_url ?> alt="" />
                </div>
                <?php endforeach; ?>
            </div>

            <?php if(count($pictures) > 1): ?>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Предыдущая</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Следующая</span>
            </a>
            <?php endif ?>
        </div>
    </div>
    <?php endif ?>
    <div class="col-md-7">
        <h2><?php echo $brand->name . ' ' . $model->name ?></h2>
        <h4><?php echo $body_type->name ?></h4>
        <p><?php echo $model->description ?></p>
    </div>
</div>
<div class="row" style="margin-top:30px">
    <div class="col-md-12">
    <?php $form = ActiveForm::begin(['action' =>['cars/request'], 'id' => 'form-request', 'method' => 'post']); ?>
        <?= $form->field($request, 'name') ?>
        <?= $form->field($request, 'phone') ?>
        <?= $form->field($request, 'brand_id')->hiddenInput()->label(false) ?>
        <?= $form->field($request, 'car_model_id')->hiddenInput()->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-block btn-primary', 'name' => 'submit-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>