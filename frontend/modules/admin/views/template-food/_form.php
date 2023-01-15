<?php

use common\models\TemplateFoodRegulations;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateFood */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-food-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'food_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>
    <?php
    $res = TemplateFoodRegulations::find()->select(['regulation_id'])->where(['template_id' => $model->id])->all();
    $arr = [];
    foreach ($res as $item) {
        $arr[] = $item->regulation_id;
    }
    ?>
    <?= $form->field($model, 'regulations[]')->widget(Select2::class,
        [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Regulations::find()->asArray()->all(), 'id', 'name_uz'),
            'theme' => Select2::THEME_KRAJEE,
            'size' => \kartik\base\BootstrapInterface::SIZE_MEDIUM,
            'value' => $arr,
            'options' => [
                'multiple' => true
            ]
        ])->label(Yii::t('cp', 'Normativ hujjatlar'));
        $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
    ?>
    <?= $form->field($model, 'unit_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\TemplateUnit::find()->all(),'id','name_'.$lg),['prompt'=>'Birlikni tanlang']) ?>


    <div class="isfalse" style="display: none">

        <?= $form->field($model, 'min_1')->textInput(['maxlength' => true]) ?>

        <div class="oraliq" style="display: none">

            <?= $form->field($model, 'min_2')->textInput(['maxlength' => true]) ?>

        </div>

        <?= $form->field($model, 'max_1')->textInput(['maxlength' => true]) ?>

        <div class="oraliq" style="display: none">

            <?= $form->field($model, 'max_2')->textInput(['maxlength' => true]) ?>

        </div>

    </div>

    <div class="istrue" style="display: none">

        <?= $form->field($model, 'true_1')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>

        <?= $form->field($model, 'true_2')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>

    </div>

    <div class="ismm" style="display:  none">

        <?= $form->field($model, 'mm_1')->dropDownList(Yii::$app->params['unit_belgi']) ?>
        <?= $form->field($model, 'mm_2')->dropDownList(Yii::$app->params['unit_belgi']) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$url = Yii::$app->urlManager->createUrl(['/cp/template-animal/gettype']);
// minimal va maksimallarni aniqlashtirib ishlash kerak
$this->registerJs("
    $('#templatefood-unit_id').change(function(){
//         alert($('#tamplateanimal-unit_id').val());
           $.get('{$url}?id='+$('#templatefood-unit_id').val()).done(function(data){
              $('.oraliq').css('display','none');
              $('.istrue').css('display','none');
              $('.ismm').css('display','none');
              $('.isfalse').css('display','none');
              if(data==4){
                  $('.isfalse').css('display','block');
                  $('.oraliq').css('display','block');
                  $('.ismm').css('display','none');
                  $('.istrue').css('display','none');
              }else if(data==2){
                  $('.oraliq').css('display','none');
                  $('.isfalse').css('display','none');
                  $('.ismm').css('display','none');
                  $('.istrue').css('display','block');
              }else if(data==5){
                  $('.oraliq').css('display','none');
                  $('.isfalse').css('display','none');
                  $('.ismm').css('display','block');
                  $('.istrue').css('display','none');
              }else{
                  $('.oraliq').css('display','none');
                  $('.istrue').css('display','none');
                   $('.ismm').css('display','none');
                  $('.isfalse').css('display','block');
              }
          })
    })
")

?>