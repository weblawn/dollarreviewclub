<?php

/*
 * Get Current Class
 */

function get_current_object($type) {
    $ci = & get_instance();
    return $ci->router->{"fetch_{$type}"}();
}

/*
 * Load View File with header and footer
 */

function load_view($file, array $data = array(), $route = false, $sidebar = false) {
    $ci = & get_instance();

    $router = ($route) ? '' : get_current_object('class');

    $ci->load->view('header', $data);

    if ($sidebar) {
        $ci->load->view($router . "/" . $sidebar, $data);
    }

    $ci->load->view($router . "/" . $file, $data);
    $ci->load->view('footer', $data);
}

/*
 * Is User Logged In
 */

function get_online_product($pid) {
    $ci = & get_instance();

    if ($uData = $ci->product->get_online_product($pid)) {
        return $uData;
    }
    return false;
}

/*
 * Is User Logged In
 */

function get_offline_product($pid) {
    $ci = & get_instance();

    if ($uData = $ci->product->get_offline_product($pid)) {
        return $uData;
    }
    return false;
}

/*
 * Is User Logged In
 */

function get_active_user() {
    $ci = & get_instance();

    if ($uData = $ci->userm->get()) {
        return $uData;
    }
    return false;
}

/*
 * get notification
 */

function get_notification($user_type) {
    $ci = & get_instance();

    if ($Data = $ci->userm->get_notification($user_type)) {
        return $Data;
    }
    return 'fasle';
}

/*
 * Logout Url
 */

function login_url($redirect = '') {
    $url = site_url('user/login');

    if (!empty($redirect)) {
        $url = $url . "?redirect=" . urlencode($redirect);
    }
    return $url;
}

/*
 * Current URL
 */

function get_current_url() {
    $CI = & get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}

/*
 * Get Menus
 */

function get_menu($key, $active = '') {
    $ci = & get_instance();

    // Get menus from config_custom file
    $menus = $ci->config->item('menus');

    // If active menu active then get current page
    if (empty($active)) {
        $active = $ci->router->fetch_class();
    }

    // Check menu key is exists or not in menus array
    $menu = (array_key_exists($key, $menus)) ? $menus[$key] : false;
    if ($menu) {

        $menuItem = '';

        foreach ($menu as $link) {

            $href = $link;
            if (strpos($link, '/')) {
                $parts = explode("/", $link);
                $link = end($parts);
                //echo $link."</br>";
            }
            
            $page = $ci->uri->segment(2);
            //echo $key." ".$active." ".$link.' '.$plan_id."</br>";
            if($active == "pages" && $link == $page)
            {
                $selected = 'active';
            }
            else
            {
                $selected = ($link == $active) ? 'active' : '';
            }
            
            if($key == 'footer')
            {
                if($menuItem == '')
                {
                    $menuItem .= '<a href="' . site_url($href) . '">' . lang($link) . '</a>';
                }
                else
                {
                    $menuItem .= '   | <a href="' . site_url($href) . '">' . lang($link) . '</a>';
                }
                
            }
            else
            {
               $menuItem .= '<li class="' . $selected . '"><a href="' . site_url($href) . '">' . lang($link) . '</a></li>'; 
            }
            
        }

        return $menuItem;
    }

    return;
}

/*
 * Get assets folder url with files
 */

function assets_url($file = '') {
    return base_url('public/' . $file);
}
/*
 * Get new assets folder url with files
 */

function new_assets_url($file = '') {
    return base_url('public/new/' . $file);
}

/*
 * Get Assets files with html
 */

function get_assets_files($key) {
    $ci = & get_instance();

    /* Getting files from config/config_custom.php */
    $fileConfigs = $ci->config->item('assets');
    $assets = (array_key_exists($key, $fileConfigs)) ? $fileConfigs[$key] : false;

    /* Get CUSTOM CSS assets according to controller */
    $page = $key . "_" . $ci->router->fetch_class() . "_" . $ci->router->fetch_method();
    if (array_key_exists($page, $fileConfigs)) {
        $custom = $fileConfigs[$page];
        $assets = array_merge_recursive($assets, $custom);
    }

    if (!$assets) {
        return;
    }

    // Generating JS/CSS/ICO head html data
    $media = '';
    foreach ($assets as $ext => $files) {
        foreach ($files as $type => $file) {

            // Prepare file path
            $fileUrl = ( strpos($file, 'live::') !== false ) ? ltrim($file, "live::") : assets_url($file);
            if ($ext == 'ico') {
                $media .= '<link rel="shortcut icon" href="' . $fileUrl . '" />';
            } elseif ($ext == 'css') {
                $media .= '<link href="' . $fileUrl . '" rel="stylesheet" type="text/css"/>';
            } elseif ($ext == 'js') {
                $media .= '<script type="text/javascript" src="' . $fileUrl . '"></script>';
            }
        }
    }
    return $media;
}

