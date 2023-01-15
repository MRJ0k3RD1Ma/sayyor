<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodRegistration */

$this->title = Yii::t('cp', 'Create Food Registration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Food Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-registration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
