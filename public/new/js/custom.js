$('.form_area .radio label').on('click', function(){
    $(this).parent().addClass('current').siblings().removeClass('current');
});


$('.owl-carousel').owlCarousel({
    stagePadding: 128,
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
		300:{
            items:1
        },
		
        400:{
            items:1
        },
		700:{
            items:2
        },
		800:{
            items:3
        }
    }
})


/*range slider*/
/*$('.range-slider').jRange({
			from: 10,
			to: 40,
			step: 1,
			//scale: [0,25,50,75,100],
			format: '%s',
			width: 203,
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
		
	*/	
/* signup customer validation section */		
	$(document).ready(function() {
		var $validator = $("#sellerForm").validate({
		  rules: {
		    email: {
		      required: true,
		      email: true,
		      minlength: 3
		    },  
			yna: {
		      required: true,
		      minlength: 3
		    },
			yappl: {
		      required: true
		     
		    },
		    pass: {
		      required: true,
		      minlength: 8,
			  maxlength: 20,
		      
		    },
			con_pass: {
				required: true,
				minlength: 8,
				maxlength: 20,
				equalTo: "#pwd"
		    },
		    /*fav_cat: {
				required: true,
		    }*/
		  },
		   highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
		});

	  	$('#rootwizard-customer').bootstrapWizard({
	  		'tabClass': 'nav nav-pills',
	  		'onNext': function(tab, navigation, index) {
	  			var $valid = $("#sellerForm").valid();
	  			if(!$valid) {
	  				$validator.focusInvalid();
	  				return false;
	  			}/*
	  			else if($("#selected_val").val() == '') {
	  			  
                    var _alert = $("#signup_shopper_form_Alert");
	  			  _alert.html('<div class="alert alert-danger">You have to accept our terms.</div>').show();
	  				$("#fav_cat").focus();
	  				return false;
	  			}*/
	  			else if($("#terms").prop('checked') != true) {
	  			  
                    var _alert = $("#signup_shopper_form_Alert");
                        $("html, body").animate({ scrollTop: 0 }, "slow");
	  			  _alert.html('<div class="alert alert-danger">You have to accept our terms.</div>').show();
	  				$("#terms").focus();
	  				return false;
	  			}
	  			else if($("#current_step").val() == '1') {
	  			  var signup_error = '';
	  			   var data = new FormData($('#sellerForm')[0]);
                    var _alert = $("#signup_shopper_form_Alert");
                    $.ajax({
		  
                    type:"POST",
        			url 			:$('#1st_step_ajax_url').val(), 
        			dataType		: 'json',
        			data			: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                        beforeSend: function() {
                            _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                        },
                        success: function(r) {
                            //console.log(r);
                            if (r.res) {
                                if (r.signup_error) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                _alert.html(r.msg).show();
                                return false;
                                } else {
                                _alert.html(r.msg).hide();
                                $("#current_step").val('2');
	  				             
                                    $("#tab1").removeClass( "active" );
                                    $("#tab2").addClass( "active" );
                                    var total = navigation.find('li').length;
                    				var current = index + 1;
                                    //console.log('total'+total+'index'+index+'current'+current);
                    				var li_list = navigation.find('li');
                    				for (var i = 0; i < index; i++) {
                    					jQuery(li_list[i]).addClass("done");
                    					jQuery(li_list[i]).removeClass("active");
                    				}
                    					jQuery(li_list[index]).addClass("active");
                                    if(current >= total) {
                    					$('#rootwizard-customer').find('.pager .next').hide();
                    				} else {
                    					$('#rootwizard-customer').find('.pager .next').show();
                    				}
                                
                                
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                }
                            }
                        }
        		      });
                    return false;
	  			}
	  			else if($("#current_step").val() == '2') {
	  			  $("#amazon_link_marge").val('https://www.amazon.com/gp/profile/'+$("#amazon_link").val());
	  			  var amazon_name = $("#amazon_name").val();//console.log(amazon_name.length);	  			  
	  			    var data = new FormData($('#sellerForm')[0]);
                    var _alert = $("#signup_shopper_form_Alert");
	  			  if(amazon_name.length>20)
                  {
                    _alert.html('<div class="alert alert-danger">Amazon Name can not be greater than 20 character.</div>').show();
                    return false;
                  }
                  else if($("#amazon_link").val().length>14 || $("#amazon_link").val().length<13)
                  {
                    _alert.html('<div class="alert alert-danger">Please verify your amazon profile.</div>').show();
                    return false;
                  }
                  /* else if($("#amazon_profile_status").val()!='false')
                  {
                    _alert.html('<div class="alert alert-danger">Please verify your amazon profiless.</div>').show();
                    return false;
                  } */
	  			  
                  else{
                    $.ajax({
		  
                    type:"POST",
        			url 			:$('#ajax_url').val(), 
        			dataType		: 'json',
        			data			: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                        beforeSend: function() {
                            _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                        },
                        success: function(r) {
                            //console.log(r);
                            if (r.res) {
                                signup_error = r.signup_error;
                                if (r.signup_error) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                _alert.html(r.msg).show();
                                
                                return false;
                                
                                } else {
                                _alert.html(r.msg).hide();
                                $("#current_step").val('3');
	  				             
                                    $("#tab2").removeClass( "active" );
                                    $("#tab3").addClass( "active" );
                                    var total = navigation.find('li').length;
                                    var index = 2;
                    				var current = index + 1;
                                    //console.log('total'+total+'index'+index+'current'+current);
                    				var li_list = navigation.find('li');
                    				for (var i = 0; i < index; i++) {
                    					jQuery(li_list[i]).addClass("done");
                    					jQuery(li_list[i]).removeClass("active");
                    				}
                    					jQuery(li_list[index]).addClass("active");
                    					$('#rootwizard-customer').find('.pager .next').hide();
                    				
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                }
                            }
                        }
        		      });
                }
                return false;
	  			}
				/*var total = navigation.find('li').length;
				var current = index + 1;
				var li_list = navigation.find('li');
				for (var i = 0; i < index; i++) {
					jQuery(li_list[i]).addClass("done");
				}*/
	  		},
			'onTabClick': function(tab, navigation, index) {
				return false;
			},
			'onTabShow': function(tab, navigation, index) {
				/*var $total = navigation.find('li').length;
				var $current = index+1;
				if($current >= $total) {
					$('#rootwizard-customer').find('.pager .next').hide();
				} else {
					$('#rootwizard-customer').find('.pager .next').show();
				}*/
			}
		
		});
		
		/* category add option */
		/*var selected_items = $(".selected_items");
		$(".add").click(function(){
			 var text = $("#fav_cat option:selected").text();
			 var value = $("#fav_cat option:selected").val();
			 if (value === ''||value === '0') return;
				 $(selected_items).append("<div id='" + value + "'><span class='remove_item'></span><span  class='sel_val'>" + text + "</span></div>");
			
			//disbales the selected option
			$("#fav_cat option:selected").attr('disabled','disabled');
            if($("#fav_cat option:disabled").length == 3)
            { 
			 $("#fav_cat").attr('disabled','disabled');
            }
            selected_val='';
            $( ".selected_items" ).children('div').each(function(){ 
                id = $(this).attr('id');if(selected_val==''){selected_val = id;}else{selected_val = selected_val+','+id;}
			});
            $("#selected_val").val(selected_val);
			$("#fav_cat option:first").attr('selected','selected');
            
            if($("#fav_cat option:disabled").length >= 1){$("#fav_cat option:first").val("0");}
            else{$("#fav_cat option:first").val("");}
            //selected_val='';
            //console.log($("#fav_cat option:disabled").length);
			// show first option after add an option
			//var first_op = $("#fav_cat option:first").val("-1");
			$("#fav_cat").val($("#fav_cat option:first").val());

		}); 
		$(document).on('click','.remove_item',function(e){
			var $div = $(this).parent("div");
			var text = $div.find("span.sel_val").text();
			$("#fav_cat").removeAttr('disabled');
				
			$("#fav_cat option").each(function(){ 
				if($(this).text() === text ){
					//console.log("find");
					$div.remove();
					$(this).removeAttr('disabled');
				}
			});
            
            selected_val='';
            $( ".selected_items" ).children('div').each(function(){ 
                id = $(this).attr('id');if(selected_val==''){selected_val = id;}else{selected_val = selected_val+','+id;}
			});
            $("#selected_val").val(selected_val);
            
            if($("#fav_cat option:disabled").length >= 1){$("#fav_cat option:first").val("0");}
            else{$("#fav_cat option:first").val("");}
            
		});*/
	});	