/*
 * Breadcrums
 */

function get_breadcrumbs(array $breadcrumbs = array()) {
    $ci = & get_instance();

    $ci->breadcrumbs->push('Home', '/');

    if (!empty($breadcrumbs)) {
        foreach ($breadcrumbs as $route) {
            $ci->breadcrumbs->push($route[0], $route[0]);
        }
    }

    return $ci->breadcrumbs->show();
}

/*
 * Get Title
 */

function get_title($slug) {
    return lang($slug) . " | " . lang('website_name');
}

/*
 * Send Emails
 */

function sendEmail($to, $sub, $msg) {
    $ci = & get_instance();

    // Load Library
    $ci->load->library('email');

    // Set email
    $ci->email->set_mailtype("html");
    $ci->email->from("service@dollarreviewclub.com", lang('website_name'));
    $ci->email->to($to);
    $ci->email->subject($sub);
    $ci->email->message($msg);

    // Send email
    $ci->email->send();
}

/*
 * Verification Code
 */

function getVerificationCode($length = 32) {
    $code = md5(random_string('alnum', $length));
    return $code;
}

/*
 * Filter Date
 */

function filterDate($date) {
    $date = date("Y-m-d", strtotime($date));
    return $date;
}

/*
 * get HASH
 */

function get_hash($val) {
    $secretKey = "KIZC0rlbxvqAT9p%A-G&63v";
    $returnHash = md5($secretKey . $val);
    return $returnHash;
}

/*
 * Get category
 */

function get_category($cid = null) {
    $ci = & get_instance();
    $category = $ci->product->category((array("category.cid" => $cid)));
    if ($category) {
        return $category[0];
    }
    return false;
}

/*
 * AJAX Resp
 */

function ajaxResp($res, $msg, array $extra = array()) {
    $data = array("res" => $res, "msg" => $msg);

    if (!empty($extra)) {
        $data = array_merge_recursive($data, $extra);
    }

    die(json_encode($data));
}

/*
 * Clean slug
 */

function clean_slug($str) {
    $string = str_replace(", ", "-", $str);
    $string = str_replace(" ", "-", $str);
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string));
    return $string;
}

/*
 * GET Excerpt
 */

function the_excerpt($string, $start = 0, $length = 100) {
    $org_len = strlen($string);
    $string = strip_tags($string);
    $string = substr($string, $start, $length);

    $result = '';
    if (!empty($string)) {
        if($org_len > $length)
        {
            $result = trim($string) . "...";
        }
        else
        {
            $result = trim($string);
        }
    }

    return $result;
}

/*
 * Get promo_code_details
 */

function get_promo_codes_by_id($pid, $isUsed) {
    $ci = & get_instance();
    $get_promo_code_details = $ci->product->get_promo_codes_by_id($pid, $isUsed);
    return $get_promo_code_details;
}

/*
 * Get product_details
 */

function get_product_details($pid) {
    $ci = & get_instance();
    $get_product_details = $ci->product->get($pid);
    return $get_product_details;
}
/*
 * Get get_manual_pending_by_id
 */

function get_manual_pending_by_id($pid) {
    $ci = & get_instance();
    $get_manual_pending_by_id = $ci->product->get_manual_pending_by_id($pid);
    return $get_manual_pending_by_id;
}
/*
 * Get get_manual_approve_by_id
 */

function get_manual_approve_by_id($pid) {
    $ci = & get_instance();
    $get_manual_approve_by_id = $ci->product->get_manual_approve_by_id($pid);
    return $get_manual_approve_by_id;
}
/*
 * Get get_manual_disapprove_by_id
 */

function get_manual_disapprove_by_id($pid) {
    $ci = & get_instance();
    $get_manual_disapprove_by_id = $ci->product->get_manual_disapprove_by_id($pid);
    return $get_manual_disapprove_by_id;
}
/*
 * Get product_details
 */

function get_finished_review_for_product($pid) {
    $ci = & get_instance();
    $get_finished_review_for_product = $ci->product->get_finished_review_for_product($pid);
    return $get_finished_review_for_product;
}
/*
 * Get product_details
 */

