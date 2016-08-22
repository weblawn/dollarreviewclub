<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <div class="span8">
            <h1><?php echo $page_title ?></h1>
        </div>
        <div class="span4">            
            <form class="pull-right">                
                <div class="form-group">

                    <form action="" method="get">
                        <div class="input-prepend searchBox">
                            <div class="add-on">
                                <i class="fa fa-search"></i>
                            </div>
                            <input type="text" class="m-wrap search" id="dealsSearch" placeholder="Search Deals" name="q" value="<?php echo (isset($_GET['q'])) ? $_GET['q'] : '' ?>" autocomplete="off">
                        </div>
                    </form>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- BEGIN CONTAINER -->   
<div class="container"><!-- BEGIN SERVICE BOX -->
    <div class="deal row-fluid">
        <div class="span2">            
            <div class="side_widget">
                <h2 class="widget_title">Product Catetories</h2>
                <ul class="unstyled">
                    <?php
                    $categoriesList = get_categories_list();
                    $catHtml = '';
                    foreach ($categoriesList as $cat) {
                        $catLink = site_url("categories/item/" . $cat->slug);
                        $catHtml .= "<li><a href='{$catLink}'><i class='icon-caret-right'></i> {$cat->name}</a></li>";
                    }
                    echo $catHtml;
                    ?>
                </ul>
            </div>

            <div class="side_widget">
                <h2 class="widget_title">Price Range</h2>
                <ul class="unstyled">
                    <li>
                        <div id="slider-range" class="slider bg-blue"></div>
                        <div class="slider-value"><span id="slider-range-amount"></span></div><br/>
                    </li>
                    <li>
                        <input id="upper_bound" name="upper_bound" type="number" min="1"  max="1000" />
                        <input id="lower_bound" name="lower_bound" type="number" min="1"  max="1000" />
                    </li>
                    <li class="submit"><button class="btn btn-primary" id="filterAjaxBtn"><i class="icon fa fa-filter"></i> <span>Filter</span></button></li>
                </ul>
            </div>

        </div>
<script>
$("input[type=number]#lower_bound").bind('keyup input', function(){
    var priceRange_custom = {values: [$('input#lower_bound').val(), $('input#upper_bound').val()]}
    $("#slider-range").slider({
                range: true,
                values: priceRange_custom.values,
                slide: function(event, ui) {
                    $("#slider-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]); 
                    $('input#lower_bound').val(parseInt(ui.values[0]));
                    $('input#upper_bound').val(parseInt(ui.values[1]));    
                    priceRange.values = ui.values;
                }
            });
            priceRange.values = $("#slider-range").slider("values");
            $("#slider-range-amount").text("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
});
$("input[type=number]#upper_bound").bind('keyup input', function(){  
    var priceRange_custom = {values: [$('input#lower_bound').val(), $('input#upper_bound').val()]}
    $("#slider-range").slider({
                range: true,
                values: priceRange_custom.values,
                slide: function(event, ui) {
                    $("#slider-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]); 
                    $('input#lower_bound').val(parseInt(ui.values[0]));
                    $('input#upper_bound').val(parseInt(ui.values[1]));   
                    priceRange.values = ui.values;
                }
            });
            priceRange.values = $("#slider-range").slider("values");
            $("#slider-range-amount").text("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));         
});

</script>
        <div class="span10 product-list">
            <div class="top-bar">
                <div class="span8"><?php //echo lang("showing") . " 1-20 " . lang('of') . " " . count($categories) . " " . lang("products")  ?></div>
                <div class="span4">
                    <div class="dropdown pull-right">
                        <select tabindex="1" class="m-wrap small sortBy">
                            <option value="" selected="">Sort By</option>
                            <option value="p.price_ASC">Price: Lowest First</option>
                            <option value="p.price_DESC">Price: Highest First</option>
                            <option value="p.name_ASC">Name: A-Z</option>
                            <option value="p.name_DESC">Name: Z-A</option>
                        </select>                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!-- topbar close -->
            
            
            
            
            
            