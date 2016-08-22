<?php

class Shopper extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();
        $this->load->library('excel');
    }
    
    public function index() {
        $this->data['title'] = get_title('shopper');
        $this->data['label'] = lang("shopper");
        
        /*
         * Get Shopper
         */
        $args = array(array(
            'field' => 'role',
            'cond' => "=",
            "value" => "shopper"
            )
        );
        $this->data['shopper'] = $this->userm->get_where($args);
        
        load_view('all', $this->data);
    }
    
    public function export_shopper() {
        $this->data['title'] = get_title('shopper');
        $this->data['label'] = lang("shopper");
        load_view('export', $this->data);
    }
    public function visibility() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);        
        $type = $this->input->post("type", TRUE);
        
        // IF Values are empty
        if(empty($pid) || empty($hash) && empty($type)){
            ajaxResp(false, "Sorry! Values cant be empty");
        }
        
        // Validate id and hash
        if(get_hash($pid) !== $hash){
            ajaxResp(false, "Sorry! No cheating");
        }
        
        $update = array("isDel" => (($type == "0") ? 1 : 0));
        $where = array("id" => $pid);
        $getUsermata_amazon_url = getUsermata($pid, 'amazon_url');       $getUsermata_amazon_url    = $getUsermata_amazon_url->mval;
        if($type == "0")
        {
            $getUsermata_amazon_url_new = str_replace("/","/**/",$getUsermata_amazon_url);
            $this->userm->updateUsermeta($pid, 'amazon_url', $getUsermata_amazon_url_new);            
        }
        else 
        {
            $getUsermata_amazon_url_new = str_replace("/**/","/",$getUsermata_amazon_url);
            $this->userm->updateUsermeta($pid, 'amazon_url', $getUsermata_amazon_url_new);            
        }
        if($this->userm->update($update, $where)){
            ajaxResp(true, "Success");
        }else{
            ajaxResp(false, "Error");
        }
    }
    
    
    
    public function edit() {
        $this->data['title'] = get_title('companies');
        $this->data['label'] = lang("companies");
        
        $uid = $this->uri->segment(4);
        $hash = $this->input->get('hash', TRUE);
        $this->data['uid'] = $uid;
        $this->data['hash'] = $hash;
        if (get_hash($uid) !== $hash) {
            redirect('backend/companies');
        }
        $user = $this->userm->get($uid);
        $this->data['user'] = $user;
        load_view('edit', $this->data);
        
    }
    
    
    public function update_shopper_account() {
        
        //$okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $_POST['email']);
$okay = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        
        
        
        
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $_POST['email']
            ),
        );
        $category = explode(",",$_POST['selected_val']);
        $email_verify = $this->userm->get_where($args);
        
