</div> <!-- landingbg -->

 <!-- [46] Launch New Product -->

  <input type="hidden" id="new_loading_img" value="<?php echo new_assets_url('img/loading.gif') ?>" />
 <div class="innerpage launch_new_product">

<div class="contentbox page">

	

	<div class="container">

		<div class="content page-shadow page">

		

			<div class="w900">

			<div class="launch_product">

			<h1 class="page-title">Launch New Product</h1>

			<div class="clearfix"></div>

			<form class="form-horizontal other_forms " id="launch_form" name="launch_form" method="post" enctype="multipart/form-data" >

  <div id="launch_form_Alert"></div>

  <div class="form-group" id="launch_verify">

    <label for=" " class="col-md-4 control-label">Amazon Product ASIN:<span class="required-field">*</span></label>

    <div class="col-md-8">

		<div class="row">

		<div class="col-md-7">

		<div class="launch-form-field">

		<input type="text" class="form-control" id="asin_val" name="asin_val" placeholder="" value=""> 

		<input type="hidden" class="form-control" id="asin_verify" name="asin_verify" placeholder="" value="fasle">

        <input type="hidden" id="asin_verify_ajax_url" name="asin_verify_ajax_url" value="<?php echo base_url('companies/campaign/check_asin'); ?>"/>

		</div>

		</div>

		

		<div class="col-md-5">

		<div class="row btn-verify">

		<button type="button" class="btn btn-org" onclick="asin_value_verify();">Verify</button>

		<span class="help"></span>

		<a class="help" href="#" data-toggle="modal" data-dismiss="modal" data-target="#myModal46" title="Information text goes here! Information text goes here!">What's this?</a>

		</div>

		</div>

		

		

    </div>

    </div>

  </div>
  
  

  <div class="form-group other_part">

    <label for=" " class="col-md-4 control-label">Amazon Product Url:<span class="required-field">*</span></label>

    <div class="col-md-8">

		<div class="row">

		<div class="col-md-12">

		<div class="launch-form-field">

		<input type="text" class="form-control" id="aws_url" name="aws_url" placeholder="" value=""> 

		</div>

		</div>
	

    </div>

    </div>

  </div>

  

  <div class="form-group product_title other_part">

    <label for=" " class="col-md-4 control-label">Product Title:<span class="required-field">*</span><br>(Max. 150 Words)</label>

    <div class="col-md-8">

	<div class="launch-form-field">

      <textarea class="form-control " id="product_title" name="product_title" placeholder></textarea>

      <span  id="product_title_count"></span>

    </div>

    </div>

  </div>

  

  <div class="form-group preset_value other_part">

    <label for=" " class="col-md-4 control-label">Company Name:<span class="required-field">*</span></label>

    <div class="col-md-8">

		<div class="launch-form-field existing_value">

		<?php echo $user->fname; ?>

    </div>

    </div>

  </div>





  <div class="form-group other_part">

    <label for="inputPassword3" class="col-md-4 control-label">Original Price:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="row">

	<div class="col-md-7">

	<div class="launch-form-field">

	<div class="input-group">

	<span class="input-group-addon">$</span>

		<input type="text" class="form-control" id="product_price" name="product_price" placeholder="">

     </div>

     </div>

    </div>

    </div>

    </div>

  </div>



  <div class="form-group other_part">

    <label for=" " class="col-md-4 control-label">Discounted Purchase Price:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="row">

	<div class="col-md-8">

    

    

	<div class="radio light one_dollar_deal" id="otherdeal_radio"  style="display: none;">

	<div class="control-label">

					<input type="radio" id="otherdeal" name="discount_price" onchange="makeRadioButtons()" value="otherdeal" class="radiogroup" checked="checked">

					<label for="otherdeal"><span></span>Custom Price</label>

		</div>

		</div>

    

	<div class="launch-form-field" id="otherdeal_radio_field" style="display: block;">

	<div class="input-group">

	<span class="input-group-addon">$</span>

		<input type="text" class="form-control w265" id="product_discount_price" name="product_discount_price" placeholder="">

     </div>

     </div>

     

    </div>

	

	<div class="col-md-4">

	<div class="radio light one_dollar_deal">

	<div class="control-label">

					<input type="radio" id="1deal" name="discount_price" onchange="makeRadioButtons()" value="1deal" class="radiogroup">

					<label for="1deal"><span></span>$1 Deal</label>

		</div>

		</div>

	</div>

	

    </div>

    </div>

  </div>

 



   <div class="form-group product_details_textarea other_part">

    <label for=" " class="col-md-4 control-label">Product Details:<span class="required-field">*</span><br>(Max. 2000 Words)</label>

    <div class="col-md-8">

	<div class="launch-form-field">

      <textarea class="form-control  jqte-test" id="product_details" name="product_details" placeholder="" cols="10" rows="10"></textarea>

      <span  id="product_details_count"></span>

    </div>

    </div>

  </div>

  

  <?php

  

            $categories = get_categories_list();

  ?>

  

  

    <div class="form-group other_part">

    <label for="inputPassword3" class="col-md-4 control-label">Category:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="row">

	<div class="col-md-7">

	<div class="launch-form-field">

	<div class="input-group">

    <select class="form-control" id="product_category" name="product_category">

        <option value="0">Choose category</option>

        <?php 

        foreach($categories as $category)

        {

           ?><option value="<?php echo $category->cid; ?>"><?php echo $category->name; ?></option><?php     

        }

        ?>

    </select>

     </div>

     </div>

    </div>

    </div>

    </div>

  </div>

  

  

    <div class="form-group other_part">

    <label for=" " class="col-md-4 control-label">Discount Code Given:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="row">

	<div class="col-md-4">

	<div class="radio light">

	<div class="launch-form-field control-label">

					<input type="radio" id="product_discount_unlimit" name="product_discount" value="product_discount_unlimit" class="radiogroup" checked="checked">

					<label for="product_discount_unlimit"><span></span>Unlimited</label>

	</div>

	</div>

	</div>

	

	<div class="clearfix"></div>

	

	<div class="col-md-12 discount">

	<div class="radio light">

	<div class="launch-form-field control-label">

					<input type="radio" id="product_discount_limit" name="product_discount" value="product_discount_limit" class="radiogroup">

					<label for="product_discount_limit"><span></span>Limit</label>

	</div> 

	<input type="text" name="product_discount_limit_count" id="product_discount_limit_count" class="form-control inline-field w119"><span>discount codes given within 1 day</span></div>

	</div>

	</div>

	

    </div>

    </div>

  <div class="clearfix"></div>

  <div class="form-group other_part">

    <label for=" " class="col-sm-4 control-label pt0"><span class="text-center">Discount Code Upload:<span class="required-field">*</span><br>(.txt file)</span></label>

    <div class="col-sm-3">

	<div class="launch-form-field">

       <?php /* <button type="submit" class="btn gray-light-btn">Upload</button> */ ?>

       <input type="file" name="product_discount_code_file" id="product_discount_code_file"  class="inputfile" />

		<label for="product_discount_code_file">Upload</label>

	   

    </div>

    </div>