/* end  signup customer validation section */		
/*signup seller validation section */	
$(document).ready(function() {
		var $validator = $("#regForm").validate({
		  rules: {
		    email: {
		      required: true,
		      email: true,
		      minlength: 3
		    },
		    cop_name: {
		      required: true,
		      minlength: 1
		    },
		    pass: {
		      required: true,
		      minlength: 8,
			  maxlength: 20,
		      
		    },
			cnf_pass: {
				required: true,
				minlength: 8,
				maxlength: 20,
				equalTo: "#pwd"
		    },
		    pro_cat: {
		      required: true,
		    }
		  },
		   highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
		});

	  	$('#rootwizard').bootstrapWizard({
	  		'tabClass': 'nav nav-pills',
	  		'onNext': function(tab, navigation, index) {
	  			var $valid = $("#regForm").valid();
	  			if(!$valid) {
	  				$validator.focusInvalid();
	  				return false;
	  			}
	  			else if($("#terms").prop('checked') != true) {
	  			  
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    var _alert = $("#signup_company_form_Alert");
	  			  _alert.html('<div class="alert alert-danger">You have to accept our terms.</div>').show();
	  				$("#terms").focus();
	  				return false;
	  			}
	  			else {
	  			    var data = new FormData($('#regForm')[0]);
                    var _alert = $("#signup_company_form_Alert");
                    $.ajax({
		  
                    type:"POST",
        			url 			:$('#ajax_url').val(), 
        			dataType		: 'json',
        			data			: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                            _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                        },
                    success: function(r) {
                            //console.log(r);
                            if (r.res) {
                                if (r.signup_error) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                _alert.html(r.msg).show();
                                //return false;
                                
                                } else {
                                _alert.html('').hide();
                                $("#tab1").removeClass( "active" );
                                $("#tab2").addClass( "active" );
                                var total = navigation.find('li').length;
                				var current = index + 1;
                				var li_list = navigation.find('li');
                				for (var i = 0; i < index; i++) {
                					jQuery(li_list[i]).addClass("done");
                					jQuery(li_list[i]).removeClass("active");
                				}
                					jQuery(li_list[index]).addClass("active");
                                if(current >= total) {
                					$('#rootwizard').find('.pager .next').hide();
                				} else {
                					$('#rootwizard').find('.pager .next').show();
                				}
                                    //return true;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                }
                            }
                        }
        		      });
                return false;
	  			}
	  		},
			'onTabClick': function(tab, navigation, index) {
				return false;
			},
			'onTabShow': function(tab, navigation, index) {
				/*var $total = navigation.find('li').length;
				var $current = index+1;
				if($current >= $total) {
					$('#rootwizard').find('.pager .next').hide();
				} else {
					$('#rootwizard').find('.pager .next').show();
				}*/
			}
		
		});
	});	
    
    function amazon_profile_verify(){
        var _alert = $("#signup_shopper_form_Alert");
	  	var data = new FormData($('#sellerForm')[0]);
        var _amazon_profile_status = $("#amazon_profile_status");
                    $.ajax({
		  
                    type:"POST",
        			url 			:$('#amazon_profile_ajax_url').val(), 
        			dataType		: 'json',
        			data			: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                        beforeSend: function() {
                            _alert.html('<div class="alert alert-success">Please wait...</div>').show();
                        },
                        success: function(r) {
                            //console.log(r);
                            //alert(r.res);
                            if (r.res) {
                                if (r.http_code != '200') {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                _alert.html(r.msg).show();
                                return false;
                                
                                } else {
                                _alert.html(r.msg).show();
                                $("#amazon_profile_status").val('true');
                                $("#amazon_profile_vote").val(r.vote);
                                $("#amazon_profile_rank").val(r.rank);
                                    return true;
                                }
                            }
                        }
        		      });
    }	
