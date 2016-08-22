<style>
body{
        background-color: #f7f7f7;
}
</style>
<?php /* <div class="row-fluid breadcrumbs">
    <div class="container">
        <div class="span4">
            <h1><?php //echo $pageTitle ?></h1>
        </div>
        <div class="span8">
            <ul class="pull-right breadcrumb">
                <?php //echo get_breadcrumbs($breadcrumbs); ?>
            </ul>
        </div>
    </div>
</div> */?>

<!-- BEGIN CONTAINER -->   
<div class="container elegant"><!-- BEGIN SERVICE BOX -->
    <div class="deal row-fluid">        
        <div class="span8 offset2 pages">
        <?php /*<div class="">
            <img src="https://www.snagshout.com/images/about.png" class="img-responsive mar-20-bottom">
        </div>*/?>
            <div class="card">
                <h1><?php //echo $pageTitle ?></h1>
                <p><?php echo $content ?></p>
            </div>
            <h2 class="diet text-center mar-80-top h2">
                To get started with Dollar Review Club, sign up today:
            </h2>
            <p class="text-center pad-20-top">
                <a class="btn btn-lg btn-primary" href="<?php echo site_url('user/signup'); ?>">
                    <i class="icon fa fa-star"></i>
                    Let's go!
                </a>
            </p>
        </div>
    </div>
</div><!-- END homepage  -->
<!-- END CONTAINER -->