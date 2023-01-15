<?php
/*var  */
?>
<div class="samples-view">


    <p style="font-weight: bold">
        Namuna haqida to'liq ma'lumot
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Kod</th>
            <td><?= $model->kod ?></td>
        </tr>
        <tr>
            <th>Namuna belgisi</th>
            <td><?= $model->label ?></td>
        </tr>
        <tr>
            <th>Namuna turi</th>
            <td><?= $model->sampleTypeIs->name_uz ?></td>
        </tr>
        <tr>
            <th>Namuna o'rami</th>
            <td><?= $model->sampleBox->name_uz ?></td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: center">Namuna olingan hayvon haqida ma'lumot</th>
        </tr>
        <tr>
            <th>Identifikatsiya raqami</th>
            <td><?= $model->animal_id ?></td>
        </tr>
        <tr>
            <th>Hayvon turi</th>
            <td><?= $model->animal->type->name_uz ?></td>
        </tr>
        <tr>
            <th>Hayvon jinsi</th>
            <td><?= Yii::$app->params['gender'][$model->animal->gender] ?></td>
        </tr>
        <tr>
            <th>Yoshi oy</th>
            <td><?= $model->animal->birthday ?></td>
        </tr>
        <?php
        $cnt_vac = \common\models\Vaccination::find()->where(['animal_id'=>$model->animal_id])->count('*');
        $cnt_eml = \common\models\Emlash::find()->where(['animal_id'=>$model->animal_id])->count('*');
        if($cnt_vac > $cnt_eml){
            $cnt = $cnt_vac;
        }else{
            $cnt = $cnt_eml;
        }
        $vac = \common\models\Vaccination::find()->where(['animal_id'=>$model->animal_id])->orderBy(['disease_date'=>SORT_DESC])->all();
        $eml = \common\models\Emlash::find()->where(['animal_id'=>$model->animal_id])->orderBy(['emlash_date'=>SORT_DESC])->all();
        for ($i=0;$i<$cnt; $i++):?>
            <tr>
                <td><?= isset($vac[$i]) ? $vac[$i]->disease->name_uz : ' ' ?></td>
                <td><?= isset($vac[$i]) ? $vac[$i]->disease_date : ' '?></td>
                <td><?= isset($eml[$i]) ? $eml[$i]->antibiotic : ' ' ?></td>
                <td><?= isset($eml[$i]) ? $eml[$i]->emlash_date : ' '?></td>
            </tr>
            <tr>
                <td><?= isset($vac[$i]) ? $vac[$i]->disease->name_uz : ' ' ?></td>
                <td><?= isset($vac[$i]) ? $vac[$i]->disease_date : ' '?></td>
                <td><?= isset($eml[$i]) ? $eml[$i]->antibiotic : ' ' ?></td>
                <td><?= isset($eml[$i]) ? $eml[$i]->emlash_date : ' '?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <th>Qaysi kasallikga gumon</th>
            <td><?= @$model->suspectedDisease->name_uz?></td>
        </tr>
        <tr>
            <th>Tahlil usuli</th>
            <td><?= @$model->testMehod->name_uz?></td>
        </tr>
        <tr>
            <th>Takroriy tahlil raqami</th>
            <td><?= @$model->repeat_code?></td>
        </tr>
        </tbody>
    </table>
</div>
