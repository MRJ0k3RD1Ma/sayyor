<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TestMethod */

$this->title = Yii::t('cp.test_method', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.test_method', 'Tahlil usullari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]];
$this->params['breadcrumbs'][] = Yii::t('cp.test_method', 'O\'zgartirish');
?>
<div class="test-method-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
