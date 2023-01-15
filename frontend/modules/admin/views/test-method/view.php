<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TestMethod */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.test_method', 'Tahlil usullari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="test-method-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('cp.test_method', 'O\'zgartirish'), ['update', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.test_method', 'O\'chirish'), ['delete', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.test_method', 'Are you sure you want to delete this item?'),
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
            'state',
        ],
    ]) ?>

</div>
