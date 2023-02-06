<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Samples */
/* @var $result common\models\ResultAnimal */
/* @var $test common\models\ResultAnimalTests */

$this->title = $model->sample->samp_code.' '.Yii::t('cp','sonli oziq-ovqat havfsizligi bo`yicha namuna raqami');
$this->params['breadcrumbs'][] = ['label' => Yii::t('food', 'Namunalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="samples-view">

    <div class="row">
        <div class="row">
            <div class="col-md-6">
                <h3>Topshiriq ma'lumotlari</h3>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [

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
                        'samp_code',

                        [
                            'attribute'=>'category_id',
                            'value'=>function($d){
                                $lg = Yii::$app->language=='ru' ?'ru':'uz';
                                return $d->category->{'name_'.$lg};
                            }
                        ],
                        [
                            'attribute'=>'food_id',
                            'value'=>function($d){
                                $lg = Yii::$app->language=='ru' ?'ru':'uz';
                                return $d->food->{'name_'.$lg};
                            }
                        ],
                        [
                            'attribute'=>'unit_id',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->unit->{'name_'.$lg};
                            }
                        ],
                        'count',
                        [
                            'attribute'=>'sample_box_id',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->sampleBox->{'name_'.$lg};
                            }
                        ],
                        [
                            'attribute'=>'sample_condition_id',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->sampleCondition->{'name_'.$lg};
                            }
                        ],
                        'total_amount',
                        'producer',
                        'serial_num',
                        'manufacture_date',
                        'sell_by',
                        'coments',
                        [
                            'attribute'=>'_country',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->country->{'name_'.$lg};
                            }
                        ],
                        [
                            'attribute'=>'laboratory_test_type_id',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->laboratoryTestType->{'name_'.$lg};
                            }
                        ],
                        [
                            'label' => 'Namunani qabul qilgan hodim',
                            'attribute' => 'emp_id',
                            'value' => function ($d) {
                                return @$d->emp->name;

                            }
                        ],
//                    'repeat_code',
                    ],
                ]) ?>
            </div>
        </div>
    </div>



    <?php if($model->status_id == 2 or $model->status_id == 6){?>
        <div class="row">
            <div>
                <h3 style="float: left">Natija ma'lumotlari</h3>
                <a href="<?= Yii::$app->urlManager->createUrl(['/lab/sendfood','id'=>$model->id])?>" class="btn btn-primary" style="float:right"><?= Yii::t('lab','Natijalarni yuborish')?></a>
            </div>
            <?php $form = ActiveForm::begin()?>


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


                            <td><?= $form->field($item,'['.$item->id.']result_type_id')->dropDownList($result_type,['prompt'=>'Normativga mosligi'])?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?= $form->field($conditions,'ads')->dropDownList([0=>Yii::t('lab','Tasdiqlandi'),1=>Yii::t('lab','Tasdiqlanmadi')],['prompt'=>'Umumiy natijani tanlang'])?>


            </div>

            <h4>O`tkazilgan tekshiruv 4VET uchun</h4>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($conditions,'organoleptik')->checkbox(['value'=>1])?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($conditions,'mikroskopik')->checkbox(['value'=>1])?>

                </div>
                <div class="col-md-2">
                    <?= $form->field($conditions,'mikrobiologik')->checkbox(['value'=>1])?>

                </div>
                <div class="col-md-2">
                    <?= $form->field($conditions,'kimyoviy')->checkbox(['value'=>1])?>

                </div>
                <div class="col-md-2">
                    <?= $form->field($conditions,'radiologik')->checkbox(['value'=>1])?>

                </div>
                <div class="col-md-2"></div>
            </div>
            <button type="submit" class="btn btn-success"><?= Yii::t('lab','Saqlash')?></button>

            <?php ActiveForm::end()?>

            <h3  style="margin-top:20px;">Tavfsiya qo'shish:</h3>
            <?php $f = ActiveForm::begin()?>

            <?= $f->field($recom,'name')->textInput()?>

            <button class="btn btn-primary">Tavfsiyani saqlash</button>
            <?php ActiveForm::end()?>
            <h3  style="margin-top:20px;">Tavfsiyalar ro'yhati:</h3>
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <?php $rec = \common\models\FoodRecomendation::find()->where(['sample_id'=>$sample->id])->all();

                        foreach ($rec as $item):
                            ?>
                            <li><?= $item->name?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>


        </div>
    <?php } else{?>

    <div class="row">
        <div>
            <h3 style="float: left">Natija ma'lumotlari</h3>
        </div>
        <?php $form = ActiveForm::begin()?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($conditions, 'temprature')->textInput(['type' => 'number','disabled'=>true]) ?>

                <?= $form->field($conditions, 'humidity')->textInput(['type' => 'number','disabled'=>true]) ?>

                <?= $form->field($conditions, 'reagent_series')->textInput(['disabled'=>true]) ?>

                <?= $form->field($conditions, 'reagent_name')->textInput(['disabled'=>true]) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($conditions, 'conditions')->textInput(['disabled'=>true]) ?>

                <?= $form->field($conditions, 'end_date')->textInput(['type' => 'date','disabled'=>true]) ?>
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
                        <td><?= $item->template_id ?></td>
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


                        <td>
                            <?= $form->field($item,'['.$item->id.']result_type_id')->dropDownList($result_type,['prompt'=>'Normativga mosligi','disabled'=>true])?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $form->field($conditions,'ads')->dropDownList([0=>Yii::t('lab','Tasdiqlandi'),1=>Yii::t('lab','Tasdiqlanmadi')],['disabled'=>true])?>


        </div>

        <?php ActiveForm::end()?>
    </div>

        <h3  style="margin-top:20px;">Tavfsiyalar ro'yhati:</h3>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <?php $rec = \common\models\FoodRecomendation::find()->where(['sample_id'=>$sample->id])->all();
                    foreach ($rec as $item):
                        ?>
                        <li><?= $item->name?></li>
                    <?php endforeach;?>
                </ul>
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
            $('#resultfoodtests-'+id+'-result').prop('disabled',false);
            $('#resultfoodtests-'+id+'-result_2').prop('disabled',false);
            $('#resultfoodtests-'+id+'-is_change').prop('disabled',false);
        }else{
            $('#tr-'+id).css('background','#e9e9ef');
            $('#resultfoodtests-'+id+'-result').prop('disabled',true);
            $('#resultfoodtests-'+id+'-result_2').prop('disabled',true);
            if($('#resultfoodtests-is_change').is(':checked')){
                $('#resultfoodtests-'+id+'-is_change').prop('disabled',true);
            }
        }
    })
      
    $('#resultfoodconditions-is_change').change(function(){
        
        if($('#resultfoodconditions-is_change').is(':checked')){
            $('#resultfoodconditions-why_change').prop('disabled',false);
            $('.checkboxok').each(function(){
                 var id = this.getAttribute('data-id');
                 if(this.checked){
                     $('#resultfoodtests-'+id+'-is_change').prop('disabled', false)
                 }
            });
        }else{
            $('#resultfoodconditions-why_change').prop('disabled',true);
            $('.unitresult.false').css('display','none');
            $('.unitresult.true').css('display','block');
            $('.checkboxok').each(function(){
                 var id = this.getAttribute('data-id');
                 $('#resultfoodtests-'+id+'-is_change').prop('disabled', true)
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