<?php

class Products extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();
    }

    public function index() {
        $this->data['title'] = get_title('products');
        $this->data['label'] = lang("products");

        /* 
         * Get Products
         */
        $this->data['products'] = $this->product->with_review();

        load_view('all', $this->data);
    }

    public function reviews() {
        
        $rid = $this->uri->segment(4);
        $hash = $this->input->get('hash', true);

        if (get_hash($rid) !== $hash) {
            redirect("backend/products");
            exit();
        }
        
        $this->data['title'] = get_title('product_review');
        $this->data['label'] = lang("product_review");
        
        $this->data['product'] = $this->product->get($rid);
        $this->data['review'] = $this->history->by_product_id($rid);
        
        load_view('review', $this->data);
    }



    public function visibility() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);
        $type = $this->input->post("type", TRUE);
        $action = $this->input->post("action", TRUE);
        // IF Values are empty
        if (empty($pid) || empty($hash) && empty($type)) {
            ajaxResp(false, "Sorry! Values cant be empty");
        }

        // Validate id and hash
        if (get_hash($pid) !== $hash) {
            ajaxResp(false, "Sorry! No cheating");
        }
        if($action == "disabled")
        {
            $update = array("disabled" => (($type == "0") ? 1 : 0));
        }
        else
        {
            $update = array("recomended" => (($type == "0") ? 1 : 0));
        }
        
        $where = array("pid" => $pid);

        if ($this->product->update($update, $where)) {
            ajaxResp(true, "Success");
        } else {
            ajaxResp(false, "Error");
        }
    }

}
