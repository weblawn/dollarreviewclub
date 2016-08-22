<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Onedeals extends CI_Controller {
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
        $this->data['slug'] = '';

        /*
         * Search
         */
        $searchTerm = array(
                array(
                    "field" => "p.discount_price",
                    "cond" => "<=",
                    "value" => "1"
                )
            );

        //$this->data['deals'] = $this->product->display(null, null, $searchTerm);
        //$this->data['deals'] = $this->product->get_where($args, $sort);
        
        //$this->data['deals'] = $this->product->display(null, "ORDER BY p.pid ASC LIMIT 1000", $searchTerm);
        $this->data['deals'] = $this->product->display(null, "ORDER BY p.pid ASC", $searchTerm);
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
        load_view('1deals', $this->data);
    }

}
