<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = 'Oziq-ovqat qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Oziq-ovqatlar guruhlari ro\'yhati', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
