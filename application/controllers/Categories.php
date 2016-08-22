<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    private $captcha_public_key = "6LcAYxETAAAAAK47QsDyWT6mQcvJn0WMgHX28-BV";
    private $captcha_server_key = "6LcAYxETAAAAAFV1TECRORq8YBUGoIid836BMUpv";
    private $captcha_public_key2 = "6Lc65xUTAAAAAOxjx_S2HRBg1GMKZOqfLMyfo9x9";
    private $captcha_server_key2 = "6Lc65xUTAAAAAOg_OtlOtuV75Do_pT11757GX8bl";

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->userm->login($_COOKIE['site_username'], $_COOKIE['site_password'], $remember, $redirect);
        $this->load->helper('recaptcha');
        $this->data['recaptcha'] = recaptcha_get_html($this->captcha_public_key);
        $this->data['recaptcha2'] = recaptcha_get_html($this->captcha_public_key2);
    }

    public function index() {
        $this->data['title'] = get_title('categories');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        $this->data['categories'] = $this->product->category_item_count();

        load_view("categories", $this->data);
    }

    public function item() {
        $this->data['title'] = get_title('categories');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // Get Category Slug
        $this->data['slug'] = $item = $this->uri->segment(3);

        // If slug is empty
        if (empty($item)) {
            redirect("categories");
            exit();
        }

        // Get Category by slug
        $this->data['category'] = $this->product->category(array('slug' => $item));

        // Get category products using slug
        $args = array(
            array(
                "comp" => "AND ",
                "field" => 'c.slug',
                "cond" => "=",
                "value" => $item
            ),
			array(
				"comp" => "",
				"field" => 'p.disabled',
				"cond" => "=",
				"value" => "0"
			)
        );
        
        $this->data['categories'] = $this->product->category_item($args);

        $this->data['page_title'] = $this->data['category'][0]->name . " " . lang('deals');

        // Loading view file
        load_view("categories_deals", $this->data, false, '../filters');
    }

}
