<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */

$this->title = Yii::t('cp', 'Create Sample Registration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Sample Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-registration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