$getUsermata_amazon_url = getUsermata($_POST['uid'], 'amazon_url');         $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;
        if($_POST['amazon_url'] !='' && $_POST['amazon_url'] !=$getUsermata_amazon_url)
        {
            $url = $_POST['amazon_url'];
        $post_paramtrs = false;
        // print_r($_POST);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        if ($post_paramtrs) {
            curl_setopt($c, CURLOPT_POST, TRUE);
            curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
        } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
        curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
        curl_setopt($c, CURLOPT_MAXREDIRS, 10);
        $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
        if ($follow_allowed) {
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
        curl_setopt($c, CURLOPT_REFERER, $url);
        curl_setopt($c, CURLOPT_TIMEOUT, 60);
        curl_setopt($c, CURLOPT_AUTOREFERER, true);
        curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
        $data = curl_exec($c);
        $status = curl_getinfo($c);
        curl_close($c);
        preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
        }
        else if($_POST['amazon_url'] ==$getUsermata_amazon_url)
        {
            $status['http_code'] = 200;
        }
        else
        {
            $status['http_code'] = 0;
        }
        //echo $status['http_code'];
        //print_r($email_verify[0]);
        
        if(get_hash($_POST['uid'])!=$_POST['hash'])
        {
            ajaxResp(true, 'Something goes wrong pleasle reload this page.',array('haserror' =>1));
        }
        else if(!$okay)
        {
            ajaxResp(true, 'Please enter valid email id.',array('haserror' =>1));
        }
        else if(!empty($email_verify) && $email_verify[0]->id != $_POST['uid'])
        {
            ajaxResp(true, 'Email id already exist.',array('haserror' =>1));
        }
        else if($_POST['cpass']!=$_POST['pass'])
        {
            ajaxResp(true, 'Please confirm your password.',array('haserror' =>1));
        }
        else if(!count($category)>0)
        {
            ajaxResp(true, 'Please choose your favourite product category.',array('haserror' =>1));
        }
        else if($category[0]=='')
        {
            ajaxResp(true, 'Please choose your favourite product category.',array('haserror' =>1));
        }
        else if($_POST['fname']=='')
        {
            ajaxResp(true, 'Please enter your name on Amazon.',array('haserror' =>1));
        }
        else if($_POST['amazon_url']=='' || $status['http_code'] != 200)
        {
            ajaxResp(true, 'Please enter your valid Amazon profile link.',array('haserror' =>1));
        }
        else
        {
            $inputs = array("fname" => $_POST['fname']);
            
            $inputArray = array( "belong_company" => $_POST['fname'] );
            $where = array('uid' => $_POST['uid'],);
            $this->product->update($inputArray, $where);
            
            if($_POST['cpass']!='' && $_POST['pass']!='')
                {
                    $inputs = array("fname" => $_POST['fname'], "email" => $_POST['email'], "pass" => md5($_POST['pass']));
                    
                }   
            else
                {
                    $inputs = array("fname" => $_POST['fname'], "email" => $_POST['email']);
                }    
                
                $where = array("id" => $_POST['uid']);
                $this->userm->update($inputs, $where);
                
			$this->userm->updateUsermeta($_POST['uid'], "category", serialize($category));
			$this->userm->updateUsermeta($_POST['uid'], "amazon_name", $_POST['fname']);
			$this->userm->updateUsermeta($_POST['uid'], "amazon_url", $_POST['amazon_url']);
            //$redirect = ($redirect === "true") ? site_url("backend/contactus") : false;
            ajaxResp(true, 'Update successful.',array('haserror' =>0));
        }
    }


    public function create() {
        //error_reporting(0);
        $from_date  = strtotime(date("Y-m-d",strtotime($_POST['from_date'])));
        $to_date    = strtotime(date("Y-m-d",strtotime($_POST['to_date'])));
        $todate     = strtotime( date("Y-m-d",time()) );
        //echo date('Y-m-d H:i:s',$todate+86400).'  '.date('Y-m-d H:i:s',$to_date);
        if($_POST['from_date']!='' && $from_date>=$todate)
        {
            ajaxResp(true, 'Please choose a previous date for From Date .',array('haserror' =>1));
        }
        else if($_POST['to_date']!='' && $to_date>$todate+86400)
        {
            ajaxResp(true, 'Please choose a previous date for To Date.' ,array('haserror' =>1));
        }
        else if($_POST['from_date']!='' && $_POST['to_date']!='' && $to_date<$from_date)
        {
            ajaxResp(true, 'Please choose a previous date for From Date.',array('haserror' =>1));
        }
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Name');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Email');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Date');
                $this->excel->getActiveSheet()->setCellValue('D1', 'Status');
                //merge cell A1 until C1
                //$this->excel->getActiveSheet()->mergeCells('E1:F1');
                //set aligment to center for that merged cell (A1 to C1)
                
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
                
                $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('#333');
                
                $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->setARGB('#333');
                
                $this->excel->getActiveSheet()->getStyle('AD1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->setARGB('#333');
                
       for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                
                
       if($_POST['from_date']!='')
        {
            $args = array(
            array(
                "field" => "registered",
                "cond" => ">=",
                "value" => date ("Y-m-d",(strtotime($_POST['from_date'])))
            ),array(
            'field' => 'role',
            'cond' => "=",
            "value" => "shopper"
            )
        );
        }
        if($_POST['to_date']!='')
        {
            $args = array(
            array(
                "field" => "registered",
                "cond" => "<=",
                "value" => date ("Y-m-d",(strtotime($_POST['to_date'] + 86399)))
            ),array(
            'field' => 'role',
            'cond' => "=",
            "value" => "shopper"
            )
        );
        }
       if($_POST['from_date']!='' && $_POST['to_date']!='')
        {
            $args = array(
            array(
                "field" => "registered",
                "cond" => ">=",
                "value" => date ("Y-m-d",(strtotime($_POST['from_date'])))
            ),array(
                "field" => "registered",
                "cond" => "<=",
                "value" => date ("Y-m-d",(strtotime($_POST['to_date'])+ 86399))
            ),array(
            'field' => 'role',
            'cond' => "=",
            "value" => "shopper"
            )
        );
        }
        else
        {
            $args = array(array(
            'field' => 'role',
            'cond' => "=",
            "value" => "shopper"
            )
            );
        }
                
        $get_data = $this->userm->get_where($args);
                
                $exceldata="";
        foreach ($get_data as $row){
            $new_array = array();
            $new_array[] = $row->fname;
            $new_array[] = $row->email;
            $new_array[] = date("d M Y",strtotime($row->registered));
            $new_array[] = ($row->isDel) ? "Disabled" : "Enabled";
            $exceldata[] = $new_array;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                 
                $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                
                 $file_name = time();
                $filename='uploads/excel/'.$file_name.'.xlsx'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('uploads/excel/'.$file_name.'.xlsx');
                //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                //$objWriter->save("05featuredemo.xlsx");

                ajaxResp(true, site_url('uploads/excel/'.$file_name.'.xlsx'),array('haserror' =>0));
                 
    }
    
}
