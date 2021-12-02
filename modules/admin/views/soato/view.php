<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Soato */

$this->title = $model->MHOBT_cod;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Soatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="soato-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Update'), ['update', 'MHOBT_cod' => $model->MHOBT_cod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp', 'Delete'), ['delete', 'MHOBT_cod' => $model->MHOBT_cod], [
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
            'MHOBT_cod',
            'res_id',
            'region_id',
            'district_id',
            'qfi_id',
            'name_lot',
            'center_lot',
            'name_cyr',
            'center_cyr',
            'name_ru',
            'center_ru',
        ],
    ]) ?>

</div>