<div class="col-sm-4 select_file_name" id="select_file_name"></div>
  </div>



  

  

   <div class="form-group launch-time other_part">

    <label for=" " class="col-md-4 control-label">Launch Time on DRC:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="row">

	<div class="col-sm-4 clearfix">

	<div class="radio light">

	<div class="launch-form-field control-label">

					<input type="radio" id="product_launch_time_now" name="product_launch_time" value="product_launch_time_now" class="radiogroup" checked="checked">

					<label for="product_launch_time_now"><span></span>Now</label>

	</div>

	</div>

	</div>	

	<div class="col-sm-8 cutomize clearfix">

	<div class="radio light">

	<div class="control-label">

					<input type="radio" id="product_launch_time_custom" name="product_launch_time" value="product_launch_time_custom" class="radiogroup">

					<label for="product_launch_time_custom"><span></span>Customized</label>

					

					

	</div>

					<input type="text" name="product_launch_time_custom_date" id="product_launch_time_custom_date" class="form-control launch-time-field " placeholder="2015/12/18">

					<input type="text" name="product_launch_time_custom_time" id="product_launch_time_custom_time" class="form-control launch-date " placeholder="18:30">

	</div>

	</div>

	

	<div class="clearfix"></div>

	

	

	</div>

	

    </div>

    </div>

	

	<div class="form-group launch-time other_part">

    <label for=" " class="col-md-4 control-label">End Time:<span class="required-field">*</span></label>

    <div class="col-md-8 clearfix">

	<div class="row">

	<div class="col-sm-4 clearfix pr0">

	<div class="radio light">

	<div class="launch-form-field control-label">

					<input type="radio" id="product_end_time_after14" name="product_end_time" value="product_end_time_after14" class="radiogroup" checked="checked">

					<label for="product_end_time_after14"><span></span>After 14 days</label>

	</div>

	</div>

	</div>	

	<div class="col-sm-8 cutomize clearfix">

	<div class="radio light">

	<div class="control-label">

					<input type="radio" id="product_end_time_custom" name="product_end_time" value="product_end_time_custom" class="radiogroup">

					<label for="product_end_time_custom"><span></span>Customized</label>

					

					

	</div>

					<input type="text" name="product_end_time_custom_date" id="product_end_time_custom_date" class="form-control launch-time-field " placeholder="2015/12/18">

					<input type="text" name="product_end_time_custom_time" id="product_end_time_custom_time" class="form-control launch-date " placeholder="18:30">

	</div>

	<div class="clearfix"></div>

	

	

	

	</div>

	

	

	<div class="clearfix"></div>

	<div class="col-md-12 discount_codes">

	<div class="radio light ">

	<div class="launch-form-field control-label ">

					<input type="radio" id="product_end_time_until" name="product_end_time" value="product_end_time_until" class="radiogroup">

					<label for="product_end_time_until"><span></span>Until</label>

	</div>

			<input type="text" name="product_end_time_until_count" id="product_end_time_until_count" class="form-control inline-field w92" placeholder="500"  onfocus="this.placeholder = ''" onblur="this.placeholder = '500'" />

				<span class="extra_label">discount codes in total been given away</span>

	</div>

	<p class=" launch-form-field note">(You could manually stop anytime at "My Product Review Status")</p>

	

	

	</div>

	</div>

	

	

    </div>

    </div>

	

	

	

	





