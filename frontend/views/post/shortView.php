<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 04.10.15
 * Time: 23:52
 */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-8 post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($dataProvider->models as $model) {
        echo $this->render('shortView', [
            'model' => $model
        ]);
    }
    ?>

</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <h1>Категории</h1>
</div>