<?php

class Contactus extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();

        $this->data['title'] = 'Contact Us';
        $this->data['label'] = 'Contact Us';
    }

    public function index() {
        /*
         * Get Products
         */
        $arg = array(
        //'parent_id'=> 0,
        );
        $this->data['content'] = $this->contactusmodel->get_where($arg);
        load_view('all', $this->data);
    }

//$this->uri->segment(3);


    public function open() {
        /*
         * Get Products
         */
        $id = $this->uri->segment(4);
        $hash = $this->uri->segment(5);
        if($hash != get_hash($id))
        {
            redirect('backend/contactus');
        }
        $arg = array(
        'id'=> $id,
        );
        $arg_rply = array(
        'parent_id'=> $id,
        );
        $this->data['open'] = $this->contactusmodel->get_where($arg);
        $this->data['rply'] = $this->contactusmodel->get_where($arg_rply);
        $this->data['id'] = $id;
        $this->data['hash'] = $hash;
        load_view('open', $this->data);
    }
    

    public function reply() {
        $hash = $this->input->post("hash", TRUE);
        $id = $this->input->post("id", TRUE);
        $redirect = 'false';
        
        if($hash != get_hash($id))
        {
            ajaxResp(false, 'Sorry! Error with reply.');
        }

        // Bind Array
        $input = array(
  'name'        =>  "Admin",
  'email'       =>  "Admin email",
  'subject'     =>  "reply",
  'message'     =>  $this->input->post('rply', TRUE),
  'parent_id'   =>  $id,
  'status'      =>  "reply",
);
$get_id = $this->contactusmodel->add($input);
        if (is_numeric($get_id)) {
            $sub = "Reply from ".lang('website_name');
            $msg = "Reply from " . lang('website_name') . "<div><br></div> Subject: ".$this->input->post('subject', TRUE)." <div><br></div> Your Message: ".$this->input->post('message', TRUE)." <div><br></div> Reply Message: ".$this->input->post('rply', TRUE).".";
            
            
            sendEmail($this->input->post('email', TRUE), $sub, $msg);//admin@dollar.q5server.com //srdev.weblawn@gmail.com
            // echo $this->input->post('email', TRUE);
            $redirect = ($redirect === "true") ? site_url("backend/contactus") : false;
            ajaxResp(true, 'Reply send successfully!', array("redirect" => $redirect));
        } else {
            ajaxResp(false, 'Sorry! Error with page insertion.');
        }
    }
    
    public function delete() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);
        
        // Validate Hash
        if (get_hash($pid) !== $hash) {
            ajaxResp(false, "Sorry! No Cheating.");
        }
        
        // Positive resposne if deleted
        if( $this->contactusmodel->delete($pid) ){
            ajaxResp(true, "Deleted!");
        }
        
        // Negative response if nothing happend
        ajaxResp(false, "Sorry! Error with delete pages");
    }



}
