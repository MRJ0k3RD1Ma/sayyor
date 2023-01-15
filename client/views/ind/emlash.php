<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Vaccination */
/* @var $animal common\models\Animals */

$this->title = Yii::t('cp.animals', 'Davolash: {name}', [
    'name' => $animal->type->name_uz,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animals', 'Hayvonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $animal->type->name_uz, 'url' => ['view', 'id' => $animal->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.animals', 'Davolash');
?>
<div class="animals-update">

    <h1><?= Html::encode($this->title) ?></h1>


        <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'antibiotic')->textInput() ?>

        <?= $form->field($model, 'emlash_date')->textInput(['type'=>'date']) ?>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('cp.animals', 'Saqlash'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
