<!-- BEGIN CONTAINER -->   
<div class="container"><!-- BEGIN SERVICE BOX -->
    <div class="deal dealItem row-fluid">
        <div class="span3">
            <div class="text-center pad-40-top">
                <img src="<?php echo $pro->img_url ?>" alt="product">
                <hr>
            </div>

            <h4>Category:</h4>
            <span class="details-value text-capitalize"><a href="<?php echo site_url('category/' . $cat[0]->slug) ?>"><?php echo $cat[0]->name ?></a></span>
        </div>

        <div class="span9">
            <div class="row-fluid">
                <div class="span9">
                    <h1 class="diet"><?php echo $pro->name ?></h1>
                    <dl class="dl-horizontal well">
                        <dt>Time Remaining:</dt>
                        <dd>
                            <?php
                            $seconds = ( strtotime($pro->start_date) - strtotime($pro->end_date));
                            $days = floor($seconds / 86400);
                            $seconds %= 86400;
                            $hours = floor($seconds / 3600);

                            echo $days . "d " . $hours . "h (" . date("D, M d, Y h:i A") . ")";
                            ?>
                        </dd>
                        <dt>Retail Price:</dt>
                        <dd class="retail-price">$<?php echo $pro->price ?></dd>
                        <dt>Dollar Price:</dt>
                        <dd class="final-price">$<?php echo $pro->price ?><small>+ Free shipping*</small></dd>
                    </dl>
                    <h4 class="upper pad-5-top pad-10-bottom">Description:</h4>
                    <p class="description"><?php echo $pro->description ?></p>
                    <p class="text-primary"><small>* Free shipping is only for Amazon Prime members or for orders of $35 or more.</small></p>
                </div>
                <div class="span3">
                    <div class="card opaque text-center">
                        <form id="confirmOrder" action="" method="post" class="ng-pristine ng-valid">
                            <a id="reviewLink" class="btn btn-primary btn-block <?php echo $btnType ?>" <?php echo $modal . $extraData ?> href="<?php echo $reviewLink; ?>">
                                    <?php echo $reviewText ?>
                                </a>
                                <div class="fancy"><span>OR</span></div>
                                <a id="amazonLink" href="<?php echo $amazonLink ?>" target="_blank" type="button" class="btn btn-default btn-block">
                                    <?php echo $amazonText ?>
                                </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- END homepage  -->

