
	<div class="other_deals ">
	<div class="container">
			<h1 class="r_deal">Recommended Deals</h1>
		
			<div class="product-list">
			<div class=" product-owl-carousel">

			<?php
if(isset($user))
{
    $new_featured = array();
    $new_featured1 = array();
    $new_featured2 = array();
    $getUsermata_category = getUsermata($user->id, 'category');
    $get_categories= unserialize($getUsermata_category->mval);
            foreach ($featured as $pro)
            {   $match = 'no';
                foreach($get_categories as $key=>$val)
                {
                    if($val == $pro->category)
                    {
                        $match = 'yes';
                        break;
                    }
                }
                if($match == 'yes'){array_push($new_featured1, $pro);}
                else{array_push($new_featured2, $pro);}
                //echo $pro->category.' '.$match;
                //$match = 'no';
            
            } 
            //print_r($new_featured2);
            foreach($new_featured1 as $single){array_push($new_featured, $single);}
            foreach($new_featured2 as $single){array_push($new_featured, $single);}
            //$new_featured = $featured;
}
else
{
    $new_featured = $featured;
}

//$no_of_list = 4;

//$count = 1;

    foreach ($new_featured as $pro)
    {
        if($pro->discount_price<=1){
        //echo $pro->pid;
        //if($count<=$no_of_list)
        //{
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
        <?php //echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>
        
        
        
        <div class="item product_item_slider">
			<div class="product">
				<div class="panel">
				<div class="product-img">
				<a  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?>  ><img src="<?php echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>" alt="deal" class="img-responsive deal-img center-block"></a>
						
				</div>
				<div class="product-details">
				<a class="btn btn-getnow"  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?>  ><?php echo $text ; ?></a>
				<h3><a   href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><?php echo the_excerpt($pro->name, 0, 60); ?> </a></h3>
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
                </div>
        <?php
        
        
        /*
        <div class="col-md-3 col-sm-6 product_item">
		<div class="panel">
		<div class="product-img">
		<img src="<?php echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>" alt="deal" class="img-responsive deal-img center-block">
				
		</div>
		<div class="product-details">
		<a class="btn btn-getnow" data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"  ><?php echo $text ; ?></a>
		<h3><a  data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')" ><?php echo the_excerpt($pro->name, 0, 50); ?> </a></h3>
		<div class="pricearea clearfix">
			<div class="price"><span class="new-price"><span>$</span><?php echo $pro->discount_price; ?></span>
			<span class="original-price"><strike>$<?php echo $pro->price; ?></strike></span>
			</div> 
			<a class="btn btn-off"><?php echo number_format((float)$off, 2, '.', ''); ?>% OFF</a>
		</div>
		</div> <!-- product-details -->
    	<div class="panel-footer"><span class="category"><a href="<?php //echo base_url('categories/item/'.$category->slug); ?>"><?php echo $category->name; ?></a></span></div>
    	</div> <!-- panel -->
    	</div>
        */
    //$count++;
    }}//}
    ?>
			
	</div><!-- row -->
	</div> <!-- product-list -->
	
	</div>
	</div>
	</div> <!-- landing bg -->
	
		<div class="searh_results full-width-page">
		<div class="container">
		<div class="row">
			<div class="results col-md-12">
			<h2 class="deals new">Other $1 Deals</h2>
			<form name="searching" id="searching">
			  <div class="col-md-3 top_field ">
              <select class="form-control selectpicker searchSlug">
              <option value="" selected="">Choose Category</option>
              <?php
                    $categoriesList = get_categories_list();
                    $catHtml = '';
                    foreach ($categoriesList as $cat) {
                        $catHtml .= "<option value='{$cat->cid}'>{$cat->name}</option>";
                    }
                    echo $catHtml;
                    ?>
				</select>
				</div>	
				
				
				  <div class=" col-md-3 top_field">
				<input type="search" class="form-control searchKey"  id="searchKey" placeholder="Type in keywords here">
                <input type="submit" class="search-btn"  id="filter_search" name="Search" value="Search"/>
				<?php /* <button type="submit" class="search-btn"  id="filter_search">Search</button>*/ ?>
				</div>	
			</form>
		  <div class="sort_by">
          <select tabindex="1" class="form-control selectpicker sortBy">
                            <option value="" selected="">Sort By</option>
                            <option value="p.discount_price__ASC">Price: Lowest First</option>
                            <option value="p.discount_price__DESC">Price: Highest First</option>
                            <option value="p.name__ASC">Name: A-Z</option>
                            <option value="p.name__DESC">Name: Z-A</option>
                </select>
				</div>	
				
			<div class="clearfix"></div>
			<div class="product-list">
	<div class="row" id="filterAjaxResponse">
