<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sertificates */

$this->title = $model->sert_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Sertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.sertificates', 'Update'), ['update', 'sert_id' => $model->sert_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.sertificates', 'Delete'), ['delete', 'sert_id' => $model->sert_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.sertificates', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sert_id',
            'sert_num',
            'sert_date',
            'organization_id',
            'pnfl',
            'owner_name',
            'vet_site_id',
            'operator',
        ],
    ]) ?>

</div>
