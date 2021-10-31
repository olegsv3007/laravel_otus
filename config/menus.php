<?php

return [
    // Меню в профиле пользователя
    // key - имя маршрута
    // value - путь к lang ресурсу
    'profile_menu' => [
        'profile' => 'public/common.profile_menu.profile',
        'public.profile.order_history' => 'public/common.profile_menu.order_history',
        'profile.view_history' => 'public/common.profile_menu.view_history',
    ],

    // Меню в админ панели
    // key - имя маршрута
    // value - массив, содержащий путь к lang ресурсу и иконке
    'cms_menu' => [
        'cms' => [
            'title' => 'cms/common.menu.main',
            'icon' => 'icons.home',
        ],
        'cms.settings.index' => [
            'title' => 'cms/common.menu.settings',
            'icon' => 'icons.settings',
            'role' => 'admin',
        ],
        'cms.countries.index' => [
            'title' => 'cms/common.menu.countries',
            'icon' => 'icons.country',
            'role' => 'admin',
        ],
        'cms.cities.index' => [
            'title' => 'cms/common.menu.cities',
            'icon' => 'icons.city',
            'role' => 'admin',
        ],
        'cms.organizations.index' => [
            'title' => 'cms/common.menu.organizations',
            'icon' => 'icons.organization',
            'role' => 'admin',
        ],
        'cms.hotels.index' => [
            'title' => 'cms/common.menu.hotels',
            'icon' => 'icons.building',
            'role' => 'manager',
        ],
        'cms.apartments.index' => [
            'title' => 'cms/common.menu.apartments',
            'icon' => 'icons.apartment',
            'role' => 'manager',
        ],
        'cms.reservations.index' => [
            'title' => 'cms/common.menu.reservations',
            'icon' => 'icons.book',
            'role' => 'manager',
        ],
        'cms.feedbacks.index' => [
            'title' => 'cms/common.menu.feedbacks',
            'icon' => 'icons.pen',
            'role' => 'moderator',
        ],
    ],
];