function get_request_table_data_for_product($pid, $where, $limit, $start_point) {
    $ci = & get_instance();
    $get_request_table_data_for_product = $ci->product->get_request_table_data_for_product($pid, $where, $limit, $start_point);
    return $get_request_table_data_for_product;
}
/*
 * Get Segment
 */

function get_segment($i) {
    $ci = & get_instance();
    $segment = $ci->uri->segment($i);
    return $segment;
}

/*
 * Get Category List
 */

function get_categories_list() {
    $ci = & get_instance();
    $categories = $ci->product->category();
    return $categories;
}

/*
 * Get Spinner
 */

function get_spinner() {
    $html = '<div id="stLoader"><i class="fa fa-refresh fa-spin"></i></div>';
    return $html;
}

/*
 * PRODUCT TILES
 */

function get_product_tiles($deals) {
    
        $min = 0;
        $max = 0;
    $html = '<div class="row-fluid">';
    if (!empty($deals)) :
        $i = 0;
        /*$fn = "(function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)()";
        //https://pinterest.com/pin/create/button/?media=//snagshoutprod-media.s3.amazonaws.com/a46ca9f6164adad0754ec7ff19a42c8818c2c073.jpg&url=http://snag.it/5349&description=Check%20out%20this%20sweet%20deal%20from%20Snagshout!%20https://www.snagshout.com/offers/brachiosaurus-action-figure-includes-real/4299f
        */
        
        foreach ($deals as $pro):
$category = get_category($pro->category);
//print_r($pro);
if($pro->discount_price > $max){$max = $pro->discount_price;}
if($pro->discount_price < $min){$min = $pro->discount_price;}
else if($min == 0 && $pro->discount_price > 0){$min = $pro->discount_price;}
            if (($i % 4) === 0) {
                $row = '</div><div class="row-fluid">';
            } else {
                $row = '';
            }

            /*$href = site_url("deals/item/{$pro->pid}?hash=" . get_hash($pro->pid));
$printerest_url = "window.open('https://pinterest.com/pin/create/button/?media=".$pro->img_url."&url=".$href."&description=".$pro->name."%20%20Check%20out%20this%20sweet%20deal%20from%20Dollar Review Club!%20".$href."')";
$facebook_url = "window.open('http://www.facebook.com/sharer.php?u=" . $href . "')";
$twitter_url = "window.open('http://twitter.com/home?status=Check%20out%20this%20sweet%20deal%20from%20@Dollar Review Club!%20Snag%20Deals,%20Write%20Reviews.%20" . $href . "')";*/
if($pro->end_date_type != 'product_end_time_until')
        {
            $end_date = strtotime($pro->end_date);
            $date = strtotime("now");
            $day = ($end_date - $date)/86400;
            if(ceil($day)>1 && ceil($day)<4)
            {
                $text = 'Get it now expires in '.ceil($day).' days!';
            }
            else if(ceil($day)==1)
            {
                $secondsToTime = secondsToTime($end_date - $date);
                $text = 'Get it now expires in '.$secondsToTime['h'].' hrs '.$secondsToTime['m'].' mins!';
            }
            else
            {
                $text = 'Get it now';
            }
        }
        else
        {
            $text = 'Get it now';
        }
            
                    $off = ($pro->price - $pro->discount_price)/$pro->price;
                    $off = $off*100 ;
        $hash = get_hash($pro->pid);
                    //base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url)
             $div = '<div class="col-md-4 col-sm-6 product_item">
                		<div class="panel">
                		<div class="product-img">
                		<a href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" ><img src="' . base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url) . '" alt="deal" class="img-responsive deal-img center-block"></a>
                				
                		</div>
                		<div class="product-details">
                		<a class="btn btn-getnow" href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" >'.$text.'</a>
                		<h3><a href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" >' . the_excerpt($pro->name, 0, 65) . '</a></h3>
                		<div class="pricearea clearfix">
                			<div class="price"><span class="new-price"><span>$</span>' . $pro->discount_price . '</span>
                			<span class="original-price"><strike>$' . $pro->price . '</strike></span>
                			</div> 
                			<a class="btn btn-off">'.number_format((float)$off, 2, '.', '').'% OFF</a>
                		</div>
                		</div> <!-- product-details -->
                    	<div class="panel-footer"><span class="category"><a href="' . base_url('deals?category='.$category->slug) . '">' . $category->name . '</a></span></div>
                    	</div> <!-- panel -->
    	           </div>' ;      
            
            $html .= $row . $div;

            $i++;
        endforeach;
    endif;
    $html .= "</div>";
    /*if(!empty($min)&&!empty($max))
    {*/
        $min_max = '<input type="hidden" id="custom_priceRange_min" value="'.$min.'" />
                <input type="hidden" id="custom_priceRange_max" value="'.$max.'" />';
        $html .= $min_max;
    /*}*/
    

    return $html;
}


