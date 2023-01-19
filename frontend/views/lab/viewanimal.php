<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Samples */
/* @var $result common\models\ResultAnimal */
/* @var $test common\models\ResultAnimalTests */

$this->title = $model->sample->kod.' '.Yii::t('cp','sonli hayvon kasalliklari tashhisi bo`yicha namuna');
$this->params['breadcrumbs'][] = ['label' => Yii::t('food', 'Namunalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
    <div class="samples-view">

        <div class="row">
            <div class="col-md-6">
                <h3>Topshiriq ma'lumotlari</h3>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                    'id',
//                    'director_id',
//                    'leader_id',
//                    'executor_id',
                        [
                            'attribute' => 'executor_id',
                            'value' => function ($d) {
                                if ($d->executor_id) {
                                    return $d->executor->name;
                                }
                                return null;
                            }
                        ],
                        'deadline',
                        'ads',
//                    'state_id',
//                    'sample_id',
//                    'registration_id',
//                    'status_id',
                        [
                            'attribute' => 'status_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') {
                                    $lg = 'ru';
                                }
                                return $d->status->{'name_' . $lg};
                            }
                        ],
                        'created',
                        'updated',
                    ],
                ]) ?>

                <h3><?= Yii::t('leader', 'Normativ hujjatlar') ?></h3>
                <ul>
                    <?php $lg = 'uz';
                    if (Yii::$app->language == 'ru') $lg = 'ru' ?>
                    <?php foreach ($docs as $item): ?>
                        <?php $url = '#';
                        if ($item->file) $url = '/uploads/' . $item->file; ?>
                        <li><a href="<?= $url ?>"><?= $item->{'name_' . $lg} ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Namuna ma'lumotlari</h3>
                <?= DetailView::widget([
                    'model' => $sample,
                    'attributes' => [
//            'id',
                        [
                            'attribute'=>'is_group',
                            'value'=>function($d){
                                if($d->is_group and $d->is_group == 1){
                                    return Yii::t('cp','Birlashgan namuna');
                                }else{
                                    return Yii::t('cp','Alohida kelgan namuna');
                                }
                            }
                        ],
                        'kod',
//            'samp_id',
                        'label',
//                    'sample_type_is',
//                    'sample_box_id',
                        [
                            'attribute' => 'sample_type_is',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                return $d->sampleTypeIs->{'name_' . $lg};
                            }
                        ],
                        [
                            'attribute' => 'sample_box_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                return $d->sampleBox->{'name_' . $lg};
                            }
                        ],
//                    'animal_id',
                        [
                            'attribute' => 'animal_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                $res = "";
                                $res .= $d->animal->type->{'name_' . $lg} . '<br>';
                                $res .= Yii::t('lab', 'Holati:') . ' ' . $d->animal->cat->{'name_' . $lg} . '<br>';
                                $res .= Yii::t('lab', 'Jinsi:') . ' ' . Yii::$app->params['gender'][$d->animal->gender] . '<br>';
                                $d1 = new DateTime($d->animal->birthday);
                                $d2 = new DateTime(date('Y-m-d'));
                                $interval = $d1->diff($d2);
                                $diff = $interval->m + ($interval->y * 12);
                                $res .= Yii::t('lab', 'Tug\'ilgan sanasi:') . ' ' . $d->animal->birthday . '(' . $diff . ' oy)';

                                return $res;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => Yii::t('lab', 'Vaksinalashlar tarixi'),
                            'value' => function ($d) {
                                $vac = $d->animal->vaccinations;
                                $res = "";
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                foreach ($vac as $item) {
                                    $res .= "{$item->disease->{'name_'.$lg}} - {$item->disease_date}<br>";
                                }
                                return $res;
                            },
                            'format' => 'raw',
                        ],
                        [
                            'label' => Yii::t('lab', 'Davolashlar tarixi'),
                            'value' => function ($d) {
                                $vac = $d->animal->emlash;
                                $res = "";
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                foreach ($vac as $item) {
                                    $res .= "{$item->antibiotic} - {$item->emlash_date}<br>";
                                }
                                return $res;
                            },
                            'format' => 'raw',
                        ],
//            'sert_id',
//                    'suspected_disease_id',
                        [
                            'attribute' => 'suspected_disease_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                return $d->suspectedDisease->{'name_' . $lg};
                            }
                        ],
                        [
                            'attribute' => 'test_mehod_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                return $d->testMehod->{'name_' . $lg};
                            }
                        ],

