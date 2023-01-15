<?php

/* @var $this yii\web\View */

use common\models\EmpPosts;

$this->title = Yii::t('client','Bosh sahifa');
?>

<div class="container-fluid">

    <?php $type = Yii::$app->user->identity->empPosts->org->type_id;
        $uid = Yii::$app->user->id;
        $upost = Yii::$app->user->identity->empPosts->post_id;
        if($type == 4 and $upost == 5){
    ?>
            <!-- Admin-->
            <?= $this->render('_director')?>

    <?php }elseif($type == 4){?>
            <!--Komitet-->
            <?= $this->render('_director')?>

        <?php }elseif($type == 3){?>
            <!--Viloyat-->
            <?= $this->render('_director')?>

        <?php }elseif($type == 2){?>
            <!--Tuman-->
            <?= $this->render('_director')?>

        <?php }elseif($type == 1){?>
            <!--Labaratoriya-->
            <?php $uid = Yii::$app->user->id; if(EmpPosts::isDirector($uid)){?>

                <?= $this->render('_director')?>

            <?php }elseif(EmpPosts::isLeader($uid)){?>

                <?= $this->render('_lider')?>

            <?php }elseif(EmpPosts::isLabor($uid)){?>

                <?= $this->render('_lab')?>

            <?php } ?>
    <?php }?>


</div>
