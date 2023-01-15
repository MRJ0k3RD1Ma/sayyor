<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model common\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = Yii::t('client','Ariza berish');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fruit">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group field-individuals-soato_id has-success">
                            <label class="control-label" for="type">Ariza turi</label>
                            <select id="type" name="type" class="form-control" aria-invalid="false">
                                <option value="">Ariza turini tanlang</option>
                                <option value="animal">Hayvon kasalliklari tashhisi</option>
                                <option value="product">Oziq-ovqat ekspertizasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Shakllantirish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
