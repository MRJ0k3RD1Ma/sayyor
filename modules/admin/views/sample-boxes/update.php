<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SampleBoxes */

$this->title = Yii::t('cp.sample_boxes', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sample_boxes', 'Namuna o\'ramlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]];
$this->params['breadcrumbs'][] = Yii::t('cp.sample_boxes', 'O\'zgartirish');
?>
<div class="sample-boxes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
