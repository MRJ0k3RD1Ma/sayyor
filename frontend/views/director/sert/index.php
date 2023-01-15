<?php
/* @var $model \common\models\ResultsConformity*/

$this->title = Yii::t('food', 'Tashkilot sertifikatlari ro`yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header flex">
                <div></div>
                <div class="btns flex">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/director/sertadd'])?>" class="btn btn-primary">Yangi sertifikat qo'shish</a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Nomi</th>
                            <th>Kodi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n=0; foreach ($model as $item): $n++?>
                            <tr>
                                <td><?= $n?></td>
                                <td><?= $item->name?></td>
                                <td><?= $item->code?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>