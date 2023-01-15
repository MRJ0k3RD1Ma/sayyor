<?php
use yii\widgets\ActiveForm;
/* @var $model \common\models\ResultsConformity*/

$this->title = Yii::t('food', 'Yangi sertifikat qo`shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('food', 'Sertifikatlar ro\'yhati'), 'url' => ['sert']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin()?>

                <?= $form->field($model,'name')->textInput()?>

                <?= $form->field($model,'code')->textInput()?>


                <button class="btn btn-success" type="submit">Saqlash</button>
                <?php ActiveForm::end()?>

            </div>
        </div>
    </div>
</div>