<?php

use common\models\EmpPosts;
use common\models\RouteSert;
use common\models\RouteStatus;

?>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/'])?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= Yii::t('lab','Bosh sahifa')?></span>
                    </a>
                </li>
                <?php $type = Yii::$app->user->identity->empPosts->org->type_id;  if($type == 4 and Yii::$app->user->identity->empPosts->post_id != 5){?>
                <!--Komitet-->


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Arizalar ro\'yhati') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/sertapp']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/sertfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Dalolatnomalar') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/listanimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                        </li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/listfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Xabarlar') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportanimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportdrugs']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Dori darmonlar') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="bar-chart-2"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu', 'Statistika') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-reganimal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari (Arizalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-regfood']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari (Arizalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-animal']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari (Dalolatnomalar)') ?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/stat-food']) ?>"
                               data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari (Dalolatnomalar)') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables"><?= Yii::t('app','Hisobotlar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportvet4'])?>" data-key="t-basic-tables">4VET hayvon kasalliklari</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/komitet/reportvet4food'])?>" data-key="t-basic-tables">4VET oziq-ovqat</a></li>
                    </ul>
                </li>

                <?php }elseif($type == 4 and Yii::$app->user->identity->empPosts->post_id == 5){?>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/sert/'])?>">
                        <i data-feather="sliders"></i>
                        <span data-key="t-table"><?= Yii::t('cp.menu','Dalolatnomalar')?></span>

                    </a>
                </li>

                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/application'])?>">
                            <i data-feather="sliders"></i>
                            <span data-key="t-table"><?= Yii::t('cp.menu','Arizalar')?></span>

                        </a>
                    </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Ma\'lumotnoma')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/inside'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Ichki')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/outside'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashqi')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/default/templates'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Shablonlar')?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="folder"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Kontragentlar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/legal-entities'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Yuridik shaxslar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/individuals'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Jismoniy shaxslar')?></a></li>
                    </ul>
                </li>
                <li class="menu-title mt-2" data-key="t-components"><?= Yii::t('cp.menu','Sozlamalar')?></li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-tables"><?= Yii::t('cp.menu','Foydalanuvchilar')?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/employees/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Foydalanuvchilar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/post-list/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Lavozimlar ro\'yhati')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/goverments/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Bo`limlar ro\'yhati')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/roles/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Foydalanuvchilar huquqlari')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/organizations/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashkilotlar')?></a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/cp/organization-type/index'])?>" data-key="t-basic-tables"><?= Yii::t('cp.menu','Tashkilot turlari')?></a></li>
                    </ul>
                </li>


                <?php }elseif($type == 3){?>
                    <!--Viloyat boshqarmasi-->

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Arizalar ro\'yhati') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/sertapp']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                            </li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/sertfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Dalolatnomalar') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/listanimal']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                            </li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/listfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Xabarlar') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/reportanimal']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari') ?></a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/reportfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/reportdrugs']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Dori darmonlar') ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="sliders"></i>
                            <span data-key="t-tables"><?= Yii::t('app','Hisobotlar')?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/reportvet4'])?>" data-key="t-basic-tables">4VET hayvon kasalliklari</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/region/reportvet4food'])?>" data-key="t-basic-tables">4VET oziq-ovqat</a></li>
                        </ul>
                    </li>


                <?php }elseif($type == 2){?>
                    <!--Tuman bulim-->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Arizalar ro\'yhati') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/sertapp']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                            </li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/sertfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Dalolatnomalar') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/listanimal']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari tashhilari') ?></a>
                            </li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/listfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="bar-chart-2"></i>
                            <span data-key="t-tables"><?= Yii::t('cp.menu', 'Xabarlar') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/reportanimal']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Hayvon kasalliklari') ?></a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/reportfood']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Oziq-ovqat ekspertizalari') ?></a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl(['/district/reportdrugs']) ?>"
                                   data-key="t-basic-tables"><?= Yii::t('cp.menu', 'Dori darmonlar') ?></a></li>
                        </ul>
                    </li>

                <?php }elseif($type==1){?>

                    <?php if(EmpPosts::isRegister(Yii::$app->user->identity->getId())):?>
                        <li class="menu-title" data-key="t-menu">Registrator</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('lab','Yangi arizalar')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/register/regtest'])?>" data-key="t-basic-tables"><?= Yii::t('menu','Hayvon kasalliklari tashhisi')?></a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/register/regproduct'])?>" data-key="t-data-tables"><?= Yii::t('menu','Oziq-ovqat havfsizligi')?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('lab','Namunani yo\'q qilish')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/register/dest'])?>" data-key="t-basic-tables"><?= Yii::t('menu','Hayvon kasalliklari tashhisi')?></a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/register/destfood'])?>" data-key="t-data-tables"><?= Yii::t('menu','Oziq-ovqat havsizligi')?></a></li>
                            </ul>
                        </li>
                    <?php endif;?>
                    <?php if(EmpPosts::isDirector(Yii::$app->user->identity->getId())):?>
                        <li class="menu-title" data-key="t-menu">Rahbar</li>
                        <?php
                        $lg = 'uz';
                        if(Yii::$app->language == 'ru'){
                            $lg = 'ru';
                        }
                        ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Hayvon kasalliklari')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/indexanimal'])?>" data-key="t-basic-tables">Barchasi
                                        <span class="badge badge-primary"><?= RouteSert::find()->where(['director_id'=>Yii::$app->user->id])->count('id')?></span>
                                    </a></li>
                                <?php foreach (RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/indexanimal','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= RouteSert::find()->where(['director_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/dest'])?>" data-key="t-basic-tables">Namunani yo'q qilish
                                        <span class="badge badge-primary"><?= \common\models\DestructionSampleAnimal::find()->where(['consent_id'=>Yii::$app->user->id])->andWhere(['state_id'=>2])->count('id')?></span>
                                    </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Oziq-ovqat havfsizligi')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/indexfood'])?>" data-key="t-basic-tables">Barchasi <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['director_id'=>Yii::$app->user->id])->count('id')?></span></a></li>
                                <?php foreach (RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/indexfood','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['director_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/destfood'])?>" data-key="t-basic-tables">Namunani yo'q qilish
                                        <span class="badge badge-primary"><?= \common\models\DestructionSampleFood::find()->where(['consent_id'=>Yii::$app->user->id])->andWhere(['state_id'=>2])->count('id')?></span>
                                    </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Hisobotlar')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/reportvet4'])?>" data-key="t-basic-tables">4VET hayvon kasalliklari</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/director/reportvet4food'])?>" data-key="t-basic-tables">4VET oziq-ovqat</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/director/sert'])?>">
                                <i data-feather="paperclip"></i>
                                <span data-key="t-dashboard"><?= Yii::t('lab','Sertifikatlar')?></span>
                            </a>
                        </li>
                    <?php endif;?>

                    <?php if(EmpPosts::isLeader(Yii::$app->user->identity->getId())):?>
                        <li class="menu-title" data-key="t-menu">Labaratoriya mudiri</li>
                        <?php
                        $lg = 'uz';
                        if(Yii::$app->language == 'ru'){
                            $lg = 'ru';
                        }
                        ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Hayvon kasalliklari')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/leader/indexanimal'])?>" data-key="t-basic-tables">Barchasi
                                        <span class="badge badge-primary"><?= RouteSert::find()->where(['leader_id'=>Yii::$app->user->id])->count('id')?></span>
                                    </a></li>
                                <?php foreach (RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/leader/indexanimal','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= RouteSert::find()->where(['leader_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Oziq-ovqat havfsizligi')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/leader/indexfood'])?>" data-key="t-basic-tables">Barchasi <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['leader_id'=>Yii::$app->user->id])->count('id')?></span></a></li>
                                <?php foreach (RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/leader/indexfood','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['leader_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>

                            </ul>
                        </li>

                    <?php endif;?>
                    <?php if(EmpPosts::isLabor(Yii::$app->user->identity->getId())):?>
                        <li class="menu-title" data-key="t-menu">Labaratoriya</li>
                        <?php
                        $lg = 'uz';
                        if(Yii::$app->language == 'ru'){
                            $lg = 'ru';
                        }
                        ?>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Hayvon kasalliklari')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/indexanimal'])?>" data-key="t-basic-tables">Barchasi
                                        <span class="badge badge-primary"><?= \common\models\RouteSert::find()->where(['executor_id'=>Yii::$app->user->id])->count('id')?></span>
                                    </a></li>
                                <?php foreach (\common\models\RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/indexanimal','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= \common\models\RouteSert::find()->where(['executor_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/dest'])?>" data-key="t-basic-tables">Namunani yo'q qilish
                                        <span class="badge badge-primary"><?= \common\models\DestructionSampleAnimal::find()->where(['creator_id'=>Yii::$app->user->id])->andWhere(['state_id'=>3])->count('id')?></span>
                                    </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables"><?= Yii::t('app','Oziq-ovqat havfsizligi')?></span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/indexfood'])?>" data-key="t-basic-tables">Barchasi <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['executor_id'=>Yii::$app->user->id])->count('id')?></span></a></li>
                                <?php foreach (RouteStatus::find()->all() as $item):?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/indexfood','status'=>$item->id])?>" data-key="t-basic-tables"><?= $item->{'name_'.$lg}?>
                                            <span class="badge badge-primary"><?= \common\models\FoodRoute::find()->where(['executor_id'=>Yii::$app->user->id])->andWhere(['status_id'=>$item->id])->count('id')?></span>
                                        </a></li>
                                <?php endforeach;?>
                                <li><a href="<?= Yii::$app->urlManager->createUrl(['/lab/destfood'])?>" data-key="t-basic-tables">Namunani yo'q qilish
                                        <span class="badge badge-primary"><?= \common\models\DestructionSampleFood::find()->where(['creator_id'=>Yii::$app->user->id])->andWhere(['state_id'=>3])->count('id')?></span>
                                    </a></li>
                            </ul>
                        </li>
                    <?php endif;?>

                <?php }?>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
