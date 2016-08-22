<?php

class Export extends MX_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->userm->validateAdmin();

        $this->data['title'] = 'Export contact';
        $this->data['label'] = 'Export contact';
        $this->load->library('excel');
    }

    public function index() {
        /*
         * Get Products
         */
        load_view('index', $this->data);
    }


    public function create() {
        
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'S.No.');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Type');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Name');
                $this->excel->getActiveSheet()->setCellValue('D1', 'Email');
                $this->excel->getActiveSheet()->setCellValue('E1', 'Date');
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
                
                $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('E1')->getFill()->getStartColor()->setARGB('#333');
                
                /*$this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('F1')->getFill()->getStartColor()->setARGB('#333');*/
       for($col = ord('A'); $col <= ord('F'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                $rs = $this->db->get('dlr_contact');
                $exceldata="";
        foreach ($rs->result_array() as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                 
                $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                
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

                ajaxResp(true, site_url('uploads/excel/'.$file_name.'.xlsx'));
                 
    }
        
        


}
