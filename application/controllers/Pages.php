<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Pages extends CI_Controller {
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
        $this->data['title'] = get_title('about');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
    }

    public function index() {
        $slug = $this->uri->segment(2);
        $slug2 = $this->uri->segment(3);

        // Pages index
        if ($slug == "index") {
            redirect("");
        }

        // Load if method exists
        if (method_exists($this, $slug)) {
            $this->{$slug}();
        } else {

            // Check page data by slug
            $args = array("slug" => $slug);
            $page = $this->article->get_where($args);
            $pageData = $page[0];
//print_r($page);
            $this->data['title'] = get_title($slug);

            $this->data['keywords'] = $pageData->keywords;
            $this->data['description'] = $pageData->metadesc;

            $this->data['pageTitle'] = $pageData->title;
            $this->data['content'] = $pageData->content;

            $this->data['breadcrumbs'][] = array(lang($slug), $slug);

            // Load Layout
            /*if($slug == "about")
            {
                load_view('about', $this->data);
            }
            else if($slug == "faq")
            {
                load_view('faq', $this->data);
            }
            else */
            
            if($slug == "howitworks")
            {
                load_view('how_it_works', $this->data);
            }
            else
            {
                load_view('layout', $this->data);
            }
        }
    }

    public function contact() {
        $this->data['title'] = get_title('contact');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        
        // Load ReCaptcha helper
        //$this->load->helper('recaptcha');
        
        $this->data['breadcrumbs'][] = array(lang('contact'), 'contact');

        // set validation rules for contact form 
        $this->form_validation->set_rules('name', lang('name') , "trim|required|min_length[3]|max_length[60]");
        $this->form_validation->set_rules('email', lang('email'), "trim|required|valid_email"); 
        $this->form_validation->set_rules('subject', lang('subject'), "trim|required|min_length[5]|max_length[60]");   
        $this->form_validation->set_rules('message', lang('message'), "trim|required|min_length[5]");
$this->data['data']=array(
  'name' =>   $this->input->post('name', TRUE),
  'email' =>   $this->input->post('email', TRUE),
  'subject' =>   $this->input->post('subject', TRUE),
  'message' =>   $this->input->post('message', TRUE),
);
        //on form validate
        if( $this->form_validation->run() !== false ){
            /*$resp = recaptcha_check_answer($this->captcha_server_key, $_SERVER['REMOTE_ADDR'], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

                        if (!$resp->is_valid) {
                            $this->data["captcha_err"] = "The reCAPTCHA wasn't entered correctly. Please try it again.";
                            goto load_view_file;
                        }*/
            /*$name = $this->input->post('name', TRUE);
            $email = $this->input->post('email', TRUE);
            $subject = $this->input->post('subject', TRUE);
            $message = $this->input->post('message', TRUE);*/

            // send email to admin  
            /*$sub = lang('website_name');
            $msg = "New message from " . lang('website_name') . "<div><br></div> Name: {$name} <div><br></div> Email: {$email} <div><br></div> Subject: {$subject} <div><br></div> Message: {$message} .";
            sendEmail('srdev.weblawn@gmail.com', $sub, $msg);//admin@dollar.q5server.com //srdev.weblawn@gmail.com*/
            //$this->data['success_msg'] = "Thanks you for contact us";  
            
            $result = $this->article->add_contact_us($this->data['data']);
            $this->data['result'] = $result;
            //print_r($this->data['result']);
            if(is_numeric($result))
            {
                $this->data['open_popup'] = "yes";
            }
            else
            {
                $this->data['open_popup'] = "no";
            }
            
            
                       
        }
                    load_view_file:
                    //$this->data['recaptcha'] = recaptcha_get_html($this->captcha_public_key);
                    load_view('contact', $this->data);
    }

}
