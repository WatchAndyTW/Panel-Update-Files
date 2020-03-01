<?php

return [
    'validation_error' => '請求中有一個或多個字段錯誤',
    'errors' => [
        'return' => '返回上一頁',
        'home' => '返回首頁',
        '403' => [
            'header' => '喔歐！您沒有權限連接此網頁',
            'desc' => '您沒有存取此伺服器上的資源的權限。',
        ],
        '404' => [
            'header' => '喔歐！無法找到您所要的檔案',
            'desc' => '我們無法在此伺服器上找到所請求的資源。',
        ],
        'installing' => [
            'header' => '伺服器安裝中',
            'desc' => '伺服器正在完成安裝。請幾分鐘後再来查看，您將在安裝完成後收到電子郵件提醒。',
        ],
        'suspended' => [
            'header' => '伺服器已停用',
            'desc' => '此伺服器已停用且無法使用。',
        ],
        'maintenance' => [
            'header' => '節點維護中',
            'title' => '暫時無法使用',
            'desc' => '此節點正在維護，目前無法使用。',
        ],
    ],
    'index' => [
        'header' => '您的伺服器',
        'header_sub' => '您有權限訪問的伺服器。',
        'list' => '伺服器列表',
    ],
    'api' => [
        'index' => [
            'list' => '您的密鑰',
            'header' => '帳號 API',
            'header_sub' => '管理允許您對面板執行操作的 API 密鑰。',
            'create_new' => '建立 API 密鑰',
            'keypair_created' => '已成功建立 API 密鑰並列於下方。',
        ],
        'new' => [
            'header' => '建立 API 密鑰',
            'header_sub' => '新建帳號存取密鑰。',
            'form_title' => '詳細資訊',
            'descriptive_memo' => [
                'title' => '描述',
                'description' => '請輸入便於分辨此密鑰的描述。',
            ],
            'allowed_ips' => [
                'title' => '允許的 IP',
                'description' => '輸入允許使用此密鑰的 IP 地址列表。此功能支援無類別網域間路由。留空將允許所有 IP 使用。',
            ],
        ],
    ],
    'account' => [
        'details_updated' => '已成功更新您的帳號資料。',
        'invalid_password' => '您提供的密碼無效。',
        'header' => '您的帳號',
        'header_sub' => '管理您的帳號資料.',
        'update_pass' => '修改密碼',
        'update_email' => '修改電子郵件地址',
        'current_password' => '目前密碼',
        'new_password' => '新密碼',
        'new_password_again' => '再次輸入新密碼',
        'new_email' => '新電子郵件地址',
        'first_name' => '姓氏',
        'last_name' => '名稱',
        'update_identity' => '更新個人資料',
        'username_help' => '您的使用者名稱必須未被他人使用，且僅包含下列字元：:requirements。',
        'language' => '語言',
    ],
    'security' => [
        'session_mgmt_disabled' => '系統管理員已停用此介面来管理帳號登入狀態。',
        'header' => '帳號安全',
        'header_sub' => '管理在線中的登入與兩步驟驗證。',
        'sessions' => '目前在線的工作階段',
        '2fa_header' => '兩步驟驗證',
        '2fa_token_help' => '請填入由應用程式所生成的兩步驟驗證密鑰（Google 驗證器、Authy 等）。',
        'disable_2fa' => '關閉兩步驟驗證',
        '2fa_enabled' => '已為此帳號啟用兩步驟驗證，您將需要驗證來登入至此帳號。若您想關閉兩步驟驗證，您只需在下方輸入密鑰並按「關閉兩步驟驗證」即可。',
        '2fa_disabled' => '已關閉兩步驟驗證！您應該啟用此功能来為此帳號加強安全性。',
        'enable_2fa' => '啟用兩步驟驗證',
        '2fa_qr' => '在您的設備上設定兩步驟驗證',
        '2fa_checkpoint_help' => '在您的手機上使用兩步驟驗證應用程式掃描左侧的 QR Code 或直接輸入下方的代碼。若成功錄入，請在下方輸入應用程式生成的密碼。',
        '2fa_disable_error' => '無法關閉此帳號的兩步驟驗證。原因：提供的兩步驟驗證密鑰無效或錯誤. 關閉兩步驟驗證失敗.',
    ],
];
