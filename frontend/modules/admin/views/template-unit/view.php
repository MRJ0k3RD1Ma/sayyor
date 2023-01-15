<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateUnit */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shablon birliklari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="template-unit-view">

    <p>        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('app', 'Yangilash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Siz haqiqatdan ham buni o\'chirmoqchimisiz?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name_uz',
            'name_ru',
            [
                'attribute' => 'type_id',
                'value' => function (\common\models\TemplateUnit $model) {
                    return $model->type->name_uz;
                }
            ],
        ],
    ]) ?>

</div>
