<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Requirements */

$this->title = Yii::t('cp', 'Oziq-ovqat ekspertizasi talablarini yaratish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Oziq-ovqat ekspertizasi talablari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = "Yaratish";
?>
<div class="requirements-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
