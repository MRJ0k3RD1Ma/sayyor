<?php

use common\models\Emlash;
use common\models\Vaccination;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */

$this->title = $model->code.'-'.Yii::t('cp','sonli hayvon kasalliklari tashhisi bo`yicha ariza');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
    <div class="sertificates-view">

        <?php if ($model->status_id > 1) { ?>
            <p style="font-weight: bold">
                <a href="#" class="btn btn-primary"><?= $model->status->icon ?> <?= $model->status->name_uz ?></a>
            </p>

        <?php } else { ?>
            <p>
                <a class="btn btn-success"
                   href="<?= Yii::$app->urlManager->createUrl(['/register/income', 'id' => $model->id]) ?>"><?= Yii::t('register', 'Arzani qabul qilish') ?></a>
            </p>
        <?php } ?>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'code',
                    'value' => function ($d) {
                        $url = Yii::$app->urlManager->createUrl(['/register/regview', 'id' => $d->id]);
                        return "<a href='{$url}'>{$d->code}</a>";
                    },
                    'filter' => false,
                    'format' => 'raw'
                ],
                [
                    'label' => Yii::t('register', 'Yuboruvchi'),
                    'value' => function ($d) {
                        if ($d->inn) {
                            return $d->inn . '<br>' . $d->inn0->name;
                        } elseif ($d->pnfl) {
                            return $d->pnfl . '<br>' . $d->pnfl0->name . ' ' . $d->pnfl0->surname . ' ' . $d->pnfl0->middlename;
                        } else {
                            return null;
                        }
                    },
                    'format' => 'raw'
                ],
//                            'is_research',
                [
                    'attribute' => 'is_research',
                    'value' => function ($d) {
                        $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                        return $s[$d->is_research];
                    }
                ],
//                            'code_id',
                //'code',
                //'research_category_id',
                [
                    'attribute' => 'research_category_id',
                    'value' => function ($d) {
                        return $d->researchCategory->name_uz;
                    }
                ],

                'sender_name',
                'sender_phone',
                'created',
                [
                    'attribute' => 'status_id',
                    'value' => function ($d) {
                        $lg = 'uz';
                        if (Yii::$app->language == 'ru') $lg = 'ru';
                        return $d->status->{'name_' . $lg};
                    }
                ],
                //'updated',
            ],
        ]) ?>

    </div>



    <?= $this->render('add/_compose',[
        'samples'=>$samples,
        'compose'=>$compose,
        'model'=>$model,
    ])?>

    <hr>

    <?= $this->render('add/_uncompose',[
        'samples_comp'=>$samples_comp,
        'uncompose'=>$uncompose,
        'model'=>$model,
    ])?>


    <div class="modal fade bs-example-modal-lg" id="sendmodal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="sendmodalbody">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


<?php
$this->registerJs("
        $('.send').click(function(){
            var url = this.value;
            $('#sendmodalbody').load(url);
            $('#sendmodal').modal('show');
        })
    ");
?>