<div class="form-group other_part">

    <label for=" " class="col-md-4 control-label">Code Access Condition:<span class="required-field">*</span></label>

    <div class="col-md-8 clearfix">

	<div class="radio light">

	<ul class="radio_list">

	<li class="clearfix">

			<div class="launch-form-field control-label">

							<input type="radio" id="product_code_access_condition_none" name="product_code_access_condition" value="product_code_access_condition_none" class="radiogroup" checked="checked">

							<label for="product_code_access_condition_none"><span></span>None: Anyone can access your discount code</label>

			</div>

	</li>

	



	<li class="clearfix">

			<div class="launch-form-field control-label">

							<input type="radio" id="product_code_access_condition_custom" name="product_code_access_condition" class="radiogroup" value="product_code_access_condition_custom">

							<label for="product_code_access_condition_custom"><span></span>Auto-Approval: Automatically approve customers with </label>

			</div>

			<input type="text" id="product_code_access_condition_custom_count" name="product_code_access_condition_custom_count" class="form-control inline-field w92" placeholder="1">

			<span> or more reviews.</span>

			

			

			

	</li>



	<li class="clearfix">

			<div class="launch-form-field control-label">

							<input type="radio" id="product_code_access_condition_manual" name="product_code_access_condition" value="product_code_access_condition_manual" class="radiogroup " >

							<label for="product_code_access_condition_manual"><span></span>Manual Approval: You decide who receives your discount code.</label>

			</div>

	</li>

	</ul>

	</div>

	



	

	<div class="clearfix"></div>

	

	



	

    </div>

    </div>	

 

 <div class="form-group other_part">

    <label for=" " class="col-md-4 control-label">Review Suggestion to Customer:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="radio light">

		<ul class="radio_list sec_list">

	<li class="clearfix suggetion_none">

			<div class="launch-form-field control-label">

							<input type="radio" id="review_suggetion_none" name="review_suggetion_none" value="review_suggetion_none" class="radiogroup">

							<label for="review_suggetion_none"><span></span>None</label>

			</div>

	</li>

	



	<li class="clearfix suggetion_yes">

			<div class="launch-form-field control-label">

							<input type="checkbox" value="review_suggetion_custom" id="review_suggetion_custom" name="review_suggetion[]" class="radiogroup">

							<label for="review_suggetion_custom"><span></span>Each review should at least >=</label>

			</div>

			<input type="text" id="review_suggetion_custom_count" name="review_suggetion_custom_count" class="form-control inline-field w92" placeholder="150">

			<span>words</span>

			

			

			

	</li>



	<li class="clearfix suggetion_yes">

			<div class="launch-form-field control-label">

							<input type="checkbox" value="review_suggetion_video" id="review_suggetion_video" name="review_suggetion[]" class="radiogroup " >

							<label for="review_suggetion_video"><span></span>Video or Photo needed</label>

			</div>

	</li>

	</ul>

	<p class=" launch-form-field note">(You CAN NOT force customers to write reviews of the product so we advise you to suggest them in text)</p>

	</div>

	



	

	<div class="clearfix"></div>

    </div>

    </div>	

	

	

	 <div class="form-group upload_photo other_part">

    <label for=" " class="col-md-4 control-label">Upload Photos:<span class="required-field">*</span></label>

    <div class="col-md-8">

	<div class="launch-form-field">

      <?php /* <button type="submit" class="btn gray-light-btn">Upload Cover photo</button> */ ?>

      <input type="file" name="product_cover_pic" id="product_cover_pic"  class="inputfile"  />

      <label for="product_cover_pic">Upload Cover photo</label>

	  <div class="clearfix"></div>

	  <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive upload_img" id="product_cover_pic_preview"> 

      <input type="hidden" name="product_cover_pic_val" id="product_cover_pic_val" value="0" />    

      

      

      <input type="file" name="product_other_pic[]" id="product_other_pic" multiple="multiple"  class="inputfile"  />

      <label for="product_other_pic">Upload Other photos</label>

	  <span class="max_photos">(Max. 8 Photos)</span>

	  </div>

    

	

	<ul class="other_photos list-inline">

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_0"><input type="hidden" name="product_other_pic_val_0" id="product_other_pic_val_0" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_1"><input type="hidden" name="product_other_pic_val_1" id="product_other_pic_val_1" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_2"><input type="hidden" name="product_other_pic_val_2" id="product_other_pic_val_2" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_3"><input type="hidden" name="product_other_pic_val_3" id="product_other_pic_val_3" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_4"><input type="hidden" name="product_other_pic_val_4" id="product_other_pic_val_4" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_5"><input type="hidden" name="product_other_pic_val_5" id="product_other_pic_val_5" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_6"><input type="hidden" name="product_other_pic_val_6" id="product_other_pic_val_6" value="0" />     </li>

		<li> <img src="<?php echo new_assets_url('img/upload_photo.jpg') ?>" class="img-responsive other_photo"  id="product_other_pic_preview_7"><input type="hidden" name="product_other_pic_val_7" id="product_other_pic_val_7" value="0" />     </li>

		

	

	</ul>

	<input type="hidden" name="aspect_ratio_error_occur" id="aspect_ratio_error_occur" value="no" />

	<input type="hidden" name="aspect_ratio_error_accept" id="aspect_ratio_error_accept" value="no" />

	 <div class="form-group other_part">

    <div class="multi_btns">

      <button type="button" class="btn gray-light-btn"  data-toggle="modal" data-dismiss="modal" data-target="#myModal41">Cancel</button>

      <button type="button" class="btn gray-light-btn" onclick="set_preview();" data-toggle="modal" data-target="#myModal">Preview</button>

      <button type="button" class="btn btn-org" data-toggle="modal" data-dismiss="modal" data-target="#myModal45">Launch</button>

    </div>

  </div>

	</div>

  </div>



 





 

