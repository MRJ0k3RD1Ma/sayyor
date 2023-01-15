<?php
use yii\widgets\ActiveForm;

/* @var $ind \common\models\Individuals*/
?>
<?php $form = ActiveForm::begin([

]); ?>
<div class="input">
    <?= $form->field($ind, 'passport')->textInput(['placeholder'=>Yii::t('login','Pasport seriya raqami'),'disabled'=>true]) ?>
</div>

<div class="input">
    <?= $form->field($ind, 'pnfl')->textInput(['placeholder'=>Yii::t('login','JSH SHIR(PINFL)'),'disabled'=>true]) ?>
</div>
<div class="input">
    <?= $form->field($ind, 'name')->textInput(['placeholder'=>Yii::t('login','Ism'),'disabled'=>true]) ?>
</div>
<div class="input">
    <?= $form->field($ind, 'surname')->textInput(['placeholder'=>Yii::t('login','Familya'),'disabled'=>true]) ?>
</div>
<div class="input">
    <?= $form->field($ind, 'middlename')->textInput(['placeholder'=>Yii::t('login','Otasining ismi'),'disabled'=>true]) ?>
</div>

<div class="input">
    <?= $form->field($ind, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_lot')) ?>
</div>

<div class="input">

    <?= $form->field($ind, 'district')->dropDownList([]) ?>
</div>

<div class="input">

    <?= $form->field($ind, 'soato_id')->dropDownList([]) ?>
</div>
<div class="input">
    <?= $form->field($ind, 'adress')->textInput(['placeholder'=>Yii::t('login','Manzil')]) ?>
</div>


<div class="sign">
    <div>
        <button type="submit" class="btn btn-primary"><?= Yii::t('login','Saqlash')?> </button>
    </div>
</div>
<?php ActiveForm::end()?>
<?php
$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_qfi = Yii::$app->urlManager->createUrl(['/site/get-qfi']);
    $this->registerJs("
         $('#individuals-region').change(function(){
            $.get('{$url_district}?id='+$('#individuals-region').val()).done(function(data){
                $('#individuals-district').empty();
                $('#individuals-district').append(data);
            })        
        });
        $('#individuals-district').change(function(){
            $.get('{$url_qfi}?id='+$('#individuals-district').val()+'&regid='+$('#individuals-region').val()).done(function(data){
                $('#individuals-soato_id').empty();
                $('#individuals-soato_id').append(data);
            })        
        });
    ")
?>