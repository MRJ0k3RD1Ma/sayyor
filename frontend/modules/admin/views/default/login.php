<?php
use yii\widgets\ActiveForm;
$this->title = Yii::t('login',"Tizimga kirish");
/* @var $model \common\models\LoginForm*/
?>

<div class="login-page">
    <div class="login">
        <div class="logos">
            <div class="img">
                <img src="/design/assets/images/vet.png" alt="img" style="float: right; width: 50px;" class="img-responsive">
            </div>
            <div class="text">
                <?= Yii::t('login','Hayvon kasalliklari tashhisi va oziq-ovqat xavfsizligiga oid laboratoriya tekshiruvlari Yagona elektron ma\'lumotlar bazasini yurishish tizimi (VIS-Sayyor)')?>
            </div>

        </div>
        <div class="login-form">
            <h3><?= Yii::t('login','Tizimga kirish')?></h3>
            <p><?= Yii::t('login','Boshqaruv tizimiga xush kelibsiz!')?></p>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "{input}",
                ],
            ]); ?>
            <div class="form">
                <div class="input">
                    <span class="far fa-user"></span>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true,'class'=>'','placeholder'=>Yii::t('login','Email')]) ?>

                </div>
                <div class="input">
                    <span class="fas fa-lock"></span>
                    <?= $form->field($model, 'password')->passwordInput(['class'=>'','placeholder'=>Yii::t('login','Parol')]) ?>
                </div>
                <div class="sign">
                    <div>



                <button class="btn btn-primary"><?= Yii::t('login','Kirish')?> </button>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end()?>
        </div>
        <div class="logos">
            <div class="img">
                <img src="/design/assets/images/bank.jpg" alt="img" style="float: right; width: 50px;" class="img-responsive">
            </div>
            <div class="text"><?= Yii::t('login','Axborot tizimini yaratish Yevropa Ittifoqi tomonidan moliyalashtirilgan')?></div>

        </div>



    </div>


</div>


<style>
    .sign{
        display: flex;
        justify-content: flex-end;
    }
    .sign button{
        text-transform: capitalize;
    }
    .sign div{
        display: inline-block;
    }
    .login-form .form{
        width: 100%;
    }
    .login-form .form .input{
        width: 100%;
        position: relative;

    }
    .logos .text{
        font-size: 18px;
        color: black;
    }
    .login-form .form .input input{
        padding-left: 50px;
        font-size: .96rem;
        font-weight: 400;
        line-height: 1.25;
        color: #4e5154;
        background-color: transparent !important;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 5px

    }
    .login-form .form .input input:focus{
        outline: none;
    }
    .login-form .form .input span{
        top: 50%;
        transform: translate(-50%, -50%);
        left: 30px;
        position: absolute;
        font-size: 20px;

    }
    .login-page{
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
    .login{
        margin-top: 100px;
        width: 700px;

    }
    .logos{
        display: flex;
        align-items: center;
        margin-bottom: 50px;

    }
    .logos .img{
        width: 100px;
        margin-right: 20px;
    }
    .logos .img img{
        width: 100px !important;
        object-fit: cover;
    }
    .login-form{
        margin-bottom: 50px;
        padding: 20px;
        background: #fff;
        text-align: center;
    }

</style>