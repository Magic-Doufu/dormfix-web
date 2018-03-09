<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $config['title_front_end'] = "建工學生宿舍網頁";
    $config['list_col'] = array('uid' => '單號',
                                'place' => '地點',
                                'sender' => '申請人',
                                'cteate_time' => '申報日期',
                                'last_reply_time' => '最後回應日期'
                            );
    $config['list_col_login'] = array('uid' => '單號',
                                'place' => '地點',
                                'sender' => '申請人',
                                'situation' => '故障原因',
                                'cteate_time' => '申報日期',
                                'last_reply_time' => '最後回應日期'
                            );
    $config['per_page'] = 20;
	$config['secret'] = '6Lcwx0oUAAAAAIZFURq-AuPTZmc_TrwSJa2EwK3h';