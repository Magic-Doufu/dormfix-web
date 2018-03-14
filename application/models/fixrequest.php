<?php
class Fixrequest extends CI_Model {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Taipei');
    }
    function sent($request_data = array()) {
        $request_data['place'] = implode(' ', $request_data['place']);
        $request_data['sender'] = implode(' ', $request_data['sender']);
        $defaults = array(
            'place' => '',
            'situation' => '',
            'sender' => '',
            'cteate_time' => date("Y-m-d")
        );
		unset($request_data['g-recaptcha-response']);
        $request_data = array_merge($defaults, $request_data);
        foreach ($request_data as $key => $value) {
            $value = html_escape(remove_invisible_characters($value));
            if (empty($value) && ($key != 'secret')) {
                return FALSE;
            }
        }
        $this->db->insert('fix_detail', $request_data); 
        return TRUE;
    }
    function get_list($page, $type = '0') {
        $this->db->order_by('uid', "desc");
        $this->db->where('status =', $type);
        return $this->db->get('fix_detail', $this->config->item('per_page'), (intval($page) - 1) * $this->config->item('per_page'))->result_array();
    }
    function get_page_link($page) {
        $this->load->library('pagination');
        $config['full_tag_open'] = '<section class="text-center bkg-green text-white">';
        $config['full_tag_close'] = '</section>';
        $config['last_link'] = '>>';              //末頁
        $config['prev_link'] = '<';              //前頁
        $config['next_link'] = '>';              //下頁
        $config['cur_tag_open'] = '<a class="btn btn-success bd-n btn-square disabled">';        //當前頁
        $config['cur_tag_close'] = '</a>';
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = site_url('request_list/');
        $this->db->where('status =', $this->session->list);
        $config['total_rows'] = $this->db->count_all_results('fix_detail');
        $config['per_page'] = $this->config->item('per_page');
        $config['attributes'] = array('class' => 'btn btn-success bd-n btn-square');
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    function detail($uid) {
        $this->load->model('member');
        $query = $this->db->get_where('fix_detail', array('uid' => $uid));
        if ($query->num_rows() > 0) {
            $response = $query->row_array();
            if (!empty($response['secret']))
                $response['situation'] = $this->load->view('components/secret', '', TRUE);
        } else {
            $response = false;
        }
        return $response;
    }
    function update($uid, $state) {
        $this->db->where('uid', $uid)->update('fix_detail', array('status' => $state, 'last_reply_time' => date("Y-m-d")));
    }
    function get_situation($data) {
        $uid = html_escape(remove_invisible_characters($data['uid']));
        $secret = html_escape(remove_invisible_characters($data['secret']));
        $this->db->where('uid', $uid);
        $this->db->where('secret', $secret);
        $this->db->select('situation');
        $situation = $this->db->get('fix_detail')->row()->situation;
        if (!empty($situation)) {
            echo $situation;
        } else {
            http_response_code(403);
        }
    }
}