/*end  seller validation section */		

 function asin_value_verify(){
        var _alert = $("#launch_form_Alert");
	  	var data =  new FormData($('#launch_form')[0]);
        var _asin_verify = $("#asin_verify");
        var new_loading_img = $('#new_loading_img').val();
                    $.ajax({
		  
                    type:"POST",
        			url 			:$('#asin_verify_ajax_url').val(), 
        			dataType		: 'json',
        			data			: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                        beforeSend: function() {
                            //_alert.html('<div class="alert alert-success">Please wait...</div>').show();
                            _alert.html('<div class="alert alert-success"><img src="'+ new_loading_img +'" style="max-width: 178px;"/></div>').show();
                        },
                        success: function(r) {
                            //console.log(r);
                            //alert(r.res);
                            if (r.res) {
                                //alert('hi');
                                if (r.haserror != '0') {
                                _alert.html(r.msg).show();
                                _asin_verify.val('false');
                                $('.other_part').hide();
                                setTimeout(function(){ _alert.hide(); }, 2000);
                                //alert('1');
                                return true;
                                } else {
                                    show_progress_bar('0');
                                $( ".launch_new_product" ).removeClass( "small-bg-area" );
                                //_alert.html(r.msg).show();
                                _asin_verify.val('verified');
                                //$('.other_part').show();
                                //setTimeout(function(){ _alert.hide(); }, 1000);
                                $('#product_title').val(r.title);
                                $('#product_details').val(r.description);
                                $('#product_price').val(r.price);
                                $('.jqte_editor').html(r.description);
                                $.each(r.image, function(index, element) {
                                    //console.log('index '+index);
                                    if(index == 0)
                                    {
                                        $("#product_cover_pic_preview").attr("src", element); 
                                        $("#product_other_pic_preview").attr("onclick", "remove_cover_image_value()"); 
                                        $("#product_cover_pic_val").val(element); 
                                        //$("#product_cover_pic_preview").css("height", "257px");
                                        //$("#product_cover_pic_preview").css("width", "304px");
                                    }
                                    else
                                    {var new_index = index-1;
                                    //console.log('new_index '+new_index);
                                        $("#product_other_pic_preview_"+new_index).attr("src", element); 
                                        $("#product_other_pic_preview_"+new_index).attr("onclick", "remove_image_value("+new_index+")"); 
                                        $("#product_other_pic_val_"+new_index).val(element);
                                    }
                                });
                                /*var reader = new FileReader(); 
                                reader.readAsDataURL(files[image_no]);   
                                reader.onloadend = function() 
                                {   
                                    var src = this.result;
                                    $("#product_other_pic_preview_0").attr("src", src); 
                                    $("#product_other_pic_preview_0").attr("onclick", "remove_image_value(0)"); 
                                    $("#product_other_pic_val_0").val(src); }   */
                                //$('#product_price').val(r.price);
                                //$('#product_offer_price').val(r.Offer_amount);
                                //console.log(obj);
                                $('#aws_url').val(r.aws_url);
                                limits($('#product_title'), 150, 'product_title_count');
                                limits($('#product_details'), 2000, 'product_details_count');
                                $("#product_category option").each(function()
                                {
                                    // Add $(this).val() to your list
                                    if($(this).text() == r.category)
                                    $(this).prop("selected", true);
                                });
                                //alert('0');
                                //console.log(r.data->Item->ItemAttributes->Title);
                                    return true;
                                }
                            }
                        }
        		      });
    }
    
  function show_progress_bar(progress_percent)
  {
    var _alert = $("#launch_form_Alert");
    progress_percent = parseInt(progress_percent) + parseInt('20');
    if(progress_percent<=100)
    {
        _alert.html('<div class="progress"> <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:' + progress_percent + '%"> ' + progress_percent + '% </div> </div>').show();
        setTimeout(function(){ show_progress_bar(progress_percent); }, 1000);
    }
    else
    {
        _alert.html('<div class="alert alert-success">Asin verification Successful.</div>').show();
        $('.other_part').show();
        setTimeout(function(){ _alert.hide(); }, 1000);
    }
  }  
    
 $(document).ready(function() { 	

    $("#product_cover_pic").on("change", function()
    {
        $("#aspect_ratio_error_accept").val('no');
        $("#aspect_ratio_error_occur").val('no');
        var files = !!this.files ? this.files : [];
        //console.log(files);
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
            var src = this.result;
                
                var image = new Image();
                image.src = src;
                image.onload = function()  
                { 
                    if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no')
                    {
                        var accept = check_image_resolution(this.width, this.height); 
                    } 
                    else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') 
                    { 
                        var accept = false; 
                    } 
                    else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') 
                    { 
                        var accept = true; 
                    }
                     if(accept) 
                     { 
                        $("#product_cover_pic_preview").attr("src", src); $("#product_cover_pic_preview").attr("onclick", "remove_cover_image_value()"); $("#product_cover_pic_val").val(src); 
                     } 
                };
                $("#product_cover_pic_preview").css("height", "257px");
                $("#product_cover_pic_preview").css("width", "304px");
            }
        }
    });
    
    $("#product_other_pic").on("change", function()
    {
        
        $("#aspect_ratio_error_accept").val('no');
        $("#aspect_ratio_error_occur").val('no');
        var files = !!this.files ? this.files : [];
        var file_length = files.length ;
        var image_no = 0;
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if(image_no <file_length) { if ($("#product_other_pic_val_0").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_0").attr("src", src); $("#product_other_pic_preview_0").attr("onclick", "remove_image_value(0)"); $("#product_other_pic_val_0").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_1").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_1").attr("src", src); $("#product_other_pic_preview_1").attr("onclick", "remove_image_value(1)"); $("#product_other_pic_val_1").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_2").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_2").attr("src", src); $("#product_other_pic_preview_2").attr("onclick", "remove_image_value(2)"); $("#product_other_pic_val_2").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_3").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_3").attr("src", src); $("#product_other_pic_preview_3").attr("onclick", "remove_image_value(3)"); $("#product_other_pic_val_3").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_4").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_4").attr("src", src); $("#product_other_pic_preview_4").attr("onclick", "remove_image_value(4)"); $("#product_other_pic_val_4").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_5").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_5").attr("src", src); $("#product_other_pic_preview_5").attr("onclick", "remove_image_value(5)"); $("#product_other_pic_val_5").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_6").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_6").attr("src", src); $("#product_other_pic_preview_6").attr("onclick", "remove_image_value(6)"); $("#product_other_pic_val_6").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);

        if(image_no <file_length) { if ($("#product_other_pic_val_7").val() == '0' && /^image/.test( files[image_no].type)) {    var reader = new FileReader(); reader.readAsDataURL(files[image_no]);   reader.onloadend = function() {   var src = this.result;  var image = new Image();    image.src = src;  image.onload = function()  { if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='no'){var accept = check_image_resolution(this.width, this.height); } else if($("#aspect_ratio_error_accept").val()=='no' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = false; } else if($("#aspect_ratio_error_accept").val()=='yes' && $("#aspect_ratio_error_occur").val()=='yes') { var accept = true; } if(accept) { $("#product_other_pic_preview_7").attr("src", src); $("#product_other_pic_preview_7").attr("onclick", "remove_image_value(7)"); $("#product_other_pic_val_7").val(src); } }; };  image_no = image_no+1;  }  }
        //console.log(image_no+' '+file_length);


        

    });
    
});
 function remove_cover_image_value()
 {
    
    $("#product_cover_pic_preview").attr("src", 'http://www.dollarreviewclub.com/public/new/img/upload_photo.jpg');
    $("#product_cover_pic_preview").attr("onclick", "");
    $("#product_cover_pic_val").val('0');
 }
 
 function remove_image_value(id)
 {
    for(i=id;i<=6;i++)
    {
        var j = i+1;
        if($("#product_other_pic_val_"+j).val()!='0'){
            $("#product_other_pic_preview_"+i).attr("src", $("#product_other_pic_val_"+j).val());
            $("#product_other_pic_val_"+i).val($("#product_other_pic_val_"+j).val());
        }
        else
        {
            $("#product_other_pic_preview_"+i).attr("src", 'http://www.dollarreviewclub.com/beta_site/public/new/img/upload_photo.jpg');
            $("#product_other_pic_val_"+i).val('0');
        }
                
        $("#product_other_pic_preview_"+j).attr("src", 'http://www.dollarreviewclub.com/beta_site/public/new/img/upload_photo.jpg');
        $("#product_other_pic_val_"+j).val('0'); 
    }
    
 }
  function check_image_resolution(width, height)
 {
    //alert(width+"  "+height);
    product_pic_aspect_ratio = width/height;
            if(product_pic_aspect_ratio<1 || product_pic_aspect_ratio>1.33)
            {
                $("#aspect_ratio_error_occur").val('yes');
                var r = confirm("Suitable image size is 280x275. Your image will be distorted. Press ok to accept it or change your image ");
                if (r == true) {
                    $("#aspect_ratio_error_accept").val('yes');
                    return true;
                } else {
                    $("#aspect_ratio_error_accept").val('no');
                    return false;
                }
            }
            else
            {
                return true;
            }
 }   
    
    
   function wordCount( val ){
    var wom = val.match(/\S+/g);
    return {
        charactersNoSpaces : val.replace(/\s+/g, '').length,
        characters         : val.length,
        words              : wom ? wom.length : 0,
        lines              : val.split(/\r*\n/).length
    };
}
 /*
textarea.addEventListener("input", function(){
  var v = wordCount( this.value );
  result.innerHTML = (
      "<br>Characters (no spaces):  "+ v.charactersNoSpaces +
      "<br>Characters (and spaces): "+ v.characters +
      "<br>Words: "+ v.words +
      "<br>Lines: "+ v.lines
  );
}, false);*/

 function limits(obj, limit, result){

    var text = $(obj).val(); 
    var v = wordCount( text );

    if(v.words > limit){
        var trimmed = text.split(/\s+/, limit).join(" ");
      // Add a space at the end to make sure more typing creates new words
       $(obj).val(trimmed + " ");
       //console.log(trimmed);
     } else { // alert the user of the remaining char. I do alert here, but you can do any other thing you like
      $('#'+result).text(limit -v.words+ " words remaining!");
      //console.log(limit -length+ " characters remaining!");
     }
 }
