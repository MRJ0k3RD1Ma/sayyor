<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Goverments $model */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => 'Bo`limlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="goverments-view">

    <p>
        <?= Html::a('O`zgartirish', ['update', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O`chirish', ['delete', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru], [
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
            'name_uz',
            'name_ru',
            'code',
        ],
    ]) ?>

</div>
