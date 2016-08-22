    <div id="dashboard">
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row-fluid">
            <div class="span6 responsive" data-tablet="span12" data-desktop="span6">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="icon-file"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo $total_contents ?></div>
                        <div class="desc">Contents</div>
                    </div>
                    <a class="more" href="<?php echo site_url('backend/content') ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>                 
                </div>
            </div>
            <div class="span6 responsive" data-tablet="span12" data-desktop="span6">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="icon-book"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo $total_products ?></div>
                        <div class="desc">Products</div>
                    </div>
                    <a class="more" href="<?php echo site_url('backend/products') ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>                 
                </div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="span6 responsive" data-tablet="span12 fix-offset" data-desktop="span6">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="icon-th-large"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo $total_companies ?></div>
                        <div class="desc">Companies</div>
                    </div>
                    <a class="more" href="<?php echo site_url('backend/companies') ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>                 
                </div>
            </div>
            <div class="span6 responsive" data-tablet="span12" data-desktop="span6">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="icon-th"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo $total_shopper ?></div>
                        <div class="desc">Shopper</div>
                    </div>
                    <a class="more" href="<?php echo site_url('backend/shopper') ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>                 
                </div>
            </div>
        </div>
        <!-- END DASHBOARD STATS -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- END PAGE CONTAINER-->    