<?php if ($user) { ?>
    <div id="reviewIt" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
        <div class="modal-header">
            <button type="button" class="close clsModal" data-dismiss="modal" aria-hidden="true"></button>        
        </div>
        <div class="modal-body">
            <b> <i class="fa fa-warning"></i> <?php echo lang('review_warning'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            <button type="button" class="btn btn-primary buy-btn" id="reviewItOk">Ok</button>
        </div>
    </div>



    <div id="leaveComment" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
        <div class="modal-header"></div>
        <div class="modal-body">
            Flag offer "<span id="dataTitle"></span>"
            <hr/>

            <form id="flagItForm" action="" method="post">
                <div class="row-fluid">
                    <div class="span2 offset1">                
                        <label>Reason</label>
                    </div>
                    <div class="span7">                
                        <select id="chooseReason" class="form-control" name="reason">
                            <option value="">Choose Reason</option>
                            <option value="Offer is expired">Offer is expired</option>
                            <option value="Coupon is invalid">Coupon is invalid</option>
                            <option value="Coupon does not apply to this product">Coupon does not apply to this product</option>
                            <option value="I did not want to purchase this item">I did not want to purchase this item</option>
                            <option value="My review is not being found">My review is not being found</option>
                            <option value="Campaign has not started yet">Campaign has not started yet</option>
                            <option value="Other Reason">Other Reason</option>
                        </select>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2 offset1">
                        <label>Comment</label>
                    </div>
                    <div class="span7">                
                        <textarea id="enterComment" class="form-control" name="comment"></textarea>
                    </div>
                </div>
                <input type="hidden" name="_id" value="" />
                <input type="hidden" name="_hash" value="" />
            </form>
            <div class="alert alert-danger" id="alertHistory"></div>
        </div>

        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn">Dismiss</button>
            <button type="button" class="btn btn-primary red" id="reportYes">Report</button>
        </div>
    </div>



    <div id="waitPlease" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
        <div class="modal-header"><button type="button" class="close clsModal" data-dismiss="modal" aria-hidden="true"></button></div>
        <div class="modal-body"></div>
        <div class="modal-footer" style="display:none;"><button type="button" data-dismiss="modal" class="btn btn-primary buy-btn" id="closeReview">Close</button></div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $(document).on("click", "#reviewItOk", function(e) {
                e.preventDefault();

                var _body = $("#waitPlease div.modal-body"),
                        _foot = $("#waitPlease div.modal-footer");

                $.ajax({
                    url: "<?php echo site_url('deals/reviewit') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {pid: "<?php echo $pid ?>", hash: "<?php echo $hash ?>"},
                    beforeSend: function() {
                        $("#reviewIt .clsModal").click();
                        $("#waitPlease").modal("show");
                        _body.html("<div class='alert alert-success'><?php echo lang('please_wait') ?></div>");
                    },
                    error: function() {
                        _body.html("<div class='alert alert-danger'><?php echo lang('there_error') ?></div>");
                    },
                    success: function(r) {
                        if (r.res) {
                            _body.html("<div class='alert alert-success'>" + r.msg + "</div>");
                            _foot.show();
                            
                            $("a#reviewLink").attr("href", r.reviewLink).html(r.reviewText);
                            $("a#amazonLink").attr("href", r.amazonLink).html(r.amazonText);                            
                        } else {
                            _body.html("<div class='alert alert-danger'>" + r.msg + "</div>");
                        }
                    }
                });
            });

            
            //Flag it functionlaity
            $(document).on("click", "a#reviewLink", function() {
                var _this = $(this),
                        _id = _this.attr("data-id"),
                        _hash = _this.attr("data-hash"),
                        _reason = _this.attr("data-reason"),
                        _comment = _this.attr("data-comment"),
                        _title = _this.attr("data-title");                
                _this.addClass("active");

                $("input[name='_id']").val(_id);
                $("input[name='_hash']").val(_hash);
                $("#dataTitle").text(_title);
                $("#chooseReason").val(_reason);
                $("#enterComment").val(_comment);
            });

            $(document).on("click", "button#reportYes", function() {
                $("form#flagItForm").trigger("submit");
            });

            $('#leaveComment').on('hidden.bs.modal', function() {
                $("a.flagIt").removeClass("active");
            });

            var _alert = $("#alertHistory");
            $(document).on("submit", "form#flagItForm", function(e) {
                e.preventDefault();

                var _form = $(this), _formData = _form.serializeArray();

                $.ajax({
                    url: "<?php echo site_url('shopper/flagit') ?>",
                    type: "POST",
                    dataType: "json",
                    data: _formData,
                    beforeSend: function() {
                        _alert.removeClass("alert-danger").addClass("alert-success").text("Please wait...").show();
                        $("input, select", _form).prop("disabled", true);
                    },
                    error: function() {
                        _alert.removeClass("alert-success").addClass("alert-danger").text("There are an error with flag it").show();
                        $("input, select", _form).prop("disabled", false);
                    },
                    success: function(r) {
                        if (r.res) {
                            _alert.removeClass("alert-danger").addClass("alert-success").text(r.msg).show();

                            $("a.flagIt.active").attr("data-reason", _formData[0].value);
                            $("a.flagIt.active").attr("data-comment", _formData[1].value);
                            _form[0].reset();

                            setTimeout(function() {
                                $("#leaveComment").modal("hide");
                                _alert.hide();
                            }, 1200);

                        } else {
                            _alert.removeClass("alert-success").addClass("alert-danger").text(r.msg).show();
                        }
                        $("input, select", _form).prop("disabled", false);
                    }
                });
            });


        });
    </script>
<?php } ?>