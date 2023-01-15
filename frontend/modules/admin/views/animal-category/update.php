<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AnimalCategory */

$this->title = Yii::t('cp', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Hayvon toifalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp', 'O\'zgartirish');
?>
<div class="animal-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
