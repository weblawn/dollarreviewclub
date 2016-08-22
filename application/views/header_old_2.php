<?php error_reporting(0); ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="title" content="<?php echo $title ?>"/>
    <meta name="keywords" content="<?php echo $keywords ?>"/>
    <meta name="description" content="<?php echo $description ?>" />
    <meta name="image" content="<?php echo $image ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.html">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo new_assets_url('css/bootstrap.css') ?>" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/owl.carousel.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/owl.theme.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/dropdown.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/jquery.range.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/bootstrap-select.min.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/style.css?v='.time()) ?>" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" type="text/css">
    <?php /* <link rel="stylesheet" href="<?php echo new_assets_url('css/custum.css') ?>" type="text/css"> */ ?>
    <link rel="stylesheet" href="<?php echo new_assets_url('css/jquery-te-1.4.0.css') ?>" type="text/css">
    
    
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
           
    <script src="<?php echo new_assets_url('js/jquery.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/jquery.range.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/jquery.dropdown.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/bootstrap-select.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/jquery.validate.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/jquery.bootstrap.wizard.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/custom.js?v='.time()) ?>"></script>
    <script src="<?php echo new_assets_url('js/new_custom.js?v='.time()) ?>"></script>
    <script src="<?php echo new_assets_url('js/canvasjs.min.js') ?>"></script>
    <script src="<?php echo new_assets_url('js/jquery-te-1.4.0.min.js') ?>"></script>
    

    
    
        <?php
        $user = get_active_user();
        //print_r($user);
        $avatar = $this->session->userdata('avatar');
        $url = $_SERVER['REQUEST_URI'];
        if(is_int(strpos($url,"pages")) && strpos($url,"pages")>0)
        {
            $pos = 1;
        }
        /*if(is_int(strpos($url,"contact")) && strpos($url,"contact")>0)
        {
            $pos = 1;
        }
        else if(is_int(strpos($url,"howitworks")) && strpos($url,"howitworks")>0)
        {
            $pos = 1;
        }
        else if(is_int(strpos($url,"faq")) && strpos($url,"faq")>0)
        {
            $pos = 1;
        }
        else if(is_int(strpos($url,"about")) && strpos($url,"about")>0)
        {
            $pos = 1;
        }*/
        else if(is_int(strpos($url,"companies")) && strpos($url,"companies")>0)
        {
            $pos = 1;
        }
        else if(is_int(strpos($url,"home")) && strpos($url,"home")>0)
        {
            $pos = 1;
        }
        else
        {
            $pos = 0;
        }
        
        if($pos == 1)
        {
            $body_class = '';
        }
        else
        {
            $body_class = 'class="innerpage"';
        }
        ?>
</head>

<body  <?php echo $body_class; ?> > 
<div class="page-cover">
    <div class="landingbg clearfix">
