<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyingRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buying Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buying-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'brand',
                'value' => 'brand.name',
            ],
            [
                'attribute' => 'carModel',
                'value' => 'carModel.name',
            ],
            'name',
            'phone',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
