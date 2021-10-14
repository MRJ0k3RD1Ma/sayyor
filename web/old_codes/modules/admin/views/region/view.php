<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вилоятлар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-view">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Янгилаш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'country_id',
            'setting:ntext',
        ],
    ]) ?>
        </div>
    </div>
</div>
