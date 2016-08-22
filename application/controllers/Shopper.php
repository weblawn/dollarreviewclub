<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
class Shopper extends CI_Controller {
    private $captcha_public_key = "6LcAYxETAAAAAK47QsDyWT6mQcvJn0WMgHX28-BV";
    private $captcha_server_key = "6LcAYxETAAAAAFV1TECRORq8YBUGoIid836BMUpv";
    private $captcha_public_key2 = "6Lc65xUTAAAAAOxjx_S2HRBg1GMKZOqfLMyfo9x9";
    private $captcha_server_key2 = "6Lc65xUTAAAAAOg_OtlOtuV75Do_pT11757GX8bl";

    private $data = array();
    private $user;

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->userm->login($_COOKIE['site_username'], $_COOKIE['site_password'], $remember, $redirect);
        $this->load->helper('recaptcha');
        $this->data['recaptcha'] = recaptcha_get_html($this->captcha_public_key);
        $this->data['recaptcha2'] = recaptcha_get_html($this->captcha_public_key2);
        $this->userm->validateSession('shopper');
        $this->user = $this->userm->current();
        $this->auto_update();
    }


public function auto_update()
{
    $user =$this->user;
    //print_r($user);
    $get_manual_pending_by_id = $this->product->get_manual_pending_by_user($user->id,$user->role);
    //print_r($get_manual_pending_by_id);
}
    public function index() {
        redirect('home');
    }
    
    public function history() {
        $this->data['title'] = get_title('history');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        
        $this->data['history'] = $this->history->get($this->user->id);
        
        load_view('history', $this->data);
    }
    
    public function flagit() {
        $id = $this->input->post('_id', true);
        $hash = $this->input->post('_hash', true);
        $reason = $this->input->post('reason', true);
        $comment = $this->input->post('comment', true);
        
        if(empty($id) || empty($hash) || empty($reason) || empty($comment)){
            ajaxResp(false, lang('fill_required'));
        }
        
        if(get_hash($id) !== $hash){
            ajaxResp(false, lang('id_and_hash'));
        }
        
        $where = array("history_id" => $id);
        $data = array("reason" => $reason, "comment" => $comment);
        if( $this->history->update($data, $where) ){
            ajaxResp(true, lang("comment_submitted"));
        }
        
    }
	
	public function linkAmazon(){
		$amazonUrl = $this->input->post("amazonUrl", true);
		
		if(empty($amazonUrl) && strlen($amazonUrl) === 0){
			ajaxResp(false, "Please enter Amazon Url");
		}
		
		if(strpos($amazonUrl, "amazon") === false){
			ajaxResp(false, "Please enter valid Amazon url");
		}
		
		preg_match('~https://www.amazon.com/gp/profile/(.*)~', $amazonUrl, $matches);		
		if( isset($matches[1]) && !empty($matches[1]) && $matches[1] !== "A4BXSFGWDAXDLA"){
			if( $this->userm->updateUsermeta($this->user->id, 'amazon_url', $amazonUrl) ){
				ajaxResp(true, "You have connect to Amazon successfully");
			}
		}else{
			ajaxResp(false, "Please enter valid Amazon url");
		}		
	}
	
	public function unlinkFacebook(){
		$unlink = $this->input->post("unlink", true);
		if( !isset($unlink) || empty($unlink) ){
			ajaxResp(false, "Sorry! No cheating!");
		}
		
		if($unlink == 1){
			if( $this->userm->deleteUsermeta($this->user->id, 'facebook') ){
				ajaxResp(true, "Facebook account unlinked successfully");
			}
		}
		
		ajaxResp(false, "Sorry! There are an error");
	}
	
	
    public function my_account() {
        $this->data['title'] 		= get_title('my_account');
        $this->data['keywords'] 	= "";
        $this->data['description'] 	= "";
        $this->data['user'] = $this->user;
        $getUsermata_quota = $this->userm->getUsermeta($this->user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
		$this->data['quota'] 		= $getUsermata_quota;
		$this->data['unfinished_review'] = $this->product->get_unfinished_review($this->user->id);
		$this->data['finished_review'] = $this->product->get_finished_review($this->user->id);
        load_view('my_account', $this->data);
    }
    
        public function update_my_account() {
        $fav_cat = $_POST['fav_cat'];    
        $selected_val = $_POST['selected_val']; 
        $amazon_name = $_POST['amazon_name'];
        if($fav_cat == ''){$fav_cat = '0';}   
        
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
            
                            $category = explode(",",$selected_val);
                            //print_r($category);
                           //echo count($category);
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
                                   
        if(!$okay)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please enter valid email id.</div>',array('haserror' =>1));
        }
        else if(!empty($email_verify) && $email_verify[0]->id != $this->user->id)
        {
            ajaxResp(true, '<div class="alert alert-danger">Email id already exist.</div>',array('haserror' =>1));
        }
        else if(!count($category)>0)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please choose your favourite product category.</div>',array('haserror' =>1));
        }
        else if($category[0]=='')
        {
            ajaxResp(true, '<div class="alert alert-danger">Please choose your favourite product category.</div>',array('haserror' =>1));
        }
        else if($amazon_name == '' || $amazon_name == 'NULL')
        {
            ajaxResp(true, '<div class="alert alert-danger">Please enter your amazon name.</div>',array('haserror' =>1));
        }
        else if($_POST['cpass']!=$_POST['pass'])
        {
            ajaxResp(true, '<div class="alert alert-danger">Please confirm your password.</div>',array('haserror' =>1));
        }
        else
        {
            
                    $inputs = array("fname" => $amazon_name,"lname" => $amazon_name,);
                    $where = array("id" => $this->user->id);
                    $this->userm->update($inputs, $where);
            if($_POST['cpass']!='' && $_POST['pass']!='')
                {
                    $inputs = array("pass" => md5($_POST['pass']));
                    $where = array("id" => $this->user->id);
                    $this->userm->update($inputs, $where);
                }
                
			$this->userm->updateUsermeta($this->user->id, "category", serialize($category));
			$this->userm->updateUsermeta($this->user->id, "amazon_name", $amazon_name);
			$this->userm->updateUsermeta($this->user->id, "receive_email", $_POST['receive_email']);
            ajaxResp(true, '<div class="alert alert-danger">Update successful.</div>',array('haserror' =>0));
        }
    }
    
    public function settings() {
        $this->data['title'] = get_title('settings');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        
        $this->data['avatar'] = get_avatar($this->user->email);
        $this->data['user'] = $this->user;
		$this->data['amazon'] = $this->userm->getUsermeta($this->user->id, 'amazon_url');
		$this->data['facebook'] = $this->userm->getUsermeta($this->user->id, 'facebook');
		$this->data['receive_email'] = $this->userm->getUsermeta($this->user->id, 'receive_email')->mval;
        
        load_view('settings', $this->data);
    }
    
    	public function updatesettings(){
		$fname = $this->input->post("fname", true);
		$lname = $this->input->post("lname", true);
		$receive_email = $this->input->post("receive_email", true);
		if( !isset($fname) || empty($fname) || empty($lname) || empty($lname) || empty($receive_email) || empty($receive_email) ){
			ajaxResp(false, "Sorry! No cheating!");
		}
		
		else{
		    $update = array("fname" => $fname, "lname" => $lname);
            $where = array("id" => $this->user->id);

            // Update password
            if ($this->userm->update($update, $where)) {
                if(!$this->userm->updateUsermeta($this->user->id, 'receive_email', $receive_email))
                {
                    $args = array(
                        'uid' => $this->user->id,
                        'mkey' => 'receive_email',
                        'mval' => $receive_email
                    );
                    $this->db->insert($this->usermeta, $args);
                       
                }
                
                ajaxResp(true, "Settings updated successfully.");
            }
			
		}
		
		ajaxResp(false, "Sorry! There are an error");
	}
    
        public function home() {
        $this->data['title'] = get_title('settings');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        
		$this->data['amazon'] = $this->userm->getUsermeta($this->user->id, 'amazon_url');
		$this->data['category'] = $this->userm->getUsermeta($this->user->id, 'category');
        if(!empty($this->data['amazon']) && !empty($this->data['category']))
        {
            redirect('shopper');
        }
        load_view('home', $this->data);
    }
    
    
     
     /*
     * Preferences
     */
    public function reset_preference() {
        
        if(!$this->user){
            $this->userm->logout();
        }

        $category = $this->input->post("old_cat", TRUE);
        $category = explode(",",$category);

        
				if (isset($category) && !empty($category)) {
                    if (!$this->userm->updateUsermeta($this->user->id, 'category', serialize($category))) {
                        ajaxResp(false, "There are an error with add usermeta");
                    }
                    else{
                        
                        ajaxResp(true, "Preferences updated successfully.");
                    }
                }
			
        ajaxResp(false, "Sorry! There are an error with script.");
    }

}
