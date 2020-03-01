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
    'exceptions' => [
        'no_new_default_allocation' => '您正在嘗試刪除此伺服器的預設分配地址，但此伺服器沒有可用的備選分配地址。',
        'marked_as_failed' => '此伺服器被標記為安装失敗。目前狀態無法在面板中被改變。',
        'bad_variable' => '變數 :name 有驗證錯誤。',
        'daemon_exception' => '連接監控程式時回復了 HTTP/:code 程式碼。此錯誤已被紀錄。',
        'default_allocation_not_found' => '未在此伺服器上找到請求的預設分配地址。',
    ],
    'alerts' => [
        'startup_changed' => '已更新此伺服器的啟動設定。若此伺服器的啟動模組被更改，其將被重新安装。',
        'server_deleted' => '已成功從系统中删除伺服器。',
        'server_created' => '已成功在面板中創建伺服器。請稍等面板安装伺服器完成。',
        'build_updated' => '已更新此伺服器的建構參數。部分更改可能需要重啟後才能生效。啟動參數已更改。',
        'suspension_toggled' => '伺服器停用狀態已更改為 :status.',
        'rebuild_on_boot' => '此伺服器已被標記為需要重新建構 Docker。此操作會在下次啟動伺服器後生效。',
        'install_toggled' => '此伺服器的安装狀態已被更改。',
        'server_reinstalled' => '此伺服器已置於即將開始的重新安裝隊列中。',
        'details_updated' => '已成功更新伺服器信息。',
        'docker_image_updated' => '已成功更改此伺服器使用的預設 Docker 镜像。此操作需要重新啟動以套用更改。',
        'node_required' => '您需要配置至少一個節點以添加伺服器至面板。',
    ],
];
