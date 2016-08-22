<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    private $action;
    private $user;

    public function __construct() {
        parent::__construct();      
        $this->load->helper('file');
        $this->approve_request_table = $this->db->dbprefix('approve_request');
        $this->promo_codes = $this->db->dbprefix('promo_codes');
    }

/*public function demo_fn() {
    $data= date('Y-m-d H:i:s');
    $url = new_assets_url("demo.txt");
    $url = APPPATH."demo.txt";
    $old_data = file_get_contents($url);
    $new_data = $old_data."\r\n".$data;
    //echo $url;
        write_file($url, $new_data);
        //echo $new_data;
    }*/
    
    
    
    
public function get_review_list_fn() {
    $this->db->select("*");
        $this->db->where("code_taken", 'yes');
        $this->db->where("review_status", 'fail');
        $this->db->where("finished", '0');
        $this->db->order_by('id', 'ASC');
        //$this->db->where("review_status", 'fail');
        //$this->db->where('seller_approve_status !=', 'disapprove');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            //return $result;
        }
      foreach($result as $single)
      {
      $customer_id = $single->customer_id;
      $product_id = $single->product_id;
      $product_details = get_product_details($product_id);
      $getUsermata_amazon_url = getUsermata($customer_id, 'amazon_url');         
      $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;
      $getUsermata_amazon_id = explode('profile/',$getUsermata_amazon_url);
      $User_amazon_id = $getUsermata_amazon_id[1];
      $product_asin = $product_details->asin;
        
    $cid = $single->customer_id;//$_POST['cid'];
    $sl_id = $single->id;//$_POST['sl_id'];
    $date = $single->date;//$_POST['date'];
    $profile = $User_amazon_id;//$_POST['profile'];
    $product = $product_asin;//$_POST['product'];
    $page = '1';
    $post_paramtrs = false;
    $result = $this->get_review_list($date,$profile,$product,$page, $post_paramtrs);
    if(isset($result['content'])){
        $update = array('review_status'=>'pass', "review_content" => $result['content'], "review_image_video" => $result['image'], "review_rating" => $result['rate'], "review_date" => strtotime($result['date']), "review_url" => $result['url'], "notification" => 'no', "seller_notification" => 'yes', "finished" => '1');
        $where = array("id" => $sl_id);
        $get_id = $this->product->update_approve_request($update,$where);
        
        $getUsermata_increment_for = getUsermata($cid, 'increment_for');       $getUsermata_increment_for    = $getUsermata_increment_for->mval;
        
        $getUsermata_review = getUsermata($cid, 'review');       $getUsermata_review    = $getUsermata_review->mval;
        
        $getUsermata_new_review = $getUsermata_review+1 ;
        $this->userm->updateUsermeta($cid, 'review', $getUsermata_new_review);
        
        $getUsermata_quota = getUsermata($cid, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
        if($getUsermata_increment_for == 'signup' && $getUsermata_new_review == 1)
        {
            $getUsermata_new_quota = 2 ;
            $this->userm->updateUsermeta($cid, 'increment_for', '1st_review');
        }
        else if($getUsermata_increment_for == '1st_review' && $getUsermata_new_review == 10)
        {
            $getUsermata_new_quota = $getUsermata_quota+2 ;
            $this->userm->updateUsermeta($cid, 'increment_for', '10th_review');
        }
        else
        {
            $getUsermata_new_quota = $getUsermata_quota+1 ;
        }
        $this->userm->updateUsermeta($cid, 'quota', $getUsermata_new_quota);
        
        //ajaxResp(true, "Success", array("data" => $result));    
    }
    else{
        //ajaxResp(true, "Fail", array("data" => $result));
    }
    }
    }
