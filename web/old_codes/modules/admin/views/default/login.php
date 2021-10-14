<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    var statuschanger = function(){
        return 1;
    }
    var resetform = function(){
        return 1;
    }
</script>

<div class="middle-box text-center loginscreen  animated fadeInDown" >
    <div >
        <div>

        </div>
        <h3>Admin panelga kirish</h3>
        <?php if(\app\models\Admin::find()->count()!=0){?>

        <p>Login parollaringizni kiriting.</p>
                <?php $form = ActiveForm::begin([
                    'options'=>[
                      'class'=>'m-t'
                    ],
                ]); ?>


                <div class="form-group">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>


                <?php ActiveForm::end(); ?>




<?php }else{?>

       <?= $this->render('_reg',['model'=>new \app\models\Admin()]) ?>



        <?php }?>
    </div>

</div>