<?php
if (isset($_POST['business_name'])) {
    foreach ($_POST as $key => $val) {
        $$key = $val;
    }
}
?>
<div class="container elegant signup">
    <div class="row-fluid">
        <div class="offset4 span4">
            <div class="text-center">
                <h2 class="diet"><?php echo lang('getting_started') ?></h2>
                <h3>
                    <small>
                        <?php echo lang('learn_or_view') ?>, <a href="javascript:{}"><?php echo lang('click_here') ?></a>.
                    </small>
                </h3>
            </div>

            <div class="span12">
                <?php
                if (isset($captcha_err) && strlen($captcha_err) > 0) {
                    echo "<div class='alert alert-danger'>{$captcha_err}</div>";
                }
                echo validation_errors();
                ?>
            </div>

            <div class="card clearfix">                
                <?php echo form_open('') ?>
                <div class="form-group">
                    <label class="control-label" for="business_name"><?php echo lang('business_name') ?></label>
                    <div class="row-fluid">
                        <div class="span12">
                            <input type="text" value="<?php echo isset($business_name) ? $business_name : "" ?>" placeholder="<?php echo lang('business_name_placeholder') ?>" class="form-control required" name="business_name" required="" id="business_name" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="first_name"><?php echo lang('name') ?></label>
                    <div class="row-fluid">
                        <div class="span6">
                            <input type="text" value="<?php echo isset($first_name) ? $first_name : "" ?>" placeholder="<?php echo lang('first') . " " . lang('name') ?>" class="form-control required" name="first_name" required="" id="first_name" autocomplete="off">
                        </div>
                        <div class="span5 offset1">
                            <input type="text" value="<?php echo isset($last_name) ? $last_name : "" ?>" placeholder="<?php echo lang('last') . " " . lang('name') ?>" class="form-control required" name="last_name" required="" id="last_name" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="phone_number"><?php echo lang('phone_number') ?></label>
                    <input type="text" value="<?php echo isset($phone_number) ? $phone_number : "" ?>" placeholder="(242) 424-2424" class="form-control required" name="phone_number" required="" id="phone_number" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label" for="email"><?php echo lang('email') ?></label>
                    <input type="text" value="<?php echo isset($email) ? $email : "" ?>" placeholder="<?php echo lang('email_placeholder') ?>" class="form-control required" name="email" required="" id="email" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label" for="password"><?php echo lang('password') ?></label>
                    <input type="password" title="<?php echo lang('password_title') ?>" pattern=".{8,}" placeholder="<?php echo lang('password_placeholder') ?>" class="form-control required" name="password" required="" id="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <?php echo $recaptcha; ?>
                </div>
                <div class="signup-buttons">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block btn-success" type="submit">
                            <i class="icon fa fa-star"></i> <?php echo lang('signup') ?>
                        </button>
                    </div>
                </div>
                </form>
            </div>


            <p class="text-center">
                <small>
                    <?php echo lang('terms_agree') ?>
                    <a href="<?php echo site_url('pages/terms') ?>"><?php echo lang('terms') ?></a><br>
                    <?php echo lang('and') ?> <a href="<?php echo site_url('pages/privacy') ?>"><?php echo lang('privacy') ?></a>
                </small>
            </p>
        </div>
    </div>
</div>