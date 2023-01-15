<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Regulations */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Normativ hujjatlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="regulations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('cp', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name_uz',
            'name_ru',
            [
                'attribute' => 'file',
                'format' => 'html',
                'value' => function (\common\models\Regulations $model) {
                    $url = \yii\helpers\Url::base().'/uploads/'.$model->file;

                    return \yii\bootstrap4\Html::a($model->file,[$url]);
                }
            ],
            [
                'attribute'=>'type_id',
                'value'=>function($d){
                    $lg = 'uz'; if(Yii::$app->language == 'ru')$lg='ru';
                    return $d->type->{'name_'.$lg};
                }
            ],
            [
                'attribute' => 'creator_id',
                'value' => function (\common\models\Regulations $model) {
                    return $model->creator->name;
                }
            ],

            'created:datetime',
//            'updated:datetime',
        ],
    ]) ?>

</div>