</form>

			

			

		

		</div><!-- launch_productproduct -->

		

		</div> <!-- w900 -->

		</div> <!-- content -->	

	<div class="clearfix"></div>

	</div>

</div>

</div> <!-- innerpage close -->



  <!-- Modal -->

<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal41" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

	<div class="slant270"></div>

	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>

      <div class="modal-body text-center">

			<h3>Sure to Relaunch this Product ?</h3>

			<p>You will go to Launching page for further detail adjusting.</p>

			<a href="<?php echo site_url('companies/campaign/launch_new'); ?>"><button type="button" class="btn btn185_73" >Yes</button></a>

			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" >No</button>

			

      </div>



    </div>

  </div>



</div>





   

  <!-- Modal -->

<div class="modal fade thank_you not_log_in launch_product_popup" id="myModal45" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

	<div class="slant270"></div>

	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>

      <div class="modal-body text-center">

			<h3>Are you sure you want to launch this product?</h3>

			<p>You will not be able to edit any information about this product after the launch. Are you sure you want to launch it now?<span class="tiny-light-text">(You can manually stop it anytime at "My Product Review Status")</span>

			</p>

			

			

			<button type="button" id="confirm_submit" class="btn btn185_73" data-dismiss="modal" data-toggle="modal" >Launch</button>

			<button type="button" class="btn gray-btn btn185_73" data-dismiss="modal" data-toggle="modal" data-dismiss="modal" data-target="#myModal2" >Back</button>

			

      </div>



    </div>

  </div>