<header >

  <div class="container">
  <nav class="navbar navbar-default">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('home'); ?>">
      <img alt="Brand" src="<?php echo new_assets_url('img/drc150.jpg') ?>" class="img-responsive logo">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav top navbar-nav">
        <?php
        //if($user) { echo $user->role; }else { echo 'header';} 
            //echo get_menu(( ($user) ? $user->role : 'header'));
            echo get_menu( 'header' );
        ?>
        
    
      </ul>
 <?php 
 //echo $user->role;
 //print_r($notification);
  $notification = get_notification($user->role);
 if($notification == 'false'){$count_notification = 0;}else{$count_notification = count($notification);}
 //print_r($notification);
 if ($user->role == 'companies') { 
    ?>
 <div class="navbar-right seller_logged_in">
	 <span class="user_name"><a href="<?php echo base_url('/companies/my_account'); ?>">Hi, <?php echo the_excerpt($user->fname,'0','10').' !'; ?></a></span>
	 <a class="notification" onclick="disable_notification();"><?php  if($count_notification>0){echo "<sup>".$count_notification."</sup>";}  ?></a>
	 <?php  if($count_notification>0){?>
	 <div class="notification_list">
		<ul>
        <?php
        if($count_notification>0)
        {$i=1;
        $old_data_pending =array();
        $old_data_pass =array();
            foreach($notification as $single)
            {
                $product_id = $single->product_id;
                $product_details = get_product_details($product_id);
                $get_manual_pending_by_id = get_manual_pending_by_id($product_id);
                $get_finished_review_for_product = get_finished_review_for_product($product_id);
                if($i>2)
                {
                    break;
                }
                $date = strtotime(date('Y-m-d'));
                
                if($single->seller_approve_status == 'pending' && !in_array($single->product_id, $old_data_pending))
                {  $old_data_pending[] = $single->product_id;
                    if(count($get_manual_pending_by_id) > 1)
                    {
                        $text_before = count($get_manual_pending_by_id).' request sent to you for approval (Title: ';
                        ?>
                        <li><a href="<?php echo base_url('/companies/my_account?tab=review_status&&tab_list='.$single->product_id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50').' )'; ?></a></li>
                        <?php
                        $i++;
                    }
                    else if(count($get_manual_pending_by_id) == 1)
                    {
                        $customer_id = $single->customer_id;
                        $udata = $this->userm->get($customer_id);
                        $text_before = $udata->fname.' request sent to you for approval (Title: ';
                        ?>
                        <li><a href="<?php echo base_url('/companies/my_account?tab=review_status&&tab_list='.$single->product_id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50').' )'; ?></a></li>
                        <?php
                        $i++;
                    }
                }
                else if($single->review_status == 'pass' && !in_array($single->product_id, $old_data_pass))
                {  $old_data_pass[] = $single->product_id;
                    if(count($get_finished_review_for_product) == 1)
                    {
                        $text_before = 'You product reviews +'.count($get_finished_review_for_product).' (Title: ';
                        ?>
                        <li><a href="<?php echo base_url('/companies/my_account?tab=review_status&&tab_list='.$single->product_id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50').' )'; ?></a></li>
                        <?php
                        $i++;
                    }
                }
                
            }
                ?>
                <li class="more"><a href="<?php echo base_url('/companies/my_account?tab=review_status'); ?>">+ Show More My Product Review Status</a></li>
                <?php
        }
        ?>
		</ul>
	 
	 </div> <!-- notification_list-->
	 <?php } ?>
	 
	 
	 <button type="button" class="small_menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <?php
       $online_product = get_online_product($user->id);
       $offline_product = get_offline_product($user->id);
       if($online_product !='false'){$online_product_count = count($online_product);}  else{$online_product_count = 0;}
      if($offline_product !='false'){$offline_product_count = count($offline_product);}  else{$offline_product_count = 0;}
      $total_product = $online_product_count + $offline_product_count;
       
       ?>
  <ul class="log_in_status">
	<li><a href="<?php echo base_url('/companies/my_account'); ?>"><span class="seller"></span> My Account </a></li>
    <li><a href="<?php echo base_url('/companies/my_account?tab=review_status'); ?>"><span class="products"></span> <?php if($total_product>1){echo $total_product." Products";}else{echo $total_product." Product";} ?></a></li>
    <li><a href="" data-toggle="modal" data-target="#myModal7" ><span class="logout"></span> Logout </a></li>
 </ul>
      </div>
      
      
 
 <?php }else if ($user->role == 'shopper') { 
    
    if($count_notification>0)
    {
        $count_notification = 0;
        foreach($notification as $single)
            {
                $date = strtotime(date('Y-m-d'));
                //echo $date;
                if($single->next_time != intval('0') && intval($single->next_time) > $date)
                {
                    $skip_this = 'true';                    
                }
                else
                {
                    $count_notification++;
                }
            }
    }
    
    ?>
<div class="navbar-right customer_logged_in">
	 <span class="user_name"><a href="#">Hi, <?php echo the_excerpt($user->fname,'0','10').' !'; ?></a></span>
	 <a class="notification" onclick="disable_notification();"><?php  if($count_notification>0){echo "<sup>".$count_notification."</sup>";}  ?></a>
	 <?php  if($count_notification>0){?>
     <div class="notification_list">
		<ul>
        <?php 
        if($count_notification>0)
        {$i=1;
            foreach($notification as $single)
            {
                //Your request has been APPROVED by seller on
                //Dollar Review Club reminds you to leave review on 
                $skip = 'false';
                $product_id = $single->product_id;
                $product_details = get_product_details($product_id);
                if($i>2)
                {
                    break;
                }
                $date = strtotime(date('Y-m-d'));
                //echo $date ;
                if($single->next_time != intval('0') && intval($single->next_time) > $date)
                {
                    $skip = 'true';                    
                }
                
                //echo $skip ;
                if($skip == 'false' && $single->code_taken == 'no')
                {
                    if($single->seller_approve_status == 'approve')
                    {
                        $text_before = 'Your request has been APPROVED by seller on ';
                        ?>
                        <li><a href="<?php echo base_url('/shopper/my_account?tab=review_status&&tab_list='.$single->id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50'); ?></a></li>
                        <?php
                        $i++;
                    }
                    else if($single->seller_approve_status == 'disapprove')
                    {
                        $text_before = 'Your request has been DISAPPROVED by seller on ';
                        ?>
                        <li><a href="<?php echo base_url('/shopper/my_account?tab=review_status&&tab_list='.$single->id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50'); ?></a></li>
                        <?php
                        $i++;
                    }
                }
                else if($skip == 'false' && $single->code_taken == 'yes')
                {
                        $text_before = 'Dollar Review Club reminds you to leave review on ';
                        ?>
                        <li><a href="<?php echo base_url('/shopper/my_account?tab=review_status&&tab_list='.$single->id); ?>"><?php echo $text_before.the_excerpt($product_details->name,'0','50'); ?></a></li>
                        <?php
                        $i++;
                }
                
            }
                ?>
                <li class="more"><a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>">+ Show More My Review Status</a></li>
                <?php
        }
        ?>
		</ul>
	 
	 </div> <!-- notification_list-->
	 <?php } ?>
	 
	 <button type="button" class="small_menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
         <?php $getUsermata_quota = $this->userm->getUsermeta($user->id, 'quota');       $getUsermata_quota    = $getUsermata_quota->mval; ?>
  <ul class="log_in_status">
	<li><a href="<?php echo base_url('/shopper/my_account'); ?>"><span class="user"></span> My Account </a></li>
    <li><a href="<?php echo base_url('/shopper/my_account?tab=review_status'); ?>"><span class="remain"></span> <?php echo $getUsermata_quota; ?> Remain </a></li>
    <li><a href="" data-toggle="modal" data-target="#myModal7" ><span class="logout"></span> Logout </a></li>
 </ul>     
 
      </div>
 <?php }else { ?>
 <ul class="nav navbar-nav navbar-right">
        <li><a href="javascript:void(0)<?php //echo site_url('user/login'); ?>" id="login" data-toggle="modal" data-target="#login_signup"><?php echo lang('login') ?></a></li>
        <li class="active"><a href="javascript:void(0)<?php //echo site_url('user/signup'); ?>" id="signup" data-toggle="modal" data-target="#login_signup"><?php echo lang('signup') ?></a></li>
 
      </ul>
 <?php } ?>
      
    </div><!-- /.navbar-collapse -->

</nav>
  </div>
  </header>	