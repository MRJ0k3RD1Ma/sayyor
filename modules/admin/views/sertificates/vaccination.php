<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Vaccination */
/* @var $animal app\models\Animals */

$this->title = Yii::t('cp.animals', 'Emlash: {name}', [
    'name' => $animal->type->name_uz,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animals', 'Hayvonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $animal->type->name_uz, 'url' => ['view', 'id' => $animal->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.animals', 'Emlash');
?>
<div class="animals-update">

    <h1><?= Html::encode($this->title) ?></h1>


        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'disease_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Diseases::find()->all(),'id','name_uz'),['prompt'=>Yii::t('cp.animals','Kasallikni talang')]) ?>

        <?= $form->field($model, 'disease_date')->textInput(['type'=>'date']) ?>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('cp.animals', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
