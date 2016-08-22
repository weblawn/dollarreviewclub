<!-- BEGIN CONTAINER -->   
<div class="container elegant">
    <div class="row-fluid">
        <div class="span6 offset3 select-login">
            <h2 class="text-center diet"><?php echo lang('hi_there') ?></h2>
            <h3 class="text-center">
                <small><?php echo lang('kind_of_account') ?></small>
            </h3>
        </div>
    </div>

    <div class="row-fluid signup signupwidth">
        <div class="span3 offset3">
            <a href="<?php echo site_url('user/signup/shopper'); ?>">
                <div class="card hover-card">
                    <i class="fa fa-child"></i>
                    <h3><?php echo lang('shopper_account'); ?></h3>
                    <small><?php echo lang('shopper_account_caption'); ?></small>
                </div>
            </a>
        </div>

        <div class="span3">
            <a href="<?php echo site_url('user/signup/company'); ?>">
                <div class="card hover-card">
                    <i class="fa fa-briefcase"></i><br>
                    <h3><?php echo lang('company_account'); ?></h3>
                    <small><?php echo lang('company_account_caption'); ?></small>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- END CONTAINER -->