public function get_review_list($date,$profile,$product,$page, $post_paramtrs = false) {
        $strtotime = strtotime($date);
        $url = 'http://www.amazon.com/product-reviews/'.$product.'/ref=cm_cr_getr_d_paging_btm_'.$page.'?ie=UTF8&showViewpoints=1&sortBy=recent&pageNumber='.$page.'&pageSize=50';
    //echo $url ;
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
    if ($status['http_code'] == 200) {
        
        //echo '</br>';
        $user_data = array();
        $create_review_list = explode('class="a-section review">',$data);
        $data = array();
        for($single = 1;$single<count($create_review_list);$single++)
        {
            $posted_date = explode('class="a-size-base a-color-secondary review-date">on',$create_review_list[$single]);
            $posted_date = explode('</span>',$posted_date[1]);
            $full_date = $posted_date[0];
            $posted_strtotime = strtotime($full_date);
            if($posted_strtotime>=$strtotime)
            {
                $getuser_id = explode('href="/gp/pdp/profile/',$create_review_list[$single]);
                $getuser_id = explode('/',$getuser_id[1]);
                $user_id = $getuser_id[0];
                if($user_id == $profile)
                {
                    $gole_reached = 'yes';
                    
                }
                else
                {
                    $gole_reached = 'no';
                }
            
                $out_of_date = 'no';
            }
            else
            {
                $gole_reached = 'no';
                $out_of_date = 'yes';
            }
            
            if($gole_reached == 'yes')
            {
                $get_url_1st_parse = explode('/gp/customer-reviews/',$create_review_list[$single]);
                $get_url_2nd_parse = explode('">',$get_url_1st_parse[1]);
                $get_rate_1st_parse = explode('class="a-icon-alt">',$create_review_list[$single]);
                $get_rate_2nd_parse = explode(' out',$get_rate_1st_parse[1]);
                $get_content_1st_parse = explode('class="a-size-base review-text">',$create_review_list[$single]);
                $get_content_2nd_parse = explode('</span>',$get_content_1st_parse[1]);
                $get_image_1st_parse = explode('class="review-image-tile-section">',$create_review_list[$single]);
                $get_image_2nd_parse = explode('</div>',$get_image_1st_parse[1]);
                
                $data['content'] = $get_content_2nd_parse[0];
                $data['image'] = $get_image_2nd_parse[0];
                $data['date'] = date('Y-m-d',$posted_strtotime);
                $data['rate'] = intval($get_rate_2nd_parse[0]);
                $data['url'] = 'http://www.amazon.com/gp/customer-reviews/'.$get_url_2nd_parse[0];
                $result = $data;
                break;
            }
            if($out_of_date == 'yes')
            {
                $result = 'out_of_date';
                break;
            }
            
        }
        if($gole_reached != 'yes' && $out_of_date != 'yes')
            {
                $page++;
                $result = $this->get_review_list($date,$profile,$product,$page, $post_paramtrs = false);
            }
        
        return $result;
    } else{
        return 'fasle';
    } 
}

  
public function send_email_to_get_discount_code_fn() {//Email auto send for reviewers not claimed discount codes
    $this->db->select("*");
        $where = "seller_approve_status='approve' AND code_taken='no' AND ( next_time_to_email='0' OR next_time_to_email <= ". strtotime(date('Y-m-d h:i:s'))." ) AND finished='0' ";

        $this->db->where($where); 
        $this->db->order_by('id', 'ASC');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            //return $result;
        }
      foreach($result as $single)
      {
      $customer_id = $single->customer_id;
      $product_id = $single->product_id;
      $product_details = get_product_details($product_id);
      $get_customer_details = $this->userm->get($customer_id);
        
    $customer_name = $get_customer_details->fname;//$_POST['cid'];
    $customer_email = $get_customer_details->email;//$_POST['cid'];
    $product_name = $product_details->name;//$_POST['cid'];
    $sl_id = $single->id;//$_POST['sl_id'];
    $date = $single->date;//$_POST['date'];
    $nextdate = strtotime(date('Y-m-d h:i:s')) + (72*3600);//$_POST['date'];

    $msg ='<div style="margin:0;padding:0">

    <div style="min-width:320px;background-color:#f5f7fa" lang="x-wrapper">
      <div style="Margin:0 auto;max-width:560px;min-width:280px;width:280px;width:calc(28000% - 173040px)">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:140px;width:140px;width:calc(14000% - 78120px);padding:10px 0 5px 0;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:139px;width:139px;width:calc(14100% - 78680px);padding:10px 0 5px 0;text-align:right;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
        </div>
      </div>
      
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#307fb0;background-position:0px 0px;background-image:url(https://ci6.googleusercontent.com/proxy/j2p3qE1GC9r_UXfvXVd2ZGe0FhbXH52yjn1NUa5ixweR_md1Ra03tkzL5wqALgIspoBwfdCQJYX-6LDJn52D3050_XII3RvhngwKHBcyQxc2l-odKc014gF9MBy2fcuLpoWP5N8OoFXtjGgfMkQD=s0-d-e1-ft#http://i1.cmail20.com/ei/d/F2/398/30A/202649/csfinal/08b79b7fdd0b4de98a30c931bff1be2a.png);background-repeat:repeat">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:65px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <h1 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:32px;line-height:40px;font-family:Cabin,Avenir,sans-serif;text-align:center" lang="x-size-40"><strong><span style="color:#ffffff">Claim your Promo Code</span></strong></h1><p style="Margin-top:20px;Margin-bottom:20px;font-size:17px;line-height:26px;text-align:center" lang="x-size-20"><font color="#ffffff">on Dollar Review Club!</font></p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="line-height:20px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="Margin-bottom:20px;text-align:center">
        <a style="border-radius:4px;display:inline-block;font-size:14px;font-weight:bold;line-height:24px;padding:12px 24px 13px 24px;text-align:center;text-decoration:none!important;color:#fff;background-color:#ff9900;color:#f5f7fa;font-family:"Open Sans",sans-serif!important;font-family:&quot;Open Sans&quot;,sans-serif" href="http://dollarreviewclub.com/home/login" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail20.com/t/d-i-tkhlkll-l-r/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNHI9SGqS5_TlO9lMCqNrGLoot1N6A">Click here to log in</a>
       
      </div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <div style="line-height:12px;font-size:1px">&nbsp;</div>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:10px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:20px;line-height:28px;text-align:left" lang="x-size-24"><span style="color:#ff9900">Hello '.$customer_name.',</span></h2><p style="Margin-top:16px;Margin-bottom:0">This is just to softly remind you that you have been approved by seller of “'.$product_name.'” on Dollar Review Club. However, we found that you did not claim this promo code yet so you might still unable to use the code to process purchasing on Amazon.</p><p style="Margin-top:20px;Margin-bottom:0">Simply follow the steps below:<br>
&nbsp;</p>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:325px" src="https://ci3.googleusercontent.com/proxy/RdTZV-tVuYxzfPX9VTyfamuFfLNiOtX0Gq9bLRmzDIJHmP2wwHJigbsHLcP6Xhio17jgSgislW164nov-haFdw-e-qpd_49AV_Yec2EgQPPU=s0-d-e1-ft#http://i1.cmail20.com/ei/d/F2/398/30A/202650/csfinal/12.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>1. Go to My Review Status</strong></span></h2><h2 style="Margin-top:16px;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px" lang="x-size-14"><span style="color:rgb(96,102,109)">Log in to Dollar Review Club -&gt; Click the menu icon at the top right-hand corner - # Remain, then you will be redirect to My Review Status page.</span></h2>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci4.googleusercontent.com/proxy/MjcFzFnwSi80EeIkJP-xxNgdpV_-F_Ehm3JLumYPyaSNIz9aZGJht1Gp4SjZ-btnCdz5j56D0HbVFBFfvD0d6gIr9D38J2FRYqj53dNCfhx2=s0-d-e1-ft#http://i2.cmail20.com/ei/d/F2/398/30A/202650/csfinal/21.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>2. Click Get Discount Code</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">Find your product in Unfinished Product Reviews list, and click Get Discount Code.</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci3.googleusercontent.com/proxy/RmkZygCkpuUzVCLrgJTFKCedTDXQx8Q6Mkc7PjakEwDgBfJu4H0Goeh6Glwmi6UavF9aclmuQq_AtoH38GfxFPsup4mbWZKhx6m44EzydEfk=s0-d-e1-ft#http://i3.cmail20.com/ei/d/F2/398/30A/202650/csfinal/33.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>3. Get the code number</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">After few pops up, agree term and use and accept, you will see your code at the last pop up!</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci5.googleusercontent.com/proxy/DrQz4sbnKEX_oNCofg0JaQrJSyAKoNEcmTITH5MWmCYcCN-xY77XosI_kBfQxOmXnnXHcXmtQo5KFU77-svdaKJE62rkcVAzx29aymMzut8P=s0-d-e1-ft#http://i4.cmail20.com/ei/d/F2/398/30A/202650/csfinal/57.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>4.&nbsp;</strong><strong>See the code by spread</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">Or you can simply click + on the left side of your product row, it will spread and you can see your promo code number</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:10px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px;text-align:left" lang="x-size-14"><span style="color:#60666d">(Later you will receive another email about code number, reviews instruction and other details, enjoy!)</span></h2><p style="Margin-top:16px;Margin-bottom:0">&nbsp;</p><h2 style="Margin-top:20px;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px;text-align:left" lang="x-size-14"><span style="color:#60666d">If you have any question, please simply drop us your thoughts here: 
</span><a style="text-decoration:none;color:#5c91ad" href="http://drc.cmail20.com/t/d-i-tkhlkll-l-j/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail20.com/t/d-i-tkhlkll-l-j/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNG_PGkMdwHnfOhrTyU6d1htASnmsQ"><span style="color:#ff9900">http://www.dollarreviewclub.<wbr>com/pages/contact</span></a></h2><p style="Margin-top:16px;Margin-bottom:0">&nbsp;</p><p style="Margin-top:20px;Margin-bottom:0">Best Regards,<br>
Dollar Review Club Team</p>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:400px;min-width:320px;width:320px;width:calc(8000% - 47600px)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              <table style="border-collapse:collapse;table-layout:fixed"><tbody><tr>
              
<td style="padding:0;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://www.facebook.com/dollarreviewclubofficial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.facebook.com/dollarreviewclubofficial&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNFlVuAJo-Wte5sjeo4ak5kdR_A9mw"><img style="border:0" src="https://ci6.googleusercontent.com/proxy/n2LDNC9VRuwy_hH3JFY1Hk-rSROHUnxOg9kHaSoCd2POkrI9cEChwKDtdk-iCMchAOG5Wz1cPCkdsBS5SvqRvQQXY9sUkU1dIZVtaTmnDk42Tc7rQx0NDPlzvIL5atpPsT77=s0-d-e1-ft#http://i8.cmail20.com/static/eb/master/13-the-blueprint-3/images/facebook.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://twitter.com/DRCAmazon" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://twitter.com/DRCAmazon&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNE_xUuZQq1t0jlrgWNSliE3KQs1-Q"><img style="border:0" src="https://ci5.googleusercontent.com/proxy/Vm92c2vuKRF661kPrgCahZxSL1nIf7_uyurg2YcWDCckh24DUGFdcBzoQXKsnQqHnGE1aevqpU357nUJOHqlTU7VyRuEdeMLccmjwWVHLNvI88x2BctDeeHRGCDZnHGMFHM=s0-d-e1-ft#http://i9.cmail20.com/static/eb/master/13-the-blueprint-3/images/twitter.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://www.instagram.com/dollarreviewclub/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.instagram.com/dollarreviewclub/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNEf4JiCJOztKO9XDH4kjx8LVznogg"><img style="border:0" src="https://ci4.googleusercontent.com/proxy/btdsljUthNdzVCDivhn7jlgzyFzQZXVcFhvvIJUenEtnRM0ciQf56iqdLFBwBjJUBUkR5nFHTZJJKXVyrIm6F4VeLBhfaWxSo_rYvRdMOjAW_lsywsRPjPnFJ7vAE0Xv9Knidw=s0-d-e1-ft#http://i1.cmail20.com/static/eb/master/13-the-blueprint-3/images/instagram.png" width="26" height="26" class="CToWUd"></a></td>
              </tr></tbody></table>
              <div style="Margin-top:20px">
                <div>Dollar Review Club<br>
<a href="http://www.dollarreviewclub.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dollarreviewclub.com/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNHPoxAiBIc83HZHomm4xsq7rmybKA">http://www.dollarreviewclub.<wbr>com/</a></div>
              </div>
              <div style="Margin-top:18px">
                
              </div>
            </div>
          </div>
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:200px;width:320px;width:calc(72200px - 12000%)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              
            </div>
          </div>
        
        </div>
      </div>
      <div style="line-height:40px;font-size:40px">&nbsp;</div>
    
  </div><img style="overflow:hidden;display:block!important;min-height:1px!important;width:1px!important;border:0!important;margin:0!important;padding:0!important" src="https://ci4.googleusercontent.com/proxy/bL7oTvnw-FttsH-W61elhzDsn4XCC0KaK06x2zopviBuYkAAstH2s2Cx8BPSr6lBcaefWXTldYcoxWZem5ULBWKywg=s0-d-e1-ft#https://drc.cmail20.com/t/d-o-tkhlkll-l/o.gif" width="1" height="1" border="0" alt="" class="CToWUd"><div class="yj6qo ajU"><div id=":qp" class="ajR" role="button" tabindex="0" aria-label="Hide expanded content" data-tooltip="Hide expanded content"><img class="ajT" src="//ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif"></div></div><span class="HOEnZb adL"><font color="#888888">
</font></span></div>';
   sendEmail($customer_email, "Claim your discount code", $msg);
        $update = array('next_time_to_email'=>$nextdate);
        $where = array("id" => $sl_id);
        $get_id = $this->product->update_approve_request($update,$where);
    
    }
    
    }
    
    
    
    public function send_demo_mail()
    {
        
        $customer_email = 'srdev.weblawn@gmail.com';
        $product_name = 'Teeter Hang Ups Vibration Cushion for EP Series Dmo Product';
        $customer_name = 'Debtanu Ghosh';
        $msg ='<div style="margin:0;padding:0">

    <div style="min-width:320px;background-color:#f5f7fa" lang="x-wrapper">
      <div style="Margin:0 auto;max-width:560px;min-width:280px;width:280px;width:calc(28000% - 173040px)">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:140px;width:140px;width:calc(14000% - 78120px);padding:10px 0 5px 0;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:139px;width:139px;width:calc(14100% - 78680px);padding:10px 0 5px 0;text-align:right;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
        </div>
      </div>
      
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#307fb0;background-position:0px 0px;background-image:url(https://ci6.googleusercontent.com/proxy/j2p3qE1GC9r_UXfvXVd2ZGe0FhbXH52yjn1NUa5ixweR_md1Ra03tkzL5wqALgIspoBwfdCQJYX-6LDJn52D3050_XII3RvhngwKHBcyQxc2l-odKc014gF9MBy2fcuLpoWP5N8OoFXtjGgfMkQD=s0-d-e1-ft#http://i1.cmail20.com/ei/d/F2/398/30A/202649/csfinal/08b79b7fdd0b4de98a30c931bff1be2a.png);background-repeat:repeat">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:65px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <h1 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:32px;line-height:40px;font-family:Cabin,Avenir,sans-serif;text-align:center" lang="x-size-40"><strong><span style="color:#ffffff">Claim your Promo Code</span></strong></h1><p style="Margin-top:20px;Margin-bottom:20px;font-size:17px;line-height:26px;text-align:center" lang="x-size-20"><font color="#ffffff">on Dollar Review Club!</font></p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="line-height:20px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="Margin-bottom:20px;text-align:center">
        <a style="border-radius:4px;display:inline-block;font-size:14px;font-weight:bold;line-height:24px;padding:12px 24px 13px 24px;text-align:center;text-decoration:none!important;color:#fff;background-color:#ff9900;color:#f5f7fa;font-family:"Open Sans",sans-serif!important;font-family:&quot;Open Sans&quot;,sans-serif" href="http://dollarreviewclub.com/home/login" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail20.com/t/d-i-tkhlkll-l-r/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNHI9SGqS5_TlO9lMCqNrGLoot1N6A">Click here to log in</a>
      </div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <div style="line-height:12px;font-size:1px">&nbsp;</div>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:10px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:20px;line-height:28px;text-align:left" lang="x-size-24"><span style="color:#ff9900">Hello '.$customer_name.',</span></h2><p style="Margin-top:16px;Margin-bottom:0">This is just to softly remind you that you have been approved by seller of “'.$product_name.'” on Dollar Review Club. However, we found that you did not claim this promo code yet so you might still unable to use the code to process purchasing on Amazon.</p><p style="Margin-top:20px;Margin-bottom:0">Simply follow the steps below:<br>
&nbsp;</p>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:325px" src="https://ci3.googleusercontent.com/proxy/RdTZV-tVuYxzfPX9VTyfamuFfLNiOtX0Gq9bLRmzDIJHmP2wwHJigbsHLcP6Xhio17jgSgislW164nov-haFdw-e-qpd_49AV_Yec2EgQPPU=s0-d-e1-ft#http://i1.cmail20.com/ei/d/F2/398/30A/202650/csfinal/12.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>1. Go to My Review Status</strong></span></h2><h2 style="Margin-top:16px;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px" lang="x-size-14"><span style="color:rgb(96,102,109)">Log in to Dollar Review Club -&gt; Click the menu icon at the top right-hand corner - # Remain, then you will be redirect to My Review Status page.</span></h2>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci4.googleusercontent.com/proxy/MjcFzFnwSi80EeIkJP-xxNgdpV_-F_Ehm3JLumYPyaSNIz9aZGJht1Gp4SjZ-btnCdz5j56D0HbVFBFfvD0d6gIr9D38J2FRYqj53dNCfhx2=s0-d-e1-ft#http://i2.cmail20.com/ei/d/F2/398/30A/202650/csfinal/21.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>2. Click Get Discount Code</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">Find your product in Unfinished Product Reviews list, and click Get Discount Code.</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci3.googleusercontent.com/proxy/RmkZygCkpuUzVCLrgJTFKCedTDXQx8Q6Mkc7PjakEwDgBfJu4H0Goeh6Glwmi6UavF9aclmuQq_AtoH38GfxFPsup4mbWZKhx6m44EzydEfk=s0-d-e1-ft#http://i3.cmail20.com/ei/d/F2/398/30A/202650/csfinal/33.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>3. Get the code number</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">After few pops up, agree term and use and accept, you will see your code at the last pop up!</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
        <div style="font-size:12px;font-style:normal;font-weight:normal" align="center">
          <img style="border:0;display:block;min-height:auto;width:100%;max-width:480px" src="https://ci5.googleusercontent.com/proxy/DrQz4sbnKEX_oNCofg0JaQrJSyAKoNEcmTITH5MWmCYcCN-xY77XosI_kBfQxOmXnnXHcXmtQo5KFU77-svdaKJE62rkcVAzx29aymMzut8P=s0-d-e1-ft#http://i4.cmail20.com/ei/d/F2/398/30A/202650/csfinal/57.jpg" alt="" width="260" class="CToWUd a6T" tabindex="0">
        </div>
      </div>
          
          </div>
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:300px;width:320px;width:calc(12300px - 2000%)">
          
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:17px;line-height:26px"><span style="color:#ff9900"><strong>4.&nbsp;</strong><strong>See the code by spread</strong></span></h2><p style="Margin-top:16px;Margin-bottom:0">Or you can simply click + on the left side of your product row, it will spread and you can see your promo code number</p>
    </div>
          
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:10px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px;text-align:left" lang="x-size-14"><span style="color:#60666d">(Later you will receive another email about code number, reviews instruction and other details, enjoy!)</span></h2><p style="Margin-top:16px;Margin-bottom:0">&nbsp;</p><h2 style="Margin-top:20px;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:14px;line-height:21px;text-align:left" lang="x-size-14"><span style="color:#60666d">If you have any question, please simply drop us your thoughts here: 
</span><a style="text-decoration:none;color:#5c91ad" href="http://drc.cmail20.com/t/d-i-tkhlkll-l-j/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail20.com/t/d-i-tkhlkll-l-j/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNG_PGkMdwHnfOhrTyU6d1htASnmsQ"><span style="color:#ff9900">http://www.dollarreviewclub.<wbr>com/pages/contact</span></a></h2><p style="Margin-top:16px;Margin-bottom:0">&nbsp;</p><p style="Margin-top:20px;Margin-bottom:0">Best Regards,<br>
Dollar Review Club Team</p>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:400px;min-width:320px;width:320px;width:calc(8000% - 47600px)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              <table style="border-collapse:collapse;table-layout:fixed"><tbody><tr>
              
<td style="padding:0;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://www.facebook.com/dollarreviewclubofficial" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.facebook.com/dollarreviewclubofficial&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNFlVuAJo-Wte5sjeo4ak5kdR_A9mw"><img style="border:0" src="https://ci6.googleusercontent.com/proxy/n2LDNC9VRuwy_hH3JFY1Hk-rSROHUnxOg9kHaSoCd2POkrI9cEChwKDtdk-iCMchAOG5Wz1cPCkdsBS5SvqRvQQXY9sUkU1dIZVtaTmnDk42Tc7rQx0NDPlzvIL5atpPsT77=s0-d-e1-ft#http://i8.cmail20.com/static/eb/master/13-the-blueprint-3/images/facebook.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://twitter.com/DRCAmazon" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://twitter.com/DRCAmazon&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNE_xUuZQq1t0jlrgWNSliE3KQs1-Q"><img style="border:0" src="https://ci5.googleusercontent.com/proxy/Vm92c2vuKRF661kPrgCahZxSL1nIf7_uyurg2YcWDCckh24DUGFdcBzoQXKsnQqHnGE1aevqpU357nUJOHqlTU7VyRuEdeMLccmjwWVHLNvI88x2BctDeeHRGCDZnHGMFHM=s0-d-e1-ft#http://i9.cmail20.com/static/eb/master/13-the-blueprint-3/images/twitter.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="https://www.instagram.com/dollarreviewclub/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.instagram.com/dollarreviewclub/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNEf4JiCJOztKO9XDH4kjx8LVznogg"><img style="border:0" src="https://ci4.googleusercontent.com/proxy/btdsljUthNdzVCDivhn7jlgzyFzQZXVcFhvvIJUenEtnRM0ciQf56iqdLFBwBjJUBUkR5nFHTZJJKXVyrIm6F4VeLBhfaWxSo_rYvRdMOjAW_lsywsRPjPnFJ7vAE0Xv9Knidw=s0-d-e1-ft#http://i1.cmail20.com/static/eb/master/13-the-blueprint-3/images/instagram.png" width="26" height="26" class="CToWUd"></a></td>
              </tr></tbody></table>
              <div style="Margin-top:20px">
                <div>Dollar Review Club<br>
<a href="http://www.dollarreviewclub.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dollarreviewclub.com/&amp;source=gmail&amp;ust=1468677638822000&amp;usg=AFQjCNHPoxAiBIc83HZHomm4xsq7rmybKA">http://www.dollarreviewclub.<wbr>com/</a></div>
              </div>
              <div style="Margin-top:18px">
                
              </div>
            </div>
          </div>
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:200px;width:320px;width:calc(72200px - 12000%)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              
            </div>
          </div>
        
        </div>
      </div>
      <div style="line-height:40px;font-size:40px">&nbsp;</div>
    
  </div><img style="overflow:hidden;display:block!important;min-height:1px!important;width:1px!important;border:0!important;margin:0!important;padding:0!important" src="https://ci4.googleusercontent.com/proxy/bL7oTvnw-FttsH-W61elhzDsn4XCC0KaK06x2zopviBuYkAAstH2s2Cx8BPSr6lBcaefWXTldYcoxWZem5ULBWKywg=s0-d-e1-ft#https://drc.cmail20.com/t/d-o-tkhlkll-l/o.gif" width="1" height="1" border="0" alt="" class="CToWUd"><div class="yj6qo ajU"><div id=":qp" class="ajR" role="button" tabindex="0" aria-label="Hide expanded content" data-tooltip="Hide expanded content"><img class="ajT" src="//ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif"></div></div><span class="HOEnZb adL"><font color="#888888">
</font></span></div>';
   sendEmail($customer_email, "Email Verification", $msg);
    }
    
    
    
    
    