/* function limits(obj, limit, result){

    var text = $(obj).val(); 
    var length = text.length;
    if(length > limit){
       $(obj).val(text.substr(0,limit));
     } else { // alert the user of the remaining char. I do alert here, but you can do any other thing you like
      $('#'+result).text(limit -length+ " characters remaining!");
      //console.log(limit -length+ " characters remaining!");
     }
 }*/
 
 $(document).ready(function(){
    var verify = $("#asin_verify").val();
    if(verify != 'verified')
    {
        $('.other_part').hide();
        $('#launch_verify').show();
        $( ".launch_new_product" ).addClass( "small-bg-area" );
    }
    

$("#asin_val").keyup(function(){
    $("#asin_verify").val('false');
    $('.other_part').hide();
    $('#launch_form_Alert').hide();
    $('#launch_verify').show();
    $( ".launch_new_product" ).addClass( "small-bg-area" );
});


$('#product_title').keyup(function(){

    limits($(this), 150, 'product_title_count');
});
$('#product_title').keydown(function(){

    limits($(this), 150, 'product_title_count');
});


$('#product_details').keyup(function(){

    limits($(this), 2000, 'product_details_count');
});
$('#product_details').keydown(function(){

    limits($(this), 2000, 'product_details_count');
});
$('#reviewSuggetionOther').keyup(function(){

    limits($(this), 150, 'reviewSuggetionOther_count');
});
$('#reviewSuggetionOther').keydown(function(){

    limits($(this), 150, 'reviewSuggetionOther_count');
});

$('.jqte_editor').keyup(function(){

    //limits($(this), 2000, 'product_details_count');
    limit = 2000;
    result = 'product_details_count';
        var text = $('.jqte_editor').text(); 
    var v = wordCount( text );

    if(v.words > limit){
        var trimmed = text.split(/\s+/, limit).join(" ");
      // Add a space at the end to make sure more typing creates new words
      $('.jqte_editor').text(trimmed + " ");
       //console.log(trimmed);
     } else { // alert the user of the remaining char. I do alert here, but you can do any other thing you like
      $('#'+result).text(limit -v.words+ " words remaining!");
      //console.log(limit -length+ " characters remaining!");
     }
     $('.product_details').html($('.jqte_editor').html());
     
});
$('.jqte_editor').keydown(function(){

    //limits($(this), 2000, 'product_details_count');
    limit = 2000;
    result = 'product_details_count';
        var text = $('.jqte_editor').text(); 
    var v = wordCount( text );

    if(v.words > limit){
        var trimmed = text.split(/\s+/, limit).join(" ");
      // Add a space at the end to make sure more typing creates new words
       $('.jqte_editor').text(trimmed + " ");
       //console.log(trimmed);
     } else { // alert the user of the remaining char. I do alert here, but you can do any other thing you like
      $('#'+result).text(limit -v.words+ " words remaining!");
      //console.log(limit -length+ " characters remaining!");
     }
     $('.product_details').html($('.jqte_editor').html());
});


  }); 


