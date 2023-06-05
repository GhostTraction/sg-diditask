<?php
/**
 * User: Yu Peng
 * Date: 2023-6-2
 * Remark: 本文件为滴滴任务模块目录层级
 */

return [
    'diditask' => [
        'name' => '滴滴任务',
        'icon' => 'fas fa-rocket',
        'route_segment' => 'diditask',
        'permission' => 'diditask.request',
        'entries' => [
            [
                'name' => '老板发布任务',
                'icon' => 'fas fa-medkit',
                'route' => 'diditask.publishTask',
                'permission' => 'diditask.request',
            ],
            [
                'name' => '打手接受任务',
                'icon' => 'fas fa-gavel',
                'route' => 'diditask.acceptTask',
                'permission' => 'diditask.request',
            ],
        ],
    ],
];
