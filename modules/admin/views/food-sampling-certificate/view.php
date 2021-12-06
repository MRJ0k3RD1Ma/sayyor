<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FoodSamplingCertificate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.food_sampling_certificate', 'Food Sampling Certificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-sampling-certificate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.food_sampling_certificate', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.food_sampling_certificate', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.food_sampling_certificate', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kod',
            'pnfl',
            'organization_id',
            'sampling_site',
            'sampling_adress',
            'sampler_organization_code',
            'sampler_person_pnfl',
            'unit_id',
            'count',
            'verification_sample',
            'producer',
            'serial_num',
            'manufacture_date',
            'sell_by',
            'coments',
            'verification_pupose_id',
            'sample_box_id',
            'sample_condition_id',
            'sampling_date',
            'send_sample_date',
            'explanations',
            'based_public_information',
            'message_number',
            'laboratory_test_type_id',
        ],
    ]) ?>

</div>
