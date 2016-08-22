<div class="front-content">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <h1 class="strUpper"><?php echo lang('history') ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container elegant campaign">
    <div class="row-fluid">
        <div class="span10 offset1">
            <div class="row-fluid">
                <div class="span12">
                    <a href="#alertPage" class="btn blue pull-right" data-toggle="modal"><i class="icon-refresh"></i> Check for reviews</a>
                </div>  

                <?php
                if (!empty($history)) {
                    foreach ($history as $h) {
                        ?>

                        <div class="span12">
                            <div class="card-alias">                        
                                <div class="row-fluid">
                                    <div class="span2">
                                        <img src="<?php echo $h->img_url ?>" height="70" width="70" />
                                    </div>
                                    <div class="span6">
                                        <a href="<?php echo site_url('deals/item/' . $h->pid . "?hash=" . get_hash($h->pid)) ?>"><?php echo $h->name ?></a><br/>
                                        <span class="promoCode strUpper">Promo Code: </span>
                                        <span class="promoCoup"><?php echo $h->promo_code ?> </span>
                                    </div>
                                    <div class="span2">$<?php echo $h->price ?></div>
                                    <div class="span2">
                                        <a data-reason="<?php echo $h->reason ?>" data-comment="<?php echo $h->comment ?>" data-id="<?php echo $h->history_id ?>" data-hash="<?php echo get_hash($h->history_id); ?>" data-title="<?php echo $h->name ?>" href="#leaveComment" data-toggle="modal" class="btn red btn-small flagIt">
                                            <i class="icon-flag"></i>
                                        </a>
                                        <?php if ($h->is_pending == 1) { ?>
                                            <a href="javascript:void(0);" class="btn green btn-small">PENDING</a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0);" class="btn green btn-small">DELIVERED</a>
                                        <?php } ?>
                                    </div>
                                </div>                        
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>        
</div>

<!-- MODAL -->
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

<!-- MODAL -->
<div id="alertPage" class="modal hide fade" tabindex="-1" data-focus-on="input:first">    
    <div class="modal-body">
        <h3><i class="fa fa-warning"></i> Are you sure you want to check for reviews?</h3><b id="delPage"></b>
        <p>Only click ok if you have already left a review for one of the pending items below. Then allow our system up to 24 hours to check for your review.</p>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">No</button>
        <button type="button" class="btn btn-primary green" id="deleYes">Yes</button>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        //Flag it functionlaity
        $(document).on("click", "a.flagIt", function() {
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