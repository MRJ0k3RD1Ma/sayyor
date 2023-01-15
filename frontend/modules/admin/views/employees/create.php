<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = Yii::t('cp', 'Foydalanuvchi qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Foydalanuvchilar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', [
                    'model' => $model,
                    'org'=>$org,
                ]) ?>
            </div>
        </div>
    </div>
</div>