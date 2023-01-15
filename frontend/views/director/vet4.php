<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \common\models\Vet4 */

$ads = 'lot';
$lang = Yii::$app->language;
if($lang == 'uz'){
    $ads = 'lot';
}elseif($lang=='ru'){
    $ads = 'ru';
}else{
    $ads = 'cyr';
}
if($type == 'animal'){
    $this->title = Yii::t('food', 'Hayvon kasalliklari tashxisi bo`yicha o`tkazilgan tekshiruvlar hisoboti');
}else{
    $this->title = Yii::t('food', 'Oziq-ovqat ekspertizasi bo`yicha o`tkazilgan tekshiruvlar hisoboti');
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                <?php $form = \yii\widgets\ActiveForm::begin()?>

                <?= $form->field($model,'date_to')->textInput(['type'=>'date'])?>

                <?= $form->field($model,'date_do')->textInput(['type'=>'date'])?>

                <?php if(false){?>
                <?= $form->field($model,'country')->dropDownList([17=>'O\'zbekiston Respublikasi'])?>

                <?= $form->field($model, 'region')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\RegionsView::find()->all(),'region_id','name_'.$ads),['prompt'=>Yii::t('cp.individuals','Viloyatni tanlang')]) ?>

                <?= $form->field($model, 'district')->dropDownList([],['prompt'=>Yii::t('cp.individuals','Tumanni tanlang')]) ?>

                <?= $form->field($model,'org')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Organizations::find()->where(['type_id'=>1])->all(),'id','NAME_FULL'),['prompt'=>'Tashkilotni tanlang'])?>

        <?php } ?>
                <button type="submit" class="btn btn-success">Hisbotni shakllantirish</button>
                <?php \yii\widgets\ActiveForm::end()?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$url_district = Yii::$app->urlManager->createUrl(['/site/get-district']);
$url_vet = Yii::$app->urlManager->createUrl(['/site/get-vet']);
$this->registerJs("
        $('#vet4-region').change(function(){
            $.get('{$url_district}?id='+$('#vet4-region').val()).done(function(data){
                $('#vet4-district').empty();
                $('#vet4-district').append(data);
            })        
        })");
?>