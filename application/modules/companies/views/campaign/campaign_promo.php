<div class="front-content">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <h1 class="strUpper"><?php echo lang('create_campaign') ?></h1>
            </div>            
        </div>
    </div>
</div>
<div class="container create-campaign"><!-- BEGIN SERVICE BOX -->
    <div class="deal row-fluid">
        <div class="span3">
            <div class="text-center pad-40-top">
                <img src="<?php echo $product->img_url; ?>" alt="product">
                <hr>
            </div>

            <h4 class="strUpper"><?php echo lang('item_details') ?>:</h4>
            <div class="asin-text"><strong><?php echo lang('asin') ?></strong></div>
            <div class="asin-value"><a href="#"><?php echo $product->asin; ?></a></div><br/>
        </div>

        <div class="span9">
            
            <h2 class="product-name" id="stProductName"><?php echo lang('edit_promo_codes') . " :: " . $product->name; ?></h2>

            <?php
            echo validation_errors();
            if (isset($extraError)) {
                echo "<div class='alert alert-danger'>{$extraError}</div>";
            }
            if (!empty($codes)) {
                $form = '';
                
                    $form .= form_open(site_url('companies/campaign/promo/' . $pid . "?hash=" . $hash), array("class" => "form-horizontal", "enctype" => "multipart/form-data"));
                        
                        $isInput = false;
                        $record = 1;
                        foreach($codes as $code){
                            if($code->is_used == 0){
                                $form .= '<div class="col-md-12 alert alert-success">'
                                        . '<label>Promo Code :: '. $code->promo_code .', Status:: Not Used</label>'
                                        . '<input typ="text" class="form-control" name="promo[]['. $code->promo_id .']" value="'. $code->promo_code .'" />'
                                    . '</div>';
                                
                                $isInput = true;
                            }else{
                                $form .= '<div class="col-md-12 alert alert-danger">'
                                        . '<label>Promo Code :: '. $code->promo_code .', Status:: Used</label>'
                                        . '<input typ="text" class="form-control" value="'. $code->promo_code .'" disabled />'
                                    . '</div>';                                
                            }
                            
                            $form .= "<br/>";
                            
                            $record++;
                        }
                        
                        if($isInput){
                            $form .= '<div class="control-group">
                                <button type="submit" class="btn pull-right btn-teal">'. lang('update') .'</button>
                            </div>';
                        }
                        
                    $form .= '</form>';
                
                echo $form;
            } else {
                echo '<div class="alert alert-danger">' . lang('no_promo_codes') . '</div>';
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        /*
         * Product Name
         */
        $(document).on("keyup blur", "input#stProductNameKeyup", function() {
            $("#stProductName").text($(this).val());
        });

        /*
         * Keywords
         */
        $(document).on("keyup blur", "input#stKeywordsKeyup", function() {
            var keywords = $(this).val();
            var _url = keywords.trim().split(" ").join("+");
            $("span#stKeywords").text(_url);
        });

        /*
         * PromoType
         */
        $(document).on("change", "select#stPromoType", function() {
            var type = $("option:selected", this).val();
            $(".stPromo").hide();
            $("#stPromo_" + type).show();
        });

        $("select#stPromoType").trigger("change");

        /*
         * Add Another ASIN
         */
        $(document).on("click", "button#stAnotherASIN", function() {
            var inp = "<input type='text' class='form-control' name='extraASIN[]' placeholder='<?php echo lang('enter_asin') ?>' /><br/><br/>";
            $(this).parent().prepend(inp);
        });

    });
</script>