/*
 * PRODUCT TILES
 */

function get_product_tiles_onedeals($deals) {
    
        $min = 0;
        $max = 0;
    //$html = '<div class="row-fluid">';
    $html = '<div class="row-fluid">';
    if (!empty($deals)) :
        $i = 0;
        /*$fn = "(function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)()";
        //https://pinterest.com/pin/create/button/?media=//snagshoutprod-media.s3.amazonaws.com/a46ca9f6164adad0754ec7ff19a42c8818c2c073.jpg&url=http://snag.it/5349&description=Check%20out%20this%20sweet%20deal%20from%20Snagshout!%20https://www.snagshout.com/offers/brachiosaurus-action-figure-includes-real/4299f
        
        */
        foreach ($deals as $pro):
$category = get_category($pro->category);
//print_r($pro);
/*if($pro->discount_price > $max){$max = $pro->discount_price;}
if($pro->discount_price < $min){$min = $pro->discount_price;}
else if($min == 0 && $pro->discount_price > 0){$min = $pro->discount_price;}
            if (($i % 5) === 0) {
                $row = '</div><div class="row-fluid">';
            } else {
                $row = '';
            }*/

            /*$href = site_url("deals/item/{$pro->pid}?hash=" . get_hash($pro->pid));
$printerest_url = "window.open('https://pinterest.com/pin/create/button/?media=".$pro->img_url."&url=".$href."&description=".$pro->name."%20%20Check%20out%20this%20sweet%20deal%20from%20Dollar Review Club!%20".$href."')";
$facebook_url = "window.open('http://www.facebook.com/sharer.php?u=" . $href . "')";
$twitter_url = "window.open('http://twitter.com/home?status=Check%20out%20this%20sweet%20deal%20from%20@Dollar Review Club!%20Snag%20Deals,%20Write%20Reviews.%20" . $href . "')";

            */
            if($pro->end_date_type != 'product_end_time_until')
        {
            $end_date = strtotime($pro->end_date);
            $date = strtotime("now");
            $day = ($end_date - $date)/86400;
            if(ceil($day)>1 && ceil($day)<4)
            {
                $text = 'Get it now expires in '.ceil($day).' days!';
            }
            else if(ceil($day)==1)
            {
                $secondsToTime = secondsToTime($end_date - $date);
                $text = 'Get it now expires in '.$secondsToTime['h'].' hrs '.$secondsToTime['m'].' mins!';
            }
            else
            {
                $text = 'Get it now';
            }
        }
        else
        {
            $text = 'Get it now';
        }
                    $off = ($pro->price - $pro->discount_price)/$pro->price;
                    $off = $off*100 ;
        $hash = get_hash($pro->pid);
                    //base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url)
             $div = '<div class="col-md-3 col-sm-6 product product_item">
                		<div class="panel">
                		<div class="product-img">
                		<a href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" ><img src="' . base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url) . '" alt="deal" class="img-responsive deal-img center-block"></a>
                				
                		</div>
                		<div class="product-details">
                		<a class="btn btn-getnow" href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" >'.$text.'</a>
                		<h3><a href="'.base_url('deals/item/'.$pro->pid.'/'.$hash).'" >' . the_excerpt($pro->name, 0, 65) . '</a></h3>
                		<div class="pricearea clearfix">
                			<div class="price"><span class="new-price"><span>$</span>' . $pro->discount_price . '</span>
                			<span class="original-price"><strike>$' . $pro->price . '</strike></span>
                			</div> 
                			<a class="btn btn-off">'.number_format((float)$off, 2, '.', '').'% OFF</a>
                		</div>
                		</div> <!-- product-details -->
                    	<div class="panel-footer"><span class="category"><a href="' . base_url('deals?category='.$category->slug) . '">' . $category->name . '</a></span></div>
                    	</div> <!-- panel -->
    	           </div>' ;      
            
            $html .= $div ;

            //$i++;
        endforeach;
    endif;
    $html .= "</div>";
    /*if(!empty($min)&&!empty($max))
    {
        $min_max = '<input type="hidden" id="custom_priceRange_min" value="'.$min.'" />
                <input type="hidden" id="custom_priceRange_max" value="'.$max.'" />';
        $html .= $min_max;
    }*/
    

    return $html;
}

