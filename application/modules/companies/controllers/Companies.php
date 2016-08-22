<?php



class Companies extends MX_Controller {

    

    private $data;

    private $user;

    

    public function __construct() {

        parent::__construct();

        

        $this->userm->validateSession('companies');

        $this->user = $this->userm->current();
        $this->auto_update();

    }

public function auto_update()
{
    $user =$this->user;
    //print_r($user);
    $get_manual_pending_by_id = $this->product->get_manual_pending_by_user($user->id,$user->role);
    //print_r($get_manual_pending_by_id);
    $auto_update_product_total_count = $this->product->auto_update_product_total_count($user->id);
}

    public function index() {

        $this->data['title'] 		= get_title('my_account');

        $this->data['keywords'] 	= "";

        $this->data['description'] 	= "";

        

        $this->data['avatar'] 	= get_avatar($this->user->email);

        $this->data['user'] 	= $this->user;

		

		

		$this->data['online_product'] = $this->product->get_online_product($this->user->id);

		$this->data['offline_product'] = $this->product->get_offline_product($this->user->id);

        

        load_view('settings/my_account', $this->data);

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

	

	public function saveCard(){

		

		$cardNames = array(

			"visaelectron" => "VISA Electron",

			"maestro" => "Maestro",

			"forbrugsforeningen" => "Forbrugsforeningen",

			"dankort" => "Dankort",

			"visa" => "VISA",

			"mastercard" => "MasterCard",

			"amex" => "American Express",

			"dinersclub" => "Diners Club",

			"discover" => "Discover",

			"unionpay" => "UnionPay",

			"jcb" => "JCB"

		);

		

		$token = $this->input->post("_token", true);

		$cvc   = $this->input->post("cvc", true);

		$expiry= $this->input->post("expiry", true);

		$name  = $this->input->post("name", true);

		$number= $this->input->post("number", true);

		$ctype = $this->input->post("_ctype", true);

		

		if(get_hash("vfQ1e0WBnkrVUqbqiOh") !== $token){

			ajaxResp(false, "Sorry! No Cheating");

		}

		

		$errorNo = "";

		$errorMsg= "";

		if( checkCreditCard($number, $ctype, $errorNo, $errorMsg) ){

			

			$this->userm->updateUsermeta($this->user->id, "cc_number", $number);

			$this->userm->updateUsermeta($this->user->id, "cc_name", $name);

			$this->userm->updateUsermeta($this->user->id, "cc_expiry", $expiry);

			$this->userm->updateUsermeta($this->user->id, "cc_cvc", $cvc);

			$this->userm->updateUsermeta($this->user->id, "cc_type", $ctype);

			

			ajaxResp(true, "success");

		}else{

			ajaxResp(false, $errorMsg);

		}

		

	}

	

    public function my_account() {

        $this->data['title'] 		= get_title('my_account');

        $this->data['keywords'] 	= "";

        $this->data['description'] 	= "";

        

        $this->data['avatar'] 	= get_avatar($this->user->email);

        $this->data['user'] 	= $this->user;

		

		

		$this->data['online_product'] = $this->product->get_online_product($this->user->id);

		$this->data['offline_product'] = $this->product->get_offline_product($this->user->id);

        

        load_view('settings/my_account', $this->data);

    }

    /*public function settings() {

        $this->data['title'] 		= get_title('settings');

        $this->data['keywords'] 	= "";

        $this->data['description'] 	= "";

        

        $this->data['avatar'] 	= get_avatar($this->user->email);

		$this->data['facebook'] = $this->userm->getUsermeta($this->user->id, 'facebook');

        $this->data['user'] 	= $this->user;

		

		$this->data['cc_number'] 	= $this->userm->getUsermeta($this->user->id, "cc_number");

		$this->data['cc_name'] 		= $this->userm->getUsermeta($this->user->id, "cc_name");

		$this->data['cc_expiry'] 	= $this->userm->getUsermeta($this->user->id, "cc_expiry");

		$this->data['cc_cvc'] 		= $this->userm->getUsermeta($this->user->id, "cc_cvc");

		$this->data['cc_type'] 		= $this->userm->getUsermeta($this->user->id, "cc_type");

        

        load_view('settings/settings', $this->data);

    }*/

    

    public function update_my_account() {
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
        else if($_POST['fav_cat_main']==0)

        {

            ajaxResp(true, '<div class="alert alert-danger">Please choose your main product category.</div>',array('haserror' =>1));

        }

        else if($_POST['cpass']!=$_POST['pass'])

        {

            ajaxResp(true, '<div class="alert alert-danger">Please confirm your password.</div>',array('haserror' =>1));

        }
        else if($_POST['fname']=='')
        {
            ajaxResp(true, '<div class="alert alert-danger">Please enter your name on Amazon.</div>',array('haserror' =>1));
        }

        else

        {
            $inputs = array("fname" => $_POST['fname'], "email" => $_POST['email']);
            $where = array("id" => $this->user->id);
            $this->userm->update($inputs, $where);
            
            $inputArray = array( "belong_company" => $_POST['fname'] );
            $where = array('uid' => $this->user->id,);
            $this->product->update($inputArray, $where);
            
            if($_POST['cpass']!='' && $_POST['pass']!='')

                {

                    $inputs = array("pass" => md5($_POST['pass']));

                    $where = array("id" => $this->user->id);

                    $this->userm->update($inputs, $where);

                }

                

			$this->userm->updateUsermeta($this->user->id, "category", serialize($_POST['fav_cat_main']));

            ajaxResp(true, '<div class="alert alert-danger">Update successful.</div>',array('haserror' =>0));

        }

    }

    

    

}

