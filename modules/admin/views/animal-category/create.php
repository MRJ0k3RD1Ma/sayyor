<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalCategory */

$this->title = Yii::t('app', 'Create Animal Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Animal Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
