<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationType */

$this->title = Yii::t('cp', 'Tashkilot turi qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Tashkilot turlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-type-create">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
