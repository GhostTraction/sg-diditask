<?php
/**
 * User: Yu Peng
 * Date: 2023-3-1
 * Remark: 本文件为DKP模块目录层级
 */

return [
    'dkp' => [
        'name' => 'DiDiTask',
        'icon' => 'fas fa-rocket',
        'route_segment' => 'diditask',
        'permission' => 'diditask.request',
        'entries' => [
            [
                'name' => '我的DKP',
                'icon' => 'fas fa-medkit',
                'route' => 'diditask.minelist',
                'permission' => 'diditask.request',
            ],
            [
                'name' => 'DKP兑换',
                'icon' => 'fas fa-gavel',
                'route' => 'diditask.commodity',
                'permission' => 'diditask.request',
            ],
        ],
    ],
];
