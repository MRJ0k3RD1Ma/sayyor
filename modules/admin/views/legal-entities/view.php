<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LegalEntities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.legal_entities', 'Yuridik shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="legal-entities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.legal_entities', 'O\'zgartirish'), ['update', 'inn' => $model->inn], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.legal_entities', 'O\'chirish'), ['delete', 'inn' => $model->inn], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.legal_entities', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inn',
            'name',
            'tshx',
            'soogu',
            'soato',
            'status_id',
        ],
    ]) ?>

</div>
