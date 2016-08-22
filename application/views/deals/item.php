<div class="contentbox page productView">
<div class="container container1050">
<div class="modal-content product_details_popup">
    
        <?php //echo $pid; /* <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>*/ ?>
       

      <div class="modal-body clearfix">
	  <div class="product_info_popup single_page_body" style="display: none;" >
       <div class="col-md-5"> 
	   
	   
<div id="carousel-custom" class="carousel slide" data-ride="carousel">
    <div class="carousel-outer">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item">
                <img id="product_img0" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;">
            </div>
           
        <div class="item"><img id="product_img1" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img2" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img3" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img4" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img5" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img6" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div>
        <div class="item"><img id="product_img7" src="" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;"></div></div>

    </div>
    
    <!-- Indicators -->
    <ol class="carousel-indicators mCustomScrollbar list-inline center-block text-center">
        <li data-target="#carousel-custom" data-slide-to="0" class=""><img id="product_thumb_img0" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="1" class=""><img id="product_thumb_img1" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="2" class=""><img id="product_thumb_img2" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="3" class=""><img id="product_thumb_img3" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="4" class=""><img id="product_thumb_img4" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="5" class=""><img id="product_thumb_img5" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="6" class=""><img id="product_thumb_img6" src="" alt="" height="65" width="65"></li>
      <li data-target="#carousel-custom" data-slide-to="7" class=""><img id="product_thumb_img7" src="" alt="" height="65" width="65"></li></ol>
</div>
	   
	   
	   
	   
	   </div><!--col-md-5 -->
       <div class="col-md-7">
       <div id="customdata"></div>
		<div class="time_left" id="time_left"></div>
	   <h3 id="product_title" class="product_titles"></h3>
	   <?php /* <div class="author_info">From <span id="belong_company"></span></div>*/ ?>
	   <div class="clearfix social-sec">
           <div class="author_info">From <span id="belong_company"></span></div>
           
           
           <div class="addthis_sharing_toolbox"></div>
	   </div>
	   
	   <div class="pricearea clearfix">
			<div class="price"><span class="new-price" id="product_new_price"><span>$</span>00.00</span>
			<span class="original-price" id="product_original_price"><strike>$00.00</strike></span>
			<span><a class="btn btn-off" id="product_off">00.00% OFF</a></span>
			</div> 
		</div>
		
		<div class="btn-groups clearfix">
				<a id="product_reviewLink" class="btn btn-getnow" data-toggle="modal" data-dismiss="modal" data-target="#myModal40">Get it now</a>
		<a id="product_amazonLink" target="_blank" class="btn btn-amazon" href="">View on Amazon</a>
		</div>
        
		<div class="btn-groups clearfix">
		<div class='shareaholic-canvas' data-app='share_buttons' data-app-id='7fe74797d03cbccba58d8e88d69ca41d'></div>
		</div>
        
		<div class="details">Review Suggestion:<br>
		<p id="product_review_suggestion" class="product_review_suggestion extra_list"></p>
		</div>
        
		<div class="details"><strong>Details:</strong><br>
		<p id="product_details" class="product_details"></p>

<p class="disclaimer"><em>Please leave a disclaimer that you received this discounted product in exchange
for your honest review. </em></p>
		
		</div>
		
		
	   </div> <!-- col-md-7-->
      </div> <!--product_info_popup-->
      </div> <!-- model body -->
    </div>
</div>
	
	</div>
    
    <script>
    	$(document).ready(function() {
get_product_details(<?php echo $pid; ?>);
$('.single_page_body').show();
});

</script>