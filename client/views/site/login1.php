<?php

use yii\widgets\ActiveForm;

$this->title = Yii::t('login', "Tizimga kirish");
/* @var $model \client\models\InnForm */
/* @var $ind \common\models\Individuals */
/* @var $legal \common\models\LegalEntities */
?>

<div class="login-page">
    <div class="login">
        <div class="logos">
            <div class="img">
                <img src="/design/assets/images/vet.png" alt="img" style="float: right; width: 50px;"
                     class="img-responsive">
            </div>
            <div class="text">
                <?= Yii::t('login', 'Hayvon kasalliklari tashhisi va oziq-ovqat xavfsizligiga oid laboratoriya tekshiruvlari Yagona elektron ma\'lumotlar bazasini yurishish tizimi (VIS-Sayyor)') ?>
            </div>

        </div>

        <div class="login-form">
            <h3><?= Yii::t('login', 'ERI orqali kirish') ?></h3>
            <p><?= Yii::t('login', 'Boshqaruv tizimiga xush kelibsiz!') ?></p>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "{input}",
                ],
                'options' => ['id' => 'loginform']
            ]); ?>

            <div id="wait-loading" class="preloader" style="display: none;">
            </div>
            <div id="every-thing-ok" style="display: block; width: 100%">
                <div class="input">
                    <div class="form-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" style="text-align: left" type="button" id="dropdownMenu1"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Kalitingizni tanlang
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" role="menu">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <a class="btn btn-success sign-in" href="#" onclick="authorize();" role="button"><i class="fa fa-sign-in"></i>Kirish</a>
                </div>

            </div>



            <div id="not-installed" style="display: none; margin-top: -30px;">

                <p class="h4">
                                    <span style="display: block; line-height: 26px">
                                        Tizimni to’g’ri ishlashi uchun <i>E-IMZO</i> <sup> (30 Мегабайт)</sup> modulini yoki <i>E-IMZO Brauzerini</i> <sup> (60 Мегабайт)</sup> o’rnatish kerak.
                                    </span>
                    <a style="background-color: rgba(253, 255, 255, 0.7); margin: 5px 0;" class="btn btn-default btn-xs"
                       href="https://e-imzo.uz/main/downloads/" role="button">
                        <i class="fa fa-download"></i>
                        E-IMZO dasturini kuchirib olish
                    </a> <br>
                    <strong>
                        <font size="-1">
                            DIQQAT ! E-IMZO modulni administrator nomidan o’rnating.
                        </font>
                    </strong>
                </p>

                <p></p>
            </div>


            <?php ActiveForm::end() ?>
        </div>
        <div class="logos">
            <div class="img">
                <img src="/design/assets/images/bank.jpg" alt="img" style="float: right; width: 50px;"
                     class="img-responsive">
            </div>
            <div class="text"><?= Yii::t('login', 'Axborot tizimini yaratish Yevropa Ittifoqi tomonidan moliyalashtirilgan') ?></div>

        </div>


    </div>


</div>


<style>

    .sign {
        display: flex;
        justify-content: flex-end;
    }

    .sign button {
        text-transform: capitalize;
    }

    .sign div {
        display: inline-block;
    }

    .login-form .form {
        width: 100%;
    }

    .login-form .form .input {
        width: 100%;
        position: relative;

    }

    .logos .text {
        font-size: 18px;
        color: black;
    }

    .login-form .form .input input {
        padding-left: 50px;
        font-size: .96rem;
        font-weight: 400;
        line-height: 1.25;
        color: #4e5154;
        background-color: transparent !important;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 5px

    }

    .login-form .form .input input:focus {
        outline: none;
    }

    .login-form .form .input span {
        top: 50%;
        transform: translate(-50%, -50%);
        left: 30px;
        position: absolute;
        font-size: 20px;

    }

    .login-page {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        height: 100vh;
        background: #cfd2e1;
        justify-content: center;
        background: url("/design/assets/images/background.jpg") no-repeat;
        background-size: cover;
    }

    .login {
        margin-top: 100px;
        width: 700px;

    }

    .logos {
        display: flex;
        align-items: center;
        margin-bottom: 50px;

    }

    .logos .img {
        width: 100px;
        margin-right: 20px;
    }

    .logos .img img {
        width: 100px !important;
        object-fit: cover;
    }

    .login-form {
        margin-bottom: 50px;
        padding: 20px;
        background: #fff;
        text-align: center;
    }

