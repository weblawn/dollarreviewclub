<style>
.selected_items:last-child span{}
.selected_items {
        color: #787885;
        font-size: 20px;
}

.selected_items span.remove_item {
	background: url(../../../public/new/img/remove.png) center center no-repeat;
	display: inline-block;
	height: 15px;
	width: 15px;
	margin-right: 12px
}
div.checker {
    display: none!important;
}

</style>
<link rel="stylesheet" href="<?php echo new_assets_url('css/jquery.multiselect.css') ?>" type="text/css"/>

<script src="<?php echo new_assets_url('js/jquery.multiselect.js') ?>"></script>
  <script>/*
$(document).ready(function() {
$("#fav_cat").change(function()
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
  });
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
  </script>
  
  <div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stContentForm">
<?php 
$getUsermata_category = getUsermata($user->id, 'category');
$get_categories= unserialize($getUsermata_category->mval);
$get_category_details = get_category($get_category[0]);
$getUsermata_amazon_url = getUsermata($user->id, 'amazon_url');         $getUsermata_amazon_url     = $getUsermata_amazon_url->mval;

//echo $uid.' '.$hash; 
//print_r($get_category);
//print_r($get_category_details);
//print_r($user); 
?>
                    <input type="hidden" name="uid" class="form-control" value="<?php echo $uid; ?>" readonly="readonly" />
                    <input type="hidden" name="hash" class="form-control" value="<?php echo $hash; ?>" readonly="readonly" />

        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $user->email; ?>"  />
                </div>
            </div>        
        </div>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Password</label>
                    <input type="password" name="pass" class="form-control" value=""  />
                </div>
            </div>        
        </div>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Confirm Password</label>
                    <input type="password" name="cpass" class="form-control" value=""  />
                </div>
            </div>        
        </div>
        
        <?php /*<div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Favorite product category</label>
                    
					<?php
            $ids = '';
            foreach ($get_categories as $get_category)
            {
                if($ids == ''){$ids = $get_category;}else{$ids .= ','.$get_category;}
            }//disabled="disabled"
            if(count($get_categories)>=3){$disabled='disabled="disabled"';}else{$disabled='';} ?>
<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" placeholder="Choose Category" <?php echo $disabled; ?> >
						<option value="">Choose category</option>
                        <?php
                             foreach (get_categories_list() as $cat) {
                                if(in_array($cat->cid, $get_categories)){$disabled='disabled="disabled"';}else{$disabled='';} 
                        ?>
                             <option value="<?php echo $cat->cid; ?>" <?php echo $disabled; ?>><?php echo $cat->name; ?></option>
                        <?php
                             }
                        ?>
					</select>
                     <input type="hidden" id="selected_val" name="selected_val" value="<?php echo $ids; ?>" />
                    
			
				<div class="clearfix"></div>
				<div class="selected_items">
                
                
                <?php
            foreach ($get_categories as $get_category)
            {
                $get_category_details = get_category($get_category);
                echo '<div id="'.$get_category_details->cid.'"><span class="remove_item"></span><span class="sel_val">'.$get_category_details->name.'</span></div>';
                
            }
            ?>
            </div>
                    
        		<div class="clearfix"></div><div class="clearfix"></div>
    
                </div>
            </div>        
        </div>*/?>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Favorite product category</label>
                    
					<?php
            $ids = '';
            foreach ($get_categories as $get_category)
            {
                if($ids == ''){$ids = $get_category;}else{$ids .= ','.$get_category;}
            }//disabled="disabled"
            //if(count($get_categories)>=3){$disabled='disabled="disabled"';}else{$disabled='';} ?>
<select class="form-control cat_control" name ="fav_cat" id ="fav_cat" placeholder="Choose Category" multiple="multiple" >
						
                        <?php
                             foreach (get_categories_list() as $cat) {
                                if(in_array($cat->cid, $get_categories)){$disabled='selected="selected"';}else{$disabled='';} 
                        ?>
                             <option value="<?php echo $cat->cid; ?>" <?php echo $disabled; ?>><?php echo $cat->name; ?></option>
                        <?php
                             }
                        ?>
					</select>
                     <input type="hidden" id="selected_val" name="selected_val" value="<?php echo $ids; ?>" />
                    
			
				<div class="clearfix"></div>
				<div class="selected_items">
                
                
                <?php
            foreach ($get_categories as $get_category)
            {
                $get_category_details = get_category($get_category);
                echo '<span>'.$get_category_details->name.'</span>';
                
            }
            ?>
            </div>
                    
        		<div class="clearfix"></div><div class="clearfix"></div>
    
                </div>
            </div>        
        </div>
        
 <script>
$('#fav_cat').multiselect({
    columns: 1,
    placeholder: 'Choose category',
    maxSelect: 3
});

</script> 
        <br />
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Name on Amazon</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $user->fname; ?>"  />
                </div>
            </div>        
        </div>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Amazon profile link</label>
                    <input type="text" name="amazon_url" class="form-control" value="<?php echo $getUsermata_amazon_url; ?>"  />
                </div>
            </div>        
        </div>
        
        <div class="row-fluid">
            <div class="span11">
                <br/><input type="submit" value="Update" class="btn green" /><br/><br/>
            </div>
        </div>     
        
    </form>
    <div class="stAlert alert alert-danger" style="display: none;"></div>
</div>
<!-- END PAGE CONTAINER-->

<script>
    $(function() {

        /*
         * Submit form
         */
        $(document).on("submit", "form#stContentForm", function(e) {
            e.preventDefault();

            
            var _this = $(this), _formData = _this.serializeArray();

            var _alert = $(".stAlert");

            _alert.attr("class", _alert.attr("class").replace(/(^|\s)alert-\S+/g, ""));

            // Get content editor text
            //_formData.push({name: "content", value: $("#editor").val()});
            //_formData.push({name: "content", value: $(".fr-code").val()});

            $.ajax({
                type: "POST",
                dataType: "json",
                data: _formData,
                url: "<?php echo site_url('backend/shopper/update_shopper_account'); ?>",
                beforeSend: function() {
                    _alert.addClass("alert-success").text("Please wait...").show();
                },
                error: function() {
                    _alert.addClass("alert-danger").text("Error in server scripting").show();
                },
                success: function(r) {
                    if (r.haserror == '0') {
                        _alert.removeClass("alert-danger");
                        _alert.addClass("alert-success").text(r.msg).show();
                        //_this[0].reset();
                        //$("#editor").html("");

                        
                        
                    } else {
                        _alert.removeClass("alert-success");
                        if (r.redirect) {
                            window.location.href = r.redirect;
                        }
                        _alert.addClass("alert-danger").text(r.msg).show();
                    }
                }
            });
        });


window.prettyPrint && prettyPrint();
    });
</script>