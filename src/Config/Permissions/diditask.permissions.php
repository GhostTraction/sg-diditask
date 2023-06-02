<?php
/**
 * User: Yu Peng
 * Date: 2023-6-2
 * Remark: 本文件为滴滴任务模块权限设定
 */

return [
    'request' => [
        'label' => 'Request',
        'description' => '能够查询本账号DKP以及DKP所兑商品',
    ],
    'admin' => [
        'label' => 'admin',
        'description' => '允许配置全局DKP设置',
    ],
];
