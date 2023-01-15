<?php

use common\models\Emlash;
use common\models\Vaccination;
use yii\widgets\ActiveForm;

/* @var $samples_comp \common\models\Samples*/
/* @var $uncompose \common\models\UnComposeForm*/
?>
<div class="row">
    <div class="col-md-12 table-responsive">

        <div class="row">
            <div class="col-md-8">
                <h4>Birlashgan namunalar ro'yhati</h4>

            </div>
            <div class="col-md-4 text-right pb-2">
                <a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['/register/incomeanimalmulti','id'=>$model->id])?>">Labaratoriyaga yuborish</a>
            </div>
        </div>
        <?php

        $form = ActiveForm::begin();?>

        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th rowspan="2"></th>
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
            <?php $n = 0;
            foreach ($samples_comp as $item): $n++;
                $cnt_vac = Vaccination::find()->where(['animal_id' => $item->animal_id])->count('*');
                $cnt_eml = Emlash::find()->where(['animal_id' => $item->animal_id])->count('*');
                if ($cnt_vac > $cnt_eml) {
                    $cnt = $cnt_vac;
                } else {
                    $cnt = $cnt_eml;
                }
                ?>
                <tr>
                    <td rowspan="<?= $cnt + 1 ?>">
                        <?php if($item->status_id < 3){?>

                            <?= $form->field($uncompose,'id['.$item->id.']')->checkbox(['checked'=>$item->is_group == 0 ? true : false,'value'=>1]) ?>

                        <?php } ?>
                    </td>
                    <td rowspan="<?= $cnt + 1 ?>">
                        <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomesamples', 'id' => $item->id, 'regid' => $model->id]) ?>"><?= $item->status->icon ?> <?= $item->kod ?></a>
                    </td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->label ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->sampleTypeIs->name_uz ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->sampleBox->name_uz ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->animal_id ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->animal->type->name_uz ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= Yii::$app->params['gender'][$item->animal->gender] ?></td>
                    <td rowspan="<?= $cnt + 1?>"><?php
                        $d1 = new \DateTime($item->animal->birthday);
                        $d2 = new \DateTime(date('Y-m-d'));
                        $interval = $d1->diff($d2);
                        $diff = $interval->m+($interval->y*12);
                        echo $diff ?></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->suspectedDisease->name_uz ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->testMehod->name_uz ?></td>
                    <td rowspan="<?= $cnt + 1 ?>"><?= $item->repeat_code ?></td>

                </tr>
                <?php
                $vac = Vaccination::find()->where(['animal_id' => $item->animal_id])->orderBy(['disease_date' => SORT_DESC])->all();
                $eml = Emlash::find()->where(['animal_id' => $item->animal_id])->orderBy(['emlash_date' => SORT_DESC])->all();
                for ($i = 0; $i < $cnt; $i++):?>
                    <tr>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease->name_uz : ' ' ?></td>
                        <td><?= isset($vac[$i]) ? $vac[$i]->disease_date : ' ' ?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->antibiotic : ' ' ?></td>
                        <td><?= isset($eml[$i]) ? $eml[$i]->emlash_date : ' ' ?></td>
                    </tr>

                <?php endfor; ?>
            <?php endforeach; ?>

            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">Alohida qilish</button>
        <?php ActiveForm::end()?>
    </div>
</div>