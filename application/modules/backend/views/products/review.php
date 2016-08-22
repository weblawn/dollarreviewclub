<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">Product Name :: <?php echo $product->name ?></div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="config" data-toggle="modal" href="#portlet-config"></a>
                        <a class="reload" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <h3 class="form-section">Product Info</h3>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="form-group">
                                <label>Product Image</label>
                                <img src="<?php echo $product->img_url ?>" />
                            </div><br/>

                            <div class="form-group">
                                <label>ASIN No.</label>
                                <div><?php echo $product->asin ?></div>
                            </div><br/>

                            <div class="form-group">
                                <label>Keywords</label>
                                <div><?php echo $product->keywords ?></div>
                            </div><br/>

                            <div class="form-group">
                                <label>Price</label>
                                <div>$<?php echo $product->price ?></div>
                            </div><br/>
                        </div>

                        <div class="span6">
                            <div class="form-group">
                                <label>Shipping Price</label>
                                <div>$<?php echo $product->shipping_price ?></div>
                            </div><br/>

                            <div class="form-group">
                                <label>Daily Limit</label>
                                <div><?php echo $product->daily_limit ?></div>
                            </div><br/>
                            <div class="form-group">
                                <label>Start Date</label>
                                <div><?php echo display_date($product->start_date) ?></div>
                            </div><br/>
                            <div class="form-group">
                                <label>End Date</label>
                                <div><?php echo display_date($product->end_date) ?></div>
                            </div><br/>
                            <div class="form-group">
                                <label>Promo Type</label>
                                <div><?php echo ucfirst($product->promo_type) ?></div>
                            </div><br/>

                            <div class="form-group">
                                <label>Merchant ID</label>
                                <div><?php echo $product->merchant_id ?></div>
                            </div><br/>

                            <div class="form-group">
                                <label>Category</label>
                                <div>
                                    <?php
                                    $cat = get_category($product->category);
                                    echo $cat->name;
                                    ?>
                                </div>
                            </div><br/>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                            <h3 class="form-section">Description</h3>
                            <div><?php echo $product->description ?></div>
                        </div>
                    </div>

                    <br/><br/>

                    <h3 class="form-section">Reviews</h3>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="form-group">
                                <label>Resaon</label>
                                <div><?php echo isset($review->reason) ? $review->reason : "--" ?></div>
                            </div><br/>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <div><?php echo isset($review->comment) ? $review->comment : "--" ?></div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<!-- END DASHBOARD STATS -->
<div class="clearfix"></div>
</div>
</div>
<!-- END PAGE CONTAINER-->

