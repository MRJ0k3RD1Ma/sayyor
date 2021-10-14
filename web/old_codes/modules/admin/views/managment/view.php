<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Managment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Managments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="managment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'register_id',
            'complex_id',
            'minestory_id',
            'email:email',
            'phone',
            'telegram',
            'chat_id',
            'country_id',
            'region_id',
            'district_id',
            'director_id',
            'address',
            'created',
            'updated',
            'status',
            'isDelete',
            'setting:ntext',
        ],
    ]) ?>

</div>
