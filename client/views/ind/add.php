<?php

use common\models\AnimalCategory;
use common\models\Animaltype;
use common\models\Diseases;
use common\models\RegionsView;
use common\models\SampleBoxes;
use common\models\SampleTypes;
use common\models\TestMethod;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sertificates */
/* @var $animal common\models\Animals */
/* @var $sample common\models\Samples */
/* @var $reg common\models\SampleRegistration */

$this->title = Yii::t('cp.sertificates', 'Namuna qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Dalolatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sert_id, 'url' => ['view', 'sert_id' => $model->sert_id]];
$this->params['breadcrumbs'][] = Yii::t('cp.sertificates', 'Hayvon qo\'shish');
?>
<div class="sertificates-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($sample, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sample, 'sample_type_is')->dropDownList(ArrayHelper::map(SampleTypes::find()->all(), 'id', 'name_uz'), ['prompt' => 'Namuna turini tanlang']) ?>

    <?= $form->field($sample, 'sample_box_id')->dropDownList(ArrayHelper::map(SampleBoxes::find()->all(), 'id', 'name_uz'), ['prompt' => 'Namuna o\'ramini tanlang']) ?>

    <?= $form->field($animal, 'bsual_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'pnfl')->textInput(['maxlength' => true]) ?>


    <?= $form->field($animal, 'name')->textInput(['maxlength' => true]) ?>


    <?php
    $lang = Yii::$app->language;
    if ($lang == 'ru') {
        $ads = 'ru';
        $lg = 'ru';
    } elseif ($lang == 'oz') {
        $ads = 'cyr';
        $lg = 'uz';
    } else {
        $lg = 'uz';
        $ads = 'lot';
    }
    ?>

    <?= $form->field($animal, 'type_id')->dropDownList(ArrayHelper::map(Animaltype::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('cp.animals', 'Hayvon turini tanlang')]) ?>
    <?= $form->field($animal, 'cat_id')->dropDownList(ArrayHelper::map(AnimalCategory::find()->all(), 'id', 'name_' . $lg), ['prompt' => Yii::t('cp.animals', 'Hayvon holatini tanlang')]) ?>

    <?= $form->field($animal, 'gender')->dropDownList([
        1 => Yii::t('cp.animals', 'Erkak'),
        0 => Yii::t('cp.animals', 'Urg\'ochi')
    ]) ?>

    <?= $form->field($animal, 'birthday')->textInput(['type' => 'date']) ?>

    <?= $form->field($animal, 'adress')->textInput(['maxlength' => true]) ?>


    <?= $form->field($animal, 'region')->dropDownList(ArrayHelper::map(RegionsView::find()->all(), 'region_id', 'name_' . $ads), ['prompt' => Yii::t('client', 'Viloyatni tanlang')]) ?>
    <?= $form->field($animal, 'district')->dropDownList([]) ?>

    <?= $form->field($animal, 'vet_site_id')->dropDownList([]) ?>

    <?= $form->field($sample, 'test_mehod_id')->dropDownList(ArrayHelper::map(TestMethod::find()->all(), 'id', 'name_uz'), ['prompt' => 'Tahlil usulini tanlang']) ?>


    <?= $form->field($sample, 'suspected_disease_id')->dropDownList(ArrayHelper::map(Diseases::find()->all(), 'id', 'name_uz'), ['prompt' => 'Kasallik turini tanlang', 'class' => 'form-control select2list']) ?>

    <?= $form->field($sample, 'repeat_code')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificates', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
<?php
$url = Yii::$app->urlManager->createUrl(['/site/getbirka']);
$this->registerJs("
    $('#animals-bsual_tag').keyup(function(){
        if($('#animals-bsual_tag').val().length == 12){
            $.get('{$url}?id='+$('#animals-bsual_tag').val()).done(function(data){
              
                data = JSON.parse(data);
                if(data.code.result=='2200'){
                       
                    $('#animals-birthday').val(new Date(data.data.birth).toISOString().substring(0,10));
                    $('#animals-inn').val(data.data.tin);
                    $('#animals-type_id').val(data.data.type);
                    $('#animals-gender').val(data.data.sex);
                    $('#animals-adress').val(data.data.address);
                    $('#animals-name').val(data.data.owner);
                    $('#animals-inn').val(data.data.tin);
                }
            })
        }
    })
")
?>


<?php
$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_vet = Yii::$app->urlManager->createUrl(['/site/get-vet']);
$this->registerJs("
        $('#animals-region').change(function(){
            $.get('{$url_district}?id='+$('#animals-region').val()).done(function(data){
                $('#animals-district').empty();
                $('#animals-district').append(data);
            })        
        })
       
        
        $('#animals-district').change(function(){
            $.get('{$url_vet}?id='+$('#animals-district').val()+'&regid='+$('#animals-region').val()).done(function(data){
                $('#animals-vet_site_id').empty();
                $('#animals-vet_site_id').append(data);
            })        
        })
        
      
    ")
?>


