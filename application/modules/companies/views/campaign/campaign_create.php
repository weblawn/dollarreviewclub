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

                <img src="<?php echo $asin->Item->MediumImage->URL ?>" alt="product">
                <hr>
            </div>

            <h4 class="strUpper"><?php echo lang('item_details') ?>:</h4>
            <div class="asin-text"><strong><?php echo lang('asin') ?></strong></div>
            <div class="asin-value"><a href="#"><?php echo $asin->Item->ASIN ?></a></div><br/>
            <div class="asin-text"><strong><?php echo lang('rank') ?></strong></div>
            <div class="asin-text"><?php echo isset($asin->Item->SalesRank) ? $asin->Item->SalesRank : "-"; ?></div>
        </div>

        <div class="span9">

            <h2 class="product-name" id="stProductName"><?php echo (isset($_POST['productName'])) ? $_POST['productName'] : $asin->Item->ItemAttributes->Title ?></h2>

            <?php
            echo validation_errors();
            if (isset($extraError)) {
                echo "<div class='alert alert-danger'>{$extraError}</div>";
            }
            ?>

            <div class="campaign-form">                
                <?php echo form_open(site_url('companies/campaign/create?asin=' . $asin->Item->ASIN), array("class" => "form-horizontal", "enctype" => "multipart/form-data")) ?>
                <div class="control-group">
                    <label class="control-label" for=""><?php echo lang('amazon_url') ?></label>
                    <div class="controls">
                        <span><?php echo $amazonUrl ?><span id="stKeywords"></span></span>                            
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('product_name') ?></label>
                    <div class="controls">
                        <input class="span12" name="productName" type="text" id="stProductNameKeyup" placeholder="<?php echo lang('product_name') ?>" value="<?php echo (isset($_POST['productName'])) ? $_POST['productName'] : $asin->Item->ItemAttributes->Title ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('keywords') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="keywords" value="<?php echo (isset($_POST['keywords'])) ? $_POST['keywords'] : "" ?>" id="stKeywordsKeyup" placeholder="<?php echo lang('keywords') ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('price') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="price" value="<?php echo (isset($_POST['price'])) ? $_POST['price'] : "" ?>" placeholder="<?php echo lang('price') ?>">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo lang('shipping_price') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="shipping_price" value="<?php echo (isset($_POST['shipping_price'])) ? $_POST['shipping_price'] : "" ?>" placeholder="<?php echo lang('shipping_price') ?>">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo lang('daily_limit') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="daily_limit" value="<?php echo (isset($_POST['daily_limit'])) ? $_POST['daily_limit'] : "" ?>" placeholder="<?php echo lang('daily_limit') ?>">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo lang('start_date') ?></label>
                    <div class="controls">
                        <input class="span12 isDatepicker" type="text" name="start_date" value="<?php echo (isset($_POST['start_date'])) ? $_POST['start_date'] : "" ?>" placeholder="<?php echo lang('start_date') ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('end_date') ?></label>
                    <div class="controls">
                        <input class="span12 isDatepicker" type="text" name="end_date" value="<?php echo (isset($_POST['end_date'])) ? $_POST['end_date'] : "" ?>" placeholder="<?php echo lang('end_date') ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('promo_code_type') ?> <i class="icon-question-sign icon-white"></i>  </label>
                    <div class="controls">
                        <select class="span12" id="stPromoType" name="promo_code_type">
                            <option value="">---</option>
                            <option value="onetime"><?php echo lang('promo_code_onetime') ?></option>
                            <option value="general"><?php echo lang('promo_code_general') ?></option>
                        </select>
                    </div>
                </div>
                <div class="control-group stPromo" id="stPromo_general" style="display:none;">
                    <label class="control-label"><?php echo lang('promo_code') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="promo_code" value="<?php echo (isset($_POST['promo_code'])) ? $_POST['promo_code'] : "" ?>" placeholder="<?php echo lang('promo_code') ?>">
                    </div>
                </div>
                <div class="control-group stPromo" id="stPromo_onetime" style="display:none;">
                    <label class="control-label"><?php echo lang('upload_promo_codes') ?></label>
                    <div class="controls">
                        <input type="file" class="span12" name="upload_promo_codes" placeholder="upload">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('description') ?></label>
                    <div class="controls">
                        <textarea class="span12" name="description" placeholder="<?php echo lang('description') ?>"><?php echo (isset($_POST['description'])) ? $_POST['description'] : "" ?></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('merchant_id') ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="merchant_id" value="<?php echo (isset($_POST['merchant_id'])) ? $_POST['merchant_id'] : "" ?>" placeholder="<?php echo lang('merchant_id') ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('category') ?></label>
                    <div class="controls">
                        <select class="span12" name="category">
                            <?php                            
                            $opt = "<option value=''></option>";
                            foreach ($category as $cat) {
                                $opt .= "<option value='{$cat->cid}'>{$cat->name}</option>";
                            }
                            echo $opt;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('fullfillment') ?></label>
                    <div class="controls">
                        <select class="span12" name="fullfillment">
                            <?php
                            $fulls = explode(";", "Fulfilled By Amazon;Merchant Fulfilled");
                            $opt = "<option value=''></option>";
                            foreach ($fulls as $full) {
                                $opt .= "<option value='{$full}'>{$full}</option>";
                            }
                            echo $opt;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo lang('child_asin') ?></label>
                    <div class="controls text-center">
                        <button type="button" id="stAnotherASIN" class="btn"><?php echo lang('another_asin') ?></button>
                    </div>
                </div>

                <div class="control-group">
                    <button type="submit" class="btn pull-right btn-teal"><?php echo lang('create') ?></button>
                </div>
                </form>
            </div>
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

        /*
         * Add Another ASIN
         */
        $(document).on("click", "button#stAnotherASIN", function() {
            var inp = "<input type='text' class='form-control' name='extraASIN[]' placeholder='<?php echo lang('enter_asin') ?>' /><br/><br/>";
            $(this).parent().prepend(inp);
        });

    });
</script>