<?php
use yii\widgets\ActiveForm;
use common\models\SampleTypes;
use yii\helpers\ArrayHelper;
use common\models\SampleStatus;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?php foreach ($samples as $item){echo $item->samp_code.' '; }?> <?= Yii::t('register', 'Raqamli namunalarga berilgan topshiriqlarni yangilash') ?>
<?php
$lg = 'uz';
if (Yii::$app->language == 'ru') {
    $lg = 'ru';
}
?>


<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Nomi</th>
            <th>O'rami</th>
            <th>Ishlab chiqaruvchi</th>
            <th>Seriya raqami</th>
            <th>Yaroqlilik muddati</th>
            <th>Test turi</th>
            <th>Namuna holati</th>
            <th>Izoh</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($cs as $item): $sam = $item->sample;?>
            <tr>
                <td>
                    <?= $sam->samp_code?>
                </td>
                <td><?= $sam->category->{'name_'.$lg}.' '.$sam->food->{'name_'.$lg} ?></td>
                <td><?= $sam->sampleBox->{'name_' . $lg} ?></td>
                <td><?= $sam->producer ?></td>
                <td><?= $sam->serial_num ?></td>
                <td><?= $sam->sell_by ?></td>
                <td><?= $sam->laboratoryTestType->{'name_' . $lg} ?></td>
                <td><?= $form->field($item, '['.$item->sample_id.']status_id')->dropDownList(ArrayHelper::map(SampleStatus::find()->all(), 'id', 'name_' . $lg))->label(false) ?></td>
                <td><?= $form->field($item, '['.$item->sample_id.']ads')->textInput()->label(false) ?></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>


<?php if($route->isNewRecord){ ?>
    <?php if($director_id == -1){?>
        <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang')]) ?>
    <?php }else{?>
        <?= $form->field($route, 'director_id')->dropDownList(ArrayHelper::map($director, 'id', 'name'), ['prompt' => Yii::t('test', 'Direktorni tanlang'),'disabled'=>true]) ?>
    <?php }?>
    <?= $form->field($route, 'leader_id')->dropDownList(ArrayHelper::map($lider, 'id', 'name'), ['prompt' => Yii::t('test', 'Labaratoriya mudirini tanlang')]) ?>

<?php }else{?>

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
        </tr>
        </thead>
        <tbody>
        <?php foreach (\common\models\ResultFoodTests::find()->where('route_id in (select id from food_route where leader_id='.$leader_id.' and registration_id='.$reg->id.' and is_group=1)')->all() as $item): ?>
            <tr>
                <td><?= $item->id?></td>
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
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if($model->is_group == 1 and !$route->executor_id){?>
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
