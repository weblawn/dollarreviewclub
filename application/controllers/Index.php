<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
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
        $this->data['title'] = "Get More Product Reviews, Sell More on Amazon | Dollar Review Club";
        $this->data['keywords'] = "";
        $this->data['description'] = "Amazon Sellers provide free or discount products in exchange for honest customer reviews. Offer free or discount stuff to attact Amazon reviewers to get for review, increase Amazon sales!";
    }
    
    public function index() {
        
        /*
         * Get Featured Products
         */
        /*$this->data['featured'] = $this->product->display(null, "LIMIT 4");
        
        /*
         * Get New deals ORDER BY DESC
         */
        /*$this->data['newdeals'] = $this->product->display(null, "ORDER BY pid DESC LIMIT 4");
        $this->data['dcs'] = $this->dcsmodel->get_where();
        //load_view('index', $this->data);
        $this->load->view('index/index', $this->data);*/
        
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

    public function contact_validation() {
        $this->data['title'] = get_title('contact');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        

        // set validation rules for contact form 
        $this->form_validation->set_rules('name', lang('name') , "trim|required|min_length[3]|max_length[60]");
        $this->form_validation->set_rules('email', lang('email'), "trim|required|valid_email"); 

        $name = $this->input->post('name', TRUE);
        $email = $this->input->post('email', TRUE);
        $identity = $this->input->post('identity', TRUE);
        //on form validate
        if( $this->form_validation->run() !== false ){

            $inputs = array(
                                        'type' => $identity,
                                        'name' => $name,
                                        'email' => $email,
                                        );

            // send email to admin  
            /*$sub = lang('website_name');
            $msg = "New message from " . lang('website_name') . "\n Identity: {$identity} \n Name: {$name} \n Email: {$email} \n  .";
            sendEmail('admin@dollar.q5server.com', $sub, $msg);//admin@dollar.q5server.com //srdev.weblawn@gmail.com*/
            $user_id = $this->userm->addcontact($inputs);
            if($user_id !='0')
            {
                $this->data['success_msg'] = "<div class='alert alert-success'>Thanks you for contact us.</div>"; 
            }
            else
            {
                $this->data['success_msg'] = "<div class='alert alert-danger'>Something goes wrong try again.</div>"; 
            }
                  
            $this->load->view('index/index', $this->data);     
        }
        else
        {
            $this->data['data'] = array(
                                        'name' => $name,
                                        'email' => $email,
                                        'identity' => $identity,
                                        );
                                        $this->load->view('index/index', $this->data);
        }
                    
        
    }
    
}
