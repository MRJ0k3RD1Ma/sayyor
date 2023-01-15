<?php

/* @var $model common\models\SampleRegistration */
/* @var $composite common\models\CompositeSamples */

/* @var $sertificate common\models\Sertificates */

use common\models\Employees;
use common\models\Individuals;
use common\models\Regulations;
use common\models\ResultAnimal;
use common\models\RouteSert;
use common\models\Soato;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$composite = $model->comp;
$samples = $composite[0]->sample;
$sertificate = $samples->sert;
$resultanimal = ResultAnimal::findOne(['sample_id' => $samples->id]);
$routesert = RouteSert::findOne(['sample_id' => $samples->id])->registration_id;
//\yii\helpers\VarDumper::dump($samples) or die();

//errdeb($routesert);
$docs = Regulations::find()->select(['regulations.*'])->innerJoin('template_animal_regulations', 'template_animal_regulations.regulation_id = regulations.id')
    ->innerJoin('tamplate_animal', 'template_animal_regulations.template_id = tamplate_animal.id')
    ->orderBy('template_animal_regulations.regulation_id')
    ->where('tamplate_animal.id IN (SELECT result_animal_tests.id from result_animal_tests inner join tamplate_animal on result_animal_tests.template_id=tamplate_animal.id where result_animal_tests.result_id=' . $routesert . ')')->all();
//errdeb($routesert);
$qr = function () use ($sertificate) {
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/viewsert', 'id' => $sertificate->id]))
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(100)
        ->margin(3)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
//                        ->logoPath(Yii::$app->basePath.'/web/favicon.ico')
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();
    return "<img src='{$result->getDataUri()}'>";
}
?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php
            echo $model->organization->NAME_FULL;
            ?>
        </th>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <img src="<?= Yii::$app->homeUrl . "/tmp/img.png" ?>" alt="">
        </th>
    </tr>
    </thead>

</table>
<div class="align-content-center" style="text-align: center">
    <b>ТЕКШИРИШ БАЁННОМАСИ № <?= $model->code ?></b>
</div>
<br>
<div>
    Буюртмачи номи ва манзили: <?php
    $ind = Individuals::findOne(['pnfl' => $model->pnfl]);
    echo $model->pnfl . " " . $model->inn . " "
        . $ind->surname . " "
        . $ind->name . " "
        . $ind->middlename . " "
        . Soato::Full($ind->soato_id);

    ?>
</div>
<br>
<div>
    Текширув объекти: намуна номи:<?= $samples->sampleTypeIs->name_uz ?>,кушимча маълумот:<?= $samples->label ?>,намуна
    коди: <?= $samples->kod ?>
</div>
<br>
<div>
    Намуна олинган жойи: <?= $sertificate->vetSite->name ?>,манзили: <?= Soato::Full($sertificate->vetSite->soato) ?>
</div>
<br>
<div>
    Текшириш усули буйича НХ: (танланган шаблон буйича 07102 да танланган шаблонда келтирилган «норматив хужжат» поляси,
    бир нечта булиши мумкин, факат такрорланмасин)
</div>
<br>
<div>
    Текширувни утказиш шароити: (Натижани кайд этиш (07101) дан олинади: температура, намлик, регантлар, бошка шартлар,
    изох полялари)
</div>
<br>
<div style="text-align: center">
    <b>Текширув натижалари:</b>
</div>
<br>
<table class="table table-bordered table-hover" style="text-align: center">
    <thead>
    <tr>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">
            Параметр (талаб) номи
        </th>
        <th colspan="2">
            Параметр кийматлари
        </th>
        <th rowspan="2" style="vertical-align: middle;">
            Талабга мослик
        </th>
    </tr>
    <tr>
        <th>
            НХ буйича
        </th>
        <th>
            Хакикатда
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            Data
        </td>
        <td>
            Data
        </td>
        <td>
            Data
        </td>
        <td>
            Data
        </td>
    </tr>
    </tbody>
</table>