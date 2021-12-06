<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FoodSamplingCertificate */

$this->title = Yii::t('cp.food_sampling_certificate', 'O\'zgartirish: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.food_sampling_certificate', 'Mahsulot ekspertizalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.food_sampling_certificate', 'O\'zgartirish');
?>
<div class="food-sampling-certificate-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
