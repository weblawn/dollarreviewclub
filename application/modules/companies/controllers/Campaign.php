<?php
error_reporting(0);
class Campaign extends MX_Controller {

    private $data = array();
    private $user;

    public function __construct() {
        parent::__construct();

        $this->userm->validateSession('companies');
        $this->user = $this->userm->current();
    }

    public function index() {
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // Get Products
        $args = array();

        // Current User
        $args[] = array(
            "field" => "uid",
            "cond" => "=",
            "value" => $this->user->id
        );

        // Range
        $minRange = (isset($_GET['rangeMin']) && !empty($_GET['rangeMin'])) ? $_GET['rangeMin'] : 0;
        $maxRange = (isset($_GET['rangeMax']) && !empty($_GET['rangeMax'])) ? $_GET['rangeMax'] : 2000;
        $args[] = array(
            "field" => "price BETWEEN {$minRange} AND {$maxRange}",
            "cond" => null,
            "value" => null
        );

        // Disabled        
        $args[] = array(
            "field" => "disabled",
            "cond" => "=",
            "value" => ((isset($_GET['showHidden']) && $_GET['showHidden'] == 1) ? 1 : 0)
        );

        // Not Expired
        if (isset($_GET['noExpired']) && $_GET['noExpired'] == 1) {
            $args[] = array(
                "field" => "end_date",
                "cond" => ">=",
                "value" => date("Y-m-d")
            );
        }

        // SortBy
        if (isset($_GET['sortBy'])) {
            $sort = explode("_", $this->input->get('sortBy', TRUE));
            $ct = (count($sort) - 1);
            $orderBy = $sort[$ct];
            unset($sort[$ct]); // Remove Last Value

            $sort[0] = "products." . implode("_", $sort);
            $sort[1] = $orderBy;

            $this->data['products'] = $this->product->get_where($args, $sort);
        } else {
            $this->data['products'] = $this->product->get_where($args);
        }

        // Load view file
        load_view('campaign', $this->data);
    }

