<?php

use common\models\DestructionSampleFood;
use common\models\FoodRoute;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */

$this->title = $model->code.' '.Yii::t('cp','sonli oziq-ovqat havfsizligi bo`yicha ariza');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">

    <?php if ($model->status_id == 1) { ?>
        <p style="font-weight: bold">

            <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomeproduct', 'id' => $model->id]) ?>"
               class="btn btn-success"><?= Yii::t('register', 'Qabul qilish') ?></a>
        </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code',
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


<?= $this->render('addfood/_compose',[
        'model'=>$model,
        'samp'=>$samp,
        'compose'=>$compose
])?>

<hr>

<?= $this->render('addfood/_uncompose',[
    'model'=>$model,
    'unsamp'=>$unsamp,
    'uncompose'=>$uncompose
])?>
