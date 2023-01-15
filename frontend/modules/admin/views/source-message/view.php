<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Source Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="source-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
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
            'category',
            'message:ntext',
        ],
    ]) ?>

</div>
