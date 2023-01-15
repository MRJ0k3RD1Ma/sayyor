<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TamplateAnimal */

$this->title = Yii::t('app', 'Hayvon kasalliklari tashhisini yangilash: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hayvon kasalliklari tashhisi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Yangilash   ');
?>
<div class="tamplate-animal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
