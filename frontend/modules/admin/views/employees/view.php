<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Foydalanuvchilar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?= Html::a(Yii::t('cp', 'Yana qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>

                    <?= Html::a(Yii::t('cp', 'O\'zgartirish'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('cp', 'O\'chirish'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('cp', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                        'id',
                        'name',
                        'email:email',
                        'phone',
//                        'password',
                    ],
                ]) ?>

               <h3 class="title"><?= Yii::t('cp','Lavozimlar ro\'yhati')?>
               <span style="float: right"><a href="<?= Yii::$app->urlManager->createUrl(['/cp/employees/add','id'=>$model->id])?>" class="btn btn-primary"><?= Yii::t('cp','Lavozim qo\'shish')?></a></span>
               </h3>
               <div class="table-responsive">
                   <table class="table table-hover  table-bordered">
                       <thead>
                       <tr>
                           <th>№</th>
                           <th><?= Yii::t('cp','Bo\'lim nomi')?></th>
                           <th><?= Yii::t('cp','Lavozim nomi')?></th>
                           <th><?= Yii::t('cp','Status')?></th>
                           <th><?= Yii::t('cp','Ruhsati')?></th>
                           <th><?= Yii::t('cp','Holati')?></th>
                           <th><?= Yii::t('cp','Amallar')?></th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php $n=0; foreach (\common\models\EmpPosts::find()->where(['emp_id'=>$model->id])->all() as $item): $n++?>
                            <tr>
                                <td><?= $n?></td>
                                <td><?= Yii::$app->language == 'ru' ? $item->gov->name_uz : $item->gov->name_ru ?></td>
                                <td><?= $item->post->name?></td>
                                <td><?= $item->status->name?></td>
                                <td><?= $item->post->defRole->name?></td>
                                <td><?= $item->state->name?></td>
                                <td><a data-method="post" data-confirm="<?= Yii::t('cp', 'Are you sure you want to delete this item?')?>" href="<?= Yii::$app->urlManager->createUrl(['/cp/employees/del','id'=>$item->id])?>"><span class="fa fa-trash"></span></a></td>
                            </tr>
                       <?php endforeach;?>
                       </tbody>
                   </table>
               </div>

            </div>
        </div>
    </div>
</div>