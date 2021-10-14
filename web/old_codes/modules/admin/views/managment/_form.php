<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Managment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="managment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


        <div class="form-group field-managment-minestory-type">
            <label class="control-label" for="managment-minestory-type">Республика бошқарув органи турини</label>
            <select id="managment-minestory-type" class="form-control select2-list">
                <option value="">Республика бошқарув органи турини танланг</option>
                <?php $data = \app\models\MinestoryType::find()->all();
                    foreach($data as $item):
                ?>
                        <option value="<?= $item->id?>"><?= $item->name?></option>
                <?php endforeach;?>
            </select>

            <div class="help-block"></div>
        </div>

        <?= $form->field($model, 'minestory_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Minestory::find()->all(),'id','name'),['class'=>'form-control select2-list','prompt'=>'Республика бошыармасини танланг']) ?>

        <?= $form->field($model, 'complex_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Complex::find()->all(),'id','name'),['class'=>'form-control select2-list','prompt'=>'Комплексни танланг']) ?>

        <?= $form->field($model, 'country_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Country::find()->all(),'id','name')) ?>

        <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Region::find()->where(['country_id'=>\app\models\Country::find()->one()->id])->all(),'id','name'),['class'=>'form-control select2-list','prompt'=>'Вилоятни танланг']) ?>

        <?= $form->field($model, 'district_id')->dropDownList([],['class'=>'form-control select2-list','prompt'=>'Туманни танланг']) ?>

    </div>

    <div class="col-md-6">

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

    <?php $data = [];
    foreach (\app\models\User::find()->all() as $item){
        $data[$item->id] = $item->name;
    }?>


    <?= $form->field($model, 'director_id')->dropDownList($data) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'Актив',0=>'Деактив']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сақлаш' : 'Сақлаш', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $urlMT = Yii::$app->urlManager->createUrl(['admin/minestory/getmin']);
    $urlDS = Yii::$app->urlManager->createUrl(['admin/district/getdis']);
    $this->registerJs("
        $('#managment-minestory-type').change(function(){
            $.get('{$urlMT}?id='+$('#managment-minestory-type').val()).done(function(data){
                $('#managment-minestory_id').empty();
                $('#managment-minestory_id').append(data);
                $('#managment-minestory_id').trigger('change');
            })
        })
        $('#managment-region_id').change(function(){
            $.get('{$urlDS}?id='+$('#managment-region_id').val()).done(function(data){
                $('#managment-district_id').empty();
                $('#managment-district_id').append(data);
                $('#managment-district_id').trigger('change');
            })
        })
    ");
?>