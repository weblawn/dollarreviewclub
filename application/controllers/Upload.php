<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
    
    private $data = array();

    function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $field_name = "file";
		$this->load->library('upload', $config);

		if ( $this->upload->do_upload($field_name))
		{
			$data = $this->upload->data();
            $response = new StdClass;
            $response->link = base_url('uploads/'.$data['file_name']);
            echo stripslashes(json_encode($response));

		}
	}
    
}

?>