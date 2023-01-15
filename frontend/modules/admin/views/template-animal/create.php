<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TamplateAnimal */

$this->title = Yii::t('cp', 'Shablon qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Hayvon kasalliklari tashhisi shablonlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tamplate-animal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
