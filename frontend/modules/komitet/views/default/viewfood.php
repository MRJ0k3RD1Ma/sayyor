<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamplingCertificate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.food_sampling_certificate', 'Food Sampling Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-sampling-certificate-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'food_id',
            'inn',
            'pnfl',
            'sampling_site',
            'sampling_adress',
            'sampler_person_pnfl',
            'sampler_person_inn',
            'verification_pupose_id',
            'sampling_date',
            'send_sample_date',
            'based_public_information',
            'message_number',
            'created',
            'updated',
        ],
    ]) ?>

</div>
