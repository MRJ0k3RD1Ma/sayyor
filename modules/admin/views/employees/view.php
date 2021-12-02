<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Foydalanuvchilar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?= Html::a(Yii::t('cp', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('cp', 'O\'chirish'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('cp', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <?php if(Yii::$app->security->validatePassword("admin",$model->password)) echo 'ok'; else echo 'nooo'?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'email:email',
                        'phone',
                        'password',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>