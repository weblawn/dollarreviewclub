<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /*private $captcha_public_key = "6LfpiRATAAAAAFConx8Y2DwuZx84f_UMCCtvgS5-";
    private $captcha_server_key = "6LfpiRATAAAAACxCFCxxoQhkt2EqwKgk5zko0bli";*/
    
    private $captcha_public_key = "6LcAYxETAAAAAK47QsDyWT6mQcvJn0WMgHX28-BV";
    private $captcha_server_key = "6LcAYxETAAAAAFV1TECRORq8YBUGoIid836BMUpv";
    private $captcha_public_key2 = "6Lc65xUTAAAAAOxjx_S2HRBg1GMKZOqfLMyfo9x9";
    private $captcha_server_key2 = "6Lc65xUTAAAAAOg_OtlOtuV75Do_pT11757GX8bl";
    private $data = array();

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->userm->login($_COOKIE['site_username'], $_COOKIE['site_password'], $remember, $redirect);
        
        $this->load->helper('recaptcha');
        $this->data['recaptcha'] = recaptcha_get_html($this->captcha_public_key);
        $this->data['recaptcha2'] = recaptcha_get_html($this->captcha_public_key2);
    }

    public function index() {
        $this->data['title'] = get_title('user');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        load_view('index', $this->data);
    }
    /*public function load_customer_signup() {
        $this->load->view('user/shopper/signup');
    }
    public function load_seller_signup() {
        $this->load->view('user/company/signup');
    }*/

    public function db_email_validation($email) {
        $this->userm->db_email_validation($email);
    }

    public function login() {

        /* Redirect if user logged in */
        //$this->userm->validateLogin();
        $user = get_active_user();
        //print_r($user);
        if($user->role != ''){$goToUrl = (isset($user->role) && $user->role == 'backend') ? site_url('backend/') : site_url('home/');
        ajaxResp(true, '<div class="alert alert-success">Already logged in</div>',array('login_error' =>false,'redirect' =>$goToUrl));}

        $this->data['title'] = get_title('login');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $this->form_validation->set_rules("email", "lang:email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "lang:password", "trim|required");

        if ($this->form_validation->run() !== false) {

            $mail = $this->input->post("email", TRUE);
            $pass = $this->input->post("password", TRUE);
            $remember = $this->input->post('rememberme', TRUE);
            $redirect = $this->input->post('redirect', TRUE);
            
            /*if($remember == 'on')
            {
                //$this->session->sess_expiration = '2592000'; //1 month
                //$sec =  '2592000'; //1 month
                //$this->config->set_item('sess_expiration', '2592000');
                //$this->config->set_item('sess_expiration', $sec);
                
                //$this->session->sess_expiration = $sec; //~ one year
                //$this->session->CI_Session();
                //$this->session->CI_Session;
            }*/
            
        
            // Perform login action
            $this->data['login_error'] = $this->userm->login($mail, $pass, $remember, $redirect);
            $emailvarification_resend = $this->session->userdata('verify_resend');
            if(isset($emailvarification_resend))
            {
                $this->data['login_error'] = $this->session->userdata('verify_resend');
                $this->session->sess_destroy();
            }
            
            if(isset($this->data['login_error']) && $this->data['login_error'] !== 'can login')
            {
                ajaxResp(true, '<div class="alert alert-danger">'.$this->data['login_error'].'</div>',array('login_error' =>true));
            }
            else
            {
                // Get Current User
        $user = get_active_user();
        if(isset($user->role))
        {
            if($user->role == 'backend'){$goToUrl = site_url('backend/');}
            else if($user->role == 'companies'){$goToUrl = site_url('companies/my_account?tab=review_status');}
            else if($user->role == 'shopper'){$goToUrl = site_url('shopper/my_account?tab=review_status');}
            else{$goToUrl = site_url('home/');}
        }
        //$goToUrl = (isset($user->role) && $user->role == 'backend') ? site_url('backend/') : site_url('home/');
                ajaxResp(true, '<div class="alert alert-success">Login successfully</div>',array('login_error' =>false,'redirect' =>$goToUrl));
            }
        }
        else
        {
            //return false;
            ajaxResp(true, validation_errors(),array('login_error' =>true));
        }
        /*$emailvarification_resend = $this->session->userdata('verify_resend');
        if(isset($emailvarification_resend))
        {
            $this->data['login_error'] = $this->session->userdata('verify_resend');
            $this->session->sess_destroy();
        }*/

        //load_view('login/login', $this->data);
    }

    public function logout() {
        $this->session->sess_destroy();
        unset($_COOKIE["site_username"]);
        unset($_COOKIE["site_password"]);
        redirect('/home');
        //$this->userm->logout();
    }

    public function signup() {

        /* Redirect if user logged in */
        $this->userm->validateLogin();

        $act = $this->uri->segment(3);

        switch ($act) {
            case 'shopper': {
                    $this->data['title'] = get_title('shopper_account');
                    $this->data['keywords'] = "";
                    $this->data['description'] = "";
                    $file = "signup_form";
                    load_view('shopper/' . $file, $this->data);
                    break;
                }
            case 'company': {
                    $this->data['title'] = get_title('company_account');
                    $this->data['keywords'] = "";
                    $this->data['description'] = "";
                    $file = "signup_form";
                    load_view('company/' . $file, $this->data);
                
                    break;
                }
            default: {
                    redirect('user/signup/shopper');
                    
                }
        }
    }

    public function signup_valid() {

        /* Redirect if user logged in */
        $this->userm->validateLogin();

        $act = $this->uri->segment(3);

        switch ($act) {
            case 'shopper_1st_step': {

                    //Set Messages
                    $this->form_validation->set_message('is_unique', '{field} id already exists.');

                    // Set form validation rules                    
                    $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email|is_unique[users.email]");
                    $this->form_validation->set_rules('pass', 'Password', "trim|required|min_length[8]|max_length[20]");
                    
                    $selected_val = $this->input->post('selected_val', TRUE);
                    /*if($selected_val == '')
                    {$this->form_validation->set_rules('fav_cat', 'Favourite Category', "trim|required");}*/

                    //If form validated
                    if ($this->form_validation->run() !== false) {
                            ajaxResp(true, '<div class="alert alert-success">First step verification Successful.</div>',array('signup_error' =>false));
                    }
                    else
                    {
                        
                        ajaxResp(true, validation_errors(),array('signup_error' =>true));
                    }
                    break;
                }
            case 'shopper': {

                    $file = "signup_form";

                    //Set Messages
                    $this->form_validation->set_message('is_unique', '{field} id already exists.');

                    // Set form validation rules                    
                    
                    $this->form_validation->set_rules('amazon_name', 'Name on Amazon', "trim|required");
                    $this->form_validation->set_rules('amazon_link_marge', 'Amazon Link', "trim|required|is_unique[users_meta.mval]");

                    //If form validated
                    if ($this->form_validation->run() !== false) {

                        $email = $this->input->post('email', TRUE);
                        $pass = $this->input->post('pass', TRUE);
                        $fav_cat = $this->input->post('fav_cat', TRUE);
                        $selected_val = $this->input->post('selected_val', TRUE);
                        $receive_email = $this->input->post('receive_email', TRUE);
                        $amazon_name = $this->input->post('amazon_name', TRUE);
                        $amazon_profile_vote = $this->input->post('amazon_profile_vote', TRUE);
                        $amazon_profile_rank = $this->input->post('amazon_profile_rank', TRUE);
                        $amazon_link = $this->input->post('amazon_link_marge', TRUE);
                        //$parse_amazon_link = explode('?',$amazon_link);
                        //$amazon_link = $parse_amazon_link[0];                        
                        $pos = strpos($selected_val,$fav_cat);
                        if(!is_numeric($pos) && $fav_cat !='0')
                        {
                            $category = explode(",",$selected_val);
                            if(count($category)<3)
                            {
                                if($selected_val!='')
                                {
                                    $selected_val = $selected_val.','.$fav_cat;
                                }
                                else
                                {
                                    $selected_val = $fav_cat;
                                }
                            }
                            
                        }
                        
                        $verification_code = getVerificationCode();

                        $inputs = array(
                            "fname" => $amazon_name,
                            "lname" => $amazon_name,
                            "email" => $email,
                            "pass" => md5($pass),
                            "role" => "shopper",
                            "verification_code" => $verification_code,
                            "isDel" => 1,
                        );

                        
                        //Perform signup action
                        $user_id = $this->userm->signup($inputs);
                        if (is_numeric($user_id) && $user_id>0) {
                            
                            $category = explode(",",$selected_val);
                            $this->userm->addUsermeta($user_id, 'category', serialize($category));
                            if($receive_email != 'accepted')
                            {
                                $receive_email = 'notaccepted';
                            }
                            $this->userm->addUsermeta($user_id, 'receive_email', $receive_email);
                            $this->userm->addUsermeta($user_id, 'amazon_name', $amazon_name);
                            $this->userm->addUsermeta($user_id, 'amazon_url', $amazon_link);
                            $this->userm->addUsermeta($user_id, 'amazon_profile_vote', $amazon_profile_vote);
                            $this->userm->addUsermeta($user_id, 'amazon_profile_rank', $amazon_profile_rank);
                            $this->userm->addUsermeta($user_id, 'quota', '1');
                            $this->userm->addUsermeta($user_id, 'increment_for', 'signup');
                            $this->userm->addUsermeta($user_id, 'review', '0');
                        
                            $verification_link = site_url('home/verify/' . $verification_code);
                            // Send Verification Email
                            $msg ="
                            <table > 
                             <tbody> 
                             <tr> 
                             <td> Hello ".$amazon_name.",
                              
                             </td> 
                             </tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Welcome to Dollar Review Club! To activate your account and verify your email</td></tr>
                              <tr><td> address, please click the following link:</td></tr>
                              <tr><td><a href='".$verification_link."'>".$verification_link."</a></td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>We'd also appreciate if you can help spread the word by sharing the</td></tr>
                              <tr><td><a href='".site_url()."' target='_blank'>".site_url()."</a> website on your social network.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Note: If you've received an account verification email in error, it's likely that another </td></tr>
                              <tr><td>user entered your email address. If you didn't initiate the request for subscribing </td></tr>
                              <tr><td>Dollar Review Club, you don't need to take any further action. You can simply </td></tr>
                              <tr><td>disregard the verification email, and the account won't be verified.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Thank you!</td></tr>
                              <tr><td>The Dollar Review Club Team</td></tr>
                              
                             </tbody> 
                             </table>";
                            //$msg = "Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n " . site_url('user/verify/' . $verification_code) . "\n" . "\n\nThanks\n" . lang('website_name');
                            sendEmail($email, "Please confirm your subscription to Dollar Review Club.", $msg);
                            ajaxResp(true, '<div class="alert alert-success">Registration Successful.</div>',array('signup_error' =>false));
                        }
                        ajaxResp(true, '<div class="alert alert-danger">Registration Failed.</div>',array('signup_error' =>true));
                    }
                    else
                    {
                        
                        ajaxResp(true, validation_errors(),array('signup_error' =>true));
                    }
                    break;
                }
            case 'company': {
                    $this->data['title'] = get_title('company_account');
                    $this->data['keywords'] = "";
                    $this->data['description'] = "";
                    $file = "signup_form";

                    // Set validation messages
                    $this->form_validation->set_message('is_unique', '{field} already exists.');

                    // Set validation rules
                    $this->form_validation->set_rules('email', "lang:email", "trim|required|valid_email|is_unique[users.email]");
                    $this->form_validation->set_rules("cop_name", "lang:company name", "trim|required|min_length[5]|is_unique[companies.cname]");
                    $this->form_validation->set_rules('pass', "lang:pass", "trim|required|min_length[8]|max_length[20]");
                    $this->form_validation->set_rules('pro_cat', "lang:pro_cat", "trim|required");

                    //If form validated
                    if ($this->form_validation->run() !== false) {


                        $email = $this->input->post('email', TRUE);
                        $cop_name = $this->input->post('cop_name', TRUE);
                        $pass = $this->input->post('pass', TRUE);
                        $pro_cat = $this->input->post('pro_cat', TRUE);

                        $verification_code = getVerificationCode();

                        $inputs = array(
                            "fname" => $cop_name,
                            "lname" => $cop_name,
                            "email" => $email,
                            "pass" => md5($pass),
                            "verification_code" => $verification_code,
                            "role" => "companies",
                            "isDel" => 1,
                        );
                        //Perform signup action
                        $user_id = $this->userm->signup($inputs);
                        if (is_numeric($user_id) && $user_id>0) {
                            
                            $category = explode(",",$pro_cat);
                            $this->userm->addUsermeta($user_id, 'category', $category);
                            
                            $verification_link = site_url('home/verify/' . $verification_code);
                            // Send Verification Email
                            $msg ="
                            <table > 
                             <tbody> 
                             <tr> 
                             <td> Hello ".$cop_name.",
                              
                             </td> 
                             </tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Welcome to Dollar Review Club! To activate your account and verify your email</td></tr>
                              <tr><td> address, please click the following link:</td></tr>
                              <tr><td><a href='".$verification_link."'>".$verification_link."</a></td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>We'd also appreciate if you can help spread the word by sharing the</td></tr>
                              <tr><td><a href='".site_url()."' target='_blank'>".site_url()."</a> website on your social network.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Note: If you've received an account verification email in error, it's likely that another </td></tr>
                              <tr><td>user entered your email address. If you didn't initiate the request for subscribing </td></tr>
                              <tr><td>Dollar Review Club, you don't need to take any further action. You can simply </td></tr>
                              <tr><td>disregard the verification email, and the account won't be verified.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Thank you!</td></tr>
                              <tr><td>The Dollar Review Club Team</td></tr>
                              
                             </tbody> 
                             </table>";
                            //$msg = "Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n " . site_url('user/verify/' . $verification_code) . "\n" . "\n\nThanks\n" . lang('website_name');
                            sendEmail($email, "Please confirm your subscription to Dollar Review Club.", $msg);
                            ajaxResp(true, '<div class="alert alert-success">Registration Successful.</div>',array('signup_error' =>false));
                        }
                        ajaxResp(true, '<div class="alert alert-danger">Registration Failed.</div>',array('signup_error' =>true));
                    }
                    else
                    {
                        
                        ajaxResp(true, validation_errors(),array('signup_error' =>true));
                    }
                    break;
                }
            default: {
                    redirect('user/signup/shopper');
                }
        }
    }

    


    public function amazon_profile_verify($url, $post_paramtrs = false) {
        $url = $_POST['amazon_link'];
        $parse_url = explode('www.amazon.com/', $url);
        //echo $url.'</br>';
        //print_r($parse_url);
        $ids = array('11', '19', '32', '33', '71');
                shuffle($ids);
                $url = 'https://www.amazon.com.http.s'.$ids[2].'.wbprx.com/'.$parse_url[1];
        //echo $url.'</br>';
         // print_r($_POST);
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    if ($post_paramtrs) {
        curl_setopt($c, CURLOPT_POST, TRUE);
        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
    } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
    $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
    if ($follow_allowed) {
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
    curl_setopt($c, CURLOPT_REFERER, $url);
    curl_setopt($c, CURLOPT_TIMEOUT, 60);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
    $data = curl_exec($c);
    $status = curl_getinfo($c);
    curl_close($c);
    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
    //$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
    //$data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
    //print_r($data); print_r($status);
    if ($status['http_code'] == 200) {
        $user_data = array();
        $new_data = explode('<span class="a-size-base">Helpful votes</span>',$data);
        //print_r($new_data[1]);
        $new_data = explode('</span>',$new_data[1]);
        $new_data = explode('a-size-small">',$new_data[0]);
        //print_r($new_data[1]);
        //echo $data;
        $vote = $new_data[1];
        
        $new_data = explode('a-size-base">#',$data);
        $new_data = explode('</span>',$new_data[1]);
//print_r($new_data);
        $rank = $new_data[0];
        if($rank == ''){$rank = 0;}
        if($vote == ''){$vote = 0;}
        if($rank == 0 && $vote == 0){ajaxResp(true, '<div class="alert alert-danger">Amazon profile verification failed.</div>',array('http_code' =>'400'));}
        /*if(!is_numeric($rank)){$rank = 0;}
        if(!is_numeric($vote)){$vote = 0;}*/
         
        ajaxResp(true, '<div class="alert alert-success">Amazon profile verification Successful.</div>',array('http_code' =>$status['http_code'], 'rank' =>$rank, 'vote' =>$vote));
    } else {
        
        ajaxResp(true, '<div class="alert alert-danger">Amazon profile verification failed.</div>',array('http_code' =>$status['http_code']));
    }
}
    
    public function history() {
        $this->data['title'] = get_title('history');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        load_view('history/history', $this->data, true);
    }

    /*public function forgot() {
        $this->data['title'] = get_title('settings');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $this->form_validation->set_rules("email", lang("email"), "trim|required|valid_email");

        if ($this->form_validation->run() !== false) {

            $mail = $this->input->post('email', TRUE);

            $args = array(
                array(
                    'field' => 'email',
                    'cond' => '',
                    'value' => $mail
                )
            );

            $getUser = $this->userm->get_where($args);
            if ($getUser) {

                // Get User Data
                $user = $getUser[0];

                //Get Verification code
                $verification_code = getVerificationCode();

                $inputs = array("verification_code" => $verification_code);
                $where = array("id" => $user->id);

                //Perform update action
                if ($this->userm->update($inputs, $where)) {

                    // Reset url
                    $resetUrl = site_url('user/resetpass/' . $verification_code . '?mail=' . urlencode($user->email));

                    // Send Verification Email
                    $msg = "Dear {$user->fname} {$user->lname},\nPlease click on below URL or paste URL into your browser to reset your password\n\n " . $resetUrl . "\n" . "\n\nThanks\n" . lang('website_name');
                    sendEmail($user->email, "Forgot password", $msg);
                    redirect("user/login?forgot=1");
                    exit;
                }
            } else {
                $this->data['forgot_error'] = "Sorry! This Email <b>{$mail}</b> does'nt exist in our database.<br/>Please enter valid email address.";
            }
        }

        load_view('forgot/forgot', $this->data);
    }*/

    /*public function resetpass() {
        /* Redirect if user logged in */
        /*$this->userm->validateLogin();

        $this->data['title'] = get_title('reset_pass');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $this->data['code'] = $code = $this->uri->segment(3);
        $mail = urldecode($this->input->get("mail", TRUE));
        $this->data['mail'] = urlencode($mail);

        // Redirect if coditioned did not matched
        if (empty($code) || strlen($code) < 32 || strlen($code) > 32) {
            redirect('');
            exit();
        }

        $args = array(
            array(
                "field" => "verification_code",
                "cond" => "",
                "value" => $code,
            ),
            array(
                "field" => "email",
                "cond" => "",
                "value" => $mail
            )
        );
        $getUser = $this->userm->get_where($args);

        // If User validated
        if ($getUser) {


            $this->form_validation->set_rules("fpass", lang("password"), "trim|required|min_length[3]");
            $this->form_validation->set_rules("cpass", lang("password_confirm"), "trim|required|min_length[3]");

            if ($this->form_validation->run() !== false) {
                $fpass = $this->input->post("fpass", TRUE);
                $cpass = $this->input->post("cpass", TRUE);

                if ($fpass == $cpass) {

                    $user = $getUser[0];

                    // Perform update password                    
                    $update = array("verification_code" => "", "pass" => md5($fpass));
                    if ($this->userm->update($update, $args)) {
                        redirect('user/login?reset=1');
                        exit;
                    } else {
                        $this->data['forgot_error'] = "Sorry! There are an error with reset password";
                    }
                } else {
                    $this->data['forgot_error'] = "Sorry! Both password do not match.";
                }
            }
        } else {
            $this->data['forgot_error'] = "Sorry! Reset password hash or email address is not valid to reset password.";
        }

        // Load Verification
        load_view('resetpass', $this->data);
    }*/

}