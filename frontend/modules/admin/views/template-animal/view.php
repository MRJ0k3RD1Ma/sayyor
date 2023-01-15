<?php

use common\models\Employees;
use common\models\Regulations;
use common\models\TamplateAnimal;
use common\models\TemplateAnimalRegulations;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TamplateAnimal */

$this->title = $model->name_uz || $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hayvon kasalliklari tashhisi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
YiiAsset::register($this);
?>
<div class="tamplate-animal-view">

    <p>        <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('app', 'Yangilash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'O\'chirish'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-md-6">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'label' => 'regulation',
                        'format' => 'html',
                        'value' => function (TamplateAnimal $model) {
                            $out = [];
                            $rel = TemplateAnimalRegulations::find()->where(['template_id' => $model->id])->asArray()->all();
                            foreach (array_column($rel, 'regulation_id') as $reg) {
                                $out[] = Regulations::findOne(['id' => $reg])->name_uz;
                            }
                            return implode("<br>", $out);

                        }
                    ],

                    [
                        'attribute' => 'diseases_id',
                        'value' => function (TamplateAnimal $model) {
                            return $model->diseases->name_uz;
                        }
                    ],
                    [
                        'attribute' => 'test_method_id',
                        'value' => function (TamplateAnimal $model) {
                            return $model->testMethod->name_uz;
                        }
                    ],
                    'name_uz',
                    'name_ru',
                    [
                        'attribute' => 'unit_id',
                        'value' => function (TamplateAnimal $model) {
                            return $model->unit->name_uz;
                        }
                    ],
                    'min',
                    'min_1',
                    'max',
                    'max_1',
                    'is_vaccination',
                    'dead_days',
                    [
                        'attribute' => 'creator_id',
                        'value' => function (TamplateAnimal $model) {
                            return Employees::findOne(['id' => Yii::$app->user->identity->id])->name;
                        }
                    ],
                    'consent_id',
                    [
                        'attribute' => 'state_id',
                        'value' => function (TamplateAnimal $model) {
                            return $model->state->name;
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-md-6 table-responsive">

            <h3>Hujjatlar ro'yhati <span style="float: right"><button data-toggle="modal" value="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/createregulation','template_id'=>$model->id])?>" class="btn btn-primary addnew">Qo'shish</button></span></h3>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Hujjat nomi</th>
                    <th>Fayl</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $n=0; foreach ($model->templateAnimalRegulations as $item): $n++; ?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->regulation->name_uz ?></td>
                        <td><?= $item->regulation->file ? '<a href="'.$item->regulation->file.'">Yuklab olish</a>' : '' ?></td>
                        <td><a data-confirm="Siz rostdan ham ushbu elementni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/deleteregulation','template_id'=>$item->template_id,'regulation_id'=>$item->regulation_id]) ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>


            <h3>Probalar ro`yhati <span style="float: right"><button data-toggle="modal" value="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/createsample','template_id'=>$model->id])?>" class="btn btn-primary addnew">Qo'shish</button></span></h3>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Proba turi</th>
                    <th>Kod</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $n=0; foreach ($model->samples as $item): $n++; ?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->type->name_uz ?></td>
                        <td><?= $item->type->vet4  ?></td>
                        <td><a data-confirm="Siz rostdan ham ushbu elementni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/deletesample','template_id'=>$item->template_id,'regulation_id'=>$item->type_id]) ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>


            <h3>Hayvon turlari ro`yhati <span style="float: right"><button data-toggle="modal" value="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/createanimal','template_id'=>$model->id])?>" class="btn btn-primary addnew">Qo'shish</button></span></h3>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Hayvon turi</th>
                    <th>Kod</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $n=0; foreach ($model->getAnimals as $item): $n++; ?>
                    <tr>
                        <td><?= $n?></td>
                        <td><?= $item->type->name_uz ?></td>
                        <td><?= $item->type->vet4  ?></td>
                        <td><a data-confirm="Siz rostdan ham ushbu elementni o`chirmoqchimisiz?" href="<?= Yii::$app->urlManager->createUrl(['/cp/template-animal/deleteanimal','template_id'=>$item->template_id,'regulation_id'=>$item->type_id]) ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>

        </div>
    </div>

</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ma`lumot qo`shish</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiqish</button>
            </div>
        </div>

    </div>
</div>


<?php

$this->registerJs("
    $('.addnew').on('click',function(){
        url = this.value;
        $('#myModal .modal-body').load(url);
        $('#myModal').modal('show');
    });
")

?>