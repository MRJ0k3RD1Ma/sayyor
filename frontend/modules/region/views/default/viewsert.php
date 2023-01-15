<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="sertificates-view">


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'code',
                [
                    'label'=>Yii::t('register','Yuboruvchi'),
                    'value'=>function($d){
                        if($d->inn){
                            return $d->inn.'<br>'.$d->inn0->name;
                        }elseif($d->pnfl){
                            return $d->pnfl.'<br>'.$d->pnfl0->name.' '.$d->pnfl0->surname.' '.$d->pnfl0->middlename;
                        }else{
                            return null;
                        }
                    },
                    'format'=>'raw'
                ],
//                            'is_research',
                [
                    'attribute'=>'is_research',
                    'value'=>function($d){
                        $s = [0=>'Shoshilinch emas',1=>'Shohilinch'];
                        return $s[$d->is_research];
                    }
                ],
//                            'code_id',
                //'code',
                //'research_category_id',
                [
                    'attribute'=>'research_category_id',
                    'value'=>function($d){
                        return $d->researchCategory->name_uz;
                    }
                ],
                //'results_conformity_id',
                //'organization_id',
                //'emp_id',
//                            'reg_date',
                //'reg_id',
                'sender_name',
                'sender_phone',
                'created',
                //'updated',
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
                <?php $n=0; foreach ($samples as $item): $n++;
                    $cnt_vac = \common\models\Vaccination::find()->where(['animal_id'=>$item->animal_id])->count('*');
                    $cnt_eml = \common\models\Emlash::find()->where(['animal_id'=>$item->animal_id])->count('*');
                    if($cnt_vac > $cnt_eml){
                        $cnt = $cnt_vac;
                    }else{
                        $cnt = $cnt_eml;
                    }
                    ?>
                    <tr>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->status->icon?> <?= $item->kod?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->label ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleTypeIs->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->sampleBox->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal_id ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal->type->name_uz ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= Yii::$app->params['gender'][$item->animal->gender] ?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= $item->animal->birthday ?></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td rowspan="<?= $cnt + 1?>"><?= @$item->suspectedDisease->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= @$item->testMehod->name_uz?></td>
                        <td rowspan="<?= $cnt + 1?>"><?= @$item->repeat_code?></td>

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


    <div class="modal fade bs-example-modal-lg" id="sendmodal" tabindex="-1"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="sendmodalbody">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


<?php
$this->registerJs("
        $('.send').click(function(){
            var url = this.value;
            $('#sendmodalbody').load(url);
            $('#sendmodal').modal('show');
        })
    ");
?>