/*
 * Campaign Tiles
 */

function get_campaign_html($products) {
    $tr = '';
    if (!empty($products)) {
        $i = 0;
        foreach ($products as $pro) {
            if ($pro->disabled == 1) {
                $alertLabel = "You want enable {$pro->name} product for now.";
                $labelIcon = "<i class='icon-unlock'></i>";
                $indicator = "green";
            } else {
                $indicator = "red";
                $alertLabel = "You want disable {$pro->name} product for now.";
                $labelIcon = "<i class='icon-unlock-alt'></i>";
            }

            $cat = get_category($pro->category);
            $tr .='<tr class="odd gradeX ind' . $i . '">
                    <td><input type="checkbox" class="checkboxes" value="' . $pro->pid . '" /></td>
                    <td>' . the_excerpt($pro->name) . '</td>
                    <td>' . $pro->asin . '</td>
                    <td>' . $pro->price . '</td>
                    <td>' . $pro->shipping_price . '</td>
                    <td>' . $pro->daily_limit . '</td>
                    <td>' . $pro->start_date . '</td>
                    <td class="hidden-480">' . $pro->end_date . '</td>
                    <td class="hidden-480">' . $cat->name . '</td>
                    <td class="center hidden-480">' . date("d M Y", strtotime($pro->since)) . '</td>
                    <td class="hidden-480">' . (($pro->disabled) ? "<p class='label label-danger'>Disabled</p>" : "<p class='label label-success'>Enabled</p>") . '</td>
                    <td>';
                        
                        /*
                         * $tr .='<a href="' . site_url('companies/campaign/edit/' . $pro->pid . '?hash=' . get_hash($pro->pid)) . '" class="btn blue"><i class="icon-edit"></i></a>';
                         */
                        
                        $tr .='<a href="' . site_url('companies/campaign/promo/' . $pro->pid . '?hash=' . get_hash($pro->pid)) . '" class="btn blue"><i class="icon-edit"></i></a>';
                        $tr .='<a data-label="' . $alertLabel . '" data-id="' . $pro->pid . '" data-hash="' . get_hash($pro->pid) . '" data-index="' . $i . '" data-type="' . $pro->disabled . '" href="javascript:void(0);" class="btn ' . $indicator . ' deletePage">' . $labelIcon . '</a>
                    </td>
                </tr>';

            $i++;
        }
    }
    return $tr;
}

/*
 * Get Gravatar
 */

function get_avatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

/*
 * GET Usermeta
 */

function getUsermata($uid, $key) {
    $ci = & get_instance();
    $meta = $ci->userm->getUsermeta($uid, $key);
    return $meta;
}

/*
 * Display Date
 */

function display_date($date) {
    $return = date("d M, Y", strtotime($date));
    return $return;
}

/*
 * Display Date
 */

function secondsToTime($inputSeconds) {
    $ci = & get_instance();
    $return = $ci->product->secondsToTime($inputSeconds);
    return $return;
}


