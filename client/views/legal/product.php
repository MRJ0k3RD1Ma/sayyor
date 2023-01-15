<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamplingCertificate */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('client','Oziq-ovqat ekspertizasi bo\'yicha dalolatnoma qo\'shish');
?>

    <div class="food-sampling-certificate-form">

        <?php $form = ActiveForm::begin(); ?>


        <?php
        $lang = Yii::$app->language;
        $lg = 'uz';
        if($lang == 'ru'){
            $ads = 'ru';
            $lg = 'ru';
        }elseif($lang=='oz'){
            $ads = 'cyr';
        }else{
            $ads = 'lot';
        }
        ?>
        <?= $form->field($model,'sert_number')->textInput()?>
        <?= $form->field($model,'sert_date')->textInput(['type'=>'date'])?>


        <h3>Mahsulot egasi</h3>



        <?= $form->field($model, 'ownertype')->radioList([1=>Yii::t('reg','Jismoniy shaxs'),2=>Yii::t('reg','Yuridik shaxs')])->label(false) ?>

        <div id="indiv" style="padding-left: 10px; border-left: 1px solid #f0f0f0;">
            <?= $form->field($ind, 'passport')->textInput(['maxlength' => true]) ?>

            <?= $form->field($ind, 'pnfl')->textInput(['maxlength' => 14,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');",'required'=>true]) ?>

            <?= $form->field($ind, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($ind, 'surname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($ind, 'middlename')->textInput(['maxlength' => true]) ?>

            <?php if($ind->soato_id){
                $ind->region  = $ind->soato->region_id;
                $ind->district = $ind->soato->district_id;
                ?>
                <?= $form->field($ind, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

                <?= $form->field($ind, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$ind->soato->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>
                <?= $form->field($ind, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\QfiView::find()->where(['district_id'=>$ind->soato->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
            <?php }else{ ?>
                <?= $form->field($ind, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

                <?= $form->field($ind, 'district')->dropDownList([],['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>
                <?= $form->field($ind, 'soato_id')->dropDownList([],['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
            <?php }?>

            <?= $form->field($ind, 'adress')->textInput(['maxlength' => true]) ?>


        </div>

        <div id="legdiv" style="padding-left: 10px; border-left: 1px solid #f0f0f0; display: none;">
            <?= $form->field($legal,'inn')->textInput(['maxlength' => 9,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');",'required'=>false])?>
            <?= $form->field($legal,'name')->textInput()?>
            <?= $form->field($legal,'tshx_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tshx::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('test','Tashkiliy huquqiy shakli')])?>
            <?php if($legal->soato_id){
                $legal->region  = $legal->soato->region_id;
                $legal->district = $legal->soato->district_id;
                ?>
                <?= $form->field($legal, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

                <?= $form->field($legal, 'district')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$legal->soato->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>

                <?= $form->field($legal, 'soato_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\QfiView::find()->where(['district_id'=>$legal->soato->district_id])->all(),'MHOBT_cod','name_'.$ads),['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
            <?php }else{ ?>
                <?= $form->field($legal, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

                <?= $form->field($legal, 'district')->dropDownList([],['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>
                <?= $form->field($legal, 'soato_id')->dropDownList([],['prompt'=>Yii::t('cp.individuals','QFYni tanlang')]) ?>
            <?php }?>

            <?= $form->field($legal, 'soogu')->textInput(['maxlength' => true]) ?>
        </div>

        <h3>Namuna olish joyi</h3>

        <?php if($model->sampling_site){

            $model->region  = $model->samplingSite->soato0->region_id;
            $model->district = $model->samplingSite->soato0->district_id;

            ?>
            <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

            <?= $form->field($model, 'sampling_soato')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\DistrictView::find()->where(['region_id'=>$model->samplingSite->soato0->region_id])->all(),'district_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
            <?= $form->field($model, 'sampling_site')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VetSites::find()->filterWhere(['like','soato',$model->samplingSite->soato0->region_id.$model->samplingSite->soato0->district_id])->all(),'id','name'),['prompt'=>Yii::t('cp.vetsites','Vet uchstkani tanlang')]) ?>

        <?php }else{ ?>
            <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.vetsites','Viloyatni tanlang')]) ?>

            <?= $form->field($model, 'sampling_soato')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','Tumanni tanlang')]) ?>
            <?= $form->field($model, 'sampling_site')->dropDownList([],['prompt'=>Yii::t('cp.vetsites','Vet uchstkani tanlang')]) ?>

        <?php }?>

        <?= $form->field($model, 'sampling_adress')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sampling_date')->textInput(['type'=>'date']) ?>

        <?= $form->field($model, 'verification_pupose_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\VerificationPurposes::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('cp.individuals','Tekshirishdan maqsadni tanlang')]) ?>

        <?= $form->field($model, 'based_public_information')->dropDownList([0=>'Yo\'q',1=>'Ha']) ?>

        <?= $form->field($model, 'message_number')->textInput() ?>
        <h3>Namuna olgan shaxs</h3>
        <?= $form->field($model, 'sampler_name')->textInput() ?>

        <?= $form->field($model, 'sampler_position')->textInput() ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('cp.food_sampling_certificate', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/site/get-qfi']);
$url_vetsites = Yii::$app->urlManager->createUrl(['/site/get-vet']);
$this->registerJs("
        $('#foodsamplingcertificate-region').change(function(){
            $.get('{$url_district}?id='+$('#foodsamplingcertificate-region').val()).done(function(data){
                $('#foodsamplingcertificate-sampling_soato').empty();
                $('#foodsamplingcertificate-sampling_soato').append(data);
            })        
        })
        $('#foodsamplingcertificate-sampling_soato').change(function(){
            $.get('{$url_vetsites}?id='+$('#foodsamplingcertificate-sampling_soato').val()+'&regid='+$('#foodsamplingcertificate-region').val()).done(function(data){
                $('#foodsamplingcertificate-sampling_site').empty();
                $('#foodsamplingcertificate-sampling_site').append(data);
            })        
        })
        
    ")
?>




<?php
$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/site/get-qfi']);
$url_pnfl = Yii::$app->urlManager->createUrl(['/site/get-ind']);
$url_inn = Yii::$app->urlManager->createUrl(['/site/get-inn']);

$this->registerJs("
        $('#individuals-region').change(function(){
            $.get('{$url_district}?id='+$('#individuals-region').val()).done(function(data){
                $('#individuals-district').empty();
                $('#individuals-district').append(data);
            })        
        })
        $('#individuals-district').change(function(){
            $.get('{$url_qfi}?id='+$('#individuals-district').val()+'&regid='+$('#individuals-region').val()).done(function(data){
                $('#individuals-soato_id').empty();
                $('#individuals-soato_id').append(data);
            })        
        })
        
       $('#legalentities-region').change(function(){
            $.get('{$url_district}?id='+$('#legalentities-region').val()).done(function(data){
                $('#legalentities-district').empty();
                $('#legalentities-district').append(data);
            })        
        })
        $('#legalentities-district').change(function(){
            $.get('{$url_qfi}?id='+$('#legalentities-district').val()+'&regid='+$('#legalentities-region').val()).done(function(data){
                $('#legalentities-soato_id').empty();
                $('#legalentities-soato_id').append(data);
            })        
        })
        
        $('#foodsamplingcertificate-ownertype input[type=radio]').change(function(){
            
            if(this.value==1){
                   $('#individuals-pnfl').prop('required',true);
                   $('#legalentities-inn').prop('required',false);
                   $('#legdiv').css('display','none');
                   $('#indiv').css('display','block');
            }else{
                   $('#individuals-pnfl').prop('required',false);
                   $('#legalentities-inn').prop('required',true);
                   $('#indiv').css('display','none');
                   $('#legdiv').css('display','block');
            }
        })
        
        
        $('#individuals-pnfl').keyup(function(){
            if($('#individuals-pnfl').val().length == 14 && $('#individuals-passport').val().length==9){
                $.get('{$url_pnfl}?pnfl='+$('#individuals-pnfl').val()+'&doc='+$('#individuals-passport').val()).done(function(data){
                    data = JSON.parse(data);
                    $('#individuals-name').val(data.value.name);
                    $('#individuals-surname').val(data.value.surname);
                    $('#individuals-middlename').val(data.value.middlename);
                    $('#individuals-passport').val(data.value.passport);
                    $('#individuals-adress').val(data.value.adress);
                    if(data.soato_id!=-1){
                        $('#individuals-region').val(data.value.region_id).trigger('change');
                        setInterval(function () {
                           if($('#individuals-district').val()){clearInterval();}
                           else{
                            $('#individuals-district').val(data.value.district_id).trigger('change');
                           }
                        }, 500);
                        setInterval(function () {
                           if($('#individuals-soato_id').val()){clearInterval();}
                           else{
                            $('#individuals-soato_id').val(data.value.soato_id);
                           }
                        }, 500);
                    }
                   
                })
            }
        })
        
        $('#individuals-passport').keyup(function(){
            if($('#individuals-pnfl').val().length == 14 && $('#individuals-passport').val().length==9){
                $.get('{$url_pnfl}?pnfl='+$('#individuals-pnfl').val()+'&doc='+$('#individuals-passport').val()).done(function(data){
                    data = JSON.parse(data);
                    $('#individuals-name').val(data.value.name);
                    $('#individuals-surname').val(data.value.surname);
                    $('#individuals-middlename').val(data.value.middlename);
                    $('#individuals-passport').val(data.value.passport);
                    $('#individuals-adress').val(data.value.adress);
                    if(data.soato_id!=-1){
                        $('#individuals-region').val(data.value.region_id).trigger('change');
                        setInterval(function () {
                           if($('#individuals-district').val()){clearInterval();}
                           else{
                            $('#individuals-district').val(data.value.district_id).trigger('change');
                           }
                        }, 500);
                        setInterval(function () {
                           if($('#individuals-soato_id').val()){clearInterval();}
                           else{
                            $('#individuals-soato_id').val(data.value.soato_id);
                           }
                        }, 500);
                    }
                   
                })
            }
        })
        
        
        $('#legalentities-inn').keyup(function(){
            if($('#legalentities-inn').val().length==9){
                $.get('$url_inn?inn='+$('#legalentities-inn').val()).done(function(data){
                    if(data != -1){
                        data = JSON.parse(data);
                        $('#legalentities-name').val(data.value.name);
                        $('#legalentities-soogu').val(data.value.soogu);
                        $('#legalentities-tshx_id').val(data.value.tshx_id);
                        $('#legalentities-region').val(data.value.region).trigger('change');
                        setInterval(function () {
                           if($('#legalentities-district').val().length > 0){clearInterval();}
                           else{
                            $('#legalentities-district').val(data.value.district).trigger('change');
                           }
                        }, 500);
                        setInterval(function () {
                           if($('#legalentities-soato_id').val().length>0){clearInterval();}
                           else{
                            $('#legalentities-soato_id').val(data.value.soato_id);
                           }
                        }, 500);
                    }
                })
            }
        })
    ")
?>

