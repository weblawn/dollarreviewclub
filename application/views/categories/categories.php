<style>

</style>

<div class="container">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"><?php echo lang('categories') ?></h3>
        </div>
    </div>
</div>

<div class="container">
    <div class="row-fluid">
        <?php
        if (!empty($categories)) {
            
            $i = 0;
            $html = "";
            //assets_url('img/logo.png')
            foreach ($categories as $cat) {
                if(empty($cat['image'])){$image = "missing-image.png";}else{$image = $cat['image'];}
                $image_url = assets_url('img/'.$image);
                $href = site_url("categories/item/". $cat['slug']);
                $row = ( ($i % 4) == 0 ) ? "</div><div class='row-fluid marginBottom'>" : "";
                $deal = ( $cat['count'] > 1 ) ? "DEALS" : "DEAL";
                $div = '<div class="span3">
                    <div class="thumbnail category" onmouseover="show_count('. $cat['cid'] .')" onmouseout="show_name('. $cat['cid'] .')" style="background-image: url('.$image_url.');    background-size: cover;    background-position: 50% 50%;">
                        <a href="'. $href .'" id="name_'. $cat['cid'] .'" style="text-decoration: none;">'. $cat['name'] .'</a>
                        <a href="'. $href .'" id="count_'. $cat['cid'] .'" style="display: none; text-decoration: none;">'. $cat['count'] .' '.$deal.'</a>
                        <div class="clearfix"></div>
                    </div>
                </div>';
                $html .= $row . $div;
                $i++;
            }
            echo $html;
        }
        ?>
    </div>
</div>
<script>
function show_count(id)
{
    $('#count_'+id).show();
    $('#name_'+id).hide();
}
function show_name(id)
{
    $('#count_'+id).hide();
    $('#name_'+id).show();
}
</script>