function checkCreditCard ($cardnumber, $cardname, &$errornumber, &$errortext) {

	// Define the cards we support. You may add additional card types.

	//  Name:      As in the selection box of the form - must be same as user's
	//  Length:    List of possible valid lengths of the card number for the card
	//  prefixes:  List of possible prefixes for the card
	//  checkdigit Boolean to say whether there is a check digit

	// Don't forget - all but the last array definition needs a comma separator!
  
	$cards = array (  
		array ('name' => 'American Express', 
			'length' => '15', 
			'prefixes' => '34,37',
			'checkdigit' => true
		),
		array ('name' => 'Diners Club Carte Blanche', 
			'length' => '14', 
			'prefixes' => '300,301,302,303,304,305',
			'checkdigit' => true
		),
		array ('name' => 'Diners Club', 
			'length' => '14,16',
			'prefixes' => '36,38,54,55',
			'checkdigit' => true
		),
		array ('name' => 'Discover', 
			'length' => '16', 
			'prefixes' => '6011,622,64,65',
			'checkdigit' => true
		),
		array ('name' => 'Diners Club Enroute', 
			'length' => '15', 
			'prefixes' => '2014,2149',
			'checkdigit' => true
		),
		array ('name' => 'JCB', 
			'length' => '16', 
			'prefixes' => '35',
			'checkdigit' => true
		),
		array ('name' => 'Maestro', 
			'length' => '12,13,14,15,16,18,19', 
			'prefixes' => '5018,5020,5038,6304,6759,6761,6762,6763',
			'checkdigit' => true
		),
		array ('name' => 'MasterCard', 
			'length' => '16', 
			'prefixes' => '51,52,53,54,55',
			'checkdigit' => true
		),
		array ('name' => 'Solo', 
			'length' => '16,18,19', 
			'prefixes' => '6334,6767',
			'checkdigit' => true
		),
		array ('name' => 'Switch', 
			'length' => '16,18,19', 
			'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
			'checkdigit' => true
		),
		array ('name' => 'VISA', 
			'length' => '16', 
			'prefixes' => '4',
			'checkdigit' => true
		),
		array ('name' => 'VISA Electron', 
			'length' => '16', 
			'prefixes' => '417500,4917,4913,4508,4844',
			'checkdigit' => true
		),
		array ('name' => 'LaserCard', 
			'length' => '16,17,18,19', 
			'prefixes' => '6304,6706,6771,6709',
			'checkdigit' => true
		)
	);

	$ccErrorNo = 0;

	$ccErrors [0] = "Unknown card type";
	$ccErrors [1] = "No card number provided";
	$ccErrors [2] = "Credit card number has invalid format";
	$ccErrors [3] = "Credit card number is invalid";
	$ccErrors [4] = "Credit card number is wrong length";
    
	  // Establish card type
	  $cardType = -1;
	  for ($i=0; $i<sizeof($cards); $i++) {

		// See if it is this card (ignoring the case of the string)
		if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
		  $cardType = $i;
		  break;
		}
	  }
  
	  // If card type not found, report an error
	  if ($cardType == -1) {
		 $errornumber = 0;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
   
	  // Ensure that the user has provided a credit card number
	  if (strlen($cardnumber) == 0)  {
		 $errornumber = 1;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
  
	  // Remove any spaces from the credit card number
	  $cardNo = str_replace (' ', '', $cardnumber);  
   
	// Check that the number is numeric and of the right sort of length.
	  if (!preg_match("/^[0-9]{13,19}$/",$cardNo))  {
		 $errornumber = 2;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
       
	// Now check the modulus 10 check digit - if required
	if ($cards[$cardType]['checkdigit']) {
		$checksum = 0;                                  // running checksum total
		$mychar = "";                                   // next char to process
		$j = 1;                                         // takes value of 1 or 2
	  
		// Process each digit one by one starting at the right
		for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {
		
		  // Extract the next digit and multiply by 1 or 2 on alternative digits.      
		  $calc = $cardNo{$i} * $j;
		
		  // If the result is in two digits add 1 to the checksum total
		  if ($calc > 9) {
			$checksum = $checksum + 1;
			$calc = $calc - 10;
		  }
		
		  // Add the units element to the checksum total
		  $checksum = $checksum + $calc;
		
		  // Switch the value of j
		  if ($j ==1) {$j = 2;} else {$j = 1;};
		} 
	  
		// All done - if checksum is divisible by 10, it is a valid modulus 10.
		// If not, report an error.
		if ($checksum % 10 != 0) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
		}
	  }  

	  // The following are the card-specific checks we undertake.

	  // Load an array with the valid prefixes for this card
	  $prefix = explode(',',$cards[$cardType]['prefixes']);
      
	  // Now see if any of them match what we have in the card number  
	  $PrefixValid = false; 
	  for ($i=0; $i<sizeof($prefix); $i++) {
		$exp = '/^' . $prefix[$i] . '/';
		if (preg_match($exp,$cardNo)) {
		  $PrefixValid = true;
		  break;
		}
	  }
      
	  // If it isn't a valid prefix there's no point at looking at the length
	  if (!$PrefixValid) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
    
	// See if the length is valid for this card
	  $LengthValid = false;
	  $lengths = explode(',',$cards[$cardType]['length']);
	  for ($j=0; $j<sizeof($lengths); $j++) {
		if (strlen($cardNo) == $lengths[$j]) {
		  $LengthValid = true;
		  break;
		}
	  }
  
	// See if all is OK by seeing if the length was valid. 
	if (!$LengthValid) {
	 $errornumber = 4;     
	 $errortext = $ccErrors [$errornumber];
	 return false; 
	};   
  
	// The credit card is in the required format.
	return true;
}