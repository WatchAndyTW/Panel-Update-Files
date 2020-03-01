<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * Translate by <Hmtp Hosting 凱文 Kevin>
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

return [
    'notices' => [
        'created' => '已成功建立 :name 。',
        'deleted' => '已成功從面板删除指定的管理模組。',
        'updated' => '已成功更新管理模組選項。',
    ],
    'eggs' => [
        'notices' => [
            'imported' => '已成功導入管理模組。',
            'updated_via_import' => '此管理模組已按照上傳的文件完成更新。',
            'deleted' => '已成功删除指定的管理模組。',
            'updated' => '已成功更新管理模組的配置。',
            'script_updated' => '已成功更新孵化蛋安装脚本且將於伺服器安装時自動執行。',
            'egg_created' => '一個管理模組已經成功建立. 您需要重啟所有正在運行的節點来使該模組生效。',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => '已移除變數 ":variable" 且重新載入伺服器镜像後將會失效。 ',
            'variable_updated' => '已更新變數 ":variable" 。您需要重新載入使用此變數的伺服器以套用變更。',
            'variable_created' => '已成功建立新變數並且已分配给此孵化蛋。',
        ],
    ],
];
