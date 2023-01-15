<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamplingCertificate */

$this->title = Yii::t('cp.food_sampling_certificate', 'Update Food Sampling Certificate: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.food_sampling_certificate', 'Food Sampling Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.food_sampling_certificate', 'O`zgartirish');
?>
<div class="food-sampling-certificate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
