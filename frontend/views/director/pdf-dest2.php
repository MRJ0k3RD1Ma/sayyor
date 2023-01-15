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
        ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/viewdestfood','id'=>$model->sample_id]))
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
    <b>NAMUNANI YO'Q QILISH DALOLATNOMASI № <?= $model->code ?></b>
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

<b>Tekshiruv obyekti:</b>
<b>Mahsulot guruhi:</b><?= $model->sample->category->{'name_uz'}.'-'.$model->sample->food->{'name_uz'}?>
<b>Ishlab chiqaruvchi:</b> <?= $model->sample->producer?>&nbsp;
<b>Davlat:</b><?= $model->sample->country->name_uz?>&nbsp;
<b>Soni:</b><?= $model->sample->count.' '.$model->sample->unit->name_uz?>&nbsp;
<b>Seriya raqami:</b><?= $model->sample->serial_num?>&nbsp;
<b>Ishlab chiqarilgan sana:</b> <?= @$model->sample->manufacture_date?>&nbsp;
<b>Muddati:</b> <?= @$model->sample->sell_by?>&nbsp;


<br>
<br>
<div>
    <b>Namuna yo'q qilingan sana:</b> <?= $model->destruction_date ?>
</div>

<div>
    <b>Qo'shimcha ma'lumot:</b> <?= $model->ads ?>
</div>
<div>
    <b>Laborant:</b> <?= $model->creator->name ?>
</div>
<div>
    <b>Tasdiqladi:</b> <?= $model->consent->name ?>
</div>
