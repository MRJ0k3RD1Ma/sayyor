<?php

use common\models\ResultAnimal;
use common\models\ResultAnimalTests;
use common\models\RouteSert;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Samples */
/* @var $result ResultAnimal */
/* @var $item ResultAnimalTests */
/* @var $d \common\models\Samples */

$this->title = $model->sample->kod.' '.Yii::t('cp','sonli hayvon kasalliklari tashhisi bo`yicha namuna raqami');
$this->params['breadcrumbs'][] = ['label' => Yii::t('food', 'Namunalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
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

            <h3><?= Yii::t('leader','Normativ hujjatlar')?></h3>
            <ul>
                <?php $lg = 'uz'; if(Yii::$app->language == 'ru')$lg = 'ru'?>
                <?php foreach ($docs as $item):?>
                    <?php $url = '#'; if($item->file) $url = '/uploads/'.$item->file;?>
                    <li><a href="<?= $url?>"><?= $item->{'name_'.$lg}?></a></li>
                <?php endforeach;?>
            </ul>

            <?php if ($model->status_id == 1) { ?>
                <?php $form = ActiveForm::begin() ?>

                <?php
                $data = [];
                foreach ($emp as $item) {
                    $data[$item->id] = RouteSert::find()->where(['executor_id' => $item->id])
                            ->andWhere(['<>', 'status_id', 3])->count('id')
                        . ' - ' . $item->name;
                }
                ?>
                <?= $form->field($model, 'executor_id')->dropDownList($data, ['prompt' => Yii::t('leader', 'Labarantni tanlang')]) ?>
                <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>
                <?= $form->field($model, 'ads')->textInput() ?>
                <button class="btn btn-success" type="submit">Jo'natish</button>
                <?php ActiveForm::end() ?>
            <?php } ?>
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
                        'label'=>Yii::t('lab','Vaksinalashlar tarixi'),
                        'value'=>function($d){
                            $vac = $d->animal->vaccinations;
                            $res = "";
                            $lg = 'uz'; if(Yii::$app->language=='ru')$lg='ru';
                            foreach ($vac as $item){
                                $res .= "{$item->disease->{'name_'.$lg}} - {$item->disease_date}<br>";
                            }
                            return $res;
                        },
                        'format'=>'raw',
                    ],
                    [
                        'label'=>Yii::t('lab','Davolashlar tarixi'),
                        'value'=>function($d){
                            $vac = $d->animal->emlash;
                            $res = "";
                            $lg = 'uz'; if(Yii::$app->language=='ru')$lg='ru';
                            foreach ($vac as $item){
                                $res .= "{$item->antibiotic} - {$item->emlash_date}<br>";
                            }
                            return $res;
                        },
                        'format'=>'raw',
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
                                return @$d->emp->name;
                            }
                            return null;
                        }
                    ],
                    'repeat_code',
                ],
            ]) ?>
        </div>
    </div>
    <?php if($model->status_id >= 2){?>
        <div class="row">
            <div class="col-md-6">
                <h3>Tekshiruv sharoiti</h3>
                <?= DetailView::widget([
                    'model' => $conditions,
                    'attributes' => [
                        'temprature',
                        'humidity',
                        'reagent_series',
                        'reagent_name',
                        'conditions',
                        'end_date',
                        [
                            'attribute'=>'ads',
                            'value'=>function($d){
                                $s = [0=>'Tasdiqlanmadi',1=>'Tasdiqlandi'];
                                $color = [0=>'',1=>'red'];
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                if($d->temprature){
                                    if($d->ads){
                                        return '<b style="color:'.$color[$d->ads].'">'.$d->sample->suspectedDisease->{'name_' . $lg}.'-'.$s[$d->ads].'<b>';
                                    }else{
                                        return $d->sample->suspectedDisease->{'name_' . $lg};
                                    }
                                }else{return null;}

                            },
                            'format'=>'raw'
                        ],
                    ]
                ])
                ?>
            </div>
            <div class="col-md-6">
                <h3>Natijalar</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th><?= Yii::t('lab', 'Parametr nomi') ?></th>
                            <th><?= Yii::t('lab', 'Birlik') ?></th>
                            <th><?= Yii::t('lab', 'Minimal-maksimal oraliq') ?></th>
                            <th><?= Yii::t('lab', 'Qiymat') ?></th>
                            <th><?= Yii::t('lab', 'Normativga mosligi') ?></th>
                            <th><?= Yii::t('lab', 'Emlashga aloqadorligi') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $lg = 'uz';
                        if (Yii::$app->language == 'ru') $lg = 'ru'; ?>
                        <?php $n = 0;
                        foreach ($test as $i => $item): $n++; ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= $item->template->{'name_' . $lg} ?></td>
                                <td><?= $item->unit->{'name_' . $lg} ?></td>
                                <?php $type = $item->unit->type_id; if ($type == 1) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?></td>
                                <?php } elseif ($type == 2) { ?>
                                    <td><?= Yii::$app->params['result'][intval($item->ch_min1)].'-'.Yii::$app->params['result'][intval($item->ch_max1)] ?></td>
                                <?php } elseif ($type == 3) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 . ' %' ?></td>
                                <?php } elseif ($type == 4) { ?>
                                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?>
                                        <br> <?= $item->ch_min2 . '-' . $item->ch_max2 ?></td>
                                <?php }elseif($type == 5){ ?>
                                    <td><?= Yii::$app->params['unit_belgi'][inval($item->ch_min1)].' - '.Yii::$app->params['unit_belgi'][intval($item->ch_max1)]?></td>
                                <?php }?>
                                <td>
                                    <?php if ($type == 1) { ?>
                                        <?= $item->result ?>
                                    <?php } elseif ($type == 2) { ?>
                                       <?= Yii::$app->params['result'][intval($item->result)] ?>
                                    <?php } elseif ($type == 3) { ?>
                                      <?= $item->result . ' %' ?>
                                    <?php } elseif ($type == 4) { ?>
                                        <?= $item->result . '-' . $item->result_2 ?>
                                    <?php }elseif($type == 5){ ?>
                                       <?= Yii::$app->params['unit_belgi'][intval($item->result)]?>
                                    <?php }?>
                                </td>
                                <td>
                                    <?= @$item->resultType->name_uz?>
                                </td>
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
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3">№</th>
                        <th rowspan="3">Kasallik,Hayvon nomi</th>
                        <th rowspan="3">Kod</th>
                        <th rowspan="3">Materiallar soni</th>
                        <th colspan="27">Tekshiruv o'tkazildi</th>
                        <th rowspan="3">Musabt natijalar</th>
                        <th rowspan="3">Tekshiruvlar soni</th>
                    </tr>
                    <tr>
                        <th rowspan="2">Patanomiya</th>
                        <th rowspan="2">Orgonalepika</th>
                        <th colspan="2">Mikroskopiya</th>
                        <th rowspan="2">Bakteriologik</th>
                        <th colspan="2">Virusologik</th>
                        <th rowspan="2">Biologik</th>
                        <th colspan="13">Serologik</th>
                        <th rowspan="2">PSR</th>
                        <th rowspan="2">Gistologiya</th>
                        <th rowspan="2">Gemotologiya</th>
                        <th rowspan="2">Koprologik</th>
                        <th rowspan="2">Kimyoviy</th>
                        <th rowspan="2">Biokimyoviy</th>
                    </tr>
                    <tr>
                        <th>Nur</th>
                        <th>Lyuminesent</th>
                        <th>TE KE</th>
                        <th>XM KK</th>
                        <th>RA KR</th>
                        <th>RSK</th>
                        <th>RDSK</th>
                        <th>RBP</th>
                        <th>RMA</th>
                        <th>RP,RDP</th>
                        <th>RN</th>
                        <th>RNGA</th>
                        <th>RKGA</th>
                        <th>RGA</th>
                        <th>IFA</th>
                        <th>IXLA</th>
                        <th>boshqa</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>A</th>
                        <th>B</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $lg = 'uz'; if(Yii::$app->language!='uz')$lg = 'ru';?>
                    <tr>
                        <td>1</td>
                        <td><?php $sample = $result->sample; echo $sample->suspectedDisease->vet4 . $sample->animal->type->vet4.'-'.$sample->suspectedDisease->{'name_'.$lg}.', '.$sample->animal->type->{'name_'.$lg}; ?></td>
                        <td><?= $model->vet4.', '.\common\models\SampleTypes::findOne(['vet4'=>substr($model->vet4,5,3)])->{'name_'.$lg} ?></td>
                        <td><?= $sample->cnt?></td>
                        <td><?= $conditions->patonomiya?></td>
                        <td><?= $conditions->organoleptika?></td>
                        <td><?= $conditions->mikroskopiya_nurli?></td>
                        <td><?= $conditions->mikroskopiya_lyuminesent?></td>
                        <td><?= $conditions->bakterilogik?></td>
                        <td><?= $conditions->virusologik_TE_KE?></td>
                        <td><?= $conditions->virusologik_XM_KK?></td>
                        <td><?= $conditions->biologik?></td>
                        <td><?= $conditions->RA_KR?></td>
                        <td><?= $conditions->RSK?></td>
                        <td><?= $conditions->RDSK?></td>
                        <td><?= $conditions->RBP?></td>
                        <td><?= $conditions->RMA?></td>
                        <td><?= $conditions->RP_RDP?></td>
                        <td><?= $conditions->RH?></td>
                        <td><?= $conditions->RNGA?></td>
                        <td><?= $conditions->RGKA?></td>
                        <td><?= $conditions->RGA?></td>
                        <td><?= $conditions->IFA?></td>
                        <td><?= $conditions->IXLA?></td>
                        <td><?= $conditions->boshqa_serologiya?></td>
                        <td><?= $conditions->PSR?></td>
                        <td><?= $conditions->gistologiya?></td>
                        <td><?= $conditions->gemotologiya?></td>
                        <td><?= $conditions->koprologiya?></td>
                        <td><?= $conditions->kimyoviy?></td>
                        <td><?= $conditions->biokimyoviy?></td>
                        <?php
                        $cnt = 0;
                        $sum = 0;
                        $n=0;
                        foreach ($conditions->getAttributes() as $key=>$item){
                            $n++;
                            if($n>17){
                                if($item != 0){
                                    $cnt++;
                                    $sum += intval($item);
                                }
                            }
                        }
                        ?>
                        <td><?= $conditions->ads?></td>
                        <td><?= $cnt?></td>


                    </tr>
                </tbody>
            </table>
        </div>
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

    <?php }?>

    <?php if($model->status_id == 4){?>

        <?= Html::a('Rad etish', ['leader/declineanimal', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
    <?php }?>
</div>
