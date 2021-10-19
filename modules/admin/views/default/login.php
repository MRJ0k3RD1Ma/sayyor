<?php
use yii\widgets\ActiveForm;

/* @var $model \app\models\LoginForm*/
?>
<div class="container" id="container">
    <div class="form-container sign-in-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>"Э-Аҳоли"</h1>
                <p>Хоразм вилояти ҳокимлигининг маҳаллабай аҳоли - оилалар, аёллар ва ёшлар билан ишлаш бўйича <u><big>аҳборот
                            тизими</big></u></p>
            </div>
        </div>
    </div>
    <div class="overlay-container">

        <?php $form = ActiveForm::begin()?>

            <h1>Тизимга кириш</h1>
            <span><p>"Э-Аҳоли" ахборот тизимига кириш учун логин ва парольни киритинг.</p></span>
            <span>маълумотларни киритинг</span>

            <?= $form->field($model,'email')->textInput(['autofocus' => true,'placeholder'=>$model->getAttributeLabel('email')])->label(false) ?>

            <?= $form->field($model,'password')->passwordInput(['placeholder'=>$model->getAttributeLabel('password')])->label(false) ?>

            <button type="submit" class="btn btn-primary" name="login-button">Тасдиқлаш</button>

        <?php ActiveForm::end()?>
    </div>
</div>