</div>



  

  

  <!-- Modal -->

<div class="modal fade thank_you not_log_in launch_product_popup asin" id="myModal46" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

	<div class="slant270"></div>

	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>

      <div class="modal-body">

			<h3>Amazon Product ASIN</h3>

			<p>All items in Amazon.com catalog are identified by 10-digit ASINs (Amazon Standard Identification Numbers).</p>

 <p>When you are on the product page,you just need to scroll down to "Product Information" section and you will see the ASIN, such as:</p>

			

			

		<img src="<?php echo new_assets_url('img/link_file.jpg') ?>" class="img-responsive" alt="">

			

      </div>



    </div>

  </div>



</div>

<script>



function set_preview()

{

    //$('#product_thumb_img0').attr('src','');
    //$('#product_img0').attr('src','');
    //$('#product_thumb_img0').closest('li').addClass("active");
    //$('#product_img0').closest('div').addClass("active");
    for(index = 0; index<=8; index++)
    {
        $('#product_thumb_img'+index).closest('li').remove();
        $('#product_img'+index).closest('div').remove();
    }
    var index = 0;
    if($('#product_cover_pic_val').val() != '0')
        {
            
            $(".carousel-inner").append('<div class="item"><img id="product_img'+index+'" src="'+$('#product_cover_pic_preview').attr('src')+'" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;" /></div>');
                  
            $(".carousel-indicators").append('<li data-target="#carousel-custom" data-slide-to="'+index+'"><img id="product_thumb_img'+index+'" src="'+$('#product_cover_pic_preview').attr('src')+'" alt="" height="65" width="65" /></li>');
                  
            /*$('#product_img'+new_index).attr('src',$('#product_cover_pic_preview').attr('src'));
                $('#product_thumb_img'+new_index).attr('src',$('#product_cover_pic_preview').attr('src'));*/
                index++;
        }
        
        
    
    for(new_index = 0; new_index<8; new_index++)
    {
        //old_index = new_index - 1;
        if($('#product_other_pic_val_'+new_index).val() != '0')
        {
            
            $(".carousel-inner").append('<div class="item"><img id="product_img'+index+'" src="'+$('#product_other_pic_preview_'+new_index).attr('src')+'" alt="" height="300" width="299" class="img-responsive center-block" style="height: 299px;" /></div>');
                  
            $(".carousel-indicators").append('<li data-target="#carousel-custom" data-slide-to="'+index+'"><img id="product_thumb_img'+index+'" src="'+$('#product_other_pic_preview_'+new_index).attr('src')+'" alt="" height="65" width="65" /></li>');
                  
            /*$('#product_img'+index).attr('src',$('#product_other_pic_preview_'+new_index).attr('src'));
                $('#product_thumb_img'+index).attr('src',$('#product_other_pic_preview_'+new_index).attr('src'));*/
                index++;
        }
    
                  
     }        
                $('#time_left').hide();
                $('#product_amazonLink').attr('href',$('#aws_url').val());
                $( ".carousel-inner div" ).first().addClass("active");
                $( ".carousel-indicators li" ).first().addClass("active");
                /*$('#product_img0').attr('src',$('#product_cover_pic_preview').attr('src'));
                $('#product_thumb_img0').attr('src',$('#product_cover_pic_preview').attr('src'));
                
                $('#product_img1').attr('src',$('#product_other_pic_preview_0').attr('src'));
                $('#product_thumb_img1').attr('src',$('#product_other_pic_preview_0').attr('src'));
                
                $('#product_img2').attr('src',$('#product_other_pic_preview_1').attr('src'));
                $('#product_thumb_img2').attr('src',$('#product_other_pic_preview_1').attr('src'));
                
                $('#product_img3').attr('src',$('#product_other_pic_preview_2').attr('src'));
                $('#product_thumb_img3').attr('src',$('#product_other_pic_preview_2').attr('src'));
                
                $('#product_img4').attr('src',$('#product_other_pic_preview_3').attr('src'));
                $('#product_thumb_img4').attr('src',$('#product_other_pic_preview_3').attr('src'));
                
                $('#product_img5').attr('src',$('#product_other_pic_preview_4').attr('src'));
                $('#product_thumb_img5').attr('src',$('#product_other_pic_preview_4').attr('src'));
                
                $('#product_img6').attr('src',$('#product_other_pic_preview_5').attr('src'));
                $('#product_thumb_img6').attr('src',$('#product_other_pic_preview_5').attr('src'));
                
                $('#product_img07').attr('src',$('#product_other_pic_preview_6').attr('src'));
                $('#product_thumb_img7').attr('src',$('#product_other_pic_preview_6').attr('src'));
                
                $('#product_img8').attr('src',$('#product_other_pic_preview_7').attr('src'));
                $('#product_thumb_img8').attr('src',$('#product_other_pic_preview_7').attr('src'));*/

                

                

                $('.product_titles').html($('#product_title').val());

                $('#belong_company').html('<?php echo $user->fname; ?>');
                
                var previousValue = $("input[name='review_suggetion_none']").attr('previousValue');
                $('#product_review_suggestion').html('');
                if (previousValue == 'checked')
                {
                    $('#product_review_suggestion').html('- None');
                }
                else
                {
                    if($('#review_suggetion_custom').is(':checked')) 
                    {
                        $( "#product_review_suggestion" ).append( "- "+$('#review_suggetion_custom_count').val()+" words or above <br>" );
                    }
                    if($('#review_suggetion_video').is(':checked')) 
                    {
                        $( "#product_review_suggestion" ).append( "- At least 1 photo and/or video <br>" );
                    }
                }

                $('.product_details').html($('#product_details').val());

                if(!parseInt($('#product_discount_price').val()) >0)

                {

                    var product_new_price = 1;

                }

                else

                {

                    var product_new_price = $('#product_discount_price').val();                    

                }

                $('#product_new_price').html('<span>$</span>'+product_new_price);

                $('#product_original_price').html('<strike>$'+$('#product_price').val()+'</strike>');

                

                var subtract_off = $('#product_price').val() - product_new_price;

                var calculate_off = subtract_off/$('#product_price').val();

                var off = calculate_off*100;

                //console.log(subtract_off+' '+calculate_off+' '+off)

                

                $('#product_off').html(parseFloat(off).toFixed(2)+'% OFF');

                

                



}









