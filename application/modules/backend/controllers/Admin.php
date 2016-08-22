<?php

class Admin extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();

        $this->data['title'] = get_title('admin');
        $this->data['label'] = lang("admin");
    }

    public function index() {
        /*
         * Get Admin
         */
        $args = array(array(
            'field' => 'role',
            'cond' => "=",
            "value" => "backend"
            )
        );
        $this->data['admin'] = $this->userm->get_where($args);
        load_view('all', $this->data);
    }

    public function add() {
        load_view('new', $this->data);
    }
public function save()
{
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $pass =  $_POST['pass'];
    $con_pass =  $_POST['con_pass'];
    
        //$okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $email);
$okay = filter_var($email, FILTER_VALIDATE_EMAIL);
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $email
            ),
        );
        $email_verify = $this->userm->get_where($args);
   //print_r($email_verify);
    if($name=='')
        {
            $status = "error";
            ajaxResp(true, 'Please enter a name.',array('haserror' =>1));
        }
        else if(!$okay)
        {
            $status = "error";
            ajaxResp(true, 'Please enter valid email id.',array('haserror' =>1));
        }
        else if(!empty($email_verify) && is_numeric($email_verify[0]->id ))
        {
            $status = "error";
            ajaxResp(true, 'Email id already exist.',array('haserror' =>1));
        }
        else if($con_pass!=$pass)
        {
            $status = "error";
            ajaxResp(true, 'Please confirm your password.',array('haserror' =>1));
        }
     
    
        $inputs = array(
                            "fname" => $name,
                            "email" => $email,
                            "pass" => md5($pass),
                            "role" => "backend",
                            "isDel" => 0,
                        );


            $user_id = $this->userm->signup($inputs);
            
            if($user_id)
            {
            ajaxResp(true, 'Admin created successfully.',array('haserror' =>0));
            }
            else
            {
            ajaxResp(true, 'Something went wrong when saving the file, please try again.',array('haserror' =>1));
            }
}


    
    public function visibility() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);        
        $type = $this->input->post("type", TRUE);
        
        // IF Values are empty
        if(empty($pid) || empty($hash) && empty($type)){
            ajaxResp(false, "Sorry! Values cant be empty");
        }
        
        // Validate id and hash
        if(get_hash($pid) !== $hash){
            ajaxResp(false, "Sorry! No cheating");
        }
        
        $update = array("isDel" => (($type == "0") ? 1 : 0));
        $where = array("id" => $pid);
        
        if($this->userm->update($update, $where)){
            ajaxResp(true, "Success");
        }else{
            ajaxResp(false, "Error");
        }
    }

   
    
    public function edit() {
        $this->data['title'] = get_title('admin');
        $this->data['label'] = lang("admin");
        
        $uid = $this->uri->segment(4);
        $hash = $this->input->get('hash', TRUE);
        $this->data['uid'] = $uid;
        $this->data['hash'] = $hash;
        if (get_hash($uid) !== $hash) {
            redirect('backend/admin');
        }
        $user = $this->userm->get($uid);
        $this->data['user'] = $user;
        load_view('edit', $this->data);
        
    }
    
    
    
    public function update_admin_account() {
                 
        //$okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $_POST['email']);
$okay = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $_POST['email']
            ),
        );
        $email_verify = $this->userm->get_where($args);

          
        
        if(get_hash($_POST['uid'])!=$_POST['hash'])
        {
            ajaxResp(true, 'Something goes wrong pleasle reload this page.',array('haserror' =>1));
        }
        else if($_POST['name']=='')
        {
            ajaxResp(true, 'Please enter your name.',array('haserror' =>1));
        }
        else if(!$okay)
        {
            ajaxResp(true, 'Please enter valid email id.',array('haserror' =>1));
        }
        else if(!empty($email_verify) && $email_verify[0]->id != $_POST['uid'])
        {
            ajaxResp(true, 'Email id already exist.',array('haserror' =>1));
        }
        else if($_POST['con_pass']!=$_POST['pass'])
        {
            ajaxResp(true, 'Please confirm your password.',array('haserror' =>1));
        }
        else
        {
            
            if($_POST['con_pass']!='' && $_POST['pass']!='')
                {
                    $inputs = array("fname" => $_POST['name'], "email" => $_POST['email'], "pass" => md5($_POST['pass']));
                    
                }   
            else
                {
                    $inputs = array("fname" => $_POST['fname'], "email" => $_POST['email']);
                }    
                
                $where = array("id" => $_POST['uid']);
                $this->userm->update($inputs, $where);
            ajaxResp(true, 'Update successful.',array('haserror' =>0));
        }
    }

}
