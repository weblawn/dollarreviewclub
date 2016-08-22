<?php

defined('BASEPATH') OR exit('No direct script access allowed');

define('FACEBOOK_SDK_V4_SRC_DIR', APPPATH . 'third_party/Facebook/');
require_once APPPATH . 'third_party/Facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class Facebook extends CI_Controller {

    private $fb;
	public $goToUrl;
    /*
     * @access  Constructor
     * @return  void   
     */

    public function __construct() {
        parent::__construct();
		
		$this->goToUrl = (isset($_GET['redirect'])) ? "?redirect=" . urlencode(urldecode($_GET['redirect'])) : "";        
		
		if( $this->uri->segment(2) == "link" && !empty($this->goToUrl) ){			
			setcookie("stFbLink", 1, time() + 600, "/", null, 0);
		}else{
			setcookie("stFbLink", 1, time() - 600, "/", null, 0);			
		}
		
        FacebookSession::setDefaultApplication('1614918688788345', '19656513f62a9b1fefd7f3679d0652af');
        $this->fb = new FacebookRedirectLoginHelper(site_url("facebook/oAuth")  . $this->goToUrl);
    }

    /*
     * @access  public
     * @return  void   
     */

    public function index() {
        $loginUrl = $this->fb->getLoginUrl(array('scope' => 'email'));
        redirect($loginUrl);
    }
	
	public function link(){
		$this->index();
	}
	
    public function oAuth() {
        try {
            $session = $this->fb->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (\Exception $ex) {
            // When validation fails or other local issues
        }
		
        if (isset($session)) {
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $me = $response->getGraphObject(GraphUser::className());

            $inputs = array(
                'fname' => $me->getFirstName(),
                'lname' => $me->getLastName(),
                'email' => $me->getEmail(),
                'role' => 'shopper'
            );
			
			$this->goToUrl = (isset($_GET['redirect'])) ? urldecode($_GET['redirect']) : "";
			$fbLink = (isset($_COOKIE['stFbLink'])) ? true : false;
			
			if($fbLink){
				$user = get_active_user();
				if( $this->userm->updateUsermeta($user->id, 'facebook', $inputs['email']) ){
					redirect($this->goToUrl);
				}
			}else{
				$this->userm->fbSignup($inputs, $this->goToUrl);				
			}
        } else {
            redirect('user/signup/shopper');
        }
    }
	
}
