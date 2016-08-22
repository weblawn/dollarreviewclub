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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo new_assets_url('css/owl.carousel.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/owl.theme.css') ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo new_assets_url('css/style.css') ?>" type="text/css">
	
</head>

<body class="home">
<header class="homeheader">

  <div class="container">

	<div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url('home'); ?>">
        <img alt="Brand" src="<?php echo new_assets_url('img/drc150.jpg') ?>" class="img-responsive">
      </a>
    </div>
    
  </div>



<div class="banner clearfix">

      <div class="container">
	  <hgroup>
        <h1>Introducing Dollar Review Club</h1>
        <h4>where you can find $1 and other great deals then review them on Amazon!</h4>
	</hgroup>
        	<div class="row">
            	   <div class="col-md-7 text-center">
					<img src="<?php echo new_assets_url('img/dollar_one.png') ?>" alt="dollar one" class="img-responsive dollar_one">
					</div>
           <div class="col-md-5 text-center">
			<form class="banner-form" method="post" action="<?php echo base_url('index/contact_validation'); ?>">
				<h5 class="form_title text-center">Interested? Simply leave your information below and we'll contact you:</h5>
                <?php echo validation_errors();echo $success_msg; ?>
				<div class="form_area clearfix">
				<div class="form_title2">1. Choose your identity:</div>
                
                <?php 
                if($data['identity']=="reviewer")
                {
                    $reviewer = 'checked="checked"';
                } 
                else if($data['identity']=="seller")
                {
                     $seller = 'checked="checked"';
                } 
                else
                {
                     $reviewer = 'checked="checked"';
                }
                ?>
				<div class="radio current">
					<input type="radio" id="c1" name="identity" class="radiogroup" <?php echo $reviewer; ?>  value="reviewer" />
					<label for="c1"><span></span>I'm an Amazon reviewer</label>
				</div>
				
				<div class="radio">
					<input type="radio" id="c2" name="identity" class="radiogroup" <?php echo $seller; ?> value="seller" />
					<label for="c2"><span></span>I'm an Amazon seller</label>
				</div>

				<div class="form_title2">2. Your name and email:</div>
					<input type="text" class="form-control" name="name" id="name" minlength ='3' placeholder="Your Name" required="required" value="<?php echo $data['name']; ?>">
				
					<input type="email" class="form-control" name="email" id="email" placeholder="Your email address" required="required" value="<?php echo $data['email']; ?>">
				
				<button type="submit" class="btn btn-default smt-btn">Send</button>
				</div>

			</form>
        
    
        
             </div>

        </div>
    </div><!-- container close -->
</header>	
	<div class="contentbox homepage">
	       <div class="container">
		   <h2>What is Dollar Review Club?</h2>
		   <div class="row">
			<div class="col-md-8">
		
		  <p>Dollar Review Club was created Amazon shoppers to get AWESOME DEALS with DISCOUNT PRICES in exchange for their decent REVIEWS. We provide many great deals with high quality and all you need to do is write your review of the product on Amazon. We also welcome Amazon sellers who are eager to earn reviews to contact us!</p>

<p>Feel free to leave your name and email address above and we will reach you on the Dollar Review Club official website launch day! </p>
         
        </div>
		<div class="col-md-4 drcimg"><img src="<?php echo new_assets_url('img/review.jpg') ?>" class="img-responsive"></div>
     

	
		
		   </div>
		   <p>&nbsp;</p>
		   <hr/>
		   	<h2>Deals Coming Soon!!</h2>
			</div>
			<div class="owl-carousel product_slider">
            <?php foreach ($dcs as $p){
                
   ?><div class="item"><img src="<?php echo base_url('uploads/'.$p->image_name); ?>" class="img-responsive" alt="product" style="height: 246px;"></div><?php
   // style="height: 216px;width: 358px;"
            } ?>
   

</div>


		 
		   </div> <!-- contentbox -->

<footer><p class="text-center copyright">&copy; 2016 <?php echo lang('copyright') ?></p></footer>
<div class="cornered"></div>
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo new_assets_url('js/jquery.min.js') ?>"></script>
<script src="<?php echo new_assets_url('js/bootstrap.min.js') ?>"></script>


<script src="<?php echo new_assets_url('js/owl.carousel.min.js') ?>"></script>
<script src="<?php echo new_assets_url('js/custom.js') ?>"></script>


</body>
</html>
