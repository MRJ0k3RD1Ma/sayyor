<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sertificates */

$this->title = Yii::t('cp.sertificates', 'Dalolatnoma qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Dalolatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
