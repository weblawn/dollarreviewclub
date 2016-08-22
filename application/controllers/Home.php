<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    private $captcha_public_key = "6LcAYxETAAAAAK47QsDyWT6mQcvJn0WMgHX28-BV";
    private $captcha_server_key = "6LcAYxETAAAAAFV1TECRORq8YBUGoIid836BMUpv";
    private $captcha_public_key2 = "6Lc65xUTAAAAAOxjx_S2HRBg1GMKZOqfLMyfo9x9";
    private $captcha_server_key2 = "6Lc65xUTAAAAAOg_OtlOtuV75Do_pT11757GX8bl";
    private $data = array();
    
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->userm->login($_COOKIE['site_username'], $_COOKIE['site_password'], $remember, $redirect);
         
        // Load ReCaptcha helper
                
        $this->load->helper('recaptcha');
        $this->data['recaptcha'] = recaptcha_get_html($this->captcha_public_key);
        $this->data['recaptcha2'] = recaptcha_get_html($this->captcha_public_key2);
        $this->data['title'] = "Get More Product Reviews, Sell More on Amazon | Dollar Review Club";
        $this->data['keywords'] = "";
        $this->data['description'] = "Amazon Sellers provide free or discount products in exchange for honest customer reviews. Offer free or discount stuff to attact Amazon reviewers to get for review, increase Amazon sales!";
    }
    
    public function index() {
        
        /*
         * Get New $1 deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => "<=",
                    "value" => "1"
                )
            );
        //$this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 4", $searchTerm);
        $this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        
        /*
         * Get New deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => ">",
                    "value" => "1"
                )
            );
        //$this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 1000", $searchTerm);
        $this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        
        load_view('home', $this->data);
    }
    
    
    public function login() {
        /*
         * Get New $1 deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => "<=",
                    "value" => "1"
                )
            );
        //$this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 4", $searchTerm);
        $this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        
        /*
         * Get New deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => ">",
                    "value" => "1"
                )
            );
        //$this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 1000", $searchTerm);
        $this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        $this->data['login_page'] = 'on';
        load_view('home', $this->data);
    }
    
    public function verify() {

        /* Redirect if user logged in */
        $this->userm->validateLogin();
        /*
         * Get New $1 deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => "<=",
                    "value" => "1"
                )
            );
        //$this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 4", $searchTerm);
        $this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        
        /*
         * Get New deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => ">",
                    "value" => "1"
                )
            );
        //$this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 1000", $searchTerm);
        $this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        

        $this->data['title'] = get_title('verification');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $code = $this->uri->segment(3);

        // Redirect if coditioned did not matched
        if (empty($code) || strlen($code) < 32 || strlen($code) > 32) {
            $this->data['verify'] = array(true, '<div class="alert alert-danger" style="">'.lang('email_verification_failure').'</div>');
        }

        // Perform verify email verification
        if ($this->userm->email_verification($code)) {
            $this->data['verify'] = array(true, '<div class="alert alert-success" style="">'.lang('email_verification_sussess').'</div>');
                        
        } else {
            $this->data['verify'] = array(true, '<div class="alert alert-danger" style="">'.lang('email_verification_failure').'</div>');
        }

        // Load Verification
        load_view('home', $this->data);
    }
    
    
    public function reset() {

        /* Redirect if user logged in */
        $this->userm->validateLogin();
        /*
         * Get New $1 deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => "<=",
                    "value" => "1"
                )
            );
        //$this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 4", $searchTerm);
        $this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        
        /*
         * Get New deals ORDER BY DESC
         */
         $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => ">",
                    "value" => "1"
                )
            );
        //$this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 1000", $searchTerm);
        $this->data['newdeals'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        

        $this->data['title'] = get_title('resetpass');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $code = $this->uri->segment(3);
        $hash = $this->input->get('hash', TRUE);
        //echo $code.' '.$hash.' '.get_hash($code);
        $get_hash = get_hash($code);
        
        $getUsermata_apply_resetpass = getUsermata($code, 'apply_resetpass');       
        $getUsermata_apply_resetpass = $getUsermata_apply_resetpass->mval;
        // Redirect if coditioned did not matched
        if (empty($code) || $get_hash != $hash || $getUsermata_apply_resetpass !='yes') {
            $this->data['verify'] = array(true, '<div class="alert alert-danger" style="">'.lang('resetpass_failure').'</div>');
        }else {
            $this->data['verify'] = array(true, 'resetpasswordpopup');
        }
        $this->data['userid'] = $code;
        $this->data['hash'] = $hash;

        // Load Verification
        load_view('home', $this->data);
    }
    
}
