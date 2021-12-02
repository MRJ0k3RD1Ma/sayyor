<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animals */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animals', 'Hayvonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="animals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p >
        <?= Html::a(Yii::t('cp.animals', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.animals', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.animals', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('cp.animals', 'Emlash'), ['vaccination', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'cat_id',
                    'gender',
                    'birthday',
                    'inn',
                    'pnfl',
                    'adress',
                    'vet_site_id',
                    'bsual_tag',
                    'type_id',
                ],
            ]) ?>
        </div>
        <div class="col-md-6 table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>№</th>
                        <th><?= Yii::t('cp.animals','Vaksina nomi')?></th>
                        <th><?= Yii::t('cp.animals','Kasallik nomi')?></th>
                        <th><?= Yii::t('cp.animals','Sana')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=0;  foreach (\app\models\Vaccination::find()->where(['animal_id'=>$model->id])->all() as $item): $n++;?>
                        <tr>
                            <td><?= $n;?></td>
                            <td><?= $item->vaccina->name ?></td>
                            <td><?= Yii::$app->language == 'ru' ? $item->disease->name_ru : $item->disease->name_uz ?></td>
                            <td><?= $item->disease_date ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

</div>