//            'state_id',
//                    'status_id',
//                    'emp_id',
                        [
                            'label' => 'Namunani qabul qilgan hodim',
                            'attribute' => 'emp_id',
                            'value' => function ($d) {
                                if ($d->emp_id != -1) {
                                    return $d->emp->name;
                                }
                                return null;
                            }
                        ],
                        'repeat_code',
                    ],
                ]) ?>
            </div>
        </div>


        <?php if ($model->status_id == 2 or $model->status_id == 6) { ?>
            <div class="row">
                <div>
                    <h3 style="float: left">Tekshiruv sharoiti</h3>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/lab/sendanimal', 'id' => $model->id]) ?>"
                       class="btn btn-primary" style="float:right"><?= Yii::t('lab', 'Natijalarni yuborish') ?></a>
                </div>
                <?php $form = ActiveForm::begin() ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($conditions, 'temprature')->textInput(['type' => 'number']) ?>

                        <?= $form->field($conditions, 'humidity')->textInput(['type' => 'number']) ?>

                        <?= $form->field($conditions, 'reagent_series')->textInput() ?>

                        <?= $form->field($conditions, 'reagent_name')->textInput() ?>

                    </div>
                    <div class="col-md-6">
                        <?= $form->field($conditions, 'conditions')->textInput() ?>

                        <?= $form->field($conditions, 'end_date')->textInput(['type' => 'date']) ?>

                        <?= $form->field($conditions, 'is_change')->checkbox(['value'=>1,'style'=>'margin-top:35px;']) ?>

                        <?= $form->field($conditions, 'why_change')->textInput(['disabled'=> $conditions->is_change==0 ? true : false]) ?>

                </div>
            </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th><?= Yii::t('lab', 'Parametr nomi') ?></th>
                            <th><?= Yii::t('lab', 'Birlik') ?></th>
                            <th><?= Yii::t('lab', 'Minimal-maksimal oraliq') ?></th>
                            <th colspan="2"><?= Yii::t('lab', 'Qiymat') ?></th>
                            <th><?= Yii::t('lab', 'Emlashga aloqadorligi') ?></th>
                            <th><?= Yii::t('lab', 'Normativga mosligi') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $lg = 'uz';
                        if (Yii::$app->language == 'ru') $lg = 'ru'; ?>
                        <?php $n = 0;
                        $result_type = \yii\helpers\ArrayHelper::map(\common\models\ResultType::find()->all(),'id','name_uz');
                        foreach ($test as $i => $item): $n++; ?>
                            <div class="hidden" hidden> <?= $form->field($item, '[' . $item->id . ']checked')->checkbox(['value' => 1, 'data-id' => $item->id, 'class' => 'checkboxok'], false)->label(false) ?></div>
                            <tr id="tr-<?= $item->id ?>"
                                style="<?= $item->checked == 1 ? 'background: #fff;' : 'background: #e9e9ef;' ?>">
                                <td><?= $item->template_id ?></td>
                                <td><?= $item->template->{'name_' . $lg} ?></td>
                                <td><?= $item->unit->{'name_' . $lg} ?></td>

                                <td>

                                    <?php if ($item->unit->type_id == 1) { ?>
                                <?= $item->ch_min1 . '-' . $item->ch_max1 ?>
                                <?php } elseif ($item->unit->type_id == 2) { ?>
                                    <?= Yii::$app->params['result'][intval($item->ch_min1)] ?>
                                <?php } elseif ($item->unit->type_id == 3) { ?>
                                    <?= $item->ch_min1 . '-' . $item->ch_max1 . ' %' ?>
                                <?php } elseif ($item->unit->type_id == 4) { ?>
                                    <?= $item->ch_min1 . '-' . $item->ch_max1 ?>
                                        <br> <?= $item->ch_min2 . '-' . $item->ch_max2 ?>
                                <?php }elseif($item->unit->type_id==5){ ?>
                                        <?= Yii::$app->params['unit_belgi'][intval($item->ch_min1)].' - '.Yii::$app->params['unit_belgi'][intval($item->ch_max1)]?>
                                <?php }?>

                                    <?= $form->field($item, '['.$item->id.']is_change')->checkbox(['class'=>'minmaxedit','value'=>1,'disabled'=>$conditions->is_change==0?true:false,'data-key'=>$item->id]) ?>
                                    <div class="changeminmax" data-key="<?= $item->id ?>" style="margin-top:10px; display: none">

                                        <?= $form->field($item,'['.$item->id.']change_unit_id')->dropDownList(
                                                \yii\helpers\ArrayHelper::map(\common\models\TemplateUnit::find()->all(),'id','name_uz'),
                                                [
                                                    'prompt'=>'Birlikni tanlang',
                                                    'class'=>'form-control birliklar',
                                                    'data-key'=>$item->id
                                                ]
                                        )->label(false)?>

                                        <?php $uid = $item->unit->type_id;
                                            if($uid == 2){
                                                $item->true1 = $item->ch_min1;
                                                $item->true2 = $item->ch_max1;
                                            }elseif($uid == 5){
                                                $item->mm_1 = $item->ch_min1;
                                                $item->mm_2 = $item->ch_max1;
                                            }
                                        $type = $item->unit->type_id;
                                        if($type == 1){
                                            $item->r_son = $item->result;
                                        }elseif($type == 2){
                                            $item->r_bool = $item->result;
                                        }elseif($type == 3){
                                            $item->r_text = $item->result;
                                        }elseif($type == 4){
                                            $item->r_1 = $item->result;
                                            $item->r_2 = $item->result_2;
                                        }elseif($type == 5){
                                            $item->r_unit = $item->result;
                                        }
                                        ?>
                                        <div class="isfalse key-<?= $item->id?>" style="display:  <?= ($uid==1 or $uid==3 or $uid==4)?'block':'none'?>">

                                            <?= $form->field($item, '['.$item->id.']ch_min1')->textInput(['maxlength' => true]) ?>

                                            <div class="oraliq key-<?= $item->id?>" style="display:  <?= $uid==4?'block':'none'?>">

                                                <?= $form->field($item, '['.$item->id.']ch_min2')->textInput(['maxlength' => true]) ?>

                                            </div>

                                            <?= $form->field($item, '['.$item->id.']ch_max1')->textInput(['maxlength' => true]) ?>

                                            <div class="oraliq key-<?= $item->id?>" style="display:  <?= $uid==2?'block':'none'?>">

                                                <?= $form->field($item, '['.$item->id.']ch_max2')->textInput(['maxlength' => true]) ?>

                                            </div>

                                        </div>

                                        <div class="istrue key-<?= $item->id?>" style="display:  <?= $uid==2?'block':'none'?>">

                                            <?= $form->field($item, '['.$item->id.']true1')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>

                                            <?= $form->field($item, '['.$item->id.']true2')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>
                                        </div>
                                        <div class="ismm key-<?= $item->id?>" style="display:  <?= $uid==5?'block':'none'?>">

                                            <?= $form->field($item, '['.$item->id.']mm_1')->dropDownList(Yii::$app->params['unit_belgi']) ?>
                                            <?= $form->field($item, '['.$item->id.']mm_2')->dropDownList(Yii::$app->params['unit_belgi']) ?>

                                        </div>
                                        <button class="btn btn-success okbtn btn-sm" value="<?= $item->id?>" type="button">OK</button>

                                    </div>

                                </td>

                                <td colspan="2" class="result-<?= $item->id?>">
                                    <?php $unittype = $item->unit->type_id;?>
                                    <div style="display: <?= $unittype == 1? 'block':'none'?>" class="unitresult <?= $unittype == 1? 'true':'false'?> r_son">
                                        <?= $form->field($item, '[' . $item->id . ']r_son')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'), ])->label(false) ?>
                                    </div>
                                    <div style="display: <?= $unittype == 2? 'block':'none'?>" class="unitresult <?= $unittype == 2? 'true':'false'?> r_bool">
                                        <?= $form->field($item, '[' . $item->id . ']r_bool')->dropDownList([0 => Yii::$app->params['result'][0], 1 => Yii::$app->params['result'][1]], ['prompt' => Yii::t('lab', 'Natijani tanlang'), ])->label(false) ?>

                                    </div>
                                    <div style="display: <?= $unittype == 3? 'block':'none'?>" class="unitresult <?= $unittype == 3? 'true':'false'?> r_text">
                                        <?= $form->field($item, '[' . $item->id . ']r_text')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'),])->label(false) ?>

                                    </div>
                                    <div style="display: <?= $unittype == 4? 'block':'none'?>" class="unitresult <?= $unittype == 4? 'true':'false'?> r_multi">
                                        <?= $form->field($item, '[' . $item->id . ']r_1')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'),])->label(false) ?>
                                        <?= $form->field($item, '[' . $item->id . ']r_2')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'),])->label(false) ?>

                                    </div>
                                    <div style="display: <?= $unittype == 5? 'block':'none'?>" class="unitresult <?= $unittype == 5? 'true':'false'?> r_unit">
                                        <?= $form->field($item,'['.$item->id.']r_unit')->dropDownList(Yii::$app->params['unit_belgi'],['prompt'=>'Natijani tanlang'])->label(false);?>
                                    </div>


                                </td>

                                <td>
                                    <?php
                                    if($item->template->is_vaccination != 0) $item->template->is_vaccination=1;
                                    echo Yii::$app->params['is_vaccination'][$item->template->is_vaccination] . '<br>';
                                    if ($item->template->is_vaccination == 1) {
                                        if ($item->template->dead_days <= 0) {
                                            echo Yii::t('lab', 'Doimiy');
                                        } else {
                                            echo $item->template->dead_days . ' ' . Yii::t('lab', 'Kun');
                                        }
                                    }else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td><?= $form->field($item,'['.$item->id.']result_type_id')->dropDownList($result_type,['prompt'=>'Normativga mosligi'])?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                    <?= $form->field($conditions,'ads')->dropDownList(['0'=>Yii::t('lab','Tasdiqlanmadi'),1=>Yii::t('lab','Tasdiqlandi')],['prompt'=>Yii::t('lab','Umumiy tekshiruv natijasi')])?>
            </div>

                <h4>O'tkazilgan tekshiruv natijalari:</h4>
                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($conditions,'patonomiya')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'organoleptika')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'mikroskopiya_nurli')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'mikroskopiya_lyuminesent')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'bakterilogik')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'virusologik_TE_KE')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'virusologik_XM_KK')->checkbox(['value'=>1])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'biologik')->checkbox(['value'=>1])?>
                        </div>


                   <h4> Serologik tekshiruvlar:</h4>
                        <div class="row">
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RA_KR')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RSK')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RDSK')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RBP')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RMA')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RP_RDP')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RH')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RNGA')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'RGA')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'IFA')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'IXLA')->checkbox(['value'=>1])?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($conditions,'boshqa_serologiya')->checkbox(['value'=>1])?>
                            </div>
                        </div>


                   <div class="row">
                       <div class="col-md-2">
                           <?= $form->field($conditions,'PSR')->checkbox(['value'=>1])?>
                       </div>
                       <div class="col-md-2">
                           <?= $form->field($conditions,'gistologiya')->checkbox(['value'=>1])?>
                       </div>
                       <div class="col-md-2">
                           <?= $form->field($conditions,'gemotologiya')->checkbox(['value'=>1])?>
                       </div>
                       <div class="col-md-2">
                           <?= $form->field($conditions,'koprologiya')->checkbox(['value'=>1])?>
                       </div>
                       <div class="col-md-2">
                           <?= $form->field($conditions,'kimyoviy')->checkbox(['value'=>1])?>
                       </div>
                       <div class="col-md-2">
                           <?= $form->field($conditions,'biokimyoviy')->checkbox(['value'=>1])?>
                       </div>

                   </div>
                    </div>


                <button type="submit" class="btn btn-success"><?= Yii::t('lab', 'Saqlash') ?></button>

                <?php ActiveForm::end() ?>
                <h3  style="margin-top:20px;">Tavfsiya qo'shish:</h3>
                <?php $f = ActiveForm::begin()?>

                    <?= $f->field($recom,'name')->textInput()?>

                    <button class="btn btn-primary">Tavfsiyani saqlash</button>
                <?php ActiveForm::end()?>
                <h3  style="margin-top:20px;">Tavfsiyalar ro'yhati:</h3>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <?php $rec = \common\models\SampleRecomendation::find()->where(['sample_id'=>$sample->id])->all();
                            foreach ($rec as $item):
                                ?>
                                <li><?= $item->name?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>



            </div>
        <?php } else { ?>

            <div class="row">
                <div>
                    <h3 style="float: left">Tekshiruv sharoiti</h3>
                </div>
                <?php $form = ActiveForm::begin() ?>
                <?= $form->field($result, 'id')->hiddenInput()->label(false) ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($conditions, 'temprature')->textInput(['type' => 'number', 'disabled' => true]) ?>

                        <?= $form->field($conditions, 'humidity')->textInput(['type' => 'number', 'disabled' => true]) ?>

                        <?= $form->field($conditions, 'reagent_series')->textInput(['disabled' => true]) ?>

                        <?= $form->field($conditions, 'reagent_name')->textInput(['disabled' => true]) ?>

                    </div>
                    <div class="col-md-6">
                        <?= $form->field($conditions, 'conditions')->textInput(['disabled' => true]) ?>

                        <?= $form->field($conditions, 'end_date')->textInput(['type' => 'date', 'disabled' => true]) ?>

                        <?= $form->field($conditions, 'is_change')->checkbox(['value'=>1,'style'=>'margin-top:35px;','disabled'=>true]) ?>

                        <?= $form->field($conditions, 'why_change')->textInput(['disabled'=> true]) ?>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?= Yii::t('lab', 'Parametr nomi') ?></th>
                                <th><?= Yii::t('lab', 'Birlik') ?></th>
                                <th><?= Yii::t('lab', 'Minimal-maksimal oraliq') ?></th>
                                <th colspan="2"><?= Yii::t('lab', 'Qiymat') ?></th>
                                <th><?= Yii::t('lab', 'Emlashga aloqadorligi') ?></th>
                                <th><?= Yii::t('lab', 'Normativga mosligi') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $lg = 'uz';
                        if (Yii::$app->language == 'ru') $lg = 'ru'; ?>
                        <?php $n = 0;
                        $result_type = \yii\helpers\ArrayHelper::map(\common\models\ResultType::find()->all(),'id','name_uz');
                        foreach ($test as $i => $item): $n++; ?>
                            <tr style="background: #e9e9ef;">
                                <td><?= $item->id ?></td>
                                <td><?= $item->template->{'name_' . $lg} ?></td>
                                <td><?= $item->unit->{'name_' . $lg} ?></td>

                                <?php if ($item->unit->type_id == 1) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?></td>
                                <?php } elseif ($item->unit->type_id == 2) { ?>
                                    <td><?= Yii::$app->params['result'][intval($item->ch_min1)] ?></td>
                                <?php } elseif ($item->unit->type_id == 3) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 . ' %' ?></td>
                                <?php } elseif ($item->unit->type_id == 4) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?>
                                        <br> <?= $item->ch_min2 . '-' . $item->ch_max2 ?>
                                    </td>
                                <?php }elseif($item->unit->type_id==5){ ?>
                                    <td><?= Yii::$app->params['unit_belgi'][intval($item->ch_min1)].' - '.Yii::$app->params['unit_belgi'][intval($item->ch_max1)]?></td>
                                <?php }?>

                                <?php if ($item->unit->type_id == 1) { ?>
                                    <td colspan="2"><?= $form->field($item, '[' . $item->id . ']result')->textInput(['disabled' => true, 'placeholder' => Yii::t('lab', 'Natijani kiriting')])->label(false) ?></td>
                                <?php } elseif ($item->unit->type_id == 2) { ?>
                                    <td colspan="2"><?= $form->field($item, '[' . $item->id . ']result')->dropDownList([0 => Yii::$app->params['result'][0], 1 => Yii::$app->params['result'][1]], ['prompt' => Yii::t('lab', 'Natijani tanlang'), 'disabled' => true])->label(false) ?></td>
                                <?php } elseif ($item->unit->type_id == 3) { ?>
                                    <td colspan="2"><?= $form->field($item, '[' . $item->id . ']result')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'), 'disabled' => true])->label(false) ?></td>
                                <?php } elseif ($item->unit->type_id == 4) { ?>
                                    <td><?= $form->field($item, '[' . $item->id . ']result')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'), 'disabled' => true])->label(false) ?></td>
                                    <td><?= $form->field($item, '[' . $item->id . ']result_2')->textInput(['placeholder' => Yii::t('lab', 'Natijani kiriting'), 'disabled' => true])->label(false) ?></td>
                                <?php }elseif($item->unit->type_id==5){ ?>
                                <td colspan="2">
                                    <?= $form->field($item,'['.$item->id.']result')->dropDownList(Yii::$app->params['unit_belgi'],['prompt'=>'Natijani tanlang','disabled'=>true]);?>
                                </td>
                                <?php }?>

                                <td><?php
                                    if($item->template->is_vaccination != 0) $item->template->is_vaccination=1;
                                    echo Yii::$app->params['is_vaccination'][$item->template->is_vaccination] . '<br>';
                                    if ($item->template->is_vaccination == 1) {
                                        if ($item->template->dead_days <= 0) {
                                            echo Yii::t('lab', 'Doimiy');
                                        } else {
                                            echo $item->template->dead_days . ' ' . Yii::t('lab', 'Kun');
                                        }
                                    }
                                    ?></td>
                                <td>
                                    <?= $form->field($item,'['.$item->id.']result_type_id')->dropDownList($result_type,['prompt'=>'Normativga mosligi','disabled'=>true])?>
                                </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $form->field($conditions,'ads')->dropDownList(['0'=>Yii::t('lab','Tasdiqlanmadi'),1=>Yii::t('lab','Tasdiqlandi')],['prompt'=>Yii::t('lab','Umumiy tekshiruv natijasi'),'disabled'=>true])?>

        </div>
                <h4>O`tkazilgan tekshruv 4VET uchun:</h4>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($conditions,'patonomiya')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'organoleptika')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'mikroskopiya_nurli')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'mikroskopiya_lyuminesent')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'bakterilogik')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'virusologik_TE_KE')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'virusologik_XM_KK')->checkbox(['disabled'=>true])?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($conditions,'biologik')->checkbox(['disabled'=>true])?>
                    </div>


                    <h4> Serologik tekshiruvlar:</h4>
                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RA_KR')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RSK')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RDSK')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RBP')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RMA')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RP_RDP')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RH')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RNGA')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'RGA')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'IFA')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'IXLA')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'boshqa_serologiya')->checkbox(['disabled'=>true])?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-2">
                            <?= $form->field($conditions,'PSR')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'gistologiya')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'gemotologiya')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'koprologiya')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'kimyoviy')->checkbox(['disabled'=>true])?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($conditions,'biokimyoviy')->checkbox(['disabled'=>true])?>
                        </div>

                    </div>
                </div>
        <?php ActiveForm::end()?>


                <div class="row">
                    <div class="col-md-12">
                        <h3  style="margin-top:20px;">Tavfsiyalar ro'yhati:</h3>

                        <ul>
                            <?php $rec = \common\models\SampleRecomendation::find()->where(['sample_id'=>$sample->id])->all();
                            foreach ($rec as $item):
                                ?>
                                <li><?= $item->name?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

            </div>

    <?php }?>

</div>


<?php

$url_birlik = Yii::$app->urlManager->createUrl(['/lab/getbirlik']);
$this->registerJs("
    $('.checkboxok').change(function(){
        // is cheked bolsa shatadi shuni yoziparaman
        var id = this.getAttribute('data-id');
        if(this.checked){
            $('#tr-'+id).css('background','#fff');
            $('#resultanimaltests-'+id+'-result').prop('disabled',false);
            $('#resultanimaltests-'+id+'-result_2').prop('disabled',false);
            $('#resultanimaltests-'+id+'-is_change').prop('disabled',false);
        }else{
            $('#tr-'+id).css('background','#e9e9ef');
            $('#resultanimaltests-'+id+'-result').prop('disabled',true);
            $('#resultanimaltests-'+id+'-result_2').prop('disabled',true);
            if($('#resultanimalconditions-is_change').is(':checked')){
                $('#resultanimaltests-'+id+'-is_change').prop('disabled',true);
            }
        }
    })
      
    $('#resultanimalconditions-is_change').change(function(){
        
        if($('#resultanimalconditions-is_change').is(':checked')){
            $('#resultanimalconditions-why_change').prop('disabled',false);
            $('.checkboxok').each(function(){
                 var id = this.getAttribute('data-id');
                 if(this.checked){
                     $('#resultanimaltests-'+id+'-is_change').prop('disabled', false)
                 }
            });
        }else{
            $('#resultanimalconditions-why_change').prop('disabled',true);
            $('.unitresult.false').css('display','none');
            $('.unitresult.true').css('display','block');
            $('.checkboxok').each(function(){
                 var id = this.getAttribute('data-id');
                 $('#resultanimaltests-'+id+'-is_change').prop('disabled', true)
            });
        }
    });
       
    
    $('.okbtn').click(function(){
        var id = this.value;
        $('.changeminmax[data-key=\"'+id+'\"]').css('display','none');
    })
    
    $('.minmaxedit').change(function(){
        var id = this.getAttribute('data-key');
        if(this.checked){
            $('.changeminmax[data-key=\"'+id+'\"]').css('display','block');        
        }else{
            $('.changeminmax[data-key=\"'+id+'\"]').css('display','none');
        }
    });
    
    $('.birliklar').change(function(){
        var id = this.getAttribute('data-key');
        var val = this.value;
        $('.key-'+id+'.oraliq').css('display','none');
        $('.key-'+id+'.istrue').css('display','none');
        $('.key-'+id+'.ismm').css('display','none');
        $('.key-'+id+'.isfalse').css('display','none');
        $('.result-'+id+' .unitresult').css('display','none');

        $.get('{$url_birlik}?id='+val).done(function(data){
             
              if(data==1){
                  $('.result-'+id+' .unitresult.r_son').css('display','block');
                  $('.key-'+id+'.isfalse').css('display','block');
              }else if(data==2){
                  $('.result-'+id+' .unitresult.r_bool').css('display','block');
                  $('.key-'+id+'.istrue').css('display','block');
              }else if(data == 3){
                  $('.result-'+id+' .unitresult.r_text').css('display','block');
                  $('.key-'+id+'.isfalse').css('display','block');
              }else if(data==4){
                  $('.result-'+id+' .unitresult.r_multi').css('display','block');
                  $('.key-'+id+'.isfalse').css('display','block');
                  $('.key-'+id+'.oraliq').css('display','block'); 
              }else if(data==5){
                  $('.result-'+id+' .unitresult.r_unit').css('display','block');
                  $('.key-'+id+'.ismm').css('display','block');
              }
             
        });
    })
    
")
?>
