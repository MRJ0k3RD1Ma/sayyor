<?php
use common\models\DestructionSampleAnimal;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\Soato;
use common\models\Tshx;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/* @var DestructionSampleAnimal $model*/

$qr =function() use ($model) {
    $data=Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/viewdest','id'=>$model->sample_id]))
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(100)
        ->margin(3)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();
    return $data->getDataUri();
};

?>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php
              echo $model->org->NAME_FULL;
            ?>
            <p style="font-size: 12px; font-weight: normal">STIR(INN): <?= $model->org->TIN?> Manzil: <?= Soato::Full($model->org->soato).' '. $model->org->ADDRESS ?> Telefon: <?= $model->org->TELEFON?></p>
        </th>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?= "<img src='{$qr()}'>";?>
        </th>
    </tr>
    </thead>

</table>
<div class="align-content-center" style="text-align: center">
    <b>NAMUNANI YO'Q QILISH DALOLATNOMASI № № <?= $model->code ?></b>
</div>
<br>

<div>
    <b>Buyurtmachi nomi va manzili:</b> <?php
    if ($model->sample->sert->inn) {
        $legal = LegalEntities::findOne(['inn' => $model->sample->sert->inn]);
        echo $legal->inn
            . " "
            . $legal->name
            . " "
            . Tshx::findOne(['id' => $legal->tshx_id])->name_uz
            . " "
            . Soato::Full($legal->soato_id,'lot');

    } else {
        $ind = Individuals::findOne(['pnfl' => $model->sample->sert->pnfl]);
        echo $model->sample->sert->pnfl . " "
            . $ind->surname . " "
            . $ind->name . " "
            . $ind->middlename . " "
            . Soato::Full($ind->soato_id,'lot');
    }
    ?>
</div>

<div>
    <?php
    $lg= 'uz';
    $res = "";
    $d = $model->sample;
    $res .= $d->animal->type->{'name_' . $lg} . ' ';
    $res .= Yii::t('lab', 'Holati:') . ' ' . $d->animal->cat->{'name_' . $lg} . ' ';
    $res .= Yii::t('lab', 'Jinsi:') . ' ' . Yii::$app->params['gender'][$d->animal->gender] . ' ';
    $d1 = new DateTime($d->animal->birthday);
    $d2 = new DateTime(date('Y-m-d'));
    $interval = $d1->diff($d2);
    $diff = $interval->m + ($interval->y * 12);
    $res .= Yii::t('lab', 'Tug\'ilgan sanasi:') . ' ' . $d->animal->birthday . '(' . $diff . ' oy)';
    ?>
    <b>Tekshiruv obyekti: Namuna nomi:</b> <?= $model->sample->sampleTypeIs->name_uz ?> <br>
    <b>Hayvon ma'lumotlari:</b> <?= $res?>
</div>
<br>
<div>
    <b>Tasdiqladi:</b> <?= $model->consent->name ?>
</div>
<br>
<div>
    <b>Namuna yo'q qilingan sana:</b> <?= $model->destruction_date ?>
</div>
<br>
<div>
    <b>Laborant:</b> <?= $model->creator->name ?>
</div>