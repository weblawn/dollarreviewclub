<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    private $action;
    private $user;

    public function __construct() {
        parent::__construct();
        $this->user = $this->userm->current();        
    }

    public function index() {

        $this->action = $this->input->post("action", TRUE);

        // Produce error if action is empty
        if (!isset($this->action) || empty($this->action)) {
            ajaxResp(false, "Sorry! Action cant be empty!");
        }

        // Call if method exists
        if (method_exists($this, $this->action)) {
            $this->{$this->action}();
        } else {
            ajaxResp(false, "Sorry! {$this->action} action does not exists.");
        }
    }
    
public function secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}



public function reset_password() {
    $reset_userid = $_POST['reset_userid'];
    $reset_hash = $_POST['reset_hash'];
    $get_hash = get_hash($reset_userid);
    if($get_hash != $reset_hash)
    {
        //echo 'here 1';
        ajaxResp(true, "Fail", array("data" => '<div class="alert alert-danger" style="">'.lang('resetpass_failure').'</div>'));
    }
    else
    {
        //echo 'here 2';
        $getUsermata_apply_resetpass = $this->userm->getUsermeta($reset_userid, 'apply_resetpass');       
        $getUsermata_apply_resetpass = $getUsermata_apply_resetpass->mval;
        if($getUsermata_apply_resetpass !='yes')
        {
            ajaxResp(true, "Fail", array("data" => '<div class="alert alert-danger" style="">'.lang('resetpass_failure').'</div>'));
        }
        else
        {
            $inputs = array("pass" => md5($_POST['reset_password']));
            $where = array("id" => $_POST['reset_userid']);
            $this->userm->update($inputs, $where);
            $this->userm->deleteUsermeta($_POST['reset_userid'], 'apply_resetpass');  
            ajaxResp(true, "Success", array("data" => '<div class="alert alert-success" style="">'.lang('resetpass_sussess').'</div>')); 
        }
        
    }
     
    }
    

public function forgot_password_email() {
    $email = $_POST['forgot_password_email'];

            $args = array(
                array(
                    'field' => 'email',
                    'cond' => '=',
                    'value' => $email
                )
            );
//site_url("deals/item/{$pro->pid}?hash=" . get_hash($pro->pid))
//echo $email;
            $getUser = $this->userm->get_where($args);
            //print_r($getUser);
            $getUser = $getUser[0];
            $getUser_id = $getUser->id;
            if(!isset($getUser_id)){ajaxResp(true, "not_found", array("data" => $email));}
            $getUser_email = $getUser->email;
            $this->userm->addUsermeta($getUser_id, 'apply_resetpass', 'yes');
            //echo $getUser_id.' '.$getUser_email;
            //echo is_numeric($getUser_id);
            
            $verification_link = site_url('home/reset/'.$getUser_id.'?hash=' . get_hash($getUser_id));
            //echo $verification_link;
    if(is_numeric($getUser_id)){
       // Send Verification Email
                            $msg ="
                            <table > 
                             <tbody> 
                             <tr> 
                             <td> Hello,
                              
                             </td> 
                             </tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>You recently requested to reset your Dollar Review Club password. To complete your request, please click the below to set a new password:</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>".$verification_link."</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>If you don't mean to reset your password, then you can ignore this email; your password will not change.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Thank you!</td></tr>
                              <tr><td>The Dollar Review Club Team</td></tr>
                              
                             </tbody> 
                             </table>";
                             
                            sendEmail($getUser_email, "Reset your Dollar Review Club Password.", $msg);
        ajaxResp(true, "Success", array("data" => $getUser_email));    
    }
    else{
        ajaxResp(true, "Fail", array("data" => $getUser_email));
    }
    
    }
public function resend_verifying_email_form() {
    $email = $_POST['resend_verifying_email'];

            $args = array(
                array(
                    'field' => 'email',
                    'cond' => '=',
                    'value' => $email
                )
            );
            
            $getUser = $this->userm->get_where($args);
            //print_r($getUser);
            $getUser = $getUser[0];
            $getUser_id = $getUser->id;
            if(!isset($getUser_id)){ajaxResp(true, "Fail", array("data" => $email));}
            $getUser_email = $getUser->email;
            $getUser_type = $getUser->role;
            $getUser_name = $getUser->fname;
            $getUser_verification_code = $getUser->verification_code;
            $getUser_isDel = $getUser->isDel;
            if(empty($getUser_verification_code)){ajaxResp(true, "Fail", array("data" => $email));}
            $verification_link = site_url('home/verify/' . $getUser_verification_code);
            //echo $verification_link;
        switch ($getUser_type) {
            case 'shopper': {
                        
                            // Send Verification Email
                            $msg ="
                            <table > 
                             <tbody> 
                             <tr> 
                             <td> Hello ".$getUser_name.",
                              
                             </td> 
                             </tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Welcome to Dollar Review Club! To activate your account and verify your email</td></tr>
                              <tr><td> address, please click the following link:</td></tr>
                              <tr><td><a href='".$verification_link."'>".$verification_link."</a></td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>We'd also appreciate if you can help spread the word by sharing the</td></tr>
                              <tr><td><a href='".site_url()."' target='_blank'>".site_url()."</a> website on your social network.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Note: If you've received an account verification email in error, it's likely that another </td></tr>
                              <tr><td>user entered your email address. If you didn't initiate the request for subscribing </td></tr>
                              <tr><td>Dollar Review Club, you don't need to take any further action. You can simply </td></tr>
                              <tr><td>disregard the verification email, and the account won't be verified.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Thank you!</td></tr>
                              <tr><td>The Dollar Review Club Team</td></tr>
                              
                             </tbody> 
                             </table>";
                            //$msg = "Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n " . site_url('user/verify/' . $verification_code) . "\n" . "\n\nThanks\n" . lang('website_name');
                            sendEmail($email, "Please confirm your subscription to Dollar Review Club.", $msg);
                            ajaxResp(true, 'Success',array("data" => $getUser_email));
                    
                    break;
                }
            case 'companies': {
                            
                            // Send Verification Email
                            $msg ="
                            <table > 
                             <tbody> 
                             <tr> 
                             <td> Hello ".$getUser_name.",
                              
                             </td> 
                             </tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Welcome to Dollar Review Club! To activate your account and verify your email</td></tr>
                              <tr><td> address, please click the following link:</td></tr>
                              <tr><td><a href='".$verification_link."'>".$verification_link."</a></td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>We'd also appreciate if you can help spread the word by sharing the</td></tr>
                              <tr><td><a href='".site_url()."' target='_blank'>".site_url()."</a> website on your social network.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Note: If you've received an account verification email in error, it's likely that another </td></tr>
                              <tr><td>user entered your email address. If you didn't initiate the request for subscribing </td></tr>
                              <tr><td>Dollar Review Club, you don't need to take any further action. You can simply </td></tr>
                              <tr><td>disregard the verification email, and the account won't be verified.</td></tr>
                              <tr><td><div><br></div></td></tr>
                              <tr><td>Thank you!</td></tr>
                              <tr><td>The Dollar Review Club Team</td></tr>
                              
                             </tbody> 
                             </table>";
                            sendEmail($email, "Please confirm your subscription to Dollar Review Club.", $msg);
                            ajaxResp(true, 'Success',array("data" => $getUser_email));
                    break;
                }
            default: {
                     ajaxResp(true, "Fail", array("data" => $getUser_email));
                }
        }
    
    }
    
    
