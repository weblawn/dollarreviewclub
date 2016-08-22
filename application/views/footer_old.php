<br/>
<!-- BEGIN COPYRIGHT -->
<div class="front-copyright">
    <div class="container">
        <div class="row-fluid">                    
            <div class="span8">
                <ul class="unstyled inline">
                    <?php echo get_menu('footer') ?>
                </ul>
            </div>
            <div class="span4">
                <p class="pull-right">2015 &copy; <?php echo lang('copyright') ?></p>
            </div>
        </div>
    </div>
</div>
<!-- END COPYRIGHT -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<?php
    echo get_spinner();
    echo get_assets_files('frontend_footer');
?>
<!--[if lt IE 9]>
<script src="<?php echo assets_url('plugins/respond.min.js'); ?>"></script>  
<![endif]-->
</body>
<!-- END BODY -->
</html>