<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Complex */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплекслар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-view">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Янгилаш', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Шчириш', ['delete', 'id' => $model->id], [
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
//            'register_id',
//            'director_id',
            [
                'attribute'=>'register_id',
                'value'=>function($d){
                    return $d->register->name;
                }
            ],
            [
                'attribute'=>'director_id',
                'value'=>function($d){
                    return $d->director->name;
                }
            ],
            'phone',
            'telegram',
            'chat_id',
            'email:email',
            'fax',
            'created',
            'updated',
            'status',
            'isDelete',
            'setting:ntext',
        ],
    ]) ?>

</div>
