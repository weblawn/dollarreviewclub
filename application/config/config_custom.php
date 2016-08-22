<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * SET Menus
 */
$config['menus'] = array(
    //'header' => array('index', 'deals', 'categories', 'pages/about', 'pages/faq'),
    'header' => array('home', 'onedeals', 'deals', 'pages/howitworks', 'pages/faq', 'pages/about', 'pages/contact'),
    /*'footer' => array('index', 'deals', 'pages/faq', 'user/signup', 'pages/terms', 'pages/privacy', 'pages/contact'),*/
    'footer' => array('pages/terms', 'pages/privacy'),
    'shopper' => array('deals', 'categories', 'shopper/history', 'pages/faq', 'pages/contact'),
    'companies' => array('index', 'companies/campaign', 'pages/faq', 'pages/contact'),
);



/*
 * Breadcrumbs
 */
$config['crumb_divider'] = '<span class="divider">/</span>';
$config['tag_open'] = '<ul class="pull-right breadcrumb">';
$config['tag_close'] = '</ul>';
$config['crumb_open'] = '<li>';
$config['crumb_last_open'] = '<li class="active">';
$config['crumb_close'] = '</li>';



/*
 * SET Assets file
 */
$config['assets'] = array(
    'frontend_header' => array(
        'ico' => array('favicon.ico'),
        'css' => array(
            'plugins/bootstrap/css/bootstrap.min.css',
            'plugins/bootstrap/css/bootstrap-responsive.min.css',
            'css/reset.css',
            'css/style-metro.css',
            'plugins/fancybox/source/jquery.fancybox.css',
            'plugins/font-awesome/css/font-awesome.min.css',
            'plugins/bxslider/jquery.bxslider.css',
            'plugins/revolution_slider/css/rs-style.css',
            'plugins/revolution_slider/rs-plugin/css/settings.css',
            'backend/plugins/jquery-ui/jquery-ui-1.10.1.custom.css',
            'backend/plugins/data-tables/DT_bootstrap.css',
            'css/style-responsive.css',
            'css/themes/blue.css',
            'css/style.css'
        ),
        'js' => array(
            'plugins/jquery-1.10.1.min.js',
            'backend/plugins/data-tables/jquery.dataTables.js',
            'backend/plugins/data-tables/DT_bootstrap.js'
        )
    ),
    'frontend_footer' => array(
        'css' => array(),
        'js' => array(
            'plugins/jquery-migrate-1.2.1.min.js',
            'backend/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js',
            'plugins/bootstrap/js/bootstrap.min.js',
            'plugins/back-to-top.js',
            'plugins/bxslider/jquery.bxslider.js',
            'plugins/fancybox/source/jquery.fancybox.pack.js',
            'plugins/hover-dropdown.js',
            'plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js',
            'plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js',
            'scripts/app.js',
            'scripts/index.js',
            'scripts/global.js',
            'backend/scripts/ui-sliders.js'
        )
    ),
    'backend_header' => array(
        'ico' => array('favicon.ico'),
        'css' => array(
            'backend/plugins/bootstrap/css/bootstrap.min.css',
            'backend/plugins/bootstrap/css/bootstrap-responsive.min.css',
            'backend/plugins/font-awesome/css/font-awesome.min.css',
            'backend/css/style-metro.css',
            'backend/css/style.css',
            'backend/css/style-responsive.css',
            'backend/css/themes/default.css',
            'backend/plugins/uniform/css/uniform.default.css',
            'backend/plugins/gritter/css/jquery.gritter.css',
            //'backend/plugins/bootstrap-daterangepicker/daterangepicker.css',
            //'backend/plugins/fullcalendar/fullcalendar/fullcalendar.css',
            //'backend/plugins/jqvmap/jqvmap/jqvmap.css',
            'backend/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css',
        ),
        'js' => array(
            'backend/plugins/jquery-1.10.1.min.js',
            'scripts/global.js',
        )        
    ),
    'backend_footer' => array(
        'css' => array(),
        'js' => array(
            'backend/plugins/jquery-migrate-1.2.1.min.js',
            'backend/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js',
            'backend/plugins/bootstrap/js/bootstrap.min.js',
            'backend/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js',
            'backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
            'backend/plugins/jquery.blockui.min.js',
            'backend/plugins/jquery.cookie.min.js',
            'backend/plugins/uniform/jquery.uniform.min.js',
            //'backend/plugins/jqvmap/jqvmap/jquery.vmap.js',
            //'backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
            //'backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
            //'backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
            //'backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
            //'backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
            //'backend/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
            'backend/plugins/flot/jquery.flot.js',
            'backend/plugins/flot/jquery.flot.resize.js',
            //'backend/plugins/jquery.pulsate.min.js',
            //'backend/plugins/bootstrap-daterangepicker/date.js',
            //'backend/plugins/bootstrap-daterangepicker/daterangepicker.js',
            //'backend/plugins/gritter/js/jquery.gritter.js',
            //'backend/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
            //'backend/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
            //'backend/plugins/jquery.sparkline.min.js" type="text/javascript',
            'backend/scripts/app.js',
            'backend/scripts/index.js',
            'backend/scripts/tasks.js',
        )
    ),
    'backend_header_login_index' => array(
        'css' => array(
            'backend/css/pages/login.css'
        )
    ),
    'backend_header_backend_index' => array(
        'css' => array(
            'backend/css/pages/tasks.css'
        )
    )
);
