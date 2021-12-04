<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sertificates */

$this->title = $model->sert_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Dalolatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp.sertificates', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cp.sertificates', 'O\'chirish'), ['delete', 'id' => $model->id], [
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
                <?php $n=0; foreach (\app\models\Samples::find()->where(['sert_id'=>$model->id])->all() as $item): $n++;
                $cnt_vac = \app\models\Vaccination::find()->where(['animal_id'=>$item->animal_id])->count('*');
                $cnt_eml = \app\models\Emlash::find()->where(['animal_id'=>$item->animal_id])->count('*');
                if($cnt_vac > $cnt_eml){
                    $cnt = $cnt_vac;
                }else{
                    $cnt = $cnt_eml;
                }
                ?>
                    <tr>
                        <td rowspan="<?= $cnt + 1?>"><?= $n?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->label ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleTypeIs->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleBox->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal_id ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal->type->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= Yii::$app->params['gender'][$item->animal->gender] ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal->birthday ?></td>
                        <td colspan="2"><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/cp/sertificates/vaccination','id'=>$item->animal_id,'sert_id'=>$model->id])?>">Emlash</a></td>
                        <td colspan="2"><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/cp/sertificates/emlash','id'=>$item->animal_id,'sert_id'=>$model->id])?>">Davolash</a></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->suspectedDisease->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->testMehod->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->kod?></td>
                    </tr>
                    <?php
                    $vac = \app\models\Vaccination::find()->where(['animal_id'=>$item->animal_id])->orderBy(['disease_date'=>SORT_DESC])->all();
                    $eml = \app\models\Emlash::find()->where(['animal_id'=>$item->animal_id])->orderBy(['emlash_date'=>SORT_DESC])->all();
                    for ($i=0;$i<$cnt; $i++):?>
                    <tr>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease->name_uz : ' ' ?></td>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease_date : ' '?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->antibiotic : ' ' ?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->emlash_date : ' '?></td>
                    </tr>
                    <?php endfor; ?>
                <?php endforeach;?>
                <tr>
                    <td colspan="15"><a href="<?= Yii::$app->urlManager->createUrl(['/cp/sertificates/add','id'=>$model->id])?>" class="btn btn-primary">Yana qo'shish</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
