<?php

use common\models\Countres;
use common\models\FoodType;
use common\models\LaboratoryTestType;
use common\models\SampleBoxes;
use common\models\SampleConditions;
use common\models\Units;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FoodSamples */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('food', 'Namuna qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('food', 'Namunalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="food-samples-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php
        $lang = Yii::$app->language;
        $lg = 'uz';
        if ($lang == 'ru') {
            $ads = 'ru';
            $lg = 'ru';
        } elseif ($lang == 'uz') {
            $ads = 'lot';
        } else {
            $ads = 'cyr';
        }
        ?>


        <?= $form->field($model,'category_id')->dropDownList(ArrayHelper::map(\common\models\FoodCategory::find()->all(),'id','name_'.$lg),['prompt'=>Yii::t('client','Mahsulot kategoriyasini tanlang')])?>

        <?= $form->field($model,'food_id')->dropDownList([],['prompt'=>Yii::t('client','Mahsulot guruhini tanlang')])?>

        <?= $form->field($model, 'unit_id')->dropDownList(ArrayHelper::map(Units::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('client', 'Mahsulot birligini tanlang')]) ?>

        <?= $form->field($model, 'count')->textInput() ?>

        <?= $form->field($model, 'sample_box_id')->dropDownList(ArrayHelper::map(SampleBoxes::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('client', 'Namuna o\'ramini tanlang')]) ?>
        <?= $form->field($model, '_country')->dropDownList(
            ArrayHelper::map(Countres::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('client', 'Davlatni tanlang'),'class'=>'form-control select2list']) ?>

        <?= $form->field($model, 'sample_condition_id')->dropDownList(ArrayHelper::map(SampleConditions::find()->all(), 'id', 'name_' . $lg), [
            'prompt' => Yii::t('client', 'Namuna holatini tanlang')
        ]) ?>

        <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'verification_sample')->radioList([
            0 => Yii::t('client', 'Tanlanmagan'),
            1 => Yii::t('client', 'Tanlangan'),
        ]) ?>

        <?= $form->field($model, 'producer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'serial_num')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'manufacture_date')->textInput(['type' => 'date']) ?>

        <?= $form->field($model, 'sell_by')->textInput(['type' => 'date']) ?>

        <?= $form->field($model, 'coments')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'laboratory_test_type_id')->dropDownList(ArrayHelper::map(LaboratoryTestType::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('client', 'Laboratoriya test turini tanlang')]) ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('food', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$url = Yii::$app->urlManager->createUrl(['/site/getfood']);
$this->registerJs("
        $('#foodsamples-category_id').change(function(){
            $.get('{$url}?id='+$('#foodsamples-category_id').val()).done(function(data){
                $('#foodsamples-food_id').empty();
                $('#foodsamples-food_id').append(data);
            })
        })
    ")

?>