public function get_review_list_fn() {
    $cid = $_POST['cid'];
    $sl_id = $_POST['sl_id'];
    $date = $_POST['date'];
    $profile = $_POST['profile'];
    $product = $_POST['product'];
    $page = '1';
    $post_paramtrs = false;
    $result = $this->get_review_list($date,$profile,$product,$page, $post_paramtrs);
    //return $result ;
    //echo $result['content'];
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
        
        ajaxResp(true, "Success", array("data" => $result));    
    }
    else{
        ajaxResp(true, "Fail", array("data" => $result));
    }
    
    }
public function get_review_list($date,$profile,$product,$page, $post_paramtrs = false) {
        /*if(!isset($date)){$date = $_POST['date'];}
        if(!isset($profile)){$profile = $_POST['profile'];}
        if(!isset($product)){$product = $_POST['product'];}
        if(!isset($page)){$page = '1';}*/
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
            //echo $profile.' '.$user_id.'</br>';
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
        //ajaxResp(true, "Success", array("data" => $result));
    } else{
        return 'fasle';
        //ajaxResp(true, "Success", array("data" => 'fasle'));
    } 
}


public function itemdetails() {
        $pid = $_POST['pid'];
        
        // Get Current User
        $user = get_active_user();
        $formatted_date = '0';
        
        $pro = $this->product->get($pid);
        $date = strtotime("now");
        $start_date = strtotime($pro->start_date);
        $end_date = strtotime($pro->end_date);
        $can_get_msg = '';
        if($pro->end_date_type == 'product_end_time_until')
          {
            if($pro->total_count < $pro->product_end_time_until_count)
           {
             $can_get = 'true';  $can_get_error = 'no';
           }
           else
           {
            $can_get = 'false';  $can_get_error = 'stock out';
           }
          }
          else
          {
           if($start_date<=$date && $end_date>=$date)
            {
              $can_get = 'true';  $can_get_error = 'no';
            }
           else
            {
              $can_get = 'false';  $can_get_error = 'out of date';
            }
                        
          }
          /*if($can_get != 'true')
          {
             $update = array("disabled" => 1);
             $where = array("pid" => $pro->pid);
             $this->update($update, $where);
             
            $can_get_msg = 'expire';
          }*/
        
        
        if($can_get_msg != 'expire')
        {
            
        
        if($pro->daily_limit != 'unlimited' && $pro->present_date != strtotime(date('Y-m-d')))
        {
            $update = array("present_date" =>  strtotime(date('Y-m-d')), "daily_count" => 0);
            $where = array("pid" => $pid);
            $this->product->update($update, $where);
            $pro = $this->product->get($pid);
            $start_date = strtotime($pro->start_date);
            $end_date = strtotime($pro->end_date);
        }
        
       if($pro->daily_limit != 'unlimited')
                    {
                        if($pro->daily_count < $pro->daily_limit)
                        {
                            $can_get_msg = 'no';
                        }
                        else
                        {
                            $can_get_msg = 'daily_limit_out';
                        }
                    }
       if($pro->end_date_type != 'product_end_time_until')
                    {
                        if($start_date<=$date && $end_date>=$date)
                        {
                            $can_get_msg = 'no'; $diff_date = $end_date-$date;
                            $get_formatted_date = $this->secondsToTime($diff_date);
                            //5d : 6h : 52min
                            $formatted_date = $get_formatted_date['d'].'d : '.$get_formatted_date['h'].'h : '.$get_formatted_date['m'].'min';
                        }
                        
                    }
        }
        //$reviewLink = login_url(get_current_url());
        $amazonLink = $pro->aws_url;
        
        
        
        $this->data['user'] = $user;
        //$this->data['reviewLink'] = $reviewLink;
        //$this->data['getitnow_text'] = $reviewLink;
        $this->data['amazonLink'] = $amazonLink;
        $this->data['pro'] = $pro;
        $this->data['other_img_url'] = unserialize($pro->other_img_url);
        $this->data['can_get_msg']= $can_get_msg;
        $this->data['time_left']= $formatted_date;
        if($pro->review_suggetion_type == 'review_suggetion_none')
        {
            $this->data['review_suggestion'] = '- None';
        }
        else
        {
            $review_suggestion = unserialize($pro->review_suggetion_type);
            if($review_suggestion['0'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] = '- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['0'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] = '- At least 1 photo and/or video';
            }
            
            if($review_suggestion['1'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] .= '</br>- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['1'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] .= '</br>- At least 1 photo and/or video';
            }
            
        }
        //$this->data['other_img_count'] = count($this->data['other_img_url']);
        /*$this->data['title'] = $pro->name;
        $this->data['description']= $pro->description;
        $this->data['image'] = $pro->img_url;
        $this->data['cat'] = $this->product->category(array("cid" => $pro->category));*/
        $this->data['custom_url'] = base_url('deals/item/'.$pid.'/'.get_hash($pid));
        //load_view('item', $this->data);
        ajaxResp(true, "Success", array("data" => $this->data));
        //return $this->data;
        //return $this->data;
    }
    
  
