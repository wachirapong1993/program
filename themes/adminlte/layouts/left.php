<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
/*Test Hit*/
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!--        <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>
        
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>-->

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Setup',
                            'icon' => 'gear',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Customer', 'icon' => 'anchor', 'url' => ['/customer'],],
                                ['label' => 'Models', 'icon' => 'anchor', 'url' => ['/models-p'],],
                                ['label' => 'Line', 'icon' => 'dashboard', 'url' => ['/line'],],
                                ['label' => 'Models-Line', 'icon' => 'dashboard', 'url' => ['/models-line'],],
                                ['label' => 'Machince', 'icon' => 'dashboard', 'url' => ['/machine'],],
                                ['label' => 'Table', 'icon' => 'dashboard', 'url' => ['/tables'],],
                                ['label' => 'Table Machine', 'icon' => 'dashboard', 'url' => ['/table-machine'],],
                                ['label' => 'Feeder', 'icon' => 'dashboard', 'url' => ['/feeder'],],
                                ['label' => 'Feeder Point', 'icon' => 'dashboard', 'url' => ['/feeder-point'],],
                                ['label' => 'Direction', 'icon' => 'dashboard', 'url' => ['/direction'],],
                                ['label' => 'Part', 'icon' => 'dashboard', 'url' => ['/item'],],
                                ['label' => 'Part Type', 'icon' => 'dashboard', 'url' => ['/part-type'],],
                                ['label' => 'PCB', 'icon' => 'dashboard', 'url' => ['/pcb'],],
                                ['label' => 'Check Status', 'icon' => 'dashboard', 'url' => ['/check-status'],],
                                ['label' => 'Program Status', 'icon' => 'dashboard', 'url' => ['/program-status'],],
                                ['label' => 'QC Status', 'icon' => 'dashboard', 'url' => ['/qc-status'],],
                            ],
                        ],
                        [
                            'label' => 'ML Process',
                            'icon' => 'tasks',
                            'url' => '#',
                        ],
                        [
                            'label' => 'EN Process',
                            'icon' => 'tasks',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Program', 'icon' => 'dashboard', 'url' => ['/program-item'],],
                                ['label' => 'Create Program', 'icon' => 'file-code-o', 'url' => ['/program/create'],],
                                ['label' => 'Export Arrengement Table', 'icon' => 'dashboard', 'url' => ['/program/export'],],
                            ]
                        ],
                        [
                            'label' => 'SMT Process',
                            'icon' => 'tasks',
                            'url' => '#',
                            'items' => [
                                ///////////////////////////////


                                ['label' => 'Check Part', 'icon' => 'file-code-o', 'url' => ['/start-main/index'],],
                                ['label' => 'Create Check Part', 'icon' => 'dashboard', 'url' => ['/start-main/create'],],
                                ['label' => 'Report-UpPart', 'icon' => 'dashboard', 'url' => ['/start-program/report-uppart'],],
                                ['label' => 'Report-JoidPart', 'icon' => 'dashboard', 'url' => ['/start-program/report'],],
//                                        ['label' => 'QC Confirm Join Part', 'icon' => 'dashboard', 'url' => ['/qc-confirm-joid'],],
                            ],
                        ////////////////////////
                        ],
                        [
                            'label' => 'QC Process',
                            'icon' => 'tasks',
                            'url' => '#',
                            'items' => [
//                                        ['label' => 'Check Part', 'icon' => 'file-code-o', 'url' => ['/start-program'],],
//                                        ['label' => 'Create Check Part', 'icon' => 'dashboard', 'url' => ['/start-program/create'],],
                                // ['label' => 'Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
                                ['label' => 'QC All', 'icon' => 'dashboard', 'url' => ['/qc-confirm/show'],],
                                ['label' => 'QC Confirm Part', 'icon' => 'dashboard', 'url' => ['/qc-confirm'],],
                                ['label' => 'QC Confirm Join Part', 'icon' => 'dashboard', 'url' => ['/qc-confirm-joid'],],
                            ],
                        ],
                        [
                            'label' => 'User Setting',
                            'icon' => 'user',
                            'url' => '#',
                            'items' => [
                                ///////////////////////////////
//                                [
//                                    'label' => 'User Management',
//                                    'icon' => 'gear',
//                                    'url' => '#',
//                                    'items' => [
//                                        ['label' => 'Customer', 'icon' => 'anchor', 'url' => ['/customer'],],
//                                        ['label' => 'Models', 'icon' => 'anchor', 'url' => ['/models-p'],],
//                                        ['label' => 'Line', 'icon' => 'dashboard', 'url' => ['/line'],],
//                                        ['label' => 'Models-Line', 'icon' => 'dashboard', 'url' => ['/models-line'],],
//                                        ['label' => 'Machince', 'icon' => 'dashboard', 'url' => ['/machine'],],
//                                        ['label' => 'Table', 'icon' => 'dashboard', 'url' => ['/tables'],],
//                                        ['label' => 'Table Machine', 'icon' => 'dashboard', 'url' => ['/table-machine'],],
//                                        ['label' => 'Feeder', 'icon' => 'dashboard', 'url' => ['/feeder'],],
//                                        ['label' => 'Feeder Point', 'icon' => 'dashboard', 'url' => ['/feeder-point'],],
//                                        ['label' => 'Direction', 'icon' => 'dashboard', 'url' => ['/direction'],],
//                                        ['label' => 'Part', 'icon' => 'dashboard', 'url' => ['/item'],],
//                                        ['label' => 'Part Type', 'icon' => 'dashboard', 'url' => ['/part-type'],],
//                                        ['label' => 'PCB', 'icon' => 'dashboard', 'url' => ['/pcb'],],
//                                        ['label' => 'Check Status', 'icon' => 'dashboard', 'url' => ['/check-status'],],
//                                        ['label' => 'Program Status', 'icon' => 'dashboard', 'url' => ['/program-status'],],
//                                        ['label' => 'QC Status', 'icon' => 'dashboard', 'url' => ['/qc-status'],],
//                                        [
//                                            'label' => 'Level One',
//                                            'icon' => 'circle-o',
//                                            'url' => '#',
//                                            'items' => [
//                                                ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                                [
//                                                    'label' => 'Level Two',
//                                                    'icon' => 'circle-o',
//                                                    'url' => '#',
//                                                    'items' => [
//                                                        ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                                        ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                                    ],
//                                                ],
//                                            ],
//                                        ],
//                                    ],
//                                ],
                                [
                                    'label' => 'User',
                                    'icon' => 'share',
                                    'url' => ['/user/admin/index'],
                                    'items' => [
                                        ['label' => 'User', 'icon' => 'dashboard', 'url' => ['/user/admin/index'],],
                                        ['label' => 'Create User', 'icon' => 'file-code-o', 'url' => ['/user/admin/create'],],
                                        ['label' => 'Account settings', 'icon' => 'dashboard', 'url' => ['/user/settings/account'],],
//                                        ['label' => 'Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
                                    ],
                                ],
                                [
                                    'label' => 'RBAC',
                                    'icon' => 'share',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'admin', 'icon' => 'file-code-o', 'url' => ['/admin'],],
//                                        ['label' => 'Create Check Part', 'icon' => 'dashboard', 'url' => ['/start-program/create'],],
//                                        ['label' => 'Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                                        ['label' => 'QC Confirm Part', 'icon' => 'dashboard', 'url' => ['/qc-confirm'],],
//                                        ['label' => 'QC Confirm Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
                                    ],
                                ],
                            ],
                        ////////////////////////
                        ],
