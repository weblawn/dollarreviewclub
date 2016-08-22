<?php

class Content extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();

        $this->data['title'] = get_title('content');
        $this->data['label'] = lang("content");
    }

    public function index() {
        /*
         * Get Products
         */
        $this->data['content'] = $this->article->get_where();
        load_view('all', $this->data);
    }

    public function add() {
        
		$this->session->set_userdata('upload_image_file_manager',true);
        load_view('new', $this->data);
    }

    public function save() {
        $title = $this->input->post("title", TRUE);
        $slug = $this->input->post("slug", TRUE);
        $content = $_POST["content"];
        $keywords = $this->input->post("keywords", TRUE);
        $metadesc = $this->input->post("metadesc", TRUE);
        $redirect = $this->input->post("redirect", TRUE);
        
        if (empty($title)) {
            ajaxResp(false, "Sorry! Please fill page title.");
        }

        // Bind Array
        $input = array(
            "title" => $title,
            "slug" => clean_slug($slug),
            "content" => $content,
            "keywords" => $keywords,
            "metadesc" => $metadesc
        );

        if ($this->article->add($input)) {
            $redirect = ($redirect === "true") ? site_url("backend/content") : false;
            ajaxResp(true, 'Page added successfully!', array("redirect" => $redirect));
        } else {
            ajaxResp(false, 'Sorry! Error with page insertion.');
        }
    }

    public function edit() {

        $id = $this->uri->segment(4);
        $hash = $this->input->get("hash", TRUE);

        if (get_hash($id) !== $hash) {
            redirect("backend/content");
        }

		$this->session->set_userdata('upload_image_file_manager',true);
        $this->data['page'] = $this->article->get($id);
        load_view("edit", $this->data);
    }

    public function update() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);

        $title = $this->input->post("title", TRUE);
        $slug = $this->input->post("slug", TRUE);
        $content = $_POST["content"];
        $keywords = $this->input->post("keywords", TRUE);
        $metadesc = $this->input->post("metadesc", TRUE);

        if (get_hash($pid) !== $hash) {
            ajaxResp(false, "Sorry! No Cheating.");
        }

        if (empty($title)) {
            ajaxResp(false, "Sorry! Please fill page title.");
        }

        // Bind Array
        $input = array(
            "title" => $title,
            "slug" => clean_slug($slug),
            "content" => $content,
            "keywords" => $keywords,
            "metadesc" => $metadesc
        );
        
        $where = array("pid" => $pid);
        
        if ($this->article->update($input, $where)) {
            ajaxResp(true, 'Page updated successfully!');
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
        if( $this->article->delete($pid) ){
            ajaxResp(true, "Deleted!");
        }
        
        // Negative response if nothing happend
        ajaxResp(false, "Sorry! Error with delete pages");
    }

    public function slug() {
        $title = $this->input->post("title", TRUE);
        ajaxResp(true, "Success", array("slug" => clean_slug($title)));
    }

}
