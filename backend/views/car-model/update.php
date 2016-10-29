<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CarModel */

$this->title = 'Update Car Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
