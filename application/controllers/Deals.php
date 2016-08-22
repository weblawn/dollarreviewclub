<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends CI_Controller {
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
        $this->data['title'] = get_title('deals');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
    }

    public function index() {

        $this->data['breadcrumbs'][] = array(lang('deals'), 'deals');
        
        /*
         * Get all deals
         */
        $this->data['slug'] = $this->input->get('category', TRUE);

        /*
         * Search
         */
        /*$searchTerm = array();
        $search = $this->input->get('q', true);
        if($search){
            $searchTerm = array(
                array(
                    "field" => "p.name",
                    "cond" => "LIKE",
                    "value" => "'%{$search}%'"
                )
            );
        }*/
        /*$searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => ">",
                    "value" => "1"
                )
            );*/

        //$this->data['deals'] = $this->product->display(null, null, $searchTerm);
        //$this->data['deals'] = $this->product->get_where($args, $sort);
        
        //$this->data['deals'] = $this->product->display(null, "ORDER BY p.pid ASC LIMIT 1000", $searchTerm);
        $this->data['deals'] = $this->product->display(null, "ORDER BY p.pid ASC", null);
/*
         * Get Featured Products
         */
         
        $searchTerm = array(
                array(
                    "field" => "p.recomended",
                    "cond" => "=",
                    "value" => "1"
                ),
            );
        //$this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC LIMIT 4", $searchTerm);
        $this->data['featured'] = $this->product->display(null, "ORDER BY p.pid DESC", $searchTerm);
        $this->data['user'] = $this->userm->current();
        $this->data['page_title'] = lang('deals');

        //load_view('deals', $this->data, false, '../filters');
        load_view('deals', $this->data);
    }

    public function item() {
        $pid = $this->uri->segment(3);
        $hash = $this->uri->segment(4);
        
        if (get_hash($pid) !== $hash) {
            redirect('deals');
            //echo "redirect ";
            //echo get_hash($pid);
        }
        $get_product_details = get_product_details($pid); 
        //print_r($get_product_details);
        $path =base_url('uploads/product_image/'.$get_product_details->pid.'/cover_pic/'.$get_product_details->img_url);
        $this->data['title'] = $get_product_details->name.' | Dollar Review Club'; 
        $this->data['keywords'] = $get_product_details->keywords;
        $new_content = preg_replace('/<[^>]*>/', '', $get_product_details->description);
        $this->data['description'] = $new_content;
        $this->data['image'] = $path;
        
        $this->data['pid'] = $pid;
        load_view('item', $this->data);
    }

    public function reviewit() {
        
        $user = get_active_user();
        if(!$user){
            ajaxResp(false, lang('login_required'));
        }
        
        if($user->role != "shopper"){
            ajaxResp(false, lang('only_shopper_allowed'));
        }
        
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);

        if (isset($pid) && isset($hash)) {
            
            if (get_hash($pid) !== $hash) {
                ajaxResp(false, lang('id_and_hash'));                
            }
            
            // Get Product
            $product = $this->product->get($pid);
            if(!$product){
                ajaxResp(false, lang('product_not_exists'));
            }
            
            // Get promo code
            $promoCodes = $this->product->get_promo_codes($pid);
            if(!$promoCodes){
                ajaxResp(false, lang('promo_not_found'));
            }
            
            if(!isset($promoCodes[0])){
                ajaxResp(false, lang('promo_have_used'));
            }
            
            $promoCode = $promoCodes[0];
            
            //Add History for current user
            $history = array(
                "user_id" => $user->id,
                "product_id" => $pid,
                "promo_id" => $promoCode->promo_id
            );
            
            if( $this->history->add($history) ){
                
                //Update Promo Code
                $where = array("promo_id" => $promoCode->promo_id);
                $upData = array("is_used" => 1);
                if($this->product->update_promo_codes($upData, $where)){
                    
                    $reviewLink = '#leaveComment';
                    $reviewText = "<i class='fa fa fa-flag'></i> " . lang('report_issue');
                    $amazonLink = "https://www.amazon.com/review/create-review?asin=" . $promoCode->promo_code;
                    $amazonText = '<i class="fa fa-amazon"></i> ' . lang('amazon_review');
                    
                    ajaxResp(true, "Thanks for revision. Please find promo code {$promoCode->promo_code}.<br/>Thanks", array(
                        'reviewLink' => $reviewLink,
                        'reviewText' => $reviewText,
                        'amazonLink' => $amazonLink,
                        'amazonText' => $amazonText
                    ));
                }
            }
            
            ajaxResp(false, lang('error_reviewit_ajax'));
        }
        
        ajaxResp(false, lang('id_and_hash'));
    }

}
