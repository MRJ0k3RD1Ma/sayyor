<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LaboratoryTestType */

$this->title = Yii::t('cp.laboratory_test_type', 'Labaratoriya tadqiqot turi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.laboratory_test_type', 'Laboratoriya tadqiqot turi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-test-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