//launch_form

$( "#confirm_submit" ).click(function() {

  $( "#launch_form" ).submit();

});

$(function() {

$( "#product_discount_code_file" ).change(function() {
  var file = $('#product_discount_code_file')[0].files[0]
if(file){
  $('#select_file_name').html(file.name);
}

});
	$(document).on("submit", "form#launch_form", function(e) {

       var data = new FormData($('#launch_form')[0]);

       var _alert = $("#launch_form_Alert");

		e.preventDefault();

		$.ajax({

		  

            type:"POST",

			url 			:"<?php echo site_url('companies/campaign/create_new'); ?>", 

			dataType		: 'json',

			data			: data,

            contentType: false,

            cache: false,

            processData: false,

            mimeType: "multipart/form-data",

                beforeSend: function() {

                    _alert.html('<div class="alert alert-success">Please wait...</div>').show();

                    $("html, body").animate({ scrollTop: 0 }, "slow");

                },

                error: function() {

                    _alert.html('<div class="alert alert-danger">Error in server scripting</div>').show();

                    $("html, body").animate({ scrollTop: 0 }, "slow");

                },

                success: function(r) {

                    if (r.res) {

                        

                                _alert.html(r.msg).show();

                                //alert(r.msg);

                       if (r.haserror == 1) {

                        $("html, body").animate({ scrollTop: 0 }, "slow");

                       }

                       else if (r.haserror == 0) {

                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        setTimeout(function(){ window.location.href = "<?php echo site_url('companies/my_account?tab=review_status'); ?>"; }, 1000);

                       }         

                        

                    } 

                }

		});

		return false;

	});

});


	$('.jqte-test').jqte();

</script>