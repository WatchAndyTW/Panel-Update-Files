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
    'validation' => [
        'fqdn_not_resolvable' => '提供的正式域名（FQDN）或 IP 位址未解析到有效的 IP 位址。',
        'fqdn_required_for_ssl' => '此節點需要解析到外網 IP 地址的正式域名才能使用 SSL。',
    ],
    'notices' => [
        'allocations_added' => '已成功為此節點分配 IP 位址。',
        'node_deleted' => '已成功從面板中移除節點。',
        'location_required' => '您必須至少設定一个區域才能添加節點到面板。',
        'node_created' => '已成功建立節點！您可以透過\'設定\'選項卡來自動設定此機器上的監控程式。<strong>在您添加伺服器之前，您必需先分配一個 IP 地址及端口。</strong>',
        'node_updated' => '已更新節點設定。若監控程式設定更改，您需要重新啟動監控程式才能生效。',
        'unallocated_deleted' => '已為 <code>:ip</code> 刪除所有未分配的端口。',
    ],
];
