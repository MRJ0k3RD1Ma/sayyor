<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamplingCertificate */

$this->title = Yii::t('cp.food_sampling_certificate', 'Mahsulot ekspertizani qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.food_sampling_certificate', 'Mahsulot ekspertizalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-sampling-certificate-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
