<?php
use yii\widgets\ActiveForm;
use common\models\SampleTypes;
use yii\helpers\ArrayHelper;
use common\models\SampleStatus;
use yii\helpers\Html;
?>




<?php $form = ActiveForm::begin(); ?>

<?= $model->samp_code ?> <?= Yii::t('register','Raqamli namunani qabul qilish')?>
<?php
$lg = 'uz';
if(Yii::$app->language == 'ru'){
    $lg = 'ru';
}
?>

<?php if($route->isNewRecord and $model->is_group == 0){?>
    <?= $form->field($cs,'status_id')->dropDownList(ArrayHelper::map(SampleStatus::find()->all(),'id','name_'.$lg))?>

    <?= $form->field($cs,'ads')->textInput()?>

    <?php if($director_id != -1){ $route->director_id = $director_id;?>
        <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang'),'disabled'=>true]) ?>
    <?php }else{?>
        <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang')]) ?>
    <?php }?>

    <?= $form->field($route,'leader_id')->dropDownList(ArrayHelper::map($lider,'id','name'),['prompt'=>Yii::t('test','Labaratoriya mudirini tanlang')])?>
<?php }else{ ?>
    <?= $form->field($cs,'status_id')->dropDownList(ArrayHelper::map(SampleStatus::find()->all(),'id','name_'.$lg),['disabled'=>true])?>

    <?= $form->field($cs,'ads')->textInput(['disabled'=>true])?>

    <?= $form->field($route,'director_id')->dropDownList(ArrayHelper::map($director,'id','name'),['disabled'=>true,'prompt'=>Yii::t('test','Direktorni tanlang')])?>

    <?= $form->field($route,'leader_id')->dropDownList(ArrayHelper::map($lider,'id','name'),['disabled'=>true,'prompt'=>Yii::t('test','Labaratoriya mudirini tanlang')])?>

<?php } ?>

<div class="table-responsive">
    <h4>Tanlangan shablonlar ro'yhati</h4>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Parametr nomi</th>
            <th>Birlik</th>
            <th>Minimal-maksimal oraliq</th>
        </tr>
        </thead>
        <tbody>
        <?php if($result){ foreach ($result->tests as $item): ?>
            <tr>
                <td><?= $item->template->name_uz?></td>
                <td><?= $item->template->unit->name_uz?></td>
                <td>
                    <?php if ($item->template->unit->type_id == 1) { ?>
                        <?= $item->template->min_1.'-'.$item->template->max_1 ?>
                    <?php } elseif ($item->template->unit->type_id == 2) { ?>
                        <?= Yii::$app->params['result'][intval($item->template->min_1)].'-'.Yii::$app->params['result'][intval($item->template->max_1)]?>
                    <?php } elseif ($item->template->unit->type_id == 3) { ?>
                        <?= $item->template->min_1.'-'.$item->template->max_1 ?>

                    <?php } elseif ($item->template->unit->type_id == 4) { ?>
                        <?= $item->template->min_1.'-'.$item->template->max_1 ?><br>
                        <?= $item->template->min_2.'-'.$item->template->max_2 ?>
                    <?php } elseif($item->template->unit->type_id == 5){?>
                        <?= Yii::$app->params['unit_belgi'][intval($item->template->min_1)].'-'.Yii::$app->params['unit_belgi'][intval($item->template->max_1)]?>

                    <?php } ?>
                </td>


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
                            <?= $item->min_1.'-'.$item->max_1 ?>
                        <?php } elseif ($item->unit->type_id == 2) { ?>
                            <?= Yii::$app->params['result'][intval($item->min_1)].'-'.Yii::$app->params['result'][intval($item->max_1)]?>
                        <?php } elseif ($item->unit->type_id == 3) { ?>
                            <?= $item->min_1.'-'.$item->max_1 ?>

                        <?php } elseif ($item->unit->type_id == 4) { ?>
                            <?= $item->min_1.'-'.$item->max_1 ?><br>
                            <?= $item->min_2.'-'.$item->max_2 ?>
                        <?php } elseif($item->unit->type_id == 5){?>
                            <?= Yii::$app->params['unit_belgi'][intval($item->min_1)].'-'.Yii::$app->params['unit_belgi'][intval($item->max_1)]?>

                        <?php } ?>
                    </td>

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
