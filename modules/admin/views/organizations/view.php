<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Tashkilorlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organizations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_from_api',
            'TIN',
            'NA1_CODE',
            'NS10_CODE',
            'NS11_CODE',
            'NAME_FULL',
            'ADDRESS',
            'REG_DATE',
            'DATE_TIN',
            'REG_NUM',
            'NS13_CODE',
            'TELEFON',
            'TELEX',
            'FAX',
            'GD_FULL_NAME',
            'GD_TIN',
            'GD_TEL_WORK',
            'GD_TEL_HOME:boolean',
            'GD_EMAIL:email',
            'GB_FULL_NAME',
            'GB_TIN',
            'GB_TEL_WORK',
            'GB_TEL_HOME',
            'OKED',
            'OKPO',
            'OKONX',
            'soato',
            'EMAIL:email',
            'DATE_END',
            'CREATED',
            'CHANGED',
            'GD_MOBILE',
            'BUDJET:boolean',
        ],
    ]) ?>

</div>
