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

    <?php $form = ActiveForm::begin(); ?>

    <?= $model->kod ?> <?= Yii::t('register', 'Raqamli namunani qabul qilish') ?>
    <?php
    $lg = 'uz';
    if (Yii::$app->language == 'ru') {
        $lg = 'ru';
    }
    $data = [];
    foreach (SampleTypes::find()->all() as $item){
        $data[$item->id] = $item->vet4.' - '.$item->{'name_'.$lg};
    }
    ?>

    <?= $form->field($route, 'vet4')->textInput(['disabled'=>true]) ?>
    <?php if($route->isNewRecord and $model->is_group == 0){ ?>
    <?= $form->field($cs, 'sample_status_id')->dropDownList(ArrayHelper::map(SampleStatus::find()->all(), 'id', 'name_' . $lg)) ?>

    <?= $form->field($cs, 'ads')->textInput() ?>

    <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang')]) ?>

    <?= $form->field($route, 'leader_id')->dropDownList(ArrayHelper::map($lider, 'id', 'name'), ['prompt' => Yii::t('test', 'Labaratoriya mudirini tanlang')]) ?>
    <?php }else{ ?>

        <?= $form->field($cs, 'sample_status_id')->dropDownList(ArrayHelper::map(SampleStatus::find()->all(), 'id', 'name_' . $lg),['disabled'=>true]) ?>

        <?= $form->field($cs, 'ads')->textInput(['disabled'=>true]) ?>

        <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang'),'disabled'=>true]) ?>

        <?= $form->field($route, 'leader_id')->dropDownList(ArrayHelper::map($lider, 'id', 'name'), ['prompt' => Yii::t('test', 'Labaratoriya mudirini tanlang'),'disabled'=>true]) ?>

    <?php }?>

    <div class="table-responsive">
        <h4>Tanlangan shablonlar ro'yhati</h4>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Parametr nomi</th>
                <th>Birlik</th>
                <th>Minimal-maksimal oraliq</th>
                <th>Emlashga aloqadorligi</th>
            </tr>
            </thead>
            <tbody>
            <?php if($result){ foreach ($result->tests as $item): ?>
                <tr>
                    <td><?= $item->id?></td>
                    <td><?= $item->template->name_uz?></td>
                    <td><?= $item->template->unit->name_uz?></td>
                    <td>
                        <?php if ($item->template->unit->type_id == 1) { ?>
                            <?= $item->template->min.'-'.$item->template->max ?>
                        <?php } elseif ($item->template->unit->type_id == 2) { ?>
                            <?= Yii::$app->params['result'][intval($item->template->min)].'-'.Yii::$app->params['result'][intval($item->template->max)]?>
                        <?php } elseif ($item->template->unit->type_id == 3) { ?>
                            <?= $item->template->min.'-'.$item->template->max ?>

                        <?php } elseif ($item->template->unit->type_id == 4) { ?>
                            <?= $item->template->min.'-'.$item->template->max ?><br>
                            <?= $item->template->min_1.'-'.$item->template->max_1 ?>
                        <?php } elseif($item->template->unit->type_id == 5){?>
                            <?= Yii::$app->params['unit_belgi'][intval($item->template->min)].'-'.Yii::$app->params['unit_belgi'][intval($item->template->max)]?>

                        <?php } ?>
                    </td>

                    <td><?php
                        if($item->template->is_vaccination != 0) $item->template->is_vaccination=1;
                        echo Yii::$app->params['is_vaccination'][$item->template->is_vaccination] . '<br>';
                        if ($item->template->is_vaccination == 1) {
                            if ($item->template->dead_days <= 0) {
                                echo Yii::t('lab', 'Doimiy');
                            } else {
                                echo $item->template->dead_days . ' ' . Yii::t('lab', 'Kun');
                            }
                        }
                        ?></td>

                </tr>
            <?php endforeach; }?>
            </tbody>
        </table>
    </div>

    <?php if($model->is_group == 0 and !$route->executor_id){?>
    <div class="table-responsive" id="templates_choose">
        <h4>Shablonlarni tanlash</h4>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Parametr nomi</th>
                    <th>Birlik</th>
                    <th>Minimal-maksimal oraliq</th>
                    <th>Emlashga aloqadorligi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($template as $item): ?>
                <tr>
                    <td><?= $form->field($route,'temp['.$item->id.']')->checkbox(['value'=>1])->label(false)?></td>
                    <td><?= $item->id?></td>
                    <td><?= $item->name_uz?></td>
                    <td><?= $item->unit->name_uz?></td>
                    <td>
                    <?php if ($item->unit->type_id == 1) { ?>
                        <?= $item->min.'-'.$item->max ?>
                    <?php } elseif ($item->unit->type_id == 2) { ?>
                        <?= Yii::$app->params['result'][intval($item->min)].'-'.Yii::$app->params['result'][intval($item->max)]?>
                    <?php } elseif ($item->unit->type_id == 3) { ?>
                        <?= $item->min.'-'.$item->max ?>

                    <?php } elseif ($item->unit->type_id == 4) { ?>
                        <?= $item->min.'-'.$item->max ?><br>
                        <?= $item->min_1.'-'.$item->max_1 ?>
                    <?php } elseif($item->unit->type_id == 5){?>
                        <?= Yii::$app->params['unit_belgi'][intval($item->min)].'-'.Yii::$app->params['unit_belgi'][intval($item->max)]?>

                    <?php } ?>
                    </td>

                    <td><?php
                        if($item->is_vaccination != 0) $item->is_vaccination=1;
                        echo Yii::$app->params['is_vaccination'][$item->is_vaccination] . '<br>';
                        if ($item->is_vaccination == 1) {
                            if ($item->dead_days <= 0) {
                                echo Yii::t('lab', 'Doimiy');
                            } else {
                                echo $item->dead_days . ' ' . Yii::t('lab', 'Kun');
                            }
                        }
                        ?></td>

                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php }?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('cp.sertificates', 'Saqlash'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


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