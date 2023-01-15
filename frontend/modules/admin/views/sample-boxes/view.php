<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SampleBoxes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sample_boxes', 'Namuna o\'ramlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sample-boxes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('cp.sample_boxes', 'O\'zgartirish'), ['update', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.sample_boxes', 'O\'chirish'), ['delete', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.sample_boxes', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',

        ],
    ]) ?>

</div>
