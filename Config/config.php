<?php

return [
    'name' => 'Purchase',

    'menus' => [
        [
            'text' => 'Purchase',
            'route' => 'admin.Purchase.index',
            'icon' => 'fas fa-fire',
            'order' => 1,
            'can' => 'Purchase-read',
        ],
    ],
];