public function get_now_condition1() {
        $pid = $_POST['pid'];
        
        // Get Current User
        $user = get_active_user();
        $getUsermata_quota = getUsermata($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
        
        $pro = $this->product->get($pid);
        
        $can_get = 'false';
        $date = strtotime("now");
        $start_date = strtotime($pro->start_date);
        $end_date = strtotime($pro->end_date);

        if($getUsermata_quota >= 1)
        {
            /*if($pro->daily_limit == 'unlimited')
            {
                if($pro->end_date_type == 'product_end_time_until')
                {
                    if($pro->total_count < $pro->product_end_time_until_count)
                    {
                        $can_get = 'true';  $can_get_error = 'no';
                    }
                    else
                    {
                        $can_get = 'false';  $can_get_error = 'stock out';
                    }
                }
                else
                {
                    if($start_date<=$date && $end_date>=$date)
                    {
                        $can_get = 'true';  $can_get_error = 'no';
                    }
                    else
                    {
                        $can_get = 'false';  $can_get_error = 'out of date';
                    }
                    
                }
            }
            else if($pro->daily_limit<=$pro->daily_count)
            {
                $can_get = 'false';  $can_get_error = 'daily limit out';
            }
            else
            {
                if($pro->end_date_type == 'product_end_time_until')
                {
                    if($pro->total_count < $pro->product_end_time_until_count)
                    {
                        $can_get = 'true';  $can_get_error = 'no';
                    }
                    else
                    {
                        $can_get = 'false';  $can_get_error = 'stock out';
                    }
                }
                else
                {
                    if($start_date<=$date && $end_date>=$date)
                    {
                        $can_get = 'true';  $can_get_error = 'no';
                    }
                    else
                    {
                        $can_get = 'false';  $can_get_error = 'out of date';
                    }
                    
                }
            }*/
            $can_get = 'true';  $can_get_error = 'no';
        }
        else
        {
             $can_get = 'false';  $can_get_error = 'no quota';   
        }
        
        
        if($pro->review_suggetion_type == 'review_suggetion_none')
        {
            $this->data['review_suggestion'] = '- None';
        }
        else
        {
            $review_suggestion = unserialize($pro->review_suggetion_type);
            if($review_suggestion['0'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] = '- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['0'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] = '- At least 1 photo and/or video';
            }
            
            if($review_suggestion['1'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] .= '</br>- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['1'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] .= '</br>- At least 1 photo and/or video';
            }
            
        }
        
        
        $this->data['can_get']= $can_get;
        $this->data['can_get_error']= $can_get_error;
        ajaxResp(true, "Success", array("data" => $this->data));
    }
  
public function get_now_condition2() {
        $pid = $_POST['pid'];
        
        // Get Current User
        $user = get_active_user();
        $getUsermata_quota = getUsermata($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
        $getUsermata_review = getUsermata($user->id, 'review');       $getUsermata_review    = $getUsermata_review->mval;
        if(!is_numeric($getUsermata_review))
        {$getUsermata_review = 0;}
        
        $pro = $this->product->get($pid);
        
        $can_get = 'false';
        $date = strtotime("now");
        $start_date = strtotime($pro->start_date);
        $end_date = strtotime($pro->end_date);
        $need_review = $pro->code_access_condition;
        if($getUsermata_quota >= 1)
        {
            if($getUsermata_review >= $pro->code_access_condition)
            {
                $can_get = 'true';  $can_get_error = 'no';
            }
            else
            {
                $can_get = 'false';  $can_get_error = 'no review'; 
            }
        }
        else
        {
             $can_get = 'false';  $can_get_error = 'no quota';   
        }
        
        if($pro->review_suggetion_type == 'review_suggetion_none')
        {
            $this->data['review_suggestion'] = '- None';
        }
        else
        {
            $review_suggestion = unserialize($pro->review_suggetion_type);
            if($review_suggestion['0'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] = '- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['0'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] = '- At least 1 photo and/or video';
            }
            
            if($review_suggestion['1'] == 'review_suggetion_custom')
            {
                $this->data['review_suggestion'] .= '</br>- '.$pro->review_suggetion.' words or above';
            }
            else if($review_suggestion['1'] == 'review_suggetion_video')
            {
                $this->data['review_suggestion'] .= '</br>- At least 1 photo and/or video';
            }
            
        }
        
        $this->data['can_get']= $can_get;
        $this->data['can_get_error']= $can_get_error;
        $this->data['need_review']= $need_review;
        
        ajaxResp(true, "Success", array("data" => $this->data));
    }
 
public function get_now_condition3() {
        $pid = $_POST['pid'];
        
        // Get Current User
        $user = get_active_user();
        $getUsermata_quota = getUsermata($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
        
        $pro = $this->product->get($pid);
        
        $can_get = 'false';
        $date = strtotime("now");
        $start_date = strtotime($pro->start_date);
        $end_date = strtotime($pro->end_date);

        if($getUsermata_quota >= 1)
        {
            $can_get = 'true';  $can_get_error = 'no';
        }
        else
        {
             $can_get = 'false';  $can_get_error = 'no quota';   
        }
        
        
        $this->data['can_get']= $can_get;
        $this->data['can_get_error']= $can_get_error;
        $this->data['seller_id']= $pro->uid;
        
        ajaxResp(true, "Success", array("data" => $this->data));
    }
  

public function send_approve_request(){
    // Get Current User
    $date = date ("Y-m-d H:i:s");
    $user = get_active_user();
    $getUsermata_quota = getUsermata($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
    $pid = $_POST['pid'];
    $seller_id = $_POST['seller_id'];
    $pro = $this->product->get($pid);
    
    $insert = array("customer_id" => $user->id,"seller_id" => $seller_id,"product_id" => $pid,"date" => $date, 'seller_approve_status'=>'pending','code_taken'=>'no', "seller_notification" => 'yes');
    $get_id = $this->product->insert_approve_request($insert);
    
    $this->userm->updateUsermeta($user->id, 'quota', $getUsermata_quota-1);
    $this->data['id'] = $get_id;
    
    
    ajaxResp(true, "Success", array("data" => $this->data));
}    


public function get_the_discount_code(){
    // Get Current User
    $date = date ("Y-m-d H:i:s");
    $user = get_active_user();
    $getUsermata_quota = getUsermata($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
    $pid = $_POST['product_id_for_code'];
    $code_access_type = $_POST['code_access_type'];
    $update_approve_request_id = $_POST['update_approve_request_id'];
    $pro = $this->product->get($pid);
    $isUsed = false;
    //$this->data['code']= $this->product->get_promo_codes($pid,$isUsed);
    $code= $this->product->get_promo_codes($pid,$isUsed);
    //print_r($code);
    $this->data['code']= $code->promo_code;
    if(is_int($pro->daily_count)){$daily_count = $pro->daily_count+1; }else{$daily_count = 1; }
    if(is_int($pro->total_count)){$total_count = $pro->total_count+1; }else{$total_count = 1; }
    
    $update = array("is_used" => '1',"customer_id" => $user->id,"seller_id" => $pro->uid,"date" => $date);
    $where = array("promo_id" => $code->promo_id);
    $this->product->update_promo_codes($update, $where);
    
    $update = array("daily_count" => $daily_count,"total_count" => $total_count,);
    $where = array("pid" => $pid);
    $this->product->update($update, $where);
    
    
    $nextdate = strtotime(date('Y-m-d h:i:s')) + (120*3600);//$_POST['date'];
    if($code_access_type == 'auto')
    {
        $insert = array("customer_id" => $user->id,"seller_id" => $pro->uid,"product_id" => $pid,"date" => $date,"promo_id" => $code->promo_id, 'seller_approve_status'=>'auto','code_taken'=>'yes',"notification" => 'yes','next_time_to_email'=>$nextdate);
        $get_id = $this->product->insert_approve_request($insert);
        $this->userm->updateUsermeta($user->id, 'quota', $getUsermata_quota-1);
    }
    else if($code_access_type == 'manual')
    {
        $update = array('code_taken'=>'yes', "notification" => 'yes', "promo_id" => $code->promo_id,'next_time_to_email'=>$nextdate);
        $where = array("id" => $update_approve_request_id);
        $get_id = $this->product->update_approve_request($update,$where);
    }
    ajaxResp(true, "Success", array("data" => $this->data));
}    
      
    public function sorting() {
        $range = $this->input->post("range", TRUE);
        $search = $this->input->post("search", TRUE);
        $slug = $this->input->post('slug', TRUE);
        $type = $this->input->post('type', TRUE);
        $sort = $this->input->post("sort", TRUE);

        if (!empty($sort)) {
            $sort = explode("__", $sort);
        }

        /*
         * IF Categories
         */
        /*if ($type == 'categories') {
            $args = array(
                array(
                    "comp" => " AND ",
                    "field" => "c.slug",
                    "cond" => "=",
                    "value" => $slug
                ),
                array(
                    "comp" => " AND ",
                    "field" => "p.discount_price",
                    "cond" => "BETWEEN {$range[0]} AND {$range[1]}",
                    "value" => ""
                )
            );

            $products = $this->product->category_item($args, false, $sort);

            /*
             * IF Deals 
             */
        /*} else if ($type == 'onedealscategories') {
            $args = array(
                array(
                    "comp" => " AND ",
                    "field" => "c.slug",
                    "cond" => "=",
                    "value" => $slug
                ),
                array(
                    "comp" => " AND ",
                    "field" => "p.discount_price",
                    "cond" => "BETWEEN {$range[0]} AND {$range[1]}",
                    "value" => ""
                )
            );

            $products = $this->product->category_item($args, false, $sort);

            /*
             * IF Deals 
             */
        /*} else */
        if ($type == 'deals') {
            $args = array(
                array(
                    "field" => "discount_price BETWEEN {$range[0]} AND {$range[1]}",
                    "cond" => null,
                    "value" => null
                )
            );

            /*SET SEARCH category*/
            if(isset($slug) && !empty($slug)){
            	$args[] = array(
                    "comp" => " AND ",
                    "field" => "category",
                    "cond" => "=",
                    "value" => $slug
                );
            }
            /*SET SEARCH TERMS*/
            if(isset($search) && !empty($search)){
            	$args[] = array(
                    "field" => "name LIKE '%{$search}%'",
                    "cond" => null,
                    "value" => null
                );
            }

            if (is_array($sort)) {
                $sort[0] = "products." . substr($sort[0], 2);
            } else {
                $sort = array();
            }
                $args[] = array(
                    "comp" => " AND ",
                    "field" => "disabled",
                    "cond" => "=",
                    "value" => "0"
                );
            $products = $this->product->get_where($args, $sort);
        } else if ($type == 'onedeals') {
            $args = array(
                array(
                    "field" => "discount_price",
                    "cond" => '<=',
                    "value" => '1'
                )
            );    
            
            /*SET SEARCH category*/
            if(isset($slug) && !empty($slug)){
            	$args[] = array(
                    "comp" => " AND ",
                    "field" => "category",
                    "cond" => "=",
                    "value" => $slug
                );
            }

            /*SET SEARCH TERMS*/
            if(isset($search) && !empty($search)){
            	$args[] = array(
                    "field" => "name LIKE '%{$search}%'",
                    "cond" => null,
                    "value" => null
                );
            }

            if (is_array($sort)) {
                $sort[0] = "products." . substr($sort[0], 2);
            } else {
                $sort = array();
            }

            	$args[] = array(
                    "comp" => " AND ",
                    "field" => "disabled",
                    "cond" => "=",
                    "value" => "0"
                );
            $products = $this->product->get_where($args, $sort);
        }
    if ($type == 'onedeals')
    {
        $response = ($products) ? get_product_tiles_onedeals($products) : "<div class='alert alert-danger'>Sorry! Deals not found.</div>";
    }
    else
    {
        $response = ($products) ? get_product_tiles($products) : "<div class='alert alert-danger'>Sorry! Deals not found.</div>";
    }
        
        ajaxResp(true, "Success", array("type" => $type, "data" => $response));
    }

    public function changepass() {
    	
    	if(!$this->user){
            $this->userm->logout();
        }

        $_old = $this->input->post('_old', TRUE);
        $_new = $this->input->post('_new', TRUE);
        $_con = $this->input->post('_con', TRUE);

        if (empty($_old) || empty($_new) || empty($_con)) {
            ajaxResp(false, "Please fill all required fields!");
        }

        // If new and confirm password is not equal
        if ($_new !== $_con) {
            ajaxResp(false, "New and confirm passwords are not equal.");
        }

        // Find User by old password
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $this->user->email
            ),
            array(
                "field" => "pass",
                "cond" => "=",
                "value" => md5($_old)
            ),
        );

        // Get User
        $getUser = $this->userm->get_where($args);
        if (!$getUser) {
            ajaxResp(false, "Sorry! Please check Old password is invalid.");
        }

        // IF Get user then update password
        $update = array("pass" => md5($_new));
        $where = array("id" => $this->user->id);

        // Update password
        if ($this->userm->update($update, $where)) {
            ajaxResp(true, "Password changed successfully.");
        }

        // If password does not update
        ajaxResp(false, "Error in script. Please contact website administrator.");
    }

    /*
     * Preferences
     */
    public function preference() {
        
        if(!$this->user){
            $this->userm->logout();
        }

        //$category = $this->input->post("category", TRUE);
        $fname = $this->input->post('fname', TRUE);
        $email = $this->input->post('email', TRUE);
        $con_email = $this->input->post('con_email', TRUE);
        $args = array(
            array(
                "field" => "email",
                "cond" => "=",
                "value" => $email
            ),
        );
        $email_verify = $this->userm->get_where($args);
        //$lname = $this->input->post('lname', TRUE);
//$okay = preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $email);
$okay = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (empty($fname)) {
            ajaxResp(false, "Name cant be empty.");
        }
        else if($email != $con_email)
        {
            ajaxResp(false, 'Please confirm email id.');
        }
        else if(!$okay)
        {
            ajaxResp(false, 'Please enter valid email id.');
        }
        else if(!empty($email_verify) && $email_verify[0]->id != $_POST['uid'])
        {
            ajaxResp(false, 'Email id already exist.');
        }

        /*if (isset($category) && !empty($category)) {
            if (!$this->userm->updateUsermeta($this->user->id, 'category', $category)) {
                ajaxResp(false, "There are an error with add usermeta");
            }
        }*/

        // Update user
        //$update = array('fname' => $fname, 'lname' => $lname);
        $update = array('fname' => $fname, 'email' => $email);
        $where = array('id' => $this->user->id);
        if ($this->userm->update($update, $where)) {
            ajaxResp(true, "Data updated successfully.");
        }

        ajaxResp(false, "Sorry! There are an error with script.");
    }
    
     
     
     /*
     * Preferences
     */
    public function setpreference() {
        
        if(!$this->user){
            $this->userm->logout();
        }

        $category = $this->input->post("user_interest", TRUE);
        $amazonUrl = $this->input->post("amazonUrl", TRUE);
        $category = explode(",",$category);

        if(empty($amazonUrl) && strlen($amazonUrl) === 0){
			ajaxResp(false, "Please enter Amazon Url");
		}
		
		if(strpos($amazonUrl, "amazon") === false){
			ajaxResp(false, "Please enter valid Amazon url");
		}
		
		preg_match('~https://www.amazon.com/gp/profile/(.*)~', $amazonUrl, $matches);		
		if( isset($matches[1]) && !empty($matches[1]) && $matches[1] !== "A4BXSFGWDAXDLA"){
			if( $this->userm->updateUsermeta($this->user->id, 'amazon_url', $amazonUrl) ){
				if (isset($category) && !empty($category)) {
                    if (!$this->userm->updateUsermeta($this->user->id, 'category', serialize($category))) {
                        ajaxResp(false, "There are an error with add usermeta");
                    }
                    else{
                        
                        ajaxResp(true, "Preferences updated successfully.");
                    }
                }
			}
		}else{
			ajaxResp(false, "Please enter valid Amazon url");
		}
        
        

        


        ajaxResp(false, "Sorry! There are an error with script.");
    }
     
      
      public function set_approve()     
      {
        $approve_value = $_POST['approve_value'];
        foreach($approve_value as $single)
        {
            
        $update = array('seller_approve_status'=>'approve', 'notification'=>'yes');
        $where = array("id" => $single);
        $get_result = $this->product->update_approve_request($update,$where);
        }
        ajaxResp(true, 'success');
      } 
     
      
      public function set_disapprove()     
      {
        $approve_value = $_POST['approve_value'];
        foreach($approve_value as $single)
        {
            
        $update = array('seller_approve_status'=>'disapprove', 'notification'=>'yes', "finished" => '1');
        $where = array("id" => $single);
        $get_result = $this->product->update_approve_request($update,$where);
        $data = $this->product->get_approve_request($single);
        $getUsermata_quota = getUsermata($data->customer_id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval;
        $this->userm->updateUsermeta($data->customer_id, 'quota', $getUsermata_quota+1);
        
        
        
        }
        ajaxResp(true, 'success');
      } 
    /**
     * WORK on 404 Page if something wrong
     */
     public function modal_body_for_manual()
     {
        $pid = $_POST['pid'];
        $key = $_POST['key'];
        $val = $_POST['val'];
        $type = $_POST['approve_type'];
        $limit = $_POST['limit'];
        $page = $_POST['page'];
        $start_point = $limit *($page-1);
        $where = array();
        $no_of_request_fun = "manual_function(".$pid.",'manual_no_request',this.value);";
        $request_type_fun = "manual_function(".$pid.",'approve_type',this.value);";
        
        //$where = array("id" => $update_approve_request_id);
        if($type != 'all')
        {
           if(!in_array('all',$type))
            {$where['seller_approve_status'] = $type;}
        }
        else{
            $selected_pending = 'checked="checked"';
        }
        if($key == 'approve_type')
        {
            foreach($val as $single_type)
            {
                if($single_type == 'all'){$selected_pending = 'checked="checked"';}else if($single_type == 'approve'){$selected_approve = 'checked="checked"';}
            else if($single_type == 'disapprove'){$selected_disapprove = 'checked="checked"';}
            }
            
        }
        
        foreach($type as $single_type)
            {
                if($single_type == 'all'){$selected_pending = 'checked="checked"';}else if($single_type == 'approve'){$selected_approve = 'checked="checked"';}
            else if($single_type == 'disapprove'){$selected_disapprove = 'checked="checked"';}
            }
            
            
        if($key == 'manual_no_request')
        {
            if($val == '10'){$selected_10 = 'selected="selected"';}else if($val == '20'){$selected_20 = 'selected="selected"';}
            else if($val == '30'){$selected_30 = 'selected="selected"';}else if($val == '40'){$selected_40 = 'selected="selected"';}
        }
        if($limit == '10'){$selected_10 = 'selected="selected"';}else if($limit == '20'){$selected_20 = 'selected="selected"';}
            else if($limit == '30'){$selected_30 = 'selected="selected"';}else if($limit == '40'){$selected_40 = 'selected="selected"';}
        
        $data = get_request_table_data_for_product($pid, $where, $limit, $start_point);
        //print_r($data);
        /*
        Array ( [0] => stdClass Object ( [id] => 1 [customer_id] => 2 [seller_id] => 3 [product_id] => 25 [date] => 2016-03-21 17:45:30 [promo_id] => 0 [seller_approve_status] => pending [code_taken] => no [review_status] => fail [review_content] => [review_image_video] => [review_rating] => [review_date] => 0000-00-00 ) [1] => stdClass Object ( [id] => 5 [customer_id] => 2 [seller_id] => 3 [product_id] => 25 [date] => 2016-03-21 17:45:30 [promo_id] => 121 [seller_approve_status] => approve [code_taken] => yes [review_status] => fail [review_content] => [review_image_video] => [review_rating] => [review_date] => 0000-00-00 ) ) 
        */
        $get_manual_pending_by_id = get_manual_pending_by_id($pid);
            if($get_manual_pending_by_id!='0'){$count_get_manual_pending_by_id = count($get_manual_pending_by_id);}else{$count_get_manual_pending_by_id = 0;}
        $get_manual_approve_by_id = get_manual_approve_by_id($pid);
            if($get_manual_approve_by_id!='0'){$count_get_manual_approve_by_id = count($get_manual_approve_by_id);}else{$count_get_manual_approve_by_id = 0;}
        $get_manual_disapprove_by_id = get_manual_disapprove_by_id($pid);
            if($get_manual_disapprove_by_id!='0'){$count_get_manual_disapprove_by_id = count($get_manual_disapprove_by_id);}else{$count_get_manual_disapprove_by_id = 0;}
        //$html =$pid.' '.$key.' '.$val.' '.$type.
            $total_applied = $count_get_manual_pending_by_id + $count_get_manual_approve_by_id + $count_get_manual_disapprove_by_id;
        $html .= '<h3>List of Customers getting your discount code</h3>
			<div class="selectoption pull-right">
					<select class="form-control cat_control" name="manual_no_of_request" id="manual_no_of_request" placeholder="Choose Category" onchange="'.$no_of_request_fun.'">
                        <option value="10" '.$selected_10.'>Show 10 requests</option>
						<option value="20" '.$selected_20.'>Show 20 requests</option>
						<option value="30" '.$selected_30.'>Show 30 requests</option>
						<option value="40" '.$selected_40.'>Show 40 requests</option>
						
					</select>
			</div>
			
			<div class="top-radio-btns">
			<div class="row">
			<div class="col-sm-4">
			<div class="control-label">
							<input type="checkbox" id="manual_pending" name="approve_type" value="all" class="radiogroup " onclick="'.$request_type_fun.'" '.$selected_pending.'>
							<label for="manual_pending"><span></span>Applied: <span class="cust_no">'.$total_applied.' customer(s)</span></label>
			</div> 
			</div> <!-- col--->
			
			<div class="col-sm-4">
			<div class="control-label">
							<input type="checkbox" id="manual_approve" name="approve_type" value="approve" class="radiogroup " onclick="'.$request_type_fun.'"'.$selected_approve.'>
							<label for="manual_approve"><span></span>Approved(V):  <span class="cust_no">'.$count_get_manual_approve_by_id.' customer(s)</span></label>
			</div> 
			</div> <!-- col--->
			<div class="col-sm-4">
			<div class="control-label">
							<input type="checkbox" id="manual_disapprove" name="approve_type" value="disapprove" class="radiogroup " onclick="'.$request_type_fun.'"'.$selected_disapprove.'>
							<label for="manual_disapprove"><span></span>Disapproved(X):  <span class="cust_no">'.$count_get_manual_disapprove_by_id.' customer(s)</span></label>
			</div> 
			</div> <!-- col--->
			
			</div><!-- row -->
			</div>
			
			
			<div id="no-more-tables">
            <table class="text-center table-bordered table-condensed table-striped-column cust_dis_code_table cf">
		
        			<thead>
        			<tr>
        				<td class="numeric col1"><div class="control-label">
							<input type="checkbox" id="approve_disapprove_all" name="approve_disapprove_all" value="all" onclick="approve_disapprove_select();" class="radiogroup ">
							<label for="approve_disapprove_all"><span></span></label>
						</div></td>
        				<td class="numeric col2">Promo Code</td>
        				<td class="numeric col2">Customer Name</td>
        				<td class="numeric col3">Checked Reviews on DRC</td>
        				<td class="numeric col4">Reviewer Ranking on Amazon</td>
        				<td class="numeric col5">Helpful Votes on Amazon</td>
        				<td class="numeric col6">Status</td>
        			</tr>
					</thead>
    
        		<tbody>';
                $results = $data['result'];
                $results_count = $data['count'];
                //$html .= $results_count;
                foreach($results as $result)
                {
                    $userdata = $this->userm->get($result->customer_id);
                    
        $getUsermata_review = getUsermata($userdata->id, 'review');       $getUsermata_review    = $getUsermata_review->mval;
        $getUsermata_amazon_profile_vote = getUsermata($userdata->id, 'amazon_profile_vote');       $getUsermata_amazon_profile_vote = $getUsermata_amazon_profile_vote->mval; if($getUsermata_amazon_profile_vote==0){$getUsermata_amazon_profile_vote='';}
        $getUsermata_amazon_profile_rank = getUsermata($userdata->id, 'amazon_profile_rank');       $getUsermata_amazon_profile_rank    = $getUsermata_amazon_profile_rank->mval; if($getUsermata_amazon_profile_rank==0){$getUsermata_amazon_profile_rank='';}
        $getUsermata_amazon_profile_link = getUsermata($userdata->id, 'amazon_url');       $getUsermata_amazon_profile_link    = $getUsermata_amazon_profile_link->mval;        //$html .= print_r($userdata);
                    if($result->seller_approve_status == 'pending'){$status = 'Approval Pending';$icon = '<div class="control-label">
							<input class="approve_disapprove" type="checkbox" id="approve_disapprove_'.$result->id.'" name="approve_disapprove" value="'.$result->id.'" class="radiogroup ">
							<label for="approve_disapprove_'.$result->id.'"><span></span></label>
						</div>';}
                    else if($result->seller_approve_status == 'disapprove'){$status = 'Disapproved';$icon = 'x';}
                    else if($result->seller_approve_status == 'auto_reject'){$status = 'No reply, return quota';$icon = 'x';}
                    else if($result->code_taken == 'yes' && $result->review_status == 'fail'){$status = 'Code Taken';$icon = 'v';}
                    else if($result->code_taken == 'yes' && $result->review_status == 'pass'){$status = 'Review Checked';$icon = 'v';}
                    else if($result->code_taken == 'no' && $result->review_status == 'fail'){$status = 'Approved';$icon = 'v';}
                    //$result->id;
                    $codes_data = $this->product->get_promo_codes_by_id($result->promo_id, 'null');
                    //print_r($codes_data);
                    $codes =$codes_data->promo_code;
                    $html .= '<tr>
        				<td data-title=" "> '.$icon.'</td>
        				<td data-title="Code">'.$codes.'</td>
        				<td data-title="Customer Name"><a href="'.$getUsermata_amazon_profile_link.'" target="_blank">'.$userdata->fname.'</a></td>
        				<td data-title="Checked Reviews on DRC">'.$getUsermata_review.'</td>
        				<td data-title="Reviewer Ranking on Amazon">'.$getUsermata_amazon_profile_rank.'</td>
        				<td data-title="Helpful Votes on Amazon" >'.$getUsermata_amazon_profile_vote.'</td>
						<td data-title="Status">'.$status.'</td>
        			</tr>';
                }
					
					
				$html .='</tbody>	
			</table>	
			
			<div class="bottom-two-btns">
				<button type="button" class="btn smt-btn"data-toggle="modal" data-dismiss="modal" data-target="#myModal44" >Approve selected customer</button>
				<button type="button" class="btn regent-gray" data-toggle="modal" data-dismiss="modal" data-target="#myModal43">Disapprove selected customer</button>
			</div>
			<div class="table-nav pull-right clearfix">	
		 ';
         
         
         $prev = $page - 1;							//previous page is page - 1
    	$next = $page + 1;							//next page is page + 1
    	$lastpage = ceil($results_count/$limit);		//lastpage is = total pages / items per page, rounded up.
    	$lpm1 = $lastpage - 1;
         $request_page_pre_fun = "manual_function('".$pid."','request_page','".$prev."');";
         $request_page_next_fun = "manual_function('".$pid."','request_page','".$next."');";
         // How many adjacent pages should be shown on each side?
	       $adjacents = 3;
         
         
         
         
         
         $pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= '<ul class="pagination">';
		//previous button
		if ($page > 1) 
			$pagination .= '<li ><a onclick="'.$request_page_pre_fun.'" style="cursor: pointer;"><span aria-hidden="true">&lsaquo;</span></a></li>';
		else
			$pagination .= '<li ><a><span aria-hidden="true" style="display:none">&lsaquo;</span></a></li>';	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{$request_page_fun = "manual_function('".$pid."','request_page','".$counter."');";
				if ($counter == $page)
					$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
				else
					$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{$request_page_fun = "manual_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "manual_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "manual_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
                $request_1st_page_fun = "manual_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "manual_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{$request_page_fun = "manual_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "manual_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "manual_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//close to end; only hide early pages
			else
			{
                $request_1st_page_fun = "manual_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "manual_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{$request_page_fun = "manual_function('".$pid."','request_page','".$counter."');"; 
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination .= '<li><a onclick="'.$request_page_next_fun.'" style="cursor: pointer;"><span aria-hidden="true">&rsaquo;</span></a></li>';
		else
			$pagination .= '<li><a><span aria-hidden="true" style="display:none">&rsaquo;</span></a></li>';
		$pagination.= "</ul>";		
	}
         $html .= $pagination;
         
         
		$html .= '
		<div class="back-btn clearfix">
		<button type="button" class="btn btn185_73" data-toggle="modal" data-dismiss="modal">Back</button>
		</div>
	</div>
		<div class="clearfix"></div>
	
			</div>';
            
            ajaxResp(true, $html);
     }
     
     
     
     public function modal_body_for_auto_none()
     {
        $pid = $_POST['pid'];
        $key = $_POST['key'];
        $val = $_POST['val'];
        $limit = $_POST['limit'];
        $page = $_POST['page'];
        $start_point = $limit *($page-1);
        $where = array();
        $no_of_request_fun = "auto_none_function(".$pid.",'no_request',this.value);";
        
        //$where = array("id" => $update_approve_request_id);
       
            
        if($key == 'request_page')
        {
            if($val == '10'){$selected_10 = 'selected="selected"';}else if($val == '20'){$selected_20 = 'selected="selected"';}
            else if($val == '30'){$selected_30 = 'selected="selected"';}else if($val == '40'){$selected_40 = 'selected="selected"';}
        }
        if($limit == '10'){$selected_10 = 'selected="selected"';}else if($limit == '20'){$selected_20 = 'selected="selected"';}
            else if($limit == '30'){$selected_30 = 'selected="selected"';}else if($limit == '40'){$selected_40 = 'selected="selected"';}
        
        $data1 = get_request_table_data_for_product($pid, $where, $limit, $start_point);
        $data = $this->product->all_promo_codes_filter($pid, $limit, $start_point);
        //$non_claimed_code = get_promo_codes_by_id($pid, false);
        //print_r($data);
        //print_r($non_claimed_code);
        if($data1['count'] == '' || $data1['count'] == 'f'){$code_given_count = '0';}else{$code_given_count = $data1['count'];}
        //$html =$pid.' '.$key.' '.$val.' '.$type.
        $html .= '<h3>List of Customers getting your discount code</h3>
			<div class="selectoption pull-right">
					<select class="form-control cat_control" name="auto_none_no_of_request" id="auto_none_no_of_request" placeholder="Choose Category" onchange="'.$no_of_request_fun.'">
                        <option value="10" '.$selected_10.'>Show 10 requests</option>
						<option value="20" '.$selected_20.'>Show 20 requests</option>
						<option value="30" '.$selected_30.'>Show 30 requests</option>
						<option value="40" '.$selected_40.'>Show 40 requests</option>
						
					</select>
			</div>
			<div class="sub-heading">Discount code given: <span>'.$code_given_count.'</span></div>
					
			
			<div id="no-more-tables">
            <table class="text-center table-bordered table-condensed table-striped-column approved-table cf">
		
        			<thead>
						<tr>
        				<td class="numeric col1"> </td>
        				<td class="numeric col2">Promo Codes</td>
        				<td class="numeric col2">Customer Name</td>
        				<td class="numeric col3">Checked Reviews on DRC</td>
        				<td class="numeric col4">Reviewer Ranking on Amazon</td>
        				<td class="numeric col5">Helpful Votes on Amazon</td>
        				<td class="numeric col6">Status</td>
        			</tr>
					</thead>
    
        		<tbody>';
                $results = $data['result'];
                $results_count = $data['count'];
                //$html .= $results_count;
                foreach($results as $result)
                {
                    //print_r($result);
                    $codes =$result->promo_code;
                    $is_used =$result->is_used;
                    $result = $this->product->get_promo_code_details_approve_request_table($result->promo_id);
                    //print_r($result);
                    if($is_used==1){$userdata = $this->userm->get($result->customer_id);
                    
                    
        $getUsermata_review = getUsermata($userdata->id, 'review');       $getUsermata_review    = $getUsermata_review->mval;
        $getUsermata_amazon_profile_vote = getUsermata($userdata->id, 'amazon_profile_vote');       $getUsermata_amazon_profile_vote = $getUsermata_amazon_profile_vote->mval; if($getUsermata_amazon_profile_vote==0){$getUsermata_amazon_profile_vote='';}
        $getUsermata_amazon_profile_rank = getUsermata($userdata->id, 'amazon_profile_rank');       $getUsermata_amazon_profile_rank    = $getUsermata_amazon_profile_rank->mval; if($getUsermata_amazon_profile_rank==0){$getUsermata_amazon_profile_rank='';}
        $getUsermata_amazon_profile_link = getUsermata($userdata->id, 'amazon_url');       $getUsermata_amazon_profile_link    = $getUsermata_amazon_profile_link->mval;
                
                    if($result->seller_approve_status == 'disapprove'){$status = 'Disapproved';$icon = 'x';}
                    else if($result->code_taken == 'yes' && $result->review_status == 'fail'){$status = 'Code Taken';$icon = 'v';}
                    else if($result->code_taken == 'yes' && $result->review_status == 'pass'){$status = 'Review Checked';$icon = 'v';}
                    }else{$userdata='';$status='';$icon='';$getUsermata_amazon_profile_link='';$getUsermata_review='';$getUsermata_amazon_profile_rank='';$getUsermata_amazon_profile_vote='';}
                    //$result->id;
                    $html .= '<tr>
        				<td data-title=" "> '.$icon.'</td>
        				<td data-title="Codes">'.$codes.'</td>
        				<td data-title="Customer Name"><a href="'.$getUsermata_amazon_profile_link.'" target="_blank">'.$userdata->fname.'</a></td>
        				<td data-title="Checked Reviews on DRC">'.$getUsermata_review.'</td>
        				<td data-title="Reviewer Ranking on Amazon">'.$getUsermata_amazon_profile_rank.'</td>
        				<td data-title="Helpful Votes on Amazon" >'.$getUsermata_amazon_profile_vote.'</td>
						<td data-title="Status">'.$status.'</td>
        			</tr>';
                }
					
					
				$html .='</tbody>	
			</table>	
			
			<div class="table-nav pull-right clearfix">	
		 <ul class="pagination">';
         
         
         $prev = $page - 1;							//previous page is page - 1
    	$next = $page + 1;							//next page is page + 1
    	$lastpage = ceil($results_count/$limit);		//lastpage is = total pages / items per page, rounded up.
    	$lpm1 = $lastpage - 1;
         $request_page_pre_fun = "auto_none_function('".$pid."','request_page','".$prev."');";
         $request_page_next_fun = "auto_none_function('".$pid."','request_page','".$next."');";
         // How many adjacent pages should be shown on each side?
	       $adjacents = 3;
         
         
         
         
         
         $pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= '<ul class="pagination">';
		//previous button
		if ($page > 1) 
			$pagination .= '<li ><a onclick="'.$request_page_pre_fun.'" style="cursor: pointer;"><span aria-hidden="true">&lsaquo;</span></a></li>';
		else
			$pagination .= '<li ><a><span aria-hidden="true" style="display:none">&lsaquo;</span></a></li>';	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{$request_page_fun = "auto_none_function('".$pid."','request_page','".$counter."');";
				if ($counter == $page)
					$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
				else
					$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{$request_page_fun = "auto_none_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "auto_none_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "auto_none_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
                $request_1st_page_fun = "auto_none_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "auto_none_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{$request_page_fun = "auto_none_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "auto_none_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "auto_none_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//close to end; only hide early pages
			else
			{
                $request_1st_page_fun = "auto_none_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "auto_none_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{$request_page_fun = "auto_none_function('".$pid."','request_page','".$counter."');"; 
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination .= '<li><a onclick="'.$request_page_next_fun.'" style="cursor: pointer;"><span aria-hidden="true">&rsaquo;</span></a></li>';
		else
			$pagination .= '<li><a><span aria-hidden="true" style="display:none">&rsaquo;</span></a></li>';
		$pagination.= "</ul>";		
	}
         $html .= $pagination;
         
         
		$html .= '
		<div class="back-btn clearfix">
		<button type="button" class="btn btn185_73" data-toggle="modal" data-dismiss="modal">Back</button>
		</div>
	</div>
		<div class="clearfix"></div>
	
			</div>';
            
            ajaxResp(true, $html);
     }
     
     
     
     
     
     public function modal_body_for_review_chart()
     {
        $pid = $_POST['pid'];
        $key = $_POST['key'];
        $val = $_POST['val'];
        $limit = $_POST['limit'];
        //$limit = 30;
        $page = $_POST['page'];
        $where = array();
        $from_date = strtotime(date ("Y-m-d"));
        $end_date = $from_date-($limit * 86400);
        $no_of_request_fun = "review_chart_function(".$pid.",'no_request',this.value);";
        $where = array("review_status" => 'pass',"review_date >=" => $end_date,"review_date <=" => $from_date);
        //$where = array("review_date >=" => $end_date);
        //$where = array("review_date <=" => $from_date);
        //$where = array("id" => $update_approve_request_id);
       //$todate = ;
            
        if($key == 'request_page')
        {
            if($val == '7'){$selected_7 = 'selected="selected"';}else if($val == '15'){$selected_15 = 'selected="selected"';}
            else if($val == '30'){$selected_30 = 'selected="selected"';}
        }
        if($limit == '7'){$selected_7 = 'selected="selected"';}else if($limit == '15'){$selected_15 = 'selected="selected"';}
            else if($limit == '30'){$selected_30 = 'selected="selected"';}
            
                
        $chart_data = array();
        $date_to_plot = $limit;
        $current_date = strtotime(date('Y-m-d H:i:s'));
        for($i=$date_to_plot;$i>=0;$i--)
        {
            $diff = 86400*$i;
            $index_value = $current_date - $diff;
            $index = strtotime(date('Y-m-d', $index_value));
            //echo $i.' '.$diff.' '.date('Y-m-d H:i:s',$index)."</br>";
            $chart_data[$index] = array( "date" => date('Y-m-d',$index), "unit" => 0 );
        }

        $graphdata = get_request_table_data_for_product($pid, $where, '0', '0');
        $graphdata_results =  $graphdata['result'];
        foreach($graphdata_results as $result)
        {
            $index = strtotime(date('Y-m-d', $result->review_date));
            $chart_data[$index] = array( "date" => date('Y-m-d',$result->review_date), "unit" => ($chart_data[$index]['unit']+1) );
        }
        //print_r($chart_data);
        $formatted_chart_data =array();
        foreach($chart_data as $single)
        {
            $date = $single['date'];
            $unit = $single['unit'];
        $formatted_chart_data[] = array(         "date" => "$date",             "unit" => $unit,         );
        }
        
        $serial = json_encode($formatted_chart_data);
        //$serial = $formatted_chart_data;
    ?>
            
    <?php        
        $limit = 10;
        $start_point = $limit *($page-1);
        $data = get_request_table_data_for_product($pid, $where, $limit, $start_point);
        $results = $data['result'];
        if($data['count'] == 'f'){$results_count = '0';}else{$results_count = $data['count'];}
        
        
        $html .= '<h3>Reviews Increasing Charts</h3>
			<div class="selectoption pull-right">
					<select class="form-control cat_control" name="review_chart_no_of_request" id="review_chart_no_of_request" placeholder="Choose Category" onchange="'.$no_of_request_fun.'">
                        <option value="7" '.$selected_7.'>Show 7 days</option>
						<option value="15" '.$selected_15.'>Show 15 days</option>
						<option value="30" '.$selected_30.'>Show 30 days</option>
						
					</select>
			</div>
			<div class="chart" id="review_chart_area" style="height: 300px; width: 100%;">
				
			
			</div>
					
			
			<div id="no-more-tables">
            <table class="text-center table-bordered table-condensed table-striped-column cust_dis_code_table cf">
		
        			<thead>
        			<tr>
        				<td class="numeric col1">Review </td>
        				<td class="numeric col2">Rating</td>
        				<td class="numeric col3">Date</td>
        				<td class="numeric col4">Action</td>
        			</tr>
					</thead>
    
        		<tbody>';
                //$html .= $results_count;
                foreach($results as $result)
                {
                    //$userdata = $this->userm->get($result->customer_id);
                    
                $getUsermata_amazon_url = getUsermata($result->customer_id, 'amazon_url');       $getUsermata_amazon_url    = $getUsermata_amazon_url->mval;
                
                    //$result->id;
                    $html .= '
					<tr>
        				<td data-title="Review"> <p><strong>'.the_excerpt($result->review_content,'0','50').'</strong>
					'.$result->review_content.'</p></td>
        				<td data-title="Rating">
							<ul class="stars">';
                            
                            for($j=1;$j<=$result->review_rating;$j++)
                            {
                               $html .= '<li><img src="'.new_assets_url('img/star.png').'"></li>'; 
                            }
                            
							$html .= '</ul>
						</td>
        				<td data-title="Date">'.date('Y-m-d',$result->review_date).'</td>
        				<td data-title="Action">
							<span class="icon"><a href="'.$getUsermata_amazon_url.'"><img src="'.new_assets_url('img/user_icon.png').'"></a></span>
							<span class="icon"><a href="'.$result->review_url.'"><img src="'.new_assets_url('img/up_arrow.png').'" ></a></span>
						
						</td>
        			</tr>';
                }
					
					
				$html .='</tbody>	
			</table>	
			
			<div class="table-nav pull-right clearfix">	
		 ';
         
         
         $prev = $page - 1;							//previous page is page - 1
    	$next = $page + 1;							//next page is page + 1
    	$lastpage = ceil($results_count/$limit);		//lastpage is = total pages / items per page, rounded up.
    	$lpm1 = $lastpage - 1;
         $request_page_pre_fun = "review_chart_function('".$pid."','request_page','".$prev."');";
         $request_page_next_fun = "review_chart_function('".$pid."','request_page','".$next."');";
         // How many adjacent pages should be shown on each side?
	       $adjacents = 3;
         
         
         
         
         
         $pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= '<ul class="pagination">';
		//previous button
		if ($page > 1) 
			$pagination .= '<li ><a onclick="'.$request_page_pre_fun.'" style="cursor: pointer;"><span aria-hidden="true">&lsaquo;</span></a></li>';
		else
			$pagination .= '<li ><a><span aria-hidden="true" style="display:none">&lsaquo;</span></a></li>';	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{$request_page_fun = "review_chart_function('".$pid."','request_page','".$counter."');";
				if ($counter == $page)
					$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
				else
					$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{$request_page_fun = "review_chart_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "review_chart_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "review_chart_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
                $request_1st_page_fun = "review_chart_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "review_chart_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{$request_page_fun = "review_chart_function('".$pid."','request_page','".$counter."');";
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
				$pagination .= '<li><a>...</a></li>';
                $request_2nd_last_page_fun = "review_chart_function('".$pid."','request_page','".$lpm1."');";
                $request_last_page_fun = "review_chart_function('".$pid."','request_page','".$lastpage."');";
				$pagination .= '<li><a onclick="'.$request_2nd_last_page_fun.'" style="cursor: pointer;">'.$lpm1.'</a></li>';
				$pagination .= '<li><a onclick="'.$request_last_page_fun.'" style="cursor: pointer;">'.$lastpage.'</a></li>';		
			}
			//close to end; only hide early pages
			else
			{
                $request_1st_page_fun = "review_chart_function('".$pid."','request_page','1');";
                $request_2nd_page_fun = "review_chart_function('".$pid."','request_page','2');";
				$pagination .= '<li><a onclick="'.$request_1st_page_fun.'" style="cursor: pointer;">1</a></li>';
				$pagination .= '<li><a onclick="'.$request_2nd_page_fun.'" style="cursor: pointer;">2</a></li>';
				$pagination .= '<li><a>...</a></li>';
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{$request_page_fun = "review_chart_function('".$pid."','request_page','".$counter."');"; 
					if ($counter == $page)
						$pagination .= '<li class="active"><a>'.$counter.'</a></li>';
					else
						$pagination .= '<li><a onclick="'.$request_page_fun.'" style="cursor: pointer;">'.$counter.'</a></li>';					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination .= '<li><a onclick="'.$request_page_next_fun.'" style="cursor: pointer;"><span aria-hidden="true">&rsaquo;</span></a></li>';
		else
			$pagination .= '<li><a><span aria-hidden="true" style="display:none">&rsaquo;</span></a></li>';
		$pagination.= "</ul>";		
	}
         $html .= $pagination;
         
         
		$html .= '
		<div class="back-btn clearfix">
		<button type="button" class="btn btn185_73" data-toggle="modal" data-dismiss="modal">Back</button>
		</div>
	</div>
		<div class="clearfix"></div>
	
			</div>';
            ?>
            
<?php
            ajaxResp(true, $html, array("data" => $serial));
     }
     
     
     
     
     public function expire_product(){
    // Get Current User
    $pid = $_POST['pid'];
    
    $update = array("disabled" => '1',);
    $where = array("pid" => $pid);
    $this->product->update($update, $where);
    $msg = 'success';
    ajaxResp(true, $msg);
    
    }
     
     public function disable_notification(){
    // Get Current User
    $user = get_active_user();
    $action = $_POST['action'];
    $user_type = $user->role;
    if($user_type == "shopper"){$this->userm->disable_notification($user_type);}
    else if($user_type == "companies"){$this->userm->disable_seller_notification($user_type);}
    
    $msg = 'success';
    ajaxResp(true, $msg);
    
    }
     
     public function disable_seller_notification(){
    // Get Current User
    $user = get_active_user();
    $action = $_POST['action'];
    $user_type = $user->role;
    $this->userm->disable_seller_notification($user_type);
    $msg = 'success';
    ajaxResp(true, $msg);
    
    }
    

}
