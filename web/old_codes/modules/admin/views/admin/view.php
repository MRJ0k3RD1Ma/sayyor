<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

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
//            'id',
            'name',
//            'share',
            'username',

            [
                'attribute'=>'share',
                'value'=>function($d){
                    $s = [
                        0=>'Администратор',
                        1=>'Супер Администратор'
                    ];
                    return $s[$d->share];
                },
                'filter'=> [
                    0=>'Администратор',
                    1=>'Супер Администратор'
                ]
            ],
            // 'password',
            'pin_code',
            // 'chat_id',
            'phone',
            'telegram',
            'email:email',
            'created',
            // 'updated',
            'status',
            // 'isDelete',
            // 'setting:ntext',
            'chat_id',
            'created',
            'updated',
            'status',
            'setting:ntext',
        ],
    ]) ?>

</div>
