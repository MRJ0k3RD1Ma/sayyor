<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vaccines */

$this->title = Yii::t('cp.vaccines', 'Vaksina qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.vaccines', 'Vaksinalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vaccines-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
