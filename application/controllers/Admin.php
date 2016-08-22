<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
class Admin extends CI_Controller {
    private $user;

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->userm->validateSession('backend');
        $this->user = $this->userm->get($this->uri->segment(3));
    }

    public function index() {
        redirect('backend/dashboard');
    }
    
    public function shopper() {
        $this->data['title'] 		= get_title('my_account');
        $this->data['keywords'] 	= "";
        $this->data['description'] 	= "";
        //echo $this->session->userdata('role');
        $id = $this->uri->segment(3);
        $hash = $this->uri->segment(4);
        //echo $id.' '.$hash;
        if($hash != get_hash($id))
        {
            redirect('backend/shopper');
        }/**/
        $this->data['user'] = $this->user;
        $getUsermata_quota = $this->userm->getUsermeta($this->user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
		$this->data['quota'] 		= $getUsermata_quota;
		$this->data['unfinished_review'] = $this->product->get_unfinished_review($this->user->id);
		$this->data['finished_review'] = $this->product->get_finished_review($this->user->id);
        load_view('shopper', $this->data);
    }
    
    

    public function companies() {

        $this->data['title'] 		= get_title('my_account');
        $this->data['keywords'] 	= "";
        $this->data['description'] 	= "";     
        $id = $this->uri->segment(3);
        $hash = $this->uri->segment(4);
        //echo $id.' '.$hash;
        if($hash != get_hash($id))
        {
            redirect('backend/shopper');
        }
        //$this->data['avatar'] 	= get_avatar($this->user->email);
        $this->data['user'] 	= $this->user;
		$this->data['online_product'] = $this->product->get_online_product($this->user->id);
		$this->data['offline_product'] = $this->product->get_offline_product($this->user->id);
        load_view('companies', $this->data);

    }
    
    
    
    public function companies_launch_edit() {
        
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        $this->data['user'] = $this->user;
        
        $pid = $this->uri->segment(4);
        $this->data['pid'] = $pid;
        $this->data['get_product_details'] = get_product_details($pid);
        
        load_view('campaign_launch_edit', $this->data);
        
        }
        
        
    public function launch_update() {
        
                        
        $pid = $_POST['pid'];
        //$asin_verify = $_POST['asin_verify'];
        $product_title = $_POST['product_title'];
        //$aws_url = $_POST['aws_url'];
        $product_price = $_POST['product_price'];
        $discount_price = $_POST['discount_price'];
        $product_discount_price = $_POST['product_discount_price'];
        $product_details = $_POST['product_details'];
        $product_category = $_POST['product_category'];
        $product_discount = $_POST['product_discount'];
        $product_discount_limit_count = $_POST['product_discount_limit_count'];
        $product_discount_code_file_name = $_FILES['product_discount_code_file']['name'];
        $product_launch_time = $_POST['product_launch_time'];
        $product_launch_time_custom_date = $_POST['product_launch_time_custom_date'];
        $product_launch_time_custom_date_explode = explode('/',$product_launch_time_custom_date);
        $check_product_launch_time_custom_date = checkdate($product_launch_time_custom_date_explode[1],$product_launch_time_custom_date_explode[2],$product_launch_time_custom_date_explode[0]);
        
        $product_launch_time_custom_time = $_POST['product_launch_time_custom_time'];
        $product_launch_time_custom_time_explode = explode(':',$product_launch_time_custom_time);
        $product_launch_time_custom_time_hr = intval($product_launch_time_custom_time_explode[0]);
        $product_launch_time_custom_time_min = intval($product_launch_time_custom_time_explode[1]);
        if(is_numeric(strpos($product_launch_time_custom_time,".")))
        {
            $product_launch_time_custom_time_hr = 1000;
        }
        
        
        $product_end_time = $_POST['product_end_time'];
        $product_end_time_custom_date = $_POST['product_end_time_custom_date'];
        $product_end_time_custom_date_explode = explode('/',$product_end_time_custom_date);
        $check_product_end_time_custom_date = checkdate($product_end_time_custom_date_explode[1],$product_end_time_custom_date_explode[2],$product_end_time_custom_date_explode[0]);
        
        $product_end_time_custom_time = $_POST['product_end_time_custom_time'];
        $product_end_time_custom_time_explode = explode(':',$product_end_time_custom_time);
        $product_end_time_custom_time_hr = intval($product_end_time_custom_time_explode[0]);
        $product_end_time_custom_time_min = intval($product_end_time_custom_time_explode[1]);
        if(is_numeric(strpos($product_end_time_custom_time,".")))
        {
            $product_end_time_custom_time_hr = 1000;
        }
        
        $product_discount_code_file_ext = pathinfo($product_discount_code_file_name, PATHINFO_EXTENSION);
        $product_end_time_until_count = $_POST['product_end_time_until_count'];
        $product_code_access_condition = $_POST['product_code_access_condition'];
        $product_code_access_condition_custom_count = $_POST['product_code_access_condition_custom_count'];
        
        
        $review_suggetion_none = $_POST['review_suggetion_none'];
        //echo $review_suggetion_none ;
        $review_suggetion = $_POST['review_suggetion'];
        //print_r($review_suggetion);
        $review_suggetion_custom_count = $_POST['review_suggetion_custom_count'];
        $aspect_ratio_error_accept = $_POST['aspect_ratio_error_accept'];
        
        $product_cover_pic_val = $_POST['product_cover_pic_val'];
                list($type, $data) = explode(';', $product_cover_pic_val);
                $type = str_replace('data:image/', '', $type);
        $product_cover_pic_name = 'cover.'.$type;
        $product_other_pic_count = 0;
        $product_other_pic_val = array();
        $product_other_pic_name = array();
        $j=1;
        for($i=0;$i<=7;$i++)
        {
            $val = $_POST['product_other_pic_val_'.$i];
            if($val !='0')
            {
                $product_other_pic_val[] = $val;
                
                list($type, $data) = explode(';', $val);
                $type = str_replace('data:image/', '', $type);
                $product_other_pic_tmpname = 'other_'.$j.'.'.$type;
                $product_other_pic_name[] = $product_other_pic_tmpname;
                $j++;                
                $product_other_pic_count++ ;
            }
        }
        
        
        if($discount_price == '1deal')
            {
                 $product_discount_price =  '1.00';
            }
            
            if($product_launch_time == 'product_launch_time_custom')
            {
                $datetime = strtotime($product_launch_time_custom_date. ' ' .$product_launch_time_custom_time); 
                $start_date = date ("Y-m-d H:i:s", $datetime);
            }
            else{$start_date = date ("Y-m-d H:i:s", time());}
            
            if($product_end_time == 'product_end_time_custom')
            {
                $datetime = strtotime($product_end_time_custom_date. ' ' .$product_end_time_custom_time); 
                $end_date = date ("Y-m-d H:i:s", $datetime);
            }
            else if($product_end_time == 'product_end_time_after14'){$Date = strtotime($start_date);
            $add_days = 14*3600*24;
$end_date = date('Y-m-d H:i:s', ($Date + $add_days));}
            else if($product_end_time == 'product_end_time_until'){
$end_date = date('Y-m-d H:i:s', time());}
            
            if($product_discount == 'product_discount_limit')
            {
                $daily_limit = $product_discount_limit_count;
            }
            else
            {
                $daily_limit = 'unlimited';
            }
            if($review_suggetion_none == 'review_suggetion_none' && $review_suggetion[0] =='')
            {
                $review_suggetion_type = $review_suggetion_none;
            }
            else{$review_suggetion_type = serialize($review_suggetion);}
            
        
        /*if(strlen($asin)!=10 && $asin_verify !== 'verified' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please verify your asin nubmer.</div>',array('haserror' =>1));
        }
        else */if(strlen($product_title)<=0 || $product_title == '' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please enter product title.</div>',array('haserror' =>1));
        }
        else if(!is_numeric($product_price) )
        {
            ajaxResp(true, '<div class="alert alert-danger">Original price must be numeric.</div>',array('haserror' =>1));
        }
        else if($discount_price == 'otherdeal' && $product_discount_price == '' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give discount price or set as $1 Deal.</div>',array('haserror' =>1));
        }
        else if($discount_price == 'otherdeal' && !is_numeric($product_discount_price) )
        {
            ajaxResp(true, '<div class="alert alert-danger">Discount price must be numeric.</div>',array('haserror' =>1));
        }
        else if($discount_price == 'otherdeal' && $product_price <= $product_discount_price )
        {
            ajaxResp(true, '<div class="alert alert-danger">Discount price must be less than Original price.</div>',array('haserror' =>1));
        }
        else if(strlen($product_details)<=0 || $product_details == '' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please enter product title.</div>',array('haserror' =>1));
        }
        else if($product_category == '0' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please select product category.</div>',array('haserror' =>1));
        }
        else if($product_discount == 'product_discount_limit' && !is_numeric($product_discount_limit_count) )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give no of limit for discount code.</div>',array('haserror' =>1));
        }
        else if($product_discount_code_file_ext != 'txt' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give text file for discount code.</div>',array('haserror' =>1));
        }
        else if($product_launch_time == 'product_launch_time_custom' && !$check_product_launch_time_custom_date )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount launch time.</div>',array('haserror' =>1));
        }
        else if($product_launch_time == 'product_launch_time_custom' && $product_launch_time_custom_time_hr > 23 )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount launch time.</div>',array('haserror' =>1));
        }
        else if($product_launch_time == 'product_launch_time_custom' && $product_launch_time_custom_time_min > 59)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount launch time.</div>',array('haserror' =>1));
        }
        else if($product_end_time == 'product_end_time_custom' && !$check_product_end_time_custom_date )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount end time.</div>',array('haserror' =>1));
        }
        else if($product_end_time == 'product_end_time_custom' && $product_end_time_custom_time_hr > 23)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount end time.</div>',array('haserror' =>1));
        }
        else if($product_end_time == 'product_end_time_custom' && $product_end_time_custom_time_min > 59)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give proper date and time for discount end time.</div>',array('haserror' =>1));
        }
        else if($product_end_time == 'product_end_time_custom' && $product_launch_time == 'product_launch_time_custom' && strtotime($start_date) > strtotime($end_date))
        {
            ajaxResp(true, '<div class="alert alert-danger">Please check Launch Time and End Time.</div>',array('haserror' =>1));
        }
        else if($product_end_time == 'product_end_time_until' && !is_numeric($product_end_time_until_count) )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give number untill discount will not end.</div>',array('haserror' =>1));
        }
        else if($product_code_access_condition == 'product_code_access_condition_custom' && !is_numeric($product_code_access_condition_custom_count) )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give number for code access condition.</div>',array('haserror' =>1));
        }
        else if($review_suggetion[0] == ''  && $review_suggetion_none == '')
        {
            ajaxResp(true, '<div class="alert alert-danger">Please set review suggetion.</div>',array('haserror' =>1));
        }
        else if(($review_suggetion[0] == 'review_suggetion_custom' || $review_suggetion[1] == 'review_suggetion_custom')  && !is_numeric($review_suggetion_custom_count))
        {
            ajaxResp(true, '<div class="alert alert-danger">Please give number for minimum word count of each review.</div>',array('haserror' =>1));
        }
        else if($product_cover_pic_val =='0')
        {
            ajaxResp(true, '<div class="alert alert-danger">Please upload an image for cover pic.</div>',array('haserror' =>1));
        }
        else if($product_other_pic_count == 0)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please upload image files for others pic.</div>',array('haserror' =>1));
        }
        else
        {
        if ($uploadResp = $this->upload("product_discount_code_file")) {
                        if (is_string($uploadResp)) {
                            ajaxResp(true, '<div class="alert alert-danger">Discount code file has error please check.</div>',array('haserror' =>2));
                        }
                    }
            // Get PromoFile
                $promoFile = (isset($uploadResp['file_name'])) ? $uploadResp['file_name'] : "";
            $inputArray = array(
                        'name' => $product_title,
                        "img_url" => $product_cover_pic_name,
                        "other_img_url" => serialize($product_other_pic_name),
                        "price" => $product_price,
                        "discount_price" => $product_discount_price,
                        "daily_limit" => $daily_limit,
                        "start_date_type" => $product_launch_time,
                        "start_date" => $start_date,
                        "end_date_type" => $product_end_time,
                        "end_date" => $end_date,
                        "product_end_time_until_count" => $product_end_time_until_count,
                        "description" => $product_details,
                        "category" => $product_category,
                        "code_access_condition_type" => $product_code_access_condition,
                        "code_access_condition" => $product_code_access_condition_custom_count,
                        "review_suggetion_type" => $review_suggetion_type,
                        "review_suggetion" => $review_suggetion_custom_count,
                        "belong_company" => $this->user->fname,
                        "disabled" => 0,
                    );
                    
                    $where = array('pid' => $pid,);
                    // If product added
                    if ($this->product->update($inputArray, $where)) {
                        $pro_id = $pid;
                        
                        $where = array('product_id' => $pid,);
                        $inputArray = array('is_used' => '2',);
                        
                        $this->product->update_promo_codes($inputArray, $where);
                        
                        
                        $this->load->library('upload');
                        $tmpPath = 'uploads/promo_code';
                        if (!empty($promoFile)) {
                            $innerFile = $tmpPath . "/" . $promoFile;
                                $txtFile = fopen($innerFile, "r");
                                while ($line = fgets($txtFile)) {
                                    $promoCodes[] = $line;
                                }
                                fclose($txtFile);
                            
                    
                    
                            // Read zip file and return promo codes
                           $this->product->add_promo_codes($pro_id, $this->user->id, $promoCodes);
                        }
                        // upload image 
                        $tmpcoverpicPath = 'uploads/product_image/'.$pro_id.'/cover_pic/';
                        $tmpotherpicPath = 'uploads/product_image/'.$pro_id.'/other_pic/';
                        
                        $files = glob($tmpcoverpicPath.'*'); // get all file names
                        foreach($files as $file){ // iterate files
                          if(is_file($file))
                            unlink($file); // delete file
                        }
                        
                        $files = glob($tmpotherpicPath.'*'); // get all file names
                        foreach($files as $file){ // iterate files
                          if(is_file($file))
                            unlink($file); // delete file
                        }
                        
                        
                        
                        if (!file_exists($tmpcoverpicPath)) {
                            mkdir($tmpcoverpicPath, 0777, true);
                        }
                        if (!file_exists($tmpotherpicPath)) {
                            mkdir($tmpotherpicPath, 0777, true);
                        }
                        
                        list($type, $data) = explode(';', $product_cover_pic_val);
                        list(, $data)      = explode(',', $data);
                        $data = base64_decode($data);
                        
                        file_put_contents($tmpcoverpicPath.'/'.$product_cover_pic_name, $data);
                        
                        
                        $j=1;
                        for($i=0;$i<=7;$i++)
                        {
                            $val = $_POST['product_other_pic_val_'.$i];
                            if($val !='0')
                            {
                                
                                list($type, $data) = explode(';', $val);
                                list(, $data)      = explode(',', $data);
                                $type = str_replace('data:image/', '', $type);
                                $product_other_pic_tmpname = 'other_'.$j.'.'.$type;
                                $data = base64_decode($data);
                                file_put_contents($tmpotherpicPath.'/'.$product_other_pic_tmpname, $data);
                                $j++;
                            }
                        }

                       ajaxResp(true, '<div class="alert alert-success">Done.</div>',array('haserror' =>0));
                    } else {
                        ajaxResp(true, '<div class="alert alert-danger">Please try again.</div>',array('haserror' =>1));
                    }
            
            
            
            ajaxResp(true, '<div class="alert alert-success">Something goes wrong</div>',array('haserror' =>0));
        }
        
    
        }  
        
        
        
    public function upload($file_name) {
        $config['upload_path'] = "uploads/promo_code/";
        $config['allowed_types'] = "txt";
        $config['max_size'] = "1000";
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($file_name)) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }   
    
}
