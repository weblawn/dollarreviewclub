<style>
.col-xs-12 {
    width: 100%;
    float: left;
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
.col-xs-6 {
    width: 50%;
    float: left;
    position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
</style>

<div class="subheader">
    <nav role="navigation" class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="row-fluid">
                <div class="span4 offset0">
                    <h3 class="page-title">&nbsp;PERSONALIZATION</h3>
                </div>
            </div>
        </div>
    </nav>
</div>
<script>
$(function() {
        var max = 4;
        var checkboxes = $('input[type="checkbox"].interests');

        checkboxes.change(function () {
            var current = checkboxes.filter(':checked').length;
            checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
            var arr = [];
            $(".interests:checked").each(function () {
                arr.push($(this).val());
                $('#user_interest').val(arr);
            });
        });
        
    });
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span6 offset3">
            <div class="card">
                
                
                    <div class="text-center">
                        <h2>One Last Thing!</h2>
                        <p>
                            You'll be snagging deals in no time.
                        </p>
                        <p class="alert alert-danger isAlert" style="display:none;"></p>
                    </div>

                    <div class="row-fluid">
                        <div class="col-xs-12">
                            <h4>Choose Up To 4 Categories That Interest You</h4>
                        </div>
                        <div class="col-xs-6">
                        <?php
                                                        foreach (get_categories_list() as $cat) {
                                                            ?>
                                                            <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="interests" name="user_interests[]" value="<?php echo $cat->cid; ?>"> <?php echo $cat->name; ?>
                                        </label>
                                    </div>
                                                            
                                                            <?php
                                                        }
                                                        ?>
                                                        <input type="hidden" id="user_interest" name="user_interest" />
                        
                             
                                                                                                                                                                                            
                         </div>

                        <div class="col-xs-12">
                            <hr>
                            <h4 style="margin-top: 20px;">Link Your Amazon Profile</h4>
                            <p>
                                In order to use Snagshout you must link your Amazon profile to your Snagshout
                                profile. This does not give us access to your Amazon account, it only allows us
                                to verify that you are a legitimate Amazon shopper.
                            </p>

                            <p>
                                Click <a href="https://www.amazon.com/gp/profile" target="_blank">this link</a>
                                and, if prompted, login to Amazon. Once you arrive on your profile page, copy the url and
                                paste it in the input below.
                            </p>

                            
                                <div class="form-group">
                                    <label for="azUrl">Amazon Profile Url</label>
                                    <input type="text" required="" class="form-control required placeholder" id="inpLinkAmazon" name="inpLinkAmazon" placeholder="https://www.amazon.com/gp/profile/A4BXSFGWDAXDLA" autocomplete="off">
                                </div>
                            
                        </div>

                        <div class="col-xs-12">
                            <div class="signup-buttons" style="margin-top: 20px;">
                                <div class="form-group">
                                    <div class="row-fluid">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success btn-lg btn-block" id="btnfinish">
                                                <i class="fa fa-check"></i>
                                                Finish
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <hr>
                            <h4 class="small" style="margin-top: 20px;">
                                <i class="fa fa-warning"></i>&nbsp;Invalid URL?
                            </h4>
                            <p class="small">
                                Your Amazon profile must be set up in order
                                for us to verify your account.
                                <a href="https://www.amazon.com/gp/profile">Please click
                                here</a> and, if prompted, press "save." Then
                                follow the steps listed above and try again.
                            </p>
                        </div>
                    </div>
                
                <script>
                /*
		 * Link Amazon URL
		 */
		$(document).on("click", "button#btnfinish", function(e){
			e.preventDefault();
			//var loader = $("#stLoader");
			var _alert = $(".isAlert"),
				user_interest = $("#user_interest").val(),
                amazonUrl = $("#inpLinkAmazon").val();
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('ajax/setpreference') ?>",
				dataType: "json",
				data: {"user_interest": user_interest,"amazonUrl": amazonUrl},
				beforeSend: function(){
					//loader.show();
				},
				error: function(){
					//loader.hide();
				},
				success: function(r){
					if(r.res){
						_alert.removeClass("alert-danger").addClass("alert-success").text(r.msg).show();
						window.location.assign("<?php echo site_url('shopper') ?>");
					}else{
						_alert.text(r.msg).show();
					}
					//loader.hide();
				}
			});
		});
                
                
                </script>
                
                
                
            </div>
        </div>
    </div>
</div>