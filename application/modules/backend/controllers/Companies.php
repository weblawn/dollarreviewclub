<?php

class Companies extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();
        $this->load->library('excel');
        error_reporting(0);
    }
    

    public function export_company() {
        $this->data['title'] = get_title('companies');
        $this->data['label'] = lang("companies");
        load_view('export', $this->data);
    }
    
    public function index() {
        $this->data['title'] = get_title('companies');
        $this->data['label'] = lang("companies");
        
        /*
         * Get companies
         */
        $args = array(array(
            'field' => 'role',
            'cond' => "=",
            "value" => "companies"
            )
        );
        $this->data['companies'] = $this->userm->get_where($args);
        
        load_view('all', $this->data);
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
    
    
    public function update_company_account() {
        
        //$okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $_POST['email']);
$okay = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $_POST['email']
            ),
        );
        $email_verify = $this->userm->get_where($args);
        //print_r($email_verify[0]);
        if($_POST['fav_cat_main']==0)
        {
            ajaxResp(true, 'Please choose your main product category.',array('haserror' =>1));
        }
        else if(get_hash($_POST['uid'])!=$_POST['hash'])
        {
            ajaxResp(true, 'Something goes wrong pleasle reload this page.',array('haserror' =>1));
        }
        else if($_POST['cpass']!=$_POST['pass'])
        {
            ajaxResp(true, 'Please confirm your password.',array('haserror' =>1));
        }
        else if($_POST['fname']=='')
        {
            ajaxResp(true, 'Please enter your name on Amazon.',array('haserror' =>1));
        }
        else if(!$okay)
        {
            ajaxResp(true, 'Please enter valid email id.',array('haserror' =>1));
        }
        else if(!empty($email_verify) && $email_verify[0]->id != $_POST['uid'])
        {
            ajaxResp(true, 'Email id already exist.',array('haserror' =>1));
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
                
			$this->userm->updateUsermeta($_POST['uid'], "category", serialize($_POST['fav_cat_main']));
            //$redirect = ($redirect === "true") ? site_url("backend/contactus") : false;
            ajaxResp(true, 'Update successful.',array('haserror' =>0));
        }
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
        
        if($this->userm->update($update, $where)){
            ajaxResp(true, "Success");
        }else{
            ajaxResp(false, "Error");
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
            "value" => "companies"
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
            "value" => "companies"
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
            "value" => "companies"
            )
        );
        }
        else
        {
            $args = array(array(
            'field' => 'role',
            'cond' => "=",
            "value" => "companies"
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
