            </div>
            <!-- END PAGE -->
        </div>
        <!-- END CONTAINER -->
        
        <!-- BEGIN FOOTER -->
        <div class="footer">
            <div class="footer-inner">
                <?php echo date("Y") ?> &copy; <?php echo lang('website_name') ?>
            </div>
            <div class="footer-tools">
                <span class="go-top">
                    <i class="icon-angle-up"></i>
                </span>
            </div>
        </div>
        <!-- END FOOTER -->
            
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php echo get_assets_files('backend_footer'); ?>
        <script>
            jQuery(document).ready(function() {
                App.init(); // initlayout and core plugins
                Index.init();
                Index.initJQVMAP(); // init index page's custom scripts
                Index.initCalendar(); // init index page's custom scripts
                Index.initCharts(); // init index page's custom scripts
                Index.initChat();
                Index.initMiniCharts();
                Index.initDashboardDaterange();
                Index.initIntro();
                Tasks.initDashboardWidget();
            });
        </script -->
        <!-- END JAVASCRIPTS>
    </body>
    <!-- END BODY -->
</html>