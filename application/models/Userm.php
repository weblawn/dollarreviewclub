<?php

class Userm extends CI_Model {

    private $table;
    private $usermeta;

    public function __construct() {
        parent::__construct();

        /* Get Table */
        $this->table = $this->db->dbprefix('users');
        $this->usermeta = $this->db->dbprefix("users_meta");
        $this->contact = $this->db->dbprefix('contact');
        $this->approve_request_table = $this->db->dbprefix('approve_request');
    }

    public function login($email, $pass, $remember, $redirect = null) {
        $resp = '';

        $this->db->select("*");
        $this->db->where("email", $email);
        $this->db->where("pass", md5($pass));

        // Where not facebook user
        $this->db->where("is_fb", 0);

        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            $uData = $q->row();

            // If user not allowed to login
            if ($uData->isDel) {
                if($uData->verification_code !='')
                {
                    return lang('blocked_login_email');
                }
                else
                {
                    return lang('blocked_login');
                }
                
            }// If user not allowed to login
            if ($uData->verification_code !='') {
                
                    return 'Please complete your email verification.';
                }
              
            
            if($remember == 'on')
            {
                setcookie("site_username", $email, time() + (86400 * 30), "/");
                setcookie("site_password", $pass, time() + (86400 * 30), "/");
            }
                
                $this->setSession($uData);
                
            //$goToUrl = (isset($redirect) && !empty($redirect)) ? urldecode($redirect) : $uData->role;
            //$goToUrl = (isset($uData->role) && $uData->role != 'backend') ? site_url('backend/') : site_url('home/');
            //$goToUrl = site_url('home/');
            //redirect($goToUrl);
            return 'can login';
            
        } else {
            return lang('invalid_login');
        }
    }

    public function logout($redirect = '') {
        $this->session->sess_destroy();
        //setcookie("site_username", "", time() - (86400 * 31), "/");
        //setcookie("site_password", "", time() - (86400 * 31), "/");
        unset($_COOKIE["site_username"]);
        unset($_COOKIE["site_password"]);
        //setcookie("password", "", time() - 3600);
        redirect($redirect);
        exit;
    }

    private function setSession(stdClass $userData) {

        //Bind session data
        $loginData = array(
            'user_id' => $userData->id,
            'role' => $userData->role,
            'avatar' => get_avatar($userData->email),
        );
        /*if($remember == 'on')
        {
            //$this->session->sess_expiration = '2592000'; //1 month
            $sec =  '2592000'; //1 month
            $this->config->set_item('sess_expiration', $sec);
        }*/
        //Set session
        $this->session->set_userdata($loginData);
        return true;
    }

    public function validateSession($role) {
        $userId = $this->session->userdata('user_id');
        $sessRole = $this->session->userdata('role');
        if (empty($userId)) {
            $this->logout();
            exit;
        }

        // Redirect To Role dashboard if role exists
        if ($role != $sessRole) {
            redirect($sessRole);
        }
    }

    public function validateAdmin() {
        $user = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        if (empty($user) || empty($role) || $role != 'backend') {
            $this->logout('backend/login');
            exit;
        }
    }

    public function validateLogin() {
        $user = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        if (isset($user) && !empty($role)) {
            $goToUrl = ($role == 'backend') ? site_url('backend/') : site_url('home/');
            redirect($goToUrl);
            exit;
        }
    }

    public function fbSignup(array $input = array(), $redirect) {
        $input['is_fb'] = 1;
        
        // If use already exist then login
        $q = $this->db->query("SELECT * FROM {$this->table} WHERE `email` = '{$input['email']}'");
        
        if ($q->num_rows() == 0) {
            if ($this->db->insert($this->table, $input)) {
                $this->setSession($this->get($this->db->insert_id()));            
            }
        }else if($q->num_rows() != 0){
            // Get Data and set session
            $this->setSession($q->row());        
        }
        
        // Redirect to dashboard
        $goToUrl = (isset($redirect) && !empty($redirect)) ? urldecode($redirect) : "";
		redirect($goToUrl);
    }
	
    public function signup(array $input) {
        // Insert to database
        if ($this->db->insert($this->table, $input)) {
            $user_id = $this->db->insert_id();
            $userData = $this->get($user_id);
            //return $userData;
            
            return $user_id;
        }
        return '0';
    }
	
    public function addcontact(array $input) {
        // Insert to database
        if ($this->db->insert($this->contact, $input)) {
            $user_id = $this->db->insert_id();
            
            return $user_id;
        }
        return '0';
    }

    public function get($userId = null) {

        $userId = (!empty($userId)) ? $userId : $this->session->userdata('user_id');

        //$this->db->select("*");
        $this->db->where("id", $userId);

        $query = $this->db->get($this->table);

        $userData = new stdClass();
        if ($query) {
            $userData = $query->row();
        }

        return $userData;
    }
    
    public function get_notification($user_type) {

        $userId = $this->session->userdata('user_id');
        //return $user_type;
        //return $userId;
        if(!is_numeric($userId))
        {
            return 'false';
        }
        $this->db->select("*");
        if($user_type == "shopper"){$this->db->where("customer_id", $userId);$this->db->where("notification", 'yes');}
        else if($user_type == "companies"){$this->db->where("seller_id", $userId);$this->db->where("seller_notification", 'yes');}
        else{ return 'false'; }
        
        $this->db->order_by('id', 'DESC');
        

        $query = $this->db->get($this->approve_request_table);

        if ($query->num_rows() > 0) {
            $result = $query->result_object();
        }
        else{$result = 'false';}
        return $result;
    }
    
    public function disable_notification($user_type) {

        $userId = $this->session->userdata('user_id');
        //return $user_type;
        //return $userId;
        if(!is_numeric($userId))
        {
            return 'false';
        }
        $this->db->select("*");
        if($user_type == "shopper"){$this->db->where("customer_id", $userId);}
        else{ return 'false'; }

        $this->db->where("notification", 'yes');
        $this->db->order_by('id', 'DESC');
        

        $query = $this->db->get($this->approve_request_table);

        if ($query->num_rows() > 0) {
            $result = $query->result_object();
            foreach($result as $single)
            {
                $date = strtotime(date('Y-m-d'));
                    $new_date = $date + 86400;
                    $update = array("next_time" => $new_date);
                    $where = array("id" => $single->id);
                    $get_id = $this->product->update_approve_request($update,$where);
                    
                /*$skip = 'false';
                $date = strtotime(date('Y-m-d'));
                if($single->next_time != intval('0') && intval($single->next_time) < $date)
                {
                    $skip = 'true';                    
                }
                if($skip == 'false' && $single->code_taken == 'no')
                {
                        $update = array("notification" => 'no');
                        $where = array("id" => $single->id);
                        $get_id = $this->product->update_approve_request($update,$where);
                }
                else if($skip == 'false' && $single->code_taken == 'yes')
                {
                    $date = strtotime(date('Y-m-d'));
                    $new_date = $date + 86400;
                    $update = array("next_time" => $new_date);
                    $where = array("id" => $single->id);
                    $get_id = $this->product->update_approve_request($update,$where);
                }*/
            
           } 
            
            
            
            
        }
        else{$result = 'false';}
        return $result;
    }
    
    public function disable_seller_notification($user_type) {

        $userId = $this->session->userdata('user_id');
        //return $user_type;
        //return $userId;
        if(!is_numeric($userId))
        {
            return 'false';
        }
        $this->db->select("*");
        if($user_type == "companies"){$this->db->where("seller_id", $userId);}
        else{ return 'false'; }

        $this->db->where("seller_notification", 'yes');
        $this->db->order_by('id', 'DESC');
        

        $query = $this->db->get($this->approve_request_table);

        if ($query->num_rows() > 0) {
            $result = $query->result_object();
            foreach($result as $single)
            {
                $date = strtotime(date('Y-m-d'));
                $new_date = $date + 86400;
                //$update = array("seller_notification" => 'no', "next_time" => $new_date);
                $update = array("next_time" => $new_date);
                $where = array("id" => $single->id);
                $get_id = $this->product->update_approve_request($update,$where);
            
           } 
        }
        else{$result = 'false';}
        return $result;
    }

    public function get_where(array $args = array(), array $orderBy = array(), $limit = NULL, $offset = NULL) {
        $this->db->select("*");

        // Bind Condition
        if (!empty($args)) {
            foreach ($args as $key => $arg) {                
                $this->db->where("{$arg['field']} {$arg['cond']}", $arg['value']);
            }
        }

        // Order By
        if (!empty($orderBy)) {
            $this->db->order_by($orderBy[0], $orderBy[1]);
        }
        else
        {
            $this->db->order_by('id', 'DESC');
        }

        $q = $this->db->get($this->table, $limit, $offset);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            return $result;
        }

        return false;
    }

    public function update(array $input, array $where) {

        // Set where condition
        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                $this->db->where($cond, $vals);
            }
        }

        // Update Records
        if ($this->db->update($this->table, $input)) {
            return true;
        }
        return false;
    }

    public function current() {
        return $this->get();
    }

    public function db_email_validation($email) {
        $this->db->select("*");
        $this->db->where("email", $email);

        $q = $this->db->get($this->table);

        if ($q->num_rows() > 0) {
            return false;
        }

        return true;
    }

    public function email_verification($code) {
        $this->db->select("*");
        // select Where
        $this->db->where('verification_code', $code);
        $this->db->where("is_fb", 0);

        $q = $this->db->get($this->table);
        $q_num_rows = $q->num_rows();
        if ($q->num_rows() > 0) {
            $uData = $q->row();
        }
        else
        {
            return false;
        }
            
            
        $updates = array(
            "isDel" => 0,
            "verification_code" => ""
        );

        // Update Where
        $this->db->where('verification_code', $code);

        // Update fields
        if ($this->db->update($this->table, $updates)) {
            // If user allowed to login
           /* if ($q_num_rows > 0 && $uData->isDel==1) {
                // Set data and redirect
                $this->setSession($uData);
                $goToUrl = $uData->role."/home";
                redirect($goToUrl);
            }*/
            
            return true;
            
        }

        return false;
    }

    public function total(array $where = array()) {
        $total = 0;

        $this->db->select("COUNT(*) AS `rec`");

        if (!empty($where)) {
            foreach ($where as $cond => $vals) {
                $this->db->where($cond, $vals);
            }
        }

        $q = $this->db->get($this->table);

        if ($q->num_rows() > 0) {
            $r = $q->row();
            $total = $r->rec;
        }
        return $total;
    }

    public function getUsermeta($uid, $key) {

        // Where        
        $this->db->where('uid', $uid);
        $this->db->where('mkey', $key);

        // Get Meta
        $q = $this->db->get($this->usermeta);
        if ($q->num_rows() > 0) {
            $meta = $q->row();            
            return $meta;
        }

        return false;
    }

    public function addUsermeta($uid, $key, $val) {

        // Encode if array
        if (is_array($val)) {
            $val = serialize($val);
        }

        // Arguments
        $args = array(
            'uid' => $uid,
            'mkey' => $key,
            'mval' => $val
        );

        // Add Usermeta
        if ($this->db->insert($this->usermeta, $args)) {
            return true;
        }

        return false;
    }

    public function updateUsermeta($uid, $key, $val) {
        
        
        // If usermeta not exists
        if(!$this->getUsermeta($uid, $key)){            
            // If Not exists then add
            if( $this->addUsermeta($uid, $key, $val) ){
                return true;
            }
        }
        
        // Encode if array
        if (is_array($val)) {
            $val = serialize($val);
        }

        // Where        
        $this->db->where('uid', $uid);
        $this->db->where('mkey', $key);

        // Update Meta
        $update = array('mval' => $val);
        if ($this->db->update($this->usermeta, $update)) {
            return true;
        }

        return false;
    }
	
	public function deleteUsermeta($uid, $key){
		$sql = "DELETE FROM {$this->usermeta} WHERE `uid` = '{$uid}' AND `mkey` = '{$key}'";
		if( $this->db->query($sql) ){
			return true;
		}
		return false;
	}
	
    public function __destruct() {
        $this->db->close();
    }

}
