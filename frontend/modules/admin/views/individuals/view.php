<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Individuals */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.individuals', 'Jismoiy shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="individuals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('cp.individuals', 'O\'zgartirish'), ['update', 'pnfl' => $model->pnfl], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.individuals', 'O\'chirish'), ['delete', 'pnfl' => $model->pnfl], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.individuals', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pnfl',
            'name',
            'surname',
            'middlename',
            'soato_id',
            'adress',
            'passport',
        ],
    ]) ?>

</div>
