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
/* @var $model common\models\TemplateAnimalRegulations */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="tamplate-animal-form">
        <div class="row">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model,'type_id')->dropDownList(ArrayHelper::map($regs,'id','name_uz'),['prompt'=>'Hayvon turini tanlang','class'=>'form-control select2list'])->label('Hayvon turlari')?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
