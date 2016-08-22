

  <div class="homebanner clearfix">

      <div class="container">
	  <div class="banner_content">
		<hgroup>
			<h1>It's your discount!</h1>
			<h4>All you need to do is give honest reviews!</h4>
		</hgroup>
	
	<a href="<?php echo base_url('pages/howitworks'); ?>" class="btn btn-default btn-works"><i class="fa fa-arrow-right"></i> &nbsp; See how it works</a>
    </div>    	
    </div>    	
		
    </div><!-- container close -->
</header>	
	<div class="contentbox landingpage">
	<div class="container productdeal">
			<section class="more-deals clearfix"><div class="deals">$1 Deals</div>
			<a href="<?php echo base_url('onedeals'); ?>" class="b-more-link">+ Browse More</a>
			</section>
	<div class="product-list">
	<div class="row">

	
<?php
//print_r($featured);
$no_of_list = 4;
$count = 1;
    foreach ($featured as $pro)
    {//echo $pro->pid."</br>";
        if($count<=$no_of_list)
        {
        //$href = site_url("deals/item/{$pro->pid}?hash=" . get_hash($pro->pid));
        
        $category = get_category($pro->category);
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
        
        ?>
        <div class="col-md-3 col-sm-6 product_item">
		<div class="panel">
		<div class="product-img">
        <?php //echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>
		<a  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><img src="<?php echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>" alt="deal" class="img-responsive deal-img center-block"></a>
				
		</div>
		<div class="product-details">
		<a class="btn btn-getnow"  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><?php echo $text ; ?></a>
		<h3><a  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><?php echo the_excerpt($pro->name, 0, 65); ?> </a></h3>
		<div class="pricearea clearfix">
			<div class="price"><span class="new-price"><span>$</span><?php echo $pro->discount_price; ?></span>
			<span class="original-price"><strike>$<?php echo $pro->price; ?></strike></span>
			</div> 
			<a class="btn btn-off"><?php echo number_format((float)$off, 2, '.', ''); ?>% OFF</a>
		</div>
		</div> <!-- product-details -->
    	<div class="panel-footer"><span class="category"><a href="<?php echo base_url('deals?category='.$category->slug) ; ?>"><?php echo $category->name; ?></a></span></div>
    	</div> <!-- panel -->
    	</div>
        <?php
        $count++;
    }
    }
    ?>
	
	

			

	
	
	
	</div><!-- row -->
	</div> <!-- product-list -->
	
	
	    <div class="clearfix"></div>   
			<section class="more-deals clearfix"><div class="deals new">Other new deals</div>
			<a href="<?php echo site_url('deals'); ?>" class="b-more-link">+ Browse More</a>
			</section>
	<div class="product-list">
	<div class="row">
     <?php
    foreach ($newdeals as $pro)
    {
        $href = site_url("deals/item/{$pro->pid}?hash=" . get_hash($pro->pid));
        
        $category = get_category($pro->category);
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
        ?>
        <div class="col-md-3 col-sm-6 product_item">
		<div class="panel">
		<div class="product-img">
        <?php //echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>
		<a  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><img src="<?php echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>" alt="deal" class="img-responsive deal-img center-block"></a>
				
		</div>
		<div class="product-details">
		<a class="btn btn-getnow"  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><?php echo $text ; ?></a>
		<h3><a   href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><?php echo the_excerpt($pro->name, 0, 65); ?> </a></h3>
		<div class="pricearea clearfix">
			<div class="price"><span class="new-price"><span>$</span><?php echo $pro->discount_price; ?></span>
			<span class="original-price"><strike>$<?php echo $pro->price; ?></strike></span>
			</div> 
			<a class="btn btn-off"><?php echo number_format((float)$off, 2, '.', ''); ?>% OFF</a>
		</div>
		</div> <!-- product-details -->
    	<div class="panel-footer"><span class="category"><a href="<?php echo base_url('deals?category='.$category->slug) ; ?>"><?php echo $category->name; ?></a></span></div>
    	</div> <!-- panel -->
    	</div>
        <?php
    }
    ?>
    
    
	
    
    
    
	</div><!-- row -->
	</div> <!-- product-list -->


		<section class="more-deals clearfix">
			<a href="javascript:void(0)" id="loadMore" class="load-more">+ Load more deals</a>
		</section>
		
	
	    <div class="clearfix"></div>   
			</div><!-- container -->
		   </div> <!-- landing page contentbox -->

		   
</div>
<div class="gray-slant"></div>
<script>
jQuery(document).ready(function () {
    //size_li = jQuery("#myList li").size();
    jQuery('.product_item').hide();
    product_item = jQuery(".product_item").size();
    //console.log(product_item);
    x=12;
    jQuery('.product_item:lt('+x+')').show();
    jQuery('#loadMore').click(function () {
        x= (x+4 <= product_item) ? x+4 : product_item;
        jQuery('.product_item:lt('+x+')').show();
        if(x == product_item)
        {
            jQuery('#loadMore').text('No more deals to show');
        }
    });
    
    /*
    $('#showLess').click(function () {
        x=(x-3<0) ? 3 : x-3;
        $('#myList li').not(':lt('+x+')').hide();
    });
    */
    
});

</script>
<?php
//print_r($featured); 
//print_r($newdeals); 
?>
