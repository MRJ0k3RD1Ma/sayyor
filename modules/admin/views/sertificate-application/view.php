<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SertificateApplication */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificate_application', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificate-application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.sertificate_application', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.sertificate_application', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.sertificate_application', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'pnfl',
            'inn',
            'fsc_id',
            'vet_site_id',
            'labaratory_test_type_id',
            'emergency_check',
            'cat_id',
            'phone',
            'name',
            'check_date',
            'status',
        ],
    ]) ?>

</div>
