<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = Yii::t('cp.roles', 'Huquq qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.roles', 'Foydalanuvchi huquqlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
