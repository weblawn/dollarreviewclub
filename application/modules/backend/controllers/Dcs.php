<?php

class Dcs extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();

        $this->data['title'] = get_title('dcs');
        $this->data['label'] = lang("dcs");
    }

    public function index() {
        /*
         * Get Products
         */
        $this->data['content'] = $this->dcsmodel->get_where();
        load_view('all', $this->data);
    }

    public function add() {
        load_view('new', $this->data);
    }
public function save()
{
    $status = "";
    $msg = "";
    $file_element_name = 'userfile';
    //$product_title =  $_POST['product_title'];
    /*if (empty($product_title))
    {
        $status = "error";
        ajaxResp(false, "Sorry! Please fill page title.");
    }*/
     
    if ($status != "error")
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
            ajaxResp(false, $msg);
        }
        else
        {
            $data = $this->upload->data();
            //echo $product_title ;
            $data = array(
            'image_name'      => $data['file_name'],
        );
            $file_id = $this->dcsmodel->add($data);
            if($file_id)
            {
                $status = "success";
                $msg = "File successfully uploaded";
                ajaxResp(true, 'Product added successfully!');
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        
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
        if( $this->dcsmodel->delete($pid) ){
            ajaxResp(true, "Deleted!");
        }
        
        // Negative response if nothing happend
        ajaxResp(false, "Sorry! Error with delete pages");
    }



}
