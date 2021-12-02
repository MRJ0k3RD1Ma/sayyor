<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sertificates */

$this->title = $model->sert_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Sertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.sertificates', 'Update'), ['update', 'sert_id' => $model->sert_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.sertificates', 'Delete'), ['delete', 'sert_id' => $model->sert_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cp.sertificates', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sert_id',
            'sert_num',
            'sert_date',
            'organization_id',
            'pnfl',
            'owner_name',
            'vet_site_id',
            'operator',
        ],
    ]) ?>

</div>


<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Namuna belgisi</th>
                    <th rowspan="2">Namuna turi</th>
                    <th rowspan="2">Namuna o'rami</th>
                    <th colspan="4">Namuna olingan hayvon haqida ma'lumot</th>
                    <th colspan="2">Emlash</th>
                    <th colspan="2">Davolash</th>
                    <th rowspan="2">Qaysi kasallikga gumon</th>
                    <th rowspan="2">Tahlil usuli</th>
                    <th rowspan="2">Takroriy tahlil raqami</th>
                </tr>
                <tr>
                    <th>Identifikatsiya raqami</th>
                    <th>Hayvon turi</th>
                    <th>Hayvon jinsi</th>
                    <th>Yoshi oy</th>
                    <th>Kasallikga qarshi</th>
                    <th>Emlash sanasi</th>
                    <th>Antibiotik turi</th>
                    <th>Sanasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (\app\models\Samples::find()->where(['sert_id'=>$model->sert_id])->all() as $item):?>
                    <tr>
                        <td></td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="15"><a href="<?= Yii::$app->urlManager->createUrl(['/cp/sertificates/add','sert_id'=>$model->sert_id])?>" class="btn btn-primary">Yana qo'shish</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
