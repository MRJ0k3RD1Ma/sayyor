<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FoodCategory */

$this->title = Yii::t('cp', 'Kategoriya qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Oziq-ovqat kategoriyalari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
