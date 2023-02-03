<?php

use common\models\SampleStatus;
use common\models\SampleTypes;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sertificates */
/* @var $animal common\models\Animals */
/* @var $sample common\models\Samples */
/* @var $reg common\models\SampleRegistration */

$this->title = Yii::t('cp.sertificates', 'Namunalarni qabul qilish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar'), 'url' => ['regproduct']];
$this->params['breadcrumbs'][] = ['label' => $reg->code, 'url' => ['regproductview', 'id' => $reg->id]];
$this->params['breadcrumbs'][] = $this->title
?>
    <div class="sertificates-update">

        <h4><?php foreach ($samples as $item){echo $item->samp_code.', '; }?> <?= Yii::t('register', 'Raqamli namunalar bo`yicha topshiriqlar ro`yhati') ?>
            <span style="float:right"><a href="<?= Yii::$app->urlManager->createUrl(['/register/incomeproductmulti','id'=>$reg->id])?>" class="btn btn-primary">Yana topshiriq qo'shish</a></span>
        </h4>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Mudir nomi</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $n=0; foreach (\common\models\FoodRoute::find()->where(['registration_id'=>$reg->id,'is_group'=>1])->orderBy('leader_id')->groupBy(['leader_id'])->all() as $item): $n++?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->leader->name ?></td>
                        <td><?= $item->status->name_uz?></td>
                        <td>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomeproductmulti','id'=>$reg->id,'leader_id'=>$item->leader_id])?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>





        <?php if($leader_id){

            echo $this->render('incomemultifood/_change',[
                'model'=>$model,
                'route'=>$route,
                'cs'=>$cs,
                'result'=>$result,
                'template'=>$template,
                'director'=>$director,
                'lider'=>$lider_all,
                'reg'=>$reg,
                'leader_id'=>$leader_id,
                'director_id'=>$director_id,
                'samples'=>$samples
            ]);
        }else{
            echo $this->render('incomemultifood/_new',[
                'model'=>$model,
                'route'=>$route,
                'cs'=>$cs,
                'result'=>$result,
                'template'=>$template,
                'director'=>$director,
                'lider'=>$lider,
                'reg'=>$reg,
                'director_id'=>$director_id,
                'samples'=>$samples
            ]);
        }?>








    </div>


<?php
$val = json_encode(ArrayHelper::map(SampleTypes::find()->all(),'id','vet4'));
$this->registerJs("
    $('#routesert-sample_type_id').change(function(){
        var val = '{$route->vet4}';
        var vet4 = JSON.parse('{$val}');
        $('#routesert-vet4').val(val+vet4[$('#routesert-sample_type_id').val()]);
    });
    $('#compositesamples-sample_status_id').change(function(){
        if($('#compositesamples-sample_status_id').val() == 1){
            $('#templates_choose').css('display','block');
        }else{
            $('#templates_choose').css('display','none')        
        }
    })
")
?>