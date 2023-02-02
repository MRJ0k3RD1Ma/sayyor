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
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar'), 'url' => ['regtest']];
$this->params['breadcrumbs'][] = ['label' => $reg->code, 'url' => ['regview', 'id' => $reg->id]];
$this->params['breadcrumbs'][] = $this->title
?>
    <div class="sertificates-update">
        <h4><?= $model->samp_code ?> namunaning topshiriqlari ro'yhati <span style="float:right"><a href="<?= Yii::$app->urlManager->createUrl(['/register/incomefood','id'=>$model->id,'regid'=>$reg->id])?>" class="btn btn-primary">Yana topshiriq qo'shish</a></span></h4>
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
                <?php $n=0; foreach (\common\models\FoodRoute::find()->where(['sample_id'=>$model->id])->all() as $item): $n++?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->leader->name ?></td>
                        <td><?= $item->status->name_uz?></td>
                        <td>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomefood','id'=>$model->id,'regid'=>$reg->id,'route_id'=>$item->id])?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>




        <?php if($route_id != -1){
            echo $this->render('incomefood/_change',[
                'model'=>$model,
                'route'=>$route,
                'cs'=>$cs,
                'result'=>$result,
                'template'=>$template,
                'director'=>$director,
                'lider'=>$lider_all,
                'reg'=>$reg,
                'director_id'=>$director_id
            ]);
        }else{
            echo $this->render('incomefood/_new',[
                'model'=>$model,
                'route'=>$route,
                'cs'=>$cs,
                'result'=>$result,
                'template'=>$template,
                'director'=>$director,
                'lider'=>$lider,
                'reg'=>$reg,
                'director_id'=>$director_id
            ]);
        }?>





    </div>
