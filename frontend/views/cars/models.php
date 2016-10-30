<?php
    use yii\helpers\Url;

    $this->title = $brand->name;
    $this->params['breadcrumbs'][] = $this->title;
?>

<?php if(count($models) == 0): ?>
<p>Нет моделей для выбранного бренда.</p>
<?php else: ?>
<h2 class="text-center">Выберите модель</h2>
<div class="list-group">
    <?php foreach($models as $model): ?>
    <a href=<?php echo Url::to(['cars/details', 'id' => $model->id]) ?> class="list-group-item"><?php echo $model->name ?></a>
    <?php endforeach; ?>
</div>
<?php endif ?>
