<?php



class Backend extends MX_Controller {



    private $data = array();

    private $user;



    public function __construct() {

        parent::__construct();

        $this->userm->validateAdmin();

        $this->user = $this->userm->current();

    }



    public function index() {

        redirect("backend/dashboard");

        exit;

    }



    public function dashboard() {

        $this->data['title'] = get_title('dashboard');

        $this->data['label'] = lang('dashboard');





        /*

         * GET Total

        */

		

        $this->data['total_contents'] = $this->article->total();

        $this->data['total_products'] = $this->product->total();

        $this->data['total_companies'] = $this->userm->total(array('role' => 'companies'));//$this->company->total();

        $this->data['total_shopper'] = $this->userm->total(array('role' => 'shopper'));



        load_view('dashboard/dashboard', $this->data);

    }



    public function settings() {

        $this->data['title'] = get_title('settings');

        $this->data['label'] = lang('settings');

        

        $this->data['avatar'] = get_avatar($this->user->email);

        $this->data['user'] = $this->user;

        

        load_view('settings/settings', $this->data);

    }



}

