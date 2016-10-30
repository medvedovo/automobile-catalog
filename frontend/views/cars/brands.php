<?php
    use yii\helpers\Url;

    $this->title = 'Бренды';
    $this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="text-center">Выберите бренд</h2>
<?php foreach($model as $brand): ?>
<div class="col-md-2">
    <a title=<?php echo $brand->name; ?> class="brand-link" href=<?php echo Url::to(['cars/models', 'id' => $brand->id]) ?>><img src=<?php echo $brand->logo_url; ?> alt=<?php echo $brand->name; ?> /></a>
</div>
<?php endforeach; ?>
