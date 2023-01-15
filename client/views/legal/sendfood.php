<?php
use yii\widgets\ActiveForm;
/* @var $model \common\models\Sertificates*/
/* @var $reg \common\models\SampleRegistration*/
/* @var $sample \common\models\Samples*/
    $this->title = $model->code.' '.Yii::t('client','sonli dalolatnoma uchun ariza yozish');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin()?>

                <?php
                $lang = Yii::$app->language;
                if($lang == 'ru'){
                    $ads = 'ru';
                    $lg = 'ru';
                }elseif($lang=='oz'){
                    $ads = 'cyr';
                    $lg = 'uz';
                }else{
                    $lg = 'uz';
                    $ads = 'lot';
                }
                ?>

                <?= $form->field($reg, 'research_category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ResearchCategory::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('client','Tekshiruv turi')])?>

                <?= $form->field($reg, 'is_research')->checkbox(['value'=>1])?>

                <?= $form->field($reg,'organization_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->where(['type_id'=>1])->all(),'id','NAME_FULL'),['prompt'=>Yii::t('client','Labaratoriyani tanlang'),'class'=>'form-control select2list']) ?>

                <?= $form->field($reg,'sender_name')?>

                <?= $form->field($reg,'sender_phone')?>

                <button type="submit" class="btn btn-success">Arizani jo'natish</button>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs("
    $(document).ready(function(){
        $('#foodregistration-sender_phone').inputmask('(99)-999-9999'); 
    })
    
")
?>