<?php echo get_product_tiles_onedeals($deals); ?>
	
	</div><!-- row -->
	</div> <!-- product-list -->


		
		</div><!-- results-->
  
			
	
		
		
	
	    <div class="clearfix"></div> 
</div>
		<section class="more-deals clearfix">
			<a href="javascript:void(0)" class="load-more" id="loadMore">+ Load more deals</a>
		</section>
			</div><!-- container -->
		   </div> <!-- landing page contentbox -->





<!-- Modal -->




	<div class="gray-slant"></div>	  
    
    
 <script>
$(document).ready(function(){
       var height = 0;
       $('.product-img').each(function(){
          height = Math.max( height, $(this).outerHeight() )
       });
       $('.product-img').outerHeight(height);
});

/*

     * PRODUCT SORTING

     */

                
$(document).on("change", "select.sortBy", function() { search_sort(); });
$( "#searching" ).submit(function( event ) {
  search_sort();
  event.preventDefault();
});
$(document).on("click", "#filter_search", function() { search_sort(); });

jQuery('.product_item').hide();
    product_item = jQuery(".product_item").size();
    //console.log(product_item);
    //jQuery('#product_count').text(product_item-4);
    /*if(parseInt(product_item)>8){jQuery('#product_count').text(parseInt(product_item)-4);}
    else if(parseInt(product_item)<=8 && parseInt(product_item)>0){jQuery('#product_count').text(parseInt(product_item)/2);}
    else{jQuery('#product_count').text(parseInt(product_item));}*/
    //jQuery('#product_count').text(product_item);
    x=12;
    jQuery('.product_item:lt('+x+')').show();
    jQuery('#loadMore').click(function () {
        x= (x+4 <= product_item) ? x+4 : product_item;
        jQuery('.product_item:lt('+x+')').show();
        if(x == product_item)
        {
            jQuery('#loadMore').text('No more deals to show');
        }
        
       var height = 0;
       $('.product_item').each(function(){
          height = Math.max( height, $(this).outerHeight() )
       });
       $('.product_item').outerHeight(height);
       var height = 0;
       $('.product-img').each(function(){
          height = Math.max( height, $(this).outerHeight() )
       });
       $('.product-img').outerHeight(height);
    });
    
   
            
             

function search_sort(){    
var searchKey = $(".searchKey").val();
var rangeMin = '0';
var rangeMax = '1.1';
var _this = $(this);
var response = $("#filterAjaxResponse");
var site_url = "<?php echo site_url() ?>";
var sortType = $("select.sortBy option:selected").val();
var searchSlug = $("select.searchSlug option:selected").val();
//if(searchSlug !=''){searchType = 'onedealscategories';}else{searchType = 'onedeals';}
searchType = 'onedeals';
var priceRange = {values: [rangeMin, rangeMax]};
var ajaxReqData = {type: searchType, slug: searchSlug, search: searchKey};

        ajaxReqData.action = "sorting";

        ajaxReqData.range = priceRange.values;

        ajaxReqData.sort = sortType;



        $.ajax({

            type: "POST",

            url: site_url + "ajax",

            dataType: "json",

            data: ajaxReqData,

            beforeSend: function() {

                //loader.show();

            },

            error: function() {

                //loader.hide();

            },

            success: function(r) {
                jQuery('#loadMore').text('+ Load more deals');
                response.html(r.data);


                jQuery('.product_item').hide();
                product_item = jQuery(".product_item").size();
                jQuery('#product_count').text(product_item);
                x=12;
                jQuery('.product_item:lt('+x+')').show();
                
                var height = 0;
                $('.product-img').each(function(){
                  height = Math.max( height, $(this).outerHeight() )
                });
                $('.product-img').outerHeight(height);
                
    
    

            }

        });

    }


</script>   