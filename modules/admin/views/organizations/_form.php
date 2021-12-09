<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_from_api',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'TIN')->textInput(['length'=>9]) ?>

    <?= $form->field($model, 'NA1_CODE',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'NS10_CODE',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'NS11_CODE',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'NAME_FULL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REG_DATE')->textInput() ?>

    <?= $form->field($model, 'DATE_TIN')->textInput() ?>

    <?= $form->field($model, 'REG_NUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NS13_CODE',['options'=>['hidden'=>true]])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TELEFON')->textInput() ?>

    <?= $form->field($model, 'TELEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FAX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GD_FULL_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GD_TIN')->textInput() ?>

    <?= $form->field($model, 'GD_TEL_WORK')->textInput() ?>

    <?= $form->field($model, 'GD_TEL_HOME')->textInput() ?>

    <?= $form->field($model, 'GD_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GB_FULL_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GB_TIN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GB_TEL_WORK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GB_TEL_HOME')->textInput(['maxlength' => true,]) ?>

    <?= $form->field($model, 'OKED')->textInput() ?>

    <?= $form->field($model, 'OKPO')->textInput() ?>

    <?= $form->field($model, 'OKONX')->textInput() ?>

    <?= $form->field($model, 'soato')->textInput() ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_END',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'CREATED',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'CHANGED',['options'=>['hidden'=>true]])->textInput() ?>

    <?= $form->field($model, 'GD_MOBILE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BUDJET')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$url = Yii::$app->urlManager->createUrl(['/cp/organizations/getyur']);
$this->registerJs("
    $('#organizations-tin').keyup(function(){
        if($('#organizations-tin').val().length==9){
            $.get('{$url}?inn='+$('#organizations-tin').val()).done(function(data){
                if(data==-1){
                    alert('Bunday INN topilmadi')
                }else{
                    data = JSON.parse(data);
                    $('#organizations-id_from_api').val(data.data.id);
                    $('#organizations-na1_code').val(data.data.NA1_CODE);
                    $('#organizations-ns10_code').val(data.data.NS10_CODE);
                    $('#organizations-ns11_code').val(data.data.NS11_CODE);
                    $('#organizations-name_full').val(data.data.NAME_FULL);
                    $('#organizations-address').val(data.data.ADDRESS);
                    $('#organizations-reg_date').val(data.data.REG_DATE);
                    $('#organizations-date_tin').val(data.data.DATE_TIN);
                    $('#organizations-reg_num').val(data.data.REG_NUM);
                    $('#organizations-ns13_code').val(data.data.NS13_CODE);
                    $('#organizations-telefon').val(data.data.TELEFON);
                    $('#organizations-telex').val(data.data.TELEX);
                    $('#organizations-fax').val(data.data.FAX);
                    $('#organizations-gd_full_name').val(data.data.GD_FULL_NAME);
                    $('#organizations-gd_tin').val(data.data.GD_TIN);
                    $('#organizations-gd_tel_work').val(data.data.GD_TEL_WORK);
                    $('#organizations-gd_tel_home').val(data.data.GD_TEL_HOME);
                    $('#organizations-gd_email').val(data.data.GD_EMAIL);
                    $('#organizations-db_full_name').val(data.data.GB_FULL_NAME);
                    $('#organizations-gb_tin').val(data.data.GB_TIN);
                    $('#organizations-gb_tel_work').val(data.data.GB_TEL_WORK);
                    $('#organizations-gb_tel_home').val(data.data.GB_TEL_HOME);
                    $('#organizations-oked').val(data.data.OKED);
                    $('#organizations-okpo').val(data.data.OKPO);
                    $('#organizations-okonx').val(data.data.OKONX);
                    $('#organizations-soato').val(data.data.soato);
                    $('#organizations-email').val(data.data.EMAIL);
                    $('#organizations-date_end').val(data.data.DATE_END);
                    $('#organizations-created').val(data.data.CREATED);
                    $('#organizations-changed').val(data.data.CHANGED);
                    $('#organizations-gb_mobile').val(data.data.GD_MOBILE);
                    $('#organizations-budget').val(data.data.BUDJET);
                    if(data.data.BUDJET==1){
                        $('#organizations-budjet').prop( \"checked\", true );
                    }
                }
            })
        }
    })
")
?>