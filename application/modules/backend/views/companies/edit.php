
  
  
  <div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <form action="#" method="post" id="stContentForm">
<?php 
$getUsermata_category = getUsermata($user->id, 'category');
$get_category= unserialize($getUsermata_category->mval);
$get_category_details = get_category($get_category[0]);
//echo $uid.' '.$hash; 
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
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Company Name</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $user->fname; ?>"  />
                </div>
            </div>        
        </div>
        
        <div class="row-fluid">        
            <div class="span11">
                <div class="input">
                    <label for="title">Main Product Category</label>
                    
					<select class="form-control" name ="fav_cat_main" id ="fav_cat_main" placeholder="Choose Category" style="border: 1px solid #ccc;">
						<option value="0">Choose category</option>
                                    <?php
                                         foreach (get_categories_list() as $cat) {
                                            if($get_category_details->cid == $cat->cid){$selected = 'selected="selected"';}else{$selected = '';}
                                    ?>
                                        <option value="<?php echo $cat->cid; ?>" <?php echo $selected; ?> ><?php echo $cat->name; ?></option>
                                    <?php
                                         }
                                    ?>
					</select>
                </div>
            </div>        
        </div>
        
                
        <div class="row-fluid" style="display: none;">
            <div class="span11">
                <div class="control-group">
                    <label class="control-label">After submit redirect</label>
                    <div class="controls">
                        <label class="radio"><div class="radio"><span><input type="radio" value="false" name="redirect"></span></div>All Pages</label>
                        <label class="radio"><div class="radio"><span><input type="radio" checked="" value="true" name="redirect"></span></div>Stay Here</label>
                    </div>
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
                url: "<?php echo site_url('backend/companies/update_company_account'); ?>",
                beforeSend: function() {
                    _alert.addClass("alert-success").text("Please wait...").show();
                },
                error: function() {
                    _alert.addClass("alert-danger").text("Error in server scripting").show();
                },
                success: function(r) {
                    if (r.haserror == '0') {
                        _alert.addClass("alert-success").text(r.msg).show();
                        //_this[0].reset();
                        //$("#editor").html("");

                        
                        
                    } else {
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