//                         ['label' => 'Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
//                        [
//                            'label' => 'Logout',
//                            'icon' => 'share',
//                            'url' => Html::a('<i class="fa fa-sign-out"></i> Back', ['/user/security/logout', 'linkOptions' => ['data-method' => 'post']]),
////                            'items' => [
////                                ['label' => 'admin', 'icon' => 'file-code-o', 'url' =>  ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post'],],
//////                                        ['label' => 'Create Check Part', 'icon' => 'dashboard', 'url' => ['/start-program/create'],],
//////                                        ['label' => 'Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
//////                                        ['label' => 'QC Confirm Part', 'icon' => 'dashboard', 'url' => ['/qc-confirm'],],
//////                                        ['label' => 'QC Confirm Join Part', 'icon' => 'dashboard', 'url' => ['/debug'],],
////                            ],
//                        ],
                    //   [],
                    ],
                ]
        )
        ?>


<!--<a href="<?= Url::to(['/user/security/logout']) ?>" data-method="post">Logout</a>-->
        //</center>
        <!--<div class="sidebar-footer hidden-small">-->

        <!--</div>-->

    </section>
    <?php
//            NavBar::begin([
//                'brandLabel' => Yii::$app->name,
//                'brandUrl' => Yii::$app->homeUrl,
//                'options' => [
//                    'class' => 'navbar-inverse navbar-fixed-top',
//                ],
//            ]);
//            echo Nav::widget([
//                'options' => ['class' => 'navbar-nav navbar-right'],
//                'items' => [
////                    ['label' => 'Home', 'url' => ['/site/index']
////                        ],
////                    ['label' => 'About', 'url' => ['/site/about']],
////                    ['label' => 'Menu', 'url' => [''], 'items' => [
////                            ['label' => 'ITEM', 'url' => ['/item/index']],
////                            ['label' => 'PRODUCT', 'url' => ['/product-models/index']],
////                            ['label' => 'PMP', 'url' => ['/pmp/index']],
////                            ['label' => 'BOM', 'url' => ['/bom/index']],
////                            ['label' => 'PRODUCTION-SUM', 'url' => ['/production-sum/index']],
////                        ]],
////                    ['label' => 'Contact', 'url' => ['/site/contact'], 'items' => [
////                            ['label' => 'Profile', 'url' => ['/user/settings/profile']],
////                            ['label' => 'Account', 'url' => ['/user/settings/account']],
////                            ['label' => 'register', 'url' => ['/user/registration/register']],
////                            ['label' => 'Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
////                        ]],
//                    Yii::$app->user->isGuest ? (
//                            ['label' => 'Login', 'url' => ['/user/security/login']]
//
//                            ) : (
//                            '<li>'
//                            . Html::beginForm(['/user/security/logout'], 'post')
//                            . Html::submitButton(
//                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
//                            )
//                            . Html::endForm()
//                            . '</li>'
//                            ),
//                ],
//            ]);
//            NavBar::end();
    ?>
</aside>
<!--<input type="submit" value="" />-->