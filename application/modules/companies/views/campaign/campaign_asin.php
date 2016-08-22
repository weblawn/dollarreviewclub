<div class="asin"><div class="front-content">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="strUpper"><?php echo lang('create_campaign') ?></h1>
                </div>            
            </div>
        </div>
    </div>
    <div class="container elegant">
        <div class="row-fluid">        
            <div class="asin-model">
                <h3><?php echo lang('enter_asin') ?></h3>
                <form action="<?php echo site_url('companies/campaign/create') ?>" method="get">
                    <div class="row-fluid">
                        <div class="span10">
                            <input type="text" placeholder="<?php echo lang('enter_asin') ?>" name="asin" class="form-control" />
                        </div>
                        <div class="span2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
                
                <?php
                if (isset($asin_error)) {
                    echo "<div class='alert alert-danger'>{$asin_error}</div>";
                }
                ?>                
            </div>
        </div>
    </div>
</div> <!-- asin close -->