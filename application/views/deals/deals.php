



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
				<a  href="<?php echo base_url('deals/item/'.$pro->pid.'/'.$hash); ?>" <?php /*data-toggle="modal" data-target="#myModal" onclick="get_product_details('<?php echo $pro->pid; ?>')"*/?> ><img src="<?php echo base_url('uploads/product_image/'.$pro->pid.'/cover_pic/'.$pro->img_url); ?>" alt="deal" class="img-responsive deal-img center-block"></a>
						
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

    }//}

    ?>

			

			

				

					

			

			

			

			

	</div><!-- row -->

	</div> <!-- product-list -->

	

	</div>

	</div>

	</div> <!-- landing bg -->

	<?php //print_r($deals);
//echo $slug;
     $min = '';$max = '';

    foreach($deals as $deal)

    {

     //print_r($deal);

     //echo  floor($deal->price);  

     /*if($min == 0){$min = floor($deal->discount_price);}

     else if($min > floor($deal->discount_price)){$min = floor($deal->discount_price);}*/

     
     if($min == ''){$min = $deal->discount_price;}

     else if($min > $deal->discount_price){$min = $deal->discount_price;}

     if($max == ''){$max = ceil($deal->discount_price);}

     else if($max < ceil($deal->discount_price)){$max = ceil($deal->discount_price);}

     

    } 

    //echo $min.' '.$max;

    ?>

		<div class="searh_results">

		<div class="container">

		<div class="row">

			<form name="searching" id="searching">
		<aside class="col-md-3">

			<h2 class="deals new">Search</h2>

			<div class="clearfix"></div>

            

            

			<div class="searchForm">

			<div class="whiteArea">

			<input type="text" class="form-control searchKey" id="searchKey" placeholder="Add Keywords">

			  <div class="result_cat">

              <select class="form-control selectpicker searchSlug">

              <option value="" selected="">Category</option>

              <?php

                    $categoriesList = get_categories_list();

                    $catHtml = '';

                    foreach ($categoriesList as $cat) {
if(!empty($slug)){if($cat->slug == $slug){$selected ="selected='selected'";}else{$selected ="";}}
                        $catHtml .= "<option value='{$cat->cid}' {$selected}>{$cat->name}</option>";

                    }

                    echo $catHtml;

                    ?>

				</select>

				</div>	

				

		<div class="formbox priceSlider clearfix">

	<label for="price">Price Range ($) </label>



    	<div class="demo-output">

    		<input class="range-slider" type="hidden" value="<?php echo $min; ?>,<?php echo $max; ?>"/>

    	</div>

		<div class="price_values clearfix">

		<strong class="min-age pull-left"> <?php echo $min; ?> </strong> <strong class="max-age pull-right"> <?php echo $max; ?> </strong> </strong>

		</div>

	</div>	

	</div>

                <input type="submit" class="btn btn-find"  id="filter_search" name="Find" value="Find"/>
	 <?php /*<button type="submit" class="btn btn-find" id="filter_search">Find</button>*/ ?>



	

	

			</div>

		

		</aside>	
			</form>

		<div class="results col-md-9">

			<h2 class="deals new">Result (<span id="product_count">1932</span> Products)</h2>

			

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



	





	

<?php echo get_product_tiles($deals); ?>

			



	



	



			



	



	



			



	

	

	</div><!-- row -->

	</div> <!-- product-list -->





		

		</div><!-- results-->

  

			

	

		

		

	

	    <div class="clearfix"></div> 

</div>

		<section class="more-deals clearfix">

        <div class="col-md-3"></div>

		<div class="col-md-9">	<a href="javascript:void(0)" class="load-more" id="loadMore">+ Load more deals</a> </div>

		</section>

			</div><!-- container -->

		   </div> <!-- landing page contentbox -->













		   

<script>

/*range slider*/

//$('.range-slider').jRange('updateRange', '0,100', '25,50');

$(document).ready(function(){

       var height = 0;

       $('.product-img').each(function(){

          height = Math.max( height, $(this).outerHeight() )

       });

       $('.product-img').outerHeight(height);
<?php
if(!empty($slug)){echo "search_sort();";}
?>
});







$('.range-slider').jRange({

			from: <?php echo $min; ?>,

			to: <?php echo $max; ?>,

			step: 1,

			//scale: [0,25,50,75,100],

			format: '%s',

			width: 300,

			showLabels: false,

			isRange : true,

			onstatechange: function(value){

				var values = value.toString().split(','),

					low_val = values[0],

					high_val = values[1];

			

				$("strong.min-age").html(low_val);

				$("strong.max-age").html(high_val);

			}

		});

//$('.range-slider').jRange('setValue', '10,20');



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

    jQuery('#product_count').text(product_item);

    /*if(parseInt(product_item)>8){jQuery('#product_count').text(parseInt(product_item)-4);}

    else if(parseInt(product_item)<=8 && parseInt(product_item)>0){jQuery('#product_count').text(parseInt(product_item)/2);}

    else{jQuery('#product_count').text(parseInt(product_item));}*/

    //jQuery('#product_count').text(product_item);

    x=12;

    jQuery('.product_item:lt('+x+')').show();

    jQuery('#loadMore').click(function () {

        x= (x+3 <= product_item) ? x+3 : product_item;

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

var range = $(".range-slider").val().split(",");

var searchKey = $(".searchKey").val();

var rangeMin = range[0];

var rangeMax = range[1];

var _this = $(this);

var response = $("#filterAjaxResponse");

var site_url = "<?php echo site_url() ?>";

var sortType = $("select.sortBy option:selected").val();

var searchSlug = $("select.searchSlug option:selected").val();

//if(searchSlug !=''){searchType = 'categories';}else{searchType = 'deals';}

searchType = 'deals';

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