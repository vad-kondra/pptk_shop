<?php

/**
 * @var $user User
 */
    $user = Yii::$app->user->identity;
    $username = $user->username;


use app\models\user\User;
use yii\helpers\Url; ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <?=Yii::$app->user->identity->getFullName()?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--                <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->


        <?php
        $menus =  [
                ['label' => 'Рабочий стол', 'icon' => 'home', 'url' => [Url::to('/admin/default/index')]],
                ['label' => 'Заказы', 'icon' => 'stack-exchange', 'url' => [Url::to('/admin/order/index')]],
                ['label' => 'Новости', 'icon' => 'file-text', 'url' => [Url::to('/admin/news/index')]],
                ['label' => 'Обратный звонок', 'icon' => 'file-text', 'url' => [Url::to('/admin/callback/index')]],
                [
                        'label' => 'Управление товарами',
                        'icon' => 'suitcase',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Товары', 'icon' => 'file-o', 'url' => ['/admin/product/index'], 'active' => $this->context->id == 'admin/product'],
                            ['label' => 'Категории', 'icon' => 'file-o', 'url' => ['/admin/category/index'], 'active' => $this->context->id == 'admin/category'],
                            ['label' => 'Группы покупателей', 'icon' => 'users', 'url' => [Url::to('/admin/buyer-group/index')]],
                            ['label' => 'Производители', 'icon' => 'file-o', 'url' => ['/admin/brand/index'], 'active' => $this->context->id == 'admin/brand'],
                            ['label' => 'Характеристики', 'icon' => 'file-o', 'url' => ['/admin/characteristic/index'], 'active' => $this->context->id == 'admin/characteristic'],
                            ['label' => 'Теги', 'icon' => 'file-o', 'url' => ['/admin/tag/index'], 'active' => $this->context->id == 'admin/tag'],
                        ],
                ],

            [
                'label' => 'Сотрудники',
                'icon' => 'suitcase',
                'url' => '#',
                'items' => [
                    ['label' => 'Отделы', 'icon' => 'file-o', 'url' => ['/admin/department/index'], 'active' => $this->context->id == 'admin/product'],
                    ['label' => 'Управление сотрудниками', 'icon' => 'file-o', 'url' => ['/admin/employ/index'], 'active' => $this->context->id == 'admin/tag'],
                ],
            ],

            /*['label' => 'Ссылки', 'icon' => 'fa fa-link', 'url' => ['/admin/link/index']],
            [
                'label' => 'Страницы',
                'icon' => 'lock',
                'url' => '#',
                'items' => [
                    ['label' => 'Услуги', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/page/service')]],
                    ['label' => 'О нас', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/page/about')]],
                    ['label' => 'Контакты', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/page/contact')]],
                    ['label' => 'Созданные', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/user-page/index')]],
                    ['label' => 'header & footer & banner', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/header/index')]],
                    ['label' => 'SEO & '.'шаблоны', 'icon' => 'circle-o', 'url' => [\yii\helpers\Url::to('/admin/content/seo/index')]],
                ],
            ],
                ['label' => 'Переводы', 'icon' => 'language', 'url' => ['/admin/translation/index']],
                ['label' => 'Выйти', 'icon' => 'sign-out', 'url' => [\yii\helpers\Url::to('/auth/logout')]]*/
            ];
//            $items = getAssignedMenu($menus);
        //$items = \mdm\admin\components\Helper::filter($menus);
        $accessItem = [
                'label' => 'Управление доступом',
                'icon' => 'lock',
                'url' => '#',
                'items' => [
                    ['label' => 'Список пользователей', 'icon' => 'users', 'url' => [Url::to('/admin/user/index')]],
                    ['label' => 'Назначения', 'icon' => 'circle-o', 'url' => [Url::to('/admin/rbac/assignment')]],
                    ['label' => 'Роли', 'icon' => 'circle-o', 'url' => [Url::to('/admin/rbac/role')]],
                    ['label' => 'Разрешения', 'icon' => 'circle-o', 'url' => [Url::to('/admin/rbac/permission')]],
                    ['label' => 'Маршруты', 'icon' => 'circle-o', 'url' => [Url::to('/admin/rbac/route')]],
                    ['label' => 'Правила', 'icon' => 'circle-o', 'url' => [Url::to('/admin/rbac/rule')]],
                ],
        ];
        $configItem = ['label' => 'Конфигурация', 'icon' => 'cog', 'url' => [Url::to('/admin/content/index')]];

        if (Yii::$app->user->can(User::ROLE_ADMIN)) {
            array_push($menus, $accessItem);
            array_push($menus, $configItem);
        }

        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree mt-4', 'data-widget'=> 'tree'],
                //'items' => $items,
                'items' => $menus,
            ]
        ) ?>

    </section>

</aside>
