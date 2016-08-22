<div class="subheader">
    <nav role="navigation" class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="row-fluid">
                <div class="span4 offset4">
                    <h3 class="page-title">&nbsp;</h3>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row-fluid">
        <div class="span4 offset4">
            <div class="card">
                <div class="row-fluid">
                    <div class="span12">
                        <h2><?php echo lang('verification') ?></h2>
                        <?php
                        $cls = ( $verify[0] == true) ? "alert-success" : "alert-danger";
                        echo "<div class='alert {$cls}'>{$verify[1]}</div>";
                        ?>

                        <p><a href="<?php echo site_url('deals') ?>" class="btn btn-primary btn-block"><?php echo lang('view_deals'); ?></a></p>
                        <div class="fancy">
                            <span class="strUpper"><?php echo lang('or') ?></span>
                        </div>
                        <p><?php echo lang('you_can_login') ?> <a href="<?php echo site_url('user/login') ?>"><span class="strCaps"><?php echo lang('click_here') ?></span></a> <?php echo lang("to") . " " . lang('login'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>