</style>


<script type="text/javascript">
    var clientDomain = 'my.soliq.uz';
    var clientId = 'AF62C3CF91F3596E';
    var scope = 'key-info certificate-info contact-info';
    var redir = 'http://my.soliq.uz/main/auth/callback';
    var state = '{"auth_state_random":"21367107","user_type":"2","context":"/","lang":"uz"}';
    var lang = 'uz';
    var captchaMode = false;
    var errorCAPIWS = 'Ошибка соединения с E-IMZO. Возможно у вас не установлен модуль E-IMZO или Браузер E-IMZO.';
    var errorBrowserWS = 'Браузер не поддерживает технологию WebSocket. Установите последнюю версию браузера.';
    var errorEnterCaptcha = 'Raqamlarni kiriting';
    var errorEnterCode = 'Kodni kiriting';
    var errorCaptchaMismatch = 'Rasmdagi raqamlar noto`g`ri kiritilgan';
    var errorNotRegistered = 'Siz ro`yxatdan o`tmagansiz. "Ro`yxatdan o`tish" tugmasini bosing.';
    var errorWrongPassword = 'Parol noto`g`ri.';
    var errorWrongCode = 'Kod noto`g`ri.';
    var errorNotActive = 'Ваша учетная запись не активирована.';
    var errorCertNotActive = 'Ваш сертификат ключа не активен.';
    var errorCookieProblem = 'Данные Cookie не переданы. Включите поддержку cookies в настройках вашего браузера.';
    var errorCertNotVerified = 'Не удалось определить издателя сертификата.';
    var errorCertPolicyIsInvalid = 'Ruxsat etilmagan.';
    var errorAccessCodeNotFound = 'Код не найден. Повторите попытку.';
    var errorSmsIsNotSent = 'Ошибка при отправке SMS сообщения. Повторите попытку.';
    var errorTryLater = 'Пожалуйста, обновите страницу и повторите попытку позже.';
    var errorCorrectTime = 'Пожалуйста, установите правильную дату и время на Вашем компьютере.';

    var notifyRenewKey = 'Sizning ERI kalitingiz muddati tugashiga <b>{}</b> kun qoldi. Yangi ERI kalitini DSI ga bormasdan bu yerda olishi mumkin:<br><a class="renew-link" target="_blank" href="https://e-imzo.uz/">https://e-imzo.uz/</a><br/><a target="_blank" href="https://e-imzo.uz/manuals/get_own_key.pdf">Qo`llanma</a>';


    var warnPasswordChanged = 'Yangi parol o`rnatildi.';
    var warnBeforePasswordChanged = 'DIQQAT ! Kalitingizni parolini o`zgartirsangiz va uni esingizdan chiqarsangiz, parolni tiklash funktsiyasi yordam bermaydi.';

    var EIMZO_MAJOR = 3;
    var EIMZO_MINOR = 27;
    var uc=Math.random().toString();
    var errorUpdateApp = '<p class="h4"><strong>ВНИМАНИЕ !!!</strong> <br />Установите новую версию приложения E-IMZO или Браузера E-IMZO.<br /><a style="background-color: rgba(253, 255, 255, 0.7); margin: 5px 0;" class="btn btn-default btn-xs" href="https://e-imzo.uz/main/downloads/" role="button">Скачать ПО E-IMZO</a><br /><strong>ВАЖНО !!!</strong> Установите приложение от имени Администратора</p>';

</script>