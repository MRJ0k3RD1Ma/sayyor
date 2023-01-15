<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodGroup */

$this->title = Yii::t('cp', 'Guruh qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Parametr guruhlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-group-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
