<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $config['title_front_end'] = "建工學生宿舍網頁";
    $config['list_col'] = array('uid' => '單號',
                                'place' => '地點',
                                'sender' => '申請人',
                                'cteate_time' => '申報日期',
                                'last_reply_time' => '最後回應日期',
                                'status' => '狀態'
                            );
    $config['list_col_login'] = array('uid' => '單號',
                                'place' => '地點',
                                'sender' => '申請人',
                                'situation' => '故障原因',
                                'cteate_time' => '申報日期',
                                'last_reply_time' => '最後回應日期'
                            );
    $config['per_page'] = 10;
    $config['zh_status'] = array(   '0' => "待處理",
                                    '1' => "已完成",
                                    '2' => "待廠商維護中",
                                    '3' => "待料中",
                                    '4' => "資訊不足"
                            );
    $config['str_deny'] = "沒有權限";