function makeRadioButtons(){
    if ($("input[name='discount_price']:checked").val()=='1deal') {
       $('#otherdeal_radio').show();
       $('#otherdeal_radio_field').hide();
       $('#product_discount_price').val('1'); 
    }
    else {
       $('#otherdeal_radio').hide();
       $('#otherdeal_radio_field').show();
    }
 }		
 
 $(document).ready(function() {
 	/*show notification_list*/
	
	$("a.notification").click(function(){
        $(".notification_list").toggle();
    });
	
	/*show login status */
	$(".small_menu").click(function(){
        $(".log_in_status").toggle();
    });
    
    /*enable account edit*/
    $('#prepare_edit').click(function(){
        $("#my_account").removeClass('in active');
        $("#my_account_edit").addClass('in active');
    });
    
    var height = 0;
                $('.product-img').each(function(){
                  height = Math.max( height, $(this).outerHeight() )
                });
                $('.product-img').outerHeight(height);
     
    
     
     
 });	
 
 	
	  $(document).on('show','.accordion', function (e) {
         //$('.accordion-heading i').toggleClass(' ');
         $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });
    
    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });
 

    

$(document).ready(function() {
    
    var count_checked = $("[name='review_suggetion[]']:checked").length;
  var previousValue = $("input[name='review_suggetion_none']").attr('previousValue');
if(count_checked>0)
{
    $('.suggetion_none').hide();
    $('.suggetion_yes').show();
}
    
  else if (previousValue == 'checked')
  {
    $('.suggetion_none').show();
    $('.suggetion_yes').hide();
  }
  else
  {
    $('.suggetion_none').show();
    $('.suggetion_yes').show();
  }

    
    
    
    //$('#c14')
    $("input[name='review_suggetion_none']").click(function()
{
  var previousValue = $(this).attr('previousValue');
  var name = $(this).attr('name');

  if (previousValue == 'checked')
  {
    $('.suggetion_none').show();
    $('.suggetion_yes').show();
    $(this).removeAttr('checked');
    $(this).attr('previousValue', false);
  }
  else
  {
    $('.suggetion_none').show();
    $('.suggetion_yes').hide();
    $(this).attr('previousValue', 'checked');
  }
});

$("input[name='review_suggetion[]']").click(function()
{
var count_checked = $("[name='review_suggetion[]']:checked").length;
if(count_checked>0)
{
    $('.suggetion_none').hide();
    $('.suggetion_yes').show();
}
else
{
    $('.suggetion_none').show();
    $('.suggetion_yes').show();
}

}); 


/*$("#fav_cat").change(function()
{
    var selected_items = $(".selected_items");
        
	var text = $("#fav_cat option:selected").text();
	var value = $("#fav_cat option:selected").val();
	if (value === ''||value === '0') return;
	$(selected_items).append("<div id='" + value + "'><span class='remove_item'></span><span  class='sel_val'>" + text + "</span></div>");
			
	//disbales the selected option
	$("#fav_cat option:selected").attr('disabled','disabled');
    if($("#fav_cat option:disabled").length == 3)
    { 
	 $("#fav_cat").attr('disabled','disabled');
    }
    selected_val='';
    $( ".selected_items" ).children('div').each(function(){ 
       id = $(this).attr('id');if(selected_val==''){selected_val = id;}else{selected_val = selected_val+','+id;}
	});
    $("#selected_val").val(selected_val);
	$("#fav_cat option:first").attr('selected','selected');
            
    if($("#fav_cat option:disabled").length >= 1){$("#fav_cat option:first").val("0");}
    else{$("#fav_cat option:first").val("");}
	$("#fav_cat").val($("#fav_cat option:first").val());
  });*/
    
    
});
