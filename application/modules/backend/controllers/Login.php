<?php

class Login extends MX_Controller {
    
    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateLogin();
    }

    public function index() {
        $this->data['title'] = get_title('deals');

        $this->form_validation->set_rules('username', "lang:username", "trim|required|min_length[3]");
        $this->form_validation->set_rules('password', "lang:password", "trim|required|min_length[3]");

        if ($this->form_validation->run() !== false) {
            $user = $this->input->post('username', TRUE);
            $pass = $this->input->post('password', TRUE);
            $remember = 'off';

            $this->data['login_error'] = $this->userm->login($user, $pass, $remember);
            if($this->data['login_error'] == 'can login')
            {
                redirect(base_url('backend'));
            }
        }

        $this->load->view('login/login', $this->data);
    }

}
