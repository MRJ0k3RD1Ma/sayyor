<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/* @var $this yii\web\View */
/* @var $model common\models\Sertificates */

$this->title = $model->sert_full;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Dalolatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">


    <p>
        <?php if($model->status_id == 0 or \common\models\Samples::find()->where(['sert_id'=>$model->id])->andWhere(['status_id'=>0])->count('id') > 0){?>
            <?= Html::a(Yii::t('cp.sertificates', 'Arizani yuborish'), ['send', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php }?>
    </p>
    <p><?= Yii::t('client','Umumiy {n} ta namuna. Shundan {m} tasiga ariza berilmagan',['n'=>count($model->samples),'m'=>\common\models\Samples::find()->where(['sert_id'=>$model->id])->andWhere(['status_id'=>0])->count('id')])?></p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sert_full',
            'sert_num',
            'sert_date',
//            'organization_id',

//            'pnfl',
            'sampler_name',
            'sampler_position',

//            'vet_site_id',
            [
                'label'=>'Hayvon egasi',
                'value'=>function($d){
                    if($d->owner_pnfl){
                        return $d->owner_pnfl.'<br>'.$d->ownerPnfl->name.' '.$d->ownerPnfl->surname.' '.$d->ownerPnfl->middlename;
                    }elseif($d->owner_inn){
                        return $d->owner_inn.'<br>'.$d->ownerInn->name;
                    }else{
                        return "Hayvon egasi haqida ma'lumot kiritilmagan";
                    }
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'vet_site_id',
                'value'=>function($d){
                    return $d->vetSite->name;
                }
            ],
            [
                'attribute'=>'status_id',
                'value'=>function($d){
                    if(Yii::$app->language == 'ru'){
                        return $d->status->name_ru;
                    }
                    return $d->status->name_uz;
                }
            ],

        ],
    ]) ?>

</div>
<div class="row">
<div class="col-md-12">
    <h4 style="float: left">Namunalar ro'yhati</h4>
    <?php if($model->status_id==0){ ?>
        <span style="float: right"><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/ind/add','id'=>$model->id])?>">
                    <span class="fa fa-plus"></span> Namuna qo'shish
                </a>
            </span>
    <?php } ?>

</div>

    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover" >
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
                    <th rowspan="2"></th>
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
                <?php $n=0; foreach (\common\models\Samples::find()->where(['sert_id'=>$model->id])->all() as $item): $n++;
                $cnt_vac = \common\models\Vaccination::find()->where(['animal_id'=>$item->animal_id])->count('*');
                $cnt_eml = \common\models\Emlash::find()->where(['animal_id'=>$item->animal_id])->count('*');
                if($cnt_vac > $cnt_eml){
                    $cnt = $cnt_vac;
                }else{
                    $cnt = $cnt_eml;
                }
                ?>
                    <tr >
                        <td rowspan="<?= $cnt + 1?>" ><?= $item->status->icon?> <?= $item->kod?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->label ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleTypeIs->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleBox->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal_id ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal->type->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= Yii::$app->params['gender'][$item->animal->gender] ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?php
                            $d1 = new \DateTime($item->animal->birthday);
                            $d2 = new \DateTime(date('Y-m-d'));
                            $interval = $d1->diff($d2);
                            $diff = $interval->m+($interval->y*12);
                             echo $diff ?> oy</td>
                        <td colspan="2"><?php if($model->status_id == 0){?><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/ind/vaccination','id'=>$item->animal_id,'sert_id'=>$model->id])?>">Emlash</a><?php }?></td>
                        <td colspan="2"><?php if($model->status_id == 0){?><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/ind/emlash','id'=>$item->animal_id,'sert_id'=>$model->id])?>">Davolash</a><?php }?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->suspectedDisease->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->testMehod->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->repeat_code?></td>
                        <td rowspan="<?= $cnt + 1?>">
                            <?php if($item->status_id == 0){?>
                                <a href="<?= Yii::$app->urlManager->createUrl(['/ind/deleteanimal','id'=>$item->id])?>" data-confirm="Siz rostdan ham ushbu namunani o`chirmoqchimisiz?" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php
                    $vac = \common\models\Vaccination::find()->where(['animal_id'=>$item->animal_id])->orderBy(['disease_date'=>SORT_DESC])->all();
                    $eml = \common\models\Emlash::find()->where(['animal_id'=>$item->animal_id])->orderBy(['emlash_date'=>SORT_DESC])->all();
                    for ($i=0;$i<$cnt; $i++):?>
                    <tr>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease->name_uz : ' ' ?></td>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease_date : ' '?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->antibiotic : ' ' ?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->emlash_date : ' '?></td>
                    </tr>
                    <?php endfor; ?>
                <?php endforeach;?>

            </tbody>
        </table>
    </div>
</div>
