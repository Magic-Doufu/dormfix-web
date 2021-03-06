<?php
class Main extends CI_Controller {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Taipei');
    }
    private function index($params = array()) {
        $defaults = array(
            'page' => 'none',
            'data' => '',
            'components' => array()
        );
        $params = array_merge($defaults, $params);
        if (! file_exists(APPPATH.'views/pages/'.$params['page'].'.php')) {
            show_404();
        }
        $data['title'] = $this->config->item('title_front_end');
        $this->load->view('general/header', $data);
        $this->load->view('general/banner');
        $this->load->view('general/nagivation');
        $this->load->view('pages/' . $params['page'], $params['data']);
        foreach ($params['components'] as $value) {
            $this->load->view('components/' . $value);
        }
        $this->load->view('general/footer');
    }

    public function request() {
        $data = array('page' => 'request_form');
        $this->index($data);
    }

    public function request_sent() {
		if($this->validate_captcha($this->input->get('g-recaptcha-response'))) {
        //function for send request
        $this->load->model('fixrequest');
        echo $this->fixrequest->sent($this->input->get(NULL, TRUE)) ? "success" : "fail";
        $this->load->view('pages/success');
		}
    }

    public function request_list($pages = '1', $type = '0') {
        $this->load->model('fixrequest');
        $this->load->model('member');
        if (!$this->session->has_userdata('list')) {
            $this->session->set_userdata('list', '0');
        }
        //$this->load->library('pagination');
        //show requests list
        $data = array(  'page' => 'list',
                        'data' => array('columns' => $this->config->item($this->member->check_login() ? 'list_col_login' : 'list_col'),
                        'lists' => $this->fixrequest->get_list($pages, $this->session->list),
                        'pagination' => $this->fixrequest->get_page_link($pages),
                        'type' => $this->session->list
                    ));
        if($this->member->check_login()) {
            $data['components'] = array('detail_update');
        }
        $this->index($data);
    }

    public function request_detail($uid = '0') {
        $this->load->model('fixrequest');
        $this->load->model('member');
        //if uid not found than show it
        //show requests detail
        $data = array(  'page' => 'detail',
                        'data' => $this->fixrequest->detail($uid),
                        'components' => array('button_back')
                    );
        empty($data['data']) ? show_404() : $this->index($data);
    }
    public function detail_update() {
        $this->load->model('fixrequest');
        $request = $this->input->post(NULL, TRUE);
        if(!empty($request)) {
            echo $this->fixrequest->update($request['uid'],$request['status']);
        }
    }
    public function get_building_data($building_id = '0') {
        $this->load->model('building_data');
        echo $this->building_data->get($building_id);
    }
    public function manage($fcs = '') {
        $this->load->model('member');
        if ($this->member->check_login()) {
            $data = array(  'page'  =>  'manage',
                            'data'  =>  array('name' => $this->session->name,
                                            'last_login' => $this->session->last_login,
                                            'prev_login' => $this->session->prev_login
                                        )
                    );
        } else {
            $data = array('page' => 'login');
        }
        switch ($fcs) {
            case 'login':
				if($this->validate_captcha($this->input->post('g-recaptcha-response'))) {
                    if($this->member->login($this->input->post(NULL, TRUE))){
                        header("Location:" . base_url('index.php/manage'));
                    } else {
                        array_push($data, $data['components'] = array('pass_error'));
                    }
				} else {
					array_push($data, $data['components'] = array('no_recaptcha'));
				}
                break;
            case 'logout':
                $this->member->logout();
                header("Location:" . base_url('index.php/manage'));
                break;
            case 'chpwd':
                if ($this->member->chpwd($this->input->post(NULL, TRUE))) {
                    header("Location:" . base_url('index.php/manage'));
                } else {
                    array_push($data, $data['components'] = array('pass_error'));
                }
                break;
        }
        $this->index($data);
    }
	private function validate_captcha($captcha) {
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->config->item('secret') . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
		return ($response->success) ? TRUE : FALSE;
    }
    public function pagetype() {
        if ($this->session->has_userdata('list')) {
            $this->session->set_userdata('list', $this->input->get('pagetype', TRUE));
        }
    }
    public function getsituation() {
        $this->load->model('fixrequest');
        echo $this->fixrequest->get_situation($this->input->get(array('uid','secret'), TRUE));
    }
}