public function send_email_once_customer_claimed_discount_fn() {//Email auto send for reviewers not claimed discount codes
    $this->db->select("*");
        $where = "promo_id!='0' AND seller_approve_status='approve' AND code_taken='yes' AND review_status='fail' AND (next_time_to_email='0' OR next_time_to_email <= ". strtotime(date('Y-m-d h:i:s')).") AND finished='0'  ";

        $this->db->where($where); 
        $this->db->order_by('id', 'ASC');

        // Find company data
        $q = $this->db->get($this->approve_request_table);
        if ($q->num_rows() > 0) {
            $result = $q->result_object();
            //return $result;
        }
      foreach($result as $single)
      {
        
        $this->db->select("promo_code");
        $where = "promo_id = ". $single->promo_id;

        $this->db->where($where); 

        // Find company data
        $q = $this->db->get($this->promo_codes);
        if ($q->num_rows() > 0) {
            $promo_code = $q->row();
            //return $result;
        }
        //print_r($single);
      $customer_id = $single->customer_id;
      $product_id = $single->product_id;
      $product_details = get_product_details($product_id);
      $get_customer_details = $this->userm->get($customer_id);
      
      $review_suggetion_type = unserialize($product_details->review_suggetion_type);
      /*echo "<pre>";
        print_r($review_suggetion_type);
      echo "</pre>";*/
      $i=1;
      $suggestion = '';
      
      foreach($review_suggetion_type as $singlesuggest)
      {
        if($singlesuggest == 'review_suggetion_custom')
        {
            $suggestion .=$i.'. At least &gt;= &nbsp;'.$product_details->review_suggetion.' &nbsp;words.<br>';
        }
        else if($singlesuggest == 'review_suggetion_video')
        {
            $suggestion .=$i.'. Video(s) or photo(s) needed.<br>';
        }
        else if($singlesuggest == 'review_suggetion_other')
        {
            $suggestion .=$i.'. Other Suggestion: '.$product_details->review_custom_suggetion.'<br>';
        }
        $i++;
      }
      
        
        if(isset($product_details->attachment_url))
        { 
            $tmpothersPath = base_url().'uploads/product_image/'.$product_details->pid.'/others/'.$product_details->attachment_url;
        
            $suggestion .=$i.'. More review instruction please refer to the attachment &quot;<a href="'.$tmpothersPath.'" target="_blank">'.$product_details->attachment_url.'</a>&quot;.';
        }
        
      
      /*1. At least &gt;= &nbsp;___ &nbsp;words.<br>
2. Video(s) or photo(s) needed.<br>
3. Other Suggestion: Please use it outside<br>
4. More review instruction please refer to the attachment &quot;ABCMom ring sling review instruction.pdf&quot;.</em></span>*/
    $customer_name = $get_customer_details->fname;//$_POST['cid'];
    $customer_email = $get_customer_details->email;//$_POST['cid'];
    $product_name = $product_details->name;//$_POST['cid'];
    $sl_id = $single->id;//$_POST['sl_id'];
    $date = $single->date;//$_POST['date'];
    $nextdate = strtotime(date('Y-m-d h:i:s')) + (72*3600);//$_POST['date'];

    $msg ='<div style="margin:0;padding:0">

    <div style="min-width:320px;background-color:#f5f7fa" lang="x-wrapper">
      <div style="Margin:0 auto;max-width:560px;min-width:280px;width:280px;width:calc(28000% - 173040px)">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:140px;width:140px;width:calc(14000% - 78120px);padding:10px 0 5px 0;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
          <div style="Float:left;font-size:12px;line-height:19px;max-width:280px;min-width:139px;width:139px;width:calc(14100% - 78680px);padding:10px 0 5px 0;text-align:right;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif">
            
          </div>
        
        </div>
      </div>
      
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#307fb0;background-position:0px 0px;background-image:url(https://ci6.googleusercontent.com/proxy/dPN04wFqcL3O0WAuGQtteeAAa4rsHUd27Uv200nvFz9hXRYX7NfFFDN8Cd-Q0L-GR8KmJQ51pWnbRRGEriykzcZ258jHDaQB1acStGYA3_SVuKZzhBvo1olbhLNlhM_GJal8A0Z5ST_5-yymOPxp=s0-d-e1-ft#http://i1.cmail19.com/ei/d/98/975/AAA/174619/csfinal/105654f4c7574664913d0ebb7c4df140.png);background-repeat:repeat">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:65px;font-size:1px">&nbsp;</div>
    </div><div><div>
        
            <div style="Margin-left:20px;Margin-right:20px">      <h1 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:32px;line-height:40px;font-family:Cabin,Avenir,sans-serif;text-align:center" lang="x-size-40"><strong><span style="color:#ffffff">Congratulation!</span></strong></h1><p style="Margin-top:20px;Margin-bottom:20px;font-size:17px;line-height:26px;text-align:center" lang="x-size-20"><span style="color:#f5f7fa">You&#8217;ve been approved on Dollar Review Club!</span></p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="line-height:20px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <div style="Margin-bottom:20px;text-align:center">        <u></u><a style="border-radius:4px;display:inline-block;font-size:14px;font-weight:bold;line-height:24px;padding:12px 24px 13px 24px;text-align:center;text-decoration:none!important;color:#fff;background-color:#f05a3c;color:#f5f7fa;font-family:Open Sans,sans-serif!important;font-family:&quot;Open Sans&quot;,sans-serif" href="http://www.dollarreviewclub.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-r/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNF8gcPuM2Vw67wQn02VE9eDGJVkog">View More Products</a><u></u>
      </div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <div style="line-height:12px;font-size:1px">&nbsp;</div>
    </div>
        
          </div></div></div>
        
        </div>
      </div><div><div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%;background-color:#ffffff">
        
          <div style="text-align:left;color:#60666d;font-size:14px;line-height:21px;font-family:&quot;Open Sans&quot;,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)">
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:24px">
      <div style="line-height:10px;font-size:1px">&nbsp;</div>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <h2 style="Margin-top:0;Margin-bottom:0;font-style:normal;font-weight:normal;color:#44a8c7;font-size:20px;line-height:28px;text-align:left" lang="x-size-24"><span style="color:#ff9900">Hello '.$customer_name.',</span></h2><p style="Margin-top:16px;Margin-bottom:20px">Thank you for claiming &quot;<strong>'.$product_name.'</strong>&quot; on Dollar Review Club!&nbsp;We&#8217;re glad to tell you that your request has been approved! Also, we are&nbsp;thrilled that you will be enjoying this in a few days after you use this promo code to purchase on Amazon!</p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <h2 style="Margin-top:0;Margin-bottom:16px;font-style:normal;font-weight:normal;color:#44a8c7;font-size:20px;line-height:28px;text-align:center" lang="x-size-24"><span style="color:#ff9900">Promo Code: '.$promo_code->promo_code.'&nbsp;</span></h2>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <p style="Margin-top:0;Margin-bottom:20px">We take customer feedback very seriously, and strive to create a memorable experience with every purchase.&nbsp;If you have enjoyed the product and would like to share your honest opinion of the product, please head to this link:<br>
<a style="text-decoration:underline;color:#5c91ad" href="'.$product_details->aws_url.'" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-y/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNH6pn3fQhI1ZU4qmV_gldJ-osTUTQ">'.$product_details->aws_url.'</a>&nbsp;<br>
where others may read about and benefit from your thoughts.</p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <p style="Margin-top:0;Margin-bottom:20px"><span style="color:#60666d"><em>Moreover, if you still not sure what to review, you may refer to below&nbsp;instruction &amp;&nbsp;suggestion from the seller:<br>
'.$suggestion.'</span></p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">      <p style="Margin-top:0;Margin-bottom:20px">Our platform will detect if you&#8217;ve left the review on Amazon automatically.&nbsp;Once passed the check of your review then you are available to access more discount product on Dollar Review Club!</p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px">
      <p style="Margin-top:0;Margin-bottom:20px"><span style="color:#60666d">If you have any question, please simply drop us your thoughts here: </span><a style="text-decoration:underline;color:#5c91ad" href="http://www.dollarreviewclub.com/pages/contact" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-j/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNFekBfIljg3ACgvpzLmCpuefmEC7Q">http://www.dollarreviewclub.com/pages/contact</a></p>
    </div>
        
            <div style="Margin-left:20px;Margin-right:20px;Margin-bottom:24px">
      <p style="Margin-top:0;Margin-bottom:0"><span style="color:#60666d">Best Regards,<br>
Dollar Review Club Team</span></p>
    </div>
        
          </div>
        
        </div>
      </div>
  
      <div style="Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 173000px);word-wrap:break-word;word-break:break-word">
        <div style="border-collapse:collapse;display:table;width:100%">
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:400px;min-width:320px;width:320px;width:calc(8000% - 47600px)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              <table style="border-collapse:collapse;table-layout:fixed"><tbody><tr>
              
<td style="padding:0;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="http://drc.cmail19.com/t/d-i-ireluy-l-i/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-i/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNHC2RRDEQPFDujDcEiRaBVn1-ItpA"><img style="border:0" src="https://ci3.googleusercontent.com/proxy/tNqAGIm0PZjWJo0SX59AeSmBF4XEqoI5W0n_V7T2akHy7BJExeIcFXrWViGI3MI7fZAceJZNls62hI7aV2BlVA5ASD-G-I1nZ8eU_CFEiG69YqYwwE9djwnsmSeo-Umy-AAs=s0-d-e1-ft#http://i8.cmail19.com/static/eb/master/13-the-blueprint-3/images/facebook.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="http://drc.cmail19.com/t/d-i-ireluy-l-d/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-d/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNHLMJ66YOflEtoA11KPcpZM0XuZjg"><img style="border:0" src="https://ci6.googleusercontent.com/proxy/NhWO8KstlI0VJQuvAd9eiG-FUCDnpnH_paomg3AYwn3Y8nY0FqQHlUpii2xA4WEpKSX1GGDa30Y__YeVAIYryeqXjS1Nk90imdsw0fEZsq7w_e2uPrhgrZ32nmqdTmpT6qU=s0-d-e1-ft#http://i9.cmail19.com/static/eb/master/13-the-blueprint-3/images/twitter.png" width="26" height="26" class="CToWUd"></a></td><td style="padding:0 0 0 3px;width:26px"><a style="text-decoration:underline;color:#b9b9b9" href="http://drc.cmail19.com/t/d-i-ireluy-l-h/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://drc.cmail19.com/t/d-i-ireluy-l-h/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNHBh6HaoF_S6sEVo5xDSHL66n9aHw"><img style="border:0" src="https://ci4.googleusercontent.com/proxy/jrWt9pljLqGpNSayLChv5b4hD82bE3UgxBtHT0mMc_rU-5VR-QkrXnRPfsXbYTjP-0Vki8g5wi-iwr8KbNxFdzGzkezpxXnPBiI0--0oPE-VsqH7INBkaO9jySy7yAUHS2IeUg=s0-d-e1-ft#http://i1.cmail19.com/static/eb/master/13-the-blueprint-3/images/instagram.png" width="26" height="26" class="CToWUd"></a></td>
              </tr></tbody></table>
              <div style="Margin-top:20px">
                <div>Dollar Review Club<br>
<a href="http://www.dollarreviewclub.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dollarreviewclub.com/&amp;source=gmail&amp;ust=1471093446146000&amp;usg=AFQjCNEkQZF3l2J6smzrW0JlxqVF42iHYQ">http://www.dollarreviewclub.co<wbr>m/</a></div>
              </div>
              <div style="Margin-top:18px">
                
              </div>
            </div>
          </div>
        
          <div style="text-align:left;font-size:12px;line-height:19px;color:#b9b9b9;font-family:&quot;Open Sans&quot;,sans-serif;Float:left;max-width:320px;min-width:200px;width:320px;width:calc(72200px - 12000%)">
            <div style="Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px">
              
            </div>
          </div>
        
        </div>
      </div>
      <div style="line-height:40px;font-size:40px">&nbsp;</div>
    
  </div></div></div><img style="overflow:hidden;display:block!important;min-height:1px!important;width:1px!important;border:0!important;margin:0!important;padding:0!important" src="https://ci5.googleusercontent.com/proxy/tOZW0lHGu8YM--g1x1C-c24rHNSlPSc6hN1TjSMYZJmVyZF0B9sHtSG3H4YVdipVpvl82TEvg1juKZdEltt2LD63=s0-d-e1-ft#https://drc.cmail19.com/t/d-o-ireluy-l/o.gif" width="1" height="1" border="0" alt="" class="CToWUd">
</div>';
   sendEmail($customer_email, "Claim your discount code", $msg);
        $update = array('next_time_to_email'=>$nextdate);
        $where = array("id" => $sl_id);
        $get_id = $this->product->update_approve_request($update,$where);
    
    }
    
    }
    

}