    public function asin() {

        $this->data['title'] = get_title('asin');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // If error
        $getError = $this->input->get('error', TRUE);
        if (!empty($getError)) {
            $this->data['asin_error'] = urldecode($getError);
        }

        load_view('campaign_asin', $this->data);
    }
 public function check_asin() {
        $asin = $_POST['asin_val'];
        $args = array();
        $i = 1;
        $args[] = array(
                "field" => "asin",
                "cond" => "=",
                "value" => $asin
            );
        $args[] = array(
                "field" => "disabled",
                "cond" => "=",
                "value" => 0
            );
        $products = $this->product->get_where($args);
        //print_r($products[0]);
        if(is_numeric($products[0]->pid))
        {
            ajaxResp(true, '<div class="alert alert-danger">Product already existed on Dollar Review Club now.</div>',array('haserror' =>1));
        }
        repeat: 
        // GET Product data
        $asinData = $this->aws->asin($asin);
        
        // If product not found B01BSCN9DS
        if (isset($asinData->Request->Errors)) {
            
                if($i<5){$i++; goto repeat;}
                else{ajaxResp(true, '<div class="alert alert-danger">'.$asinData->Request->Errors->Error->Message.'</div>',array('haserror' =>1));}
               
            //ajaxResp(true, '<div class="alert alert-danger">'.$asinData->Request->Errors->Error->Message.'</div>',array('haserror' =>1));
            //ajaxResp(true, "error");
        }
        else {
           $description = '';
            $description_about = '';
            $description_main = '';    
            $category = '';      
            $image = array();
            $title = $asinData->Item->ItemAttributes->Title;
            $aws_url = "http://www.amazon.com/dp/{$asinData->Item->ASIN}?keywords=" . str_replace(" ", "+", $title);
            $price = '';
            //$price = $asinData->Item->ItemAttributes->ListPrice->Amount;
            //$len = strlen($price)-2;
            //$formatted_price = substr($price,0,$len ).'.'.substr($price, -2);
            //$salesrank = $asinData->Item->SalesRank;
            
            
            $search_array = $asinData->Item->ItemAttributes->Feature;            
            if (array_key_exists('0', $search_array)) {
                $description_about .= '<strong>About the Product</strong></br><ul>';
                for($i=0; $i<count($search_array); $i++)
                {
                    $description_about .= '<li>'.$search_array[$i].'</li>';
                }                
                $description_about .= '</ul>';
            }       
        
        
            $search_array = $asinData->Item->EditorialReviews->EditorialReview;
            if (array_key_exists('0', $search_array)) {
                for($i=0; $i<count($search_array); $i++)
                {
                    $description_main .= '<strong>'.$search_array[$i]->Source.'</strong></br>'.$search_array[$i]->Content.'</br>';
                }                
            }
            else
            { if($description_main == ''){$description_main .= '<strong>Product Description</strong></br>'.$search_array->Content;}
                else{$description_main .= '</br>'.$search_array->Content;}
                
            }
            $search_category = $asinData->Item->BrowseNodes->BrowseNode;
            if (array_key_exists('0', $search_category)) {
                $search_category = $asinData->Item->BrowseNodes->BrowseNode[1];
            }
            else
            {
                $search_category = $asinData->Item->BrowseNodes->BrowseNode;
            }
            $depth = 1;
            while($search_category->IsCategoryRoot != '1' && $depth<=10) {
                $search_category = $search_category->Ancestors->BrowseNode;
                $depth++;
            } 
            $category = $search_category->Ancestors->BrowseNode->Name;

            $search_images = $asinData->Item->ImageSets->ImageSet;
            $image_urls = array();
            
            $primary = $asinData->Item->LargeImage->URL;
            $image_urls[] = $primary; 
            $type = pathinfo($primary, PATHINFO_EXTENSION);
            $data = file_get_contents($primary);
            $other_pic_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $image[] = $other_pic_base64; 
            
            foreach($search_images as $single)
            {
                $path =$single->LargeImage->URL;
                if(!in_array($path, $image_urls))
                {
                    $image_urls[] = $path; 
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $other_pic_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $image[] = $other_pic_base64; 
                }
                
            }
            
            if($title == '' || $category == '' || $aws_url == '' || $description_about == '' || $description_main == '' || $image[0] == '' || $price == '' )
            {
                $ids = array('11', '19', '32', '33', '71');
                shuffle($ids);
                $url = 'http://www.amazon.com.http.s'.$ids[2].'.wbprx.com/dp/'.$asin;
                //echo $url;
                $img_url = 'http://ecx.images-amazon.com.http.s'.$ids[2].'.wbprx.com/images/I/';
                $new_url = 'http://ecx.images-amazon.com/images/I/';
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
                    if($title == '')
                    {
                        $get_productTitle_1st_parse = explode('<span id="productTitle" class="a-size-large">',$data);
                        $get_productTitle_2nd_parse = explode('</span>',$get_productTitle_1st_parse[1]);
                        $title = $get_productTitle_2nd_parse[0];
                        if($title == '')
                        {
                            ajaxResp(true, '<div class="alert alert-danger">Something going wrong please try again</div>',array('haserror' =>1));
                        }
                        $aws_url = "http://www.amazon.com/dp/{$asin}?keywords=" . str_replace(" ", "+", $title);
                    }
                    if($price == '')
                    {
                        $get_price_1st_parse = explode('"priceblock_dealprice"',$data);
                        $get_price_2nd_parse = explode('</span>',$get_price_1st_parse[1]);
                        $price = trim(end(explode('$', $get_price_2nd_parse[0])));
                    }
        if($price == '')
                    {
                        $get_price_1st_parse = explode('"priceblock_ourprice"',$data);
                        $get_price_2nd_parse = explode('</span>',$get_price_1st_parse[1]);
                        $price = trim(end(explode('$', $get_price_2nd_parse[0])));
                    }
        if($price == '')
                    {
                        $get_price_1st_parse = explode('"priceblock_saleprice"',$data);
                        $get_price_2nd_parse = explode('</span>',$get_price_1st_parse[1]);
                        $price = trim(end(explode('$', $get_price_2nd_parse[0])));
                    }
                                        
                    if($category == '')
                    {
                        $get_productcategory_1st_parse = explode('data-feature-name="wayfinding-breadcrumbs">',$data);
                        $get_productcategory_2nd_parse = explode('</a>',$get_productcategory_1st_parse[1]);
                        $category = trim(end(explode('>', $get_productcategory_2nd_parse[0])));
                    }
                    
                    if($description_about == '')
                    {
                        $description_about .= '<span id="aboutTheProductText" class="a-size-medium">About the Product</span>';
                        $get_produdtdescription_1st_parse = explode('<div id="feature-bullets" ',$data);
                        $get_productdescription_2nd_parse = explode('</ul>',$get_produdtdescription_1st_parse[1]);
                        $get_produdtdescription_3rd_parse = explode('<ul class="a-vertical a-spacing-none">',$get_productdescription_2nd_parse[0]);
                        $description_about .= '<ul class="a-vertical a-spacing-none">'.$get_produdtdescription_3rd_parse[1].'</ul>';
                    }
                    
                    if($image[0] == '' )
                    {
                        $get_productimage_1st_parse = explode("'colorImages': { 'initial': ",$data);
                        $get_productimage_2nd_parse = explode("'colorToAsin': {'initial': {}},",$get_productimage_1st_parse[1]);
                        $get_productimage_3rd_parse = explode($new_url,str_replace($img_url,$new_url,$get_productimage_2nd_parse[0]));
                        $image = array();
                        for($i=0;$i<=count($get_productimage_3rd_parse);$i++)
                        {    //$i=$i+8;
                            if(strpos($get_productimage_3rd_parse[$i],'},"variant"')>0)
                            {
                                /*$get_productimage = explode('"',$get_productimage_3rd_parse[$i]);
                                $image[$i] = $new_url.$get_productimage[0];*/
                                $get_productimage = explode('"',$get_productimage_3rd_parse[$i]);
                                $path =$new_url.$get_productimage[0];
                
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                        
                                $data = file_get_contents($path);
                        
                                $other_pic_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                $image[] = $other_pic_base64;
                                    
                             }    
                            }
                    }
                    
                    $description = $description_about."<br/>".$description_main;
                    ajaxResp(true, '<div class="alert alert-success">Asin verification Successful.</div>',array('haserror' =>0, 'title'=>$title, 'image'=>$image, 'description'=>$description, 'category'=>$category, 'aws_url'=>$aws_url, 'price'=>$price));
    
                }
                else{
                    ajaxResp(true, '<div class="alert alert-danger">Asin not valid.</div>',array('haserror' =>1));
                }
            }
            else{
                $description = $description_about."<br/>".$description_main;
                ajaxResp(true, '<div class="alert alert-success">Asin verification Successful.</div>',array('haserror' =>0, 'title'=>$title, 'image'=>$image, 'description'=>$description, 'category'=>$category, 'aws_url'=>$aws_url, 'price'=>$price));
                } 
            
        }
        
        }   
    /*public function check_asin_old() {
        $asin = $_POST['asin_val'];
        // GET Product data
        $asinData = $this->aws->asin($asin);
        
        // If product not found B01BSCN9DS
        if (isset($asinData->Request->Errors)) {
            ajaxResp(true, '<div class="alert alert-danger">'.$asinData->Request->Errors->Error->Message.'</div>',array('haserror' =>1));
            //ajaxResp(true, "error");
        }
        else {
            $title = $asinData->Item->ItemAttributes->Title;
            $price = $asinData->Item->ItemAttributes->ListPrice->Amount;
            $len = strlen($price)-2;
            $formatted_price = substr($price,0,$len ).'.'.substr($price, -2);
            $salesrank = $asinData->Item->SalesRank;
            $aws_url = "http://www.amazon.com/dp/{$asinData->Item->ASIN}?keywords=" . str_replace(" ", "+", $title);
            $description = '';
            
            //$Offer_amount = $asinData->Item->Offers->Offer->OfferListing->Price->Amount;
            //$len = strlen($Offer_amount)-2;
            //$formatted_Offer_amount = substr($Offer_amount,0,$len ).'.'.substr($Offer_amount, -2);
            //, 'Offer_amount'=>$formatted_Offer_amount
            $search_array = $asinData->Item->ItemAttributes->Feature;            
            if (array_key_exists('0', $search_array)) {
                $description .= '<strong>About the Product</strong></br><ul>';
                for($i=0; $i<count($search_array); $i++)
                {
                    $description .= '<li>'.$search_array[$i].'</li>';
                }                
                $description .= '</ul>';
            }       
        
        
        
            $search_array = $asinData->Item->EditorialReviews->EditorialReview;
            if (array_key_exists('0', $search_array)) {
                for($i=0; $i<count($search_array); $i++)
                {
                    $description .= '<strong>'.$search_array[$i]->Source.'</strong></br>'.$search_array[$i]->Content.'</br>';
                }                
            }
            else
            { if($description == ''){$description .= $search_array->Content;}
                else{$description .= '<strong>Product Description</strong></br>'.$search_array->Content;}
                
            }


            
            $search_category = $asinData->Item->BrowseNodes->BrowseNode;
            if (array_key_exists('0', $search_category)) {
                $search_category = $asinData->Item->BrowseNodes->BrowseNode[1];
            }
            else
            {
                $search_category = $asinData->Item->BrowseNodes->BrowseNode;
            }
            //print_r($search_category);
            $depth = 1;
            while($search_category->IsCategoryRoot != '1' && $depth<=10) {
                $search_category = $search_category->Ancestors->BrowseNode;
                $depth++;
            } 
            $category = $search_category->Ancestors->BrowseNode->Name;
            
            
            
            ajaxResp(true, '<div class="alert alert-success">Asin verification Successful.</div>',array('haserror' =>0, 'title'=>$title, 'price'=>$formatted_price, 'salesrank'=>$salesrank, 'description'=>$description, 'category'=>$category, 'aws_url'=>$aws_url));
            //, 'data'=>$asinData
            //ajaxResp(true, "Success");
        }
        
        }*/
    /*public function check_asincurl() {
    $asin = $_POST['asin_val'];
        $ids = array('11', '19', '32', '33', '71');
        shuffle($ids);
        $url = 'http://www.amazon.com.http.s'.$ids[2].'.wbprx.com/dp/'.$asin;
        //echo $url;
        $img_url = 'http://ecx.images-amazon.com.http.s'.$ids[2].'.wbprx.com/images/I/';
        $new_url = 'http://ecx.images-amazon.com/images/I/';
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
        $result_data =array();
        $title = '';    $description = '';    $category = '';    $aws_url = '';
        
        $get_productTitle_1st_parse = explode('<span id="productTitle" class="a-size-large">',$data);
        $get_productTitle_2nd_parse = explode('</span>',$get_productTitle_1st_parse[1]);
        $title = $get_productTitle_2nd_parse[0];
        if($title == '')
        {
            ajaxResp(true, '<div class="alert alert-danger">Something going wrong please try again</div>',array('haserror' =>1));
        }
        $aws_url = "http://www.amazon.com/dp/{$asin}?keywords=" . str_replace(" ", "+", $title);
        
        $get_productcategory_1st_parse = explode('data-feature-name="wayfinding-breadcrumbs">',$data);
        $get_productcategory_2nd_parse = explode('</a>',$get_productcategory_1st_parse[1]);
        $category = trim(end(explode('>', $get_productcategory_2nd_parse[0])));
        
        $description .= '<span id="aboutTheProductText" class="a-size-medium">About the Product</span>';
        $get_produdtdescription_1st_parse = explode('<div id="feature-bullets" ',$data);
        $get_productdescription_2nd_parse = explode('</ul>',$get_produdtdescription_1st_parse[1]);
        $get_produdtdescription_3rd_parse = explode('<ul class="a-vertical a-spacing-none">',$get_productdescription_2nd_parse[0]);
        $description .= '<ul class="a-vertical a-spacing-none">'.$get_produdtdescription_3rd_parse[1].'</ul>';
        
        
        $get_productimage_1st_parse = explode("'colorImages': { 'initial': ",$data);
        $get_productimage_2nd_parse = explode("'colorToAsin': {'initial': {}},",$get_productimage_1st_parse[1]);
        $get_productimage_3rd_parse = explode($new_url,str_replace($img_url,$new_url,$get_productimage_2nd_parse[0]));
        $image = array();
        for($i=0;$i<=count($get_productimage_3rd_parse);$i++)
        {    //$i=$i+8;
            if(strpos($get_productimage_3rd_parse[$i],'},"variant"')>0)
            {
                $get_productimage = explode('"',$get_productimage_3rd_parse[$i]);
                $path =$new_url.$get_productimage[0];

                $type = pathinfo($path, PATHINFO_EXTENSION);
        
                $data = file_get_contents($path);
        
                $other_pic_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $image[] = $other_pic_base64;
                    
             }    
            } 
        
        ajaxResp(true, '<div class="alert alert-success">Asin verification Successful.</div>',array('haserror' =>0, 'title'=>$title, 'image'=>$image, 'description'=>$description, 'category'=>$category, 'aws_url'=>$aws_url));
    } else{
        ajaxResp(true, '<div class="alert alert-danger">Asin not valid.</div>',array('haserror' =>1));
    }
     
}    */
        
    public function launch_new() {
        
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        $this->data['user'] = get_active_user();
        
        load_view('campaign_create_new', $this->data);
        
        }
    public function launch_edit() {
        
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";
        $this->data['user'] = get_active_user();
        
        $pid = $this->uri->segment(4);
        $this->data['pid'] = $pid;
        
        load_view('campaign_launch_edit', $this->data);
        
        }
    public function create_new() {
        
                        
        $asin = $_POST['asin_val'];
        $asin_verify = $_POST['asin_verify'];
        $product_title = $_POST['product_title'];
        $aws_url = $_POST['aws_url'];
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
        //print_r($product_other_pic_val);
       // die;
        /*$product_cover_pic_name = $_FILES['product_cover_pic']['name'];
        $product_cover_pic_ext = pathinfo($product_cover_pic_name, PATHINFO_EXTENSION);
        $getimagesize =getimagesize($_FILES['product_cover_pic']['tmp_name']);
        $product_cover_pic_aspect_ratio = $getimagesize[0]/$getimagesize[1];
        if($product_cover_pic_aspect_ratio<1.00 || $product_cover_pic_aspect_ratio>1.33)
        {
            $product_cover_pic_aspect_ratio_error = true;
        }
        else
        {
            $product_cover_pic_aspect_ratio_error = false;
        }*/
        
        /*$file_ext = array("jpg", "png", "jpeg", "gif");
        $product_other_pic_ext_error = false;
        $product_other_pic_count = 0;
        $product_other_pic_aspect_ratio_error = false;
        $product_other_pic_name = serialize($_FILES['product_other_pic']['name']);
        for($i=0;$i<=7;$i++)
        {
            if (array_key_exists($i, $_FILES['product_other_pic']['type'])) {
            $product_other_pic_mixed_type = $_FILES['product_other_pic']['type'][$i];
            $product_other_pic_mixed_type_slice = explode('image/',$product_other_pic_mixed_type);
            $product_other_pic_type = $product_other_pic_mixed_type_slice[1];
            if(!in_array($product_other_pic_type, $file_ext))
            {
                $product_other_pic_ext_error = true;
            }
            
            $getimagesize =getimagesize($_FILES['product_other_pic']['tmp_name'][$i]);
            $product_other_pic_aspect_ratio = $getimagesize[0]/$getimagesize[1];
            if($product_other_pic_aspect_ratio<1.00 || $product_other_pic_aspect_ratio>1.33)
            {
                $product_other_pic_aspect_ratio_error = true;
            }
            $product_other_pic_count++;
            }
        }*/
        
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
            /*echo "<br/>";
            echo serialize($review_suggetion);
            print_r($review_suggetion[0]);
        print_r($review_suggetion_type);*/
        
        
        //discount_price
        
        if(strlen($asin)!=10 && $asin_verify !== 'verified' )
        {
            ajaxResp(true, '<div class="alert alert-danger">Please verify your asin nubmer.</div>',array('haserror' =>1));
        }
        else if(strlen($product_title)<=0 || $product_title == '' )
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
        /*else if($product_cover_pic_aspect_ratio_error && $aspect_ratio_error_accept !='yes')
        {
            ajaxResp(true, '<div class="alert alert-danger">Image will distorted.</div>',array('haserror' =>2));
        }*/
        else if($product_other_pic_count == 0)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please upload image files for others pic.</div>',array('haserror' =>1));
        }
        /*else if($product_other_pic_ext_error)
        {
            ajaxResp(true, '<div class="alert alert-danger">Please upload image files for others pic.</div>',array('haserror' =>1));
        }
        else if($product_other_pic_aspect_ratio_error && $aspect_ratio_error_accept !='yes')
        {
            ajaxResp(true, '<div class="alert alert-danger">Image will distorted.</div>',array('haserror' =>2));
        }*/
        else
        {
        if ($uploadResp = $this->upload("product_discount_code_file")) {
                        if (is_string($uploadResp)) {
                            ajaxResp(true, '<div class="alert alert-danger">Discount code file has error please check.</div>',array('haserror' =>2));
                        }
                    }
            // Get PromoFile
                $promoFile = (isset($uploadResp['file_name'])) ? $uploadResp['file_name'] : "";
                //echo $product_end_time_until_count.'</br>';
            //if(!is_int($product_end_time_until_count)){$product_end_time_until_count = 0;}
            //echo $product_end_time_until_count ;
            //die('hi');
            $inputArray = array(
                        'uid' => $this->user->id,
                        'name' => $product_title,
                        "asin" => $asin,
                        "aws_url" => $aws_url,
                        "img_url" => $product_cover_pic_name,
                        "other_img_url" => serialize($product_other_pic_name),
                        "keywords" => $product_title,
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
                    );

                    // If product added
                    if ($pro_id = $this->product->add($inputArray)) {
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
                        
                        /*//upload cover picture
                        
                        $config = array();
                        $config['upload_path'] = $tmpcoverpicPath;
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['max_size']      = '10240';
                        $config['overwrite']     = FALSE;
                        
                        $this->upload->initialize($config);
                        $this->upload->do_upload('product_cover_pic');
                        
                        //upload other picture
                        
                        $config = array();
                        $config['upload_path'] = $tmpotherpicPath;
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['max_size']      = '10240';
                        $config['overwrite']     = FALSE;
                        

                        $files = $_FILES;
                        $cpt = count($_FILES['product_other_pic']['name']);
                        for($i=0; $i<$cpt; $i++)
                        {           
                            $_FILES['product_single_other_pic']['name']= $files['product_other_pic']['name'][$i];
                            $_FILES['product_single_other_pic']['type']= $files['product_other_pic']['type'][$i];
                            $_FILES['product_single_other_pic']['tmp_name']= $files['product_other_pic']['tmp_name'][$i];
                            $_FILES['product_single_other_pic']['error']= $files['product_other_pic']['error'][$i];
                            $_FILES['product_single_other_pic']['size']= $files['product_other_pic']['size'][$i];    
                    
                            $this->upload->initialize($config);
                            $this->upload->do_upload('product_single_other_pic');
                        }*/

                       ajaxResp(true, '<div class="alert alert-success">Congratulation!You successfully launch this product!</div>',array('haserror' =>0));
                    } else {
                        ajaxResp(true, '<div class="alert alert-danger">Please try again.</div>',array('haserror' =>1));
                    }
            
            
            
            ajaxResp(true, '<div class="alert alert-success">Something goes wrong</div>',array('haserror' =>0));
        }
        
    
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
        
        
   /* public function create() {

        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // Get ASIN no. 
        $asin = $this->input->get('asin', TRUE);
        if (empty($asin)) {
            redirect('companies/campaign/asin?error=' . urlencode(lang('empty_asin')));
            exit;
        }

        // GET Product data
        $asinData = $this->aws->asin($asin);
        
        // If product not found
        if (isset($asinData->Request->Errors)) {
            redirect('companies/campaign/asin?error=' . urlencode($asinData->Request->Errors->Error->Message));
            exit;
        }
        
        // Set Amazon URL
        $this->data['amazonUrl'] = "http://www.amazon.com/dp/{$asinData->Item->ASIN}?keywords=";

        /* If Form posted */
        /*if (isset($_POST['productName'])) {

            $isFormValidated = true;

            /*
             * Set Form validation rule
             */
            /*$this->form_validation->set_rules("productName", "lang:product_name", "trim|required|min_length[3]");
            $this->form_validation->set_rules("keywords", "lang:keywords", "trim|required|min_length[2]");
            $this->form_validation->set_rules("price", "lang:price", "trim|required|min_length[1]");
            $this->form_validation->set_rules("shipping_price", "lang:shipping_price", "trim|required|min_length[1]");
            $this->form_validation->set_rules("daily_limit", "lang:daily_limit", "trim|required|min_length[1]");
            $this->form_validation->set_rules("start_date", "lang:start_date", "trim|required");
            $this->form_validation->set_rules("end_date", "lang:end_date", "trim|required");
            $this->form_validation->set_rules("promo_code_type", "lang:promo_code_type", "trim|required");
            $this->form_validation->set_rules("category", "lang:category", "trim|required");
            $this->form_validation->set_rules("fullfillment", "lang:fullfillment", "trim|required");

            /*
             * Get INPUT values
             */
            /*$productName = $this->input->post("productName", TRUE);
            $keywords = $this->input->post("keywords", TRUE);
            $price = $this->input->post("price", TRUE);
            $shipping_price = $this->input->post("shipping_price", TRUE);
            $daily_limit = $this->input->post("daily_limit", TRUE);
            $start_date = $this->input->post("start_date", TRUE);
            $end_date = $this->input->post("end_date", TRUE);
            $promo_code_type = $this->input->post("promo_code_type", TRUE);
            $promo_code = $this->input->post("promo_code", TRUE);

            $description = $this->input->post("description", TRUE);
            $merchant_id = $this->input->post("merchant_id", TRUE);
            $category = $this->input->post("category", TRUE);
            $fullfillment = $this->input->post("fullfillment", TRUE);
            $extraASIN = isset($_POST['extraASIN']) ? $_POST['extraASIN'] : array();

            /*
             * Check if user has selected general option for pormo codes
             */
            /*if ($promo_code_type === "onetime") {
                if (empty($_FILES['upload_promo_codes']['name'])) {
                    $this->data['extraError'] = lang("empty_promo_upload");
                    $isFormValidated = false;
                } else {
                    $ext = pathinfo($_FILES['upload_promo_codes']['name'], PATHINFO_EXTENSION);
                    if ($ext !== "zip") {
                        $this->data['extraError'] = lang("empty_promo_upload");
                        $isFormValidated = false;
                    }
                }

                // If promo code type equal one time
            } else {
                $this->form_validation->set_rules("promo_code", "lang:promo_code", "trim|required|min_length[4]");
            }

            // Validate form
            if ($this->form_validation->run() !== false) {

                if ($promo_code_type === "onetime") {
                    // Upload File
                    if ($uploadResp = $this->upload("upload_promo_codes")) {
                        if (is_string($uploadResp)) {
                            $this->data['extraError'] = $uploadResp;
                            $isFormValidated = false;
                        }
                    }
                }

                // Get PromoFile
                $promoFile = (isset($uploadResp['file_name'])) ? $uploadResp['file_name'] : "";

                // If Form validated and file uploaded too
                if ($isFormValidated) {

                    $inputArray = array(
                        'uid' => $this->user->id,
                        'name' => $productName,
                        "asin" => $asin,
                        "aws_url" => $this->data['amazonUrl'] . str_replace(" ", "+", $keywords),
                        "img_url" => $asinData->Item->MediumImage->URL,
                        "keywords" => $keywords,
                        "price" => $price,
                        "shipping_price" => $shipping_price,
                        "daily_limit" => $daily_limit,
                        "start_date" => filterDate($start_date),
                        "end_date" => filterDate($end_date),
                        "promo_type" => $promo_code_type,
                        "description" => $description,
                        "merchant_id" => $merchant_id,
                        "category" => $category,
                        "fulfillment" => $fullfillment,
                        "child_asin" => serialize($extraASIN)
                    );

                    // If product added
                    if ($pro = $this->product->add($inputArray)) {

                        if (!empty($promoFile)) {
                            // Read zip file and return promo codes
                            $promoCodes = $this->process_promo_zip("uploads/" . $promoFile);
                        } else {
                            $promoCodes = array($promo_code);
                        }

                        $this->product->add_promo_codes($pro->pid, $promoCodes);

                        redirect('companies/campaign');
                        exit();
                    } else {
                        $this->data['asin_error'] = lang("there_error");
                    }
                }
            }
        }

        // Get category
        $this->data['category'] = $this->product->category();

        $this->data['asin'] = $asinData;
        load_view('campaign_create', $this->data);
    }*/

    public function promo() {
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // Get Product id and hash
        $this->data['pid'] = $pid = $this->uri->segment(4);
        $this->data['hash'] = $hash = $this->input->get('hash', TRUE);


        // If Empty
        if (empty($pid) || empty($hash)) {
            redirect('companies/campaign');
            exit;
        }

        // If hash not validated
        if (get_hash($pid) !== $hash) {
            redirect("companies/campaign");
            exit;
        }

        // GET Product data
        $product = $this->product->get($pid);
        if ($product) {
            $this->data['product'] = $product;
        } else {
            redirect("companies/campaign");
            exit;
        }


        /* If Form posted */
        if (isset($_POST['promo'])) {

            $promo = $this->input->post('promo', true);
            if (!empty($promo)) {
                for ($i = 0; $i < count($promo); $i++) {
                    foreach ($promo[$i] as $promo_id => $promo_code) {
                        $this->product->update_promo_codes(array('promo_code' => $promo_code), array('promo_id' => $promo_id));
                    }
                }
            }
        }

        $this->data['codes'] = $this->product->all_promo_codes($product->pid);
        if (!$this->data['codes']) {
            redirect("companies/campaign");
            exit;
        }

        load_view('campaign_promo', $this->data);
    }

    /*public function edit() {
        $this->index();
        return false;
        $this->data['title'] = get_title('campaign');
        $this->data['keywords'] = "";
        $this->data['description'] = "";

        // Get Product id and hash
        $this->data['pid'] = $pid = $this->uri->segment(4);
        $this->data['hash'] = $hash = $this->input->get('hash', TRUE);


        // If Empty
        if (empty($pid) || empty($hash)) {
            redirect('companies/campaign');
            exit;
        }

        // If hash not validated
        if (get_hash($pid) !== $hash) {
            redirect("companies/campaign");
            exit;
        }

        // GET Product data
        $product = $this->product->get($pid);
        if ($product) {
            $this->data['product'] = $product;
            $this->data['asin'] = $this->aws->asin($product->asin);
            $this->data['amazonUrl'] = $product->aws_url;
        } else {
            redirect("companies/campaign");
            exit;
        }

        /* If Form posted */
        /*if (isset($_POST['productName'])) {

            $isFormValidated = true;

            /*
             * Set Form validation rule
             */
            /*$this->form_validation->set_rules("productName", "lang:product_name", "trim|required|min_length[3]");
            $this->form_validation->set_rules("keywords", "lang:keywords", "trim|required|min_length[2]");
            $this->form_validation->set_rules("price", "lang:price", "trim|required|min_length[1]");
            $this->form_validation->set_rules("shipping_price", "lang:shipping_price", "trim|required|min_length[1]");
            $this->form_validation->set_rules("daily_limit", "lang:daily_limit", "trim|required|min_length[1]");
            $this->form_validation->set_rules("start_date", "lang:start_date", "trim|required");
            $this->form_validation->set_rules("end_date", "lang:end_date", "trim|required");
            $this->form_validation->set_rules("promo_code_type", "lang:promo_code_type", "trim|required");
            $this->form_validation->set_rules("category", "lang:category", "trim|required");
            $this->form_validation->set_rules("fullfillment", "lang:fullfillment", "trim|required");

            /*
             * Get INPUT values
             */
            /*$productName = $this->input->post("productName", TRUE);
            $keywords = $this->input->post("keywords", TRUE);
            $price = $this->input->post("price", TRUE);
            $shipping_price = $this->input->post("shipping_price", TRUE);
            $daily_limit = $this->input->post("daily_limit", TRUE);
            $start_date = $this->input->post("start_date", TRUE);
            $end_date = $this->input->post("end_date", TRUE);
            $promo_code_type = $this->input->post("promo_code_type", TRUE);
            $promo_code = $this->input->post("promo_code", TRUE);

            $description = $this->input->post("description", TRUE);
            $merchant_id = $this->input->post("merchant_id", TRUE);
            $category = $this->input->post("category", TRUE);
            $fullfillment = $this->input->post("fullfillment", TRUE);
            $extraASIN = isset($_POST['extraASIN']) ? $_POST['extraASIN'] : array();

            /*
             * Check if user has selected general option for pormo codes
             */
            /*if ($promo_code_type === "onetime" && isset($_FILES['upload_promo_codes']['name'])) {
                if (empty($_FILES['upload_promo_codes']['name'])) {
                    $this->data['extraError'] = lang("empty_promo_upload");
                    $isFormValidated = false;
                } else {
                    $ext = pathinfo($_FILES['upload_promo_codes']['name'], PATHINFO_EXTENSION);
                    if ($ext !== "zip") {
                        $this->data['extraError'] = lang("empty_promo_upload");
                        $isFormValidated = false;
                    }
                }
            } else {
                $this->form_validation->set_rules("promo_code", "lang:promo_code", "trim|required|min_length[4]");
            }

            // Validate form
            if ($this->form_validation->run() !== false) {

                if ($promo_code_type === "onetime" && isset($_FILES['upload_promo_codes']['name'])) {
                    // Upload File
                    if ($uploadResp = $this->upload("upload_promo_codes")) {
                        if (is_string($uploadResp)) {
                            $this->data['extraError'] = $uploadResp;
                            $isFormValidated = false;
                        }
                    }
                }

                // Get PromoFile
                $promoFile = (isset($uploadResp['file_name'])) ? $uploadResp['file_name'] : "";

                // If Form validated and file uploaded too
                if ($isFormValidated) {

                    $inputArray = array(
                        'uid' => $this->user->id,
                        'name' => $productName,
                        "keywords" => $keywords,
                        "price" => $price,
                        "shipping_price" => $shipping_price,
                        "daily_limit" => $daily_limit,
                        "start_date" => filterDate($start_date),
                        "end_date" => filterDate($end_date),
                        "promo_type" => $promo_code_type,
                        "description" => $description,
                        "merchant_id" => $merchant_id,
                        "category" => $category,
                        "fulfillment" => $fullfillment,
                        "child_asin" => serialize($extraASIN)
                    );

                    // If product added
                    $where = array("pid" => $pid);
                    if ($this->product->update($inputArray, $where)) {

                        redirect('companies/campaign');
                        exit();
                    } else {
                        $this->data['asin_error'] = lang("there_error");
                    }
                }
            }
        }

        // Get category
        $this->data['category'] = $this->product->category();

        load_view('campaign_edit', $this->data);
    }*/

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

    public function process_promo_zip($filePath) {

        $zip = new ZipArchive();
        $res = $zip->open($filePath);

        if ($res === TRUE) {

            $tmpPath = 'uploads/tmp' . md5(uniqid() . time());

            $zip->extractTo($tmpPath);
            $zip->close();

            // Scan extracted files
            $dir = scandir($tmpPath);
            if (!empty($dir)) {

                $promoCodes = array();

                //Remove . and .. from array
                unset($dir[0]);
                unset($dir[1]);

                foreach ($dir as $file) {

                    $innerFile = $tmpPath . "/" . $file;

                    // Read file if mime type is txt
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    if ($ext == "txt") {
                        $txtFile = fopen($innerFile, "r");
                        while ($line = fgets($txtFile)) {
                            $promoCodes[] = $line;
                        }
                        fclose($txtFile);
                    }

                    // Delete File
                    unlink($innerFile);
                }

                // Delete Templorary directory
                rmdir($tmpPath);

                return $promoCodes;
            }
        }

        return false;
    }

    public function visibility() {
        $pid = $this->input->post("pid", TRUE);
        $hash = $this->input->post("hash", TRUE);
        $type = $this->input->post("type", TRUE);

        // IF Values are empty
        if (empty($pid) || empty($hash) && empty($type)) {
            ajaxResp(false, "Sorry! Values cant be empty");
        }

        // Validate id and hash
        if (get_hash($pid) !== $hash) {
            ajaxResp(false, "Sorry! No cheating");
        }

        $update = array("disabled" => (($type == "0") ? 1 : 0));
        $where = array("pid" => $pid);

        if ($this->product->update($update, $where)) {
            ajaxResp(true, "Success");
        } else {
            ajaxResp(false, "Error");
        }
    }

}
