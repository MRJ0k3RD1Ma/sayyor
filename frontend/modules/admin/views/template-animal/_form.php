<?php

use common\models\Animaltype;
use common\models\Diseases;
use common\models\Regulations;
use common\models\StateList;
use common\models\TemplateAnimalRegulations;
use common\models\TemplateUnit;
use common\models\TestMethod;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TamplateAnimal */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="tamplate-animal-form">
        <div class="row">
            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

            <?php
                $data = [];
                foreach (Diseases::find()->all() as $item){
                    $data[$item->id] = $item->vet4.'-'.$item->name_uz;
                }
            ?>
            <?= $form->field($model, 'diseases_id')->dropDownList($data) ?>
            <?php
            $res = TemplateAnimalRegulations::find()->select(['regulation_id'])->where(['template_id' => $model->id])->all();
            $arr = [];
            foreach ($res as $item) {
                $arr[] = $item->regulation_id;
            }
            ?>
            <?php if($model->isNewRecord){?>
            <?= $form->field($model, 'regulations[]')->widget(Select2::class,
                [
                    'data' => ArrayHelper::map(Regulations::find()->asArray()->all(), 'id', 'name_uz'),
                    'theme' => Select2::THEME_KRAJEE,
                    'size' => Select2::SIZE_MEDIUM,
                    'value' => $arr,
                    'options' => [
                        'multiple' => true
                    ]
                ])->label(Yii::t('cp', 'Normativ hujjatlar'))

            ?>
                <?php $data = [];
                    foreach (\common\models\SampleTypes::find()->all() as $item){
                        $data[$item->id] = $item->vet4.'-'.$item->name_uz;
                    }
                ?>
                <?= $form->field($model, 'types[]')->widget(Select2::class,
                    [
                        'data' => $data,
                        'theme' => Select2::THEME_KRAJEE,
                        'size' => Select2::SIZE_MEDIUM,
                        'value' => $arr,
                        'options' => [
                            'multiple' => true
                        ]
                    ])->label(Yii::t('cp', 'Proba turlari'))

                ?>
                <?php $data = [];
                foreach (\common\models\Animaltype::find()->all() as $item){
                    $data[$item->id] = $item->vet4.'-'.$item->name_uz;
                }
                ?>
                <?= $form->field($model, 'animals[]')->widget(Select2::class,
                    [
                        'data' => $data,
                        'theme' => Select2::THEME_KRAJEE,
                        'size' => Select2::SIZE_MEDIUM,
                        'value' => $arr,
                        'options' => [
                            'multiple' => true
                        ]
                    ])->label(Yii::t('cp', 'Hayvon turlari'))

                ?>
            <?php }?>
            <?= $form->field($model, 'test_method_id')->dropDownList(
                ArrayHelper::map(TestMethod::find()->asArray()->all(), 'id', 'name_uz')
            ) ?>


            <?= $form->field($model, 'unit_id')->dropDownList(
                ArrayHelper::map(TemplateUnit::find()->asArray()->all(), 'id', 'name_uz'),
                ['prompt'=>'Birlikni tanlang']
            ) ?>

            <div class="isfalse" style="display: <?php $type = @$model->unit->type_id;  if($type == 1 or $type==3 or $type == 4){echo "block";}else{echo "none";}?>">

                <?= $form->field($model, 'min')->textInput(['maxlength' => true]) ?>

                <div class="oraliq" style="display: <?= $type==4?'block':'none'?>">

                    <?= $form->field($model, 'min_1')->textInput(['maxlength' => true]) ?>

                </div>

                <?= $form->field($model, 'max')->textInput(['maxlength' => true]) ?>

                <div class="oraliq" style="display: none">

                    <?= $form->field($model, 'max_1')->textInput(['maxlength' => true]) ?>

                </div>

            </div>

            <div class="istrue" style="display:  <?= $type==2?'block':'none'?>">

                <?= $form->field($model, 'true')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>
                <?= $form->field($model, 'true1')->dropDownList([0 => 'Yo\'q', 1 => 'Ha']) ?>

            </div>

            <div class="ismm" style="display:  <?= $type==5?'block':'none'?>">

                <?= $form->field($model, 'mm_1')->dropDownList(Yii::$app->params['unit_belgi']) ?>
                <?= $form->field($model, 'mm_2')->dropDownList(Yii::$app->params['unit_belgi']) ?>

            </div>


            <?= $form->field($model, 'is_vaccination')->dropDownList([0 => 'Yo\'q', 1 => 'Ha', 2 => 'Baribir']) ?>

            <?= $form->field($model, 'dead_days')->textInput(['type' => 'number']) ?>

            <!--Tasdiqlovchi kiritish keyinroq Abduraxmon aytgan roldagi odamga beriladi-->

            <?= $form->field($model, 'state_id')->dropDownList(
                ArrayHelper::map(StateList::find()->asArray()->all(), 'id', 'name')
            ) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <style>
        .oraliq {
            display: block;
        }
    </style>
<?php
$url = Yii::$app->urlManager->createUrl(['/cp/template-animal/gettype']);
// minimal va maksimallarni aniqlashtirib ishlash kerak
$this->registerJs("
    $('#tamplateanimal-unit_id').change(function(){
//         alert($('#tamplateanimal-unit_id').val());
          $.get('{$url}?id='+$('#tamplateanimal-unit_id').val()).done(function(data){
              $('.oraliq').css('display','none');
              $('.istrue').css('display','none');
              $('.isfalse').css('display','block');
              $('.ismm').css('display','none');
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