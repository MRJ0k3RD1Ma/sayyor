<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AnimalCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Hayvon toifalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="animal-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'code',
            'name_uz',
            'name_ru',
        ],
    ]) ?>

</div>
