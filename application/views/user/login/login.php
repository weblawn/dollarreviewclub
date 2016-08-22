<!--Mail sent success-->
<div class="alert alert-success resetpass trymsg"><strong>Success : </strong>Password Reset email has been sent, please check email.</div>

<!--Reset Password success-->
<div class="alert alert-success resetpass success"><strong>Success : </strong>Password has been reset.</div>

<div class="container login elegant signup loginform">
    <div class="row-fluid">
        <div class="span4 offset4">
            <div class="card animated ">
                <h1 class="diet text-center"><?php echo lang('welcome_back'); ?></h1>
                <h2 class="text-center">
                    <small><?php echo lang('ready_to_review'); ?></small>
                </h2>

                <?php echo form_open('') ?>

                <?php if (isset($_GET['redirect']) && !empty($_GET['redirect'])) { ?>
                    <input type="hidden" name="redirect" value="<?php echo urldecode($_GET['redirect']); ?>" />
                <?php } ?>

                <div class="login-buttons">
                    <div class="form-group">
                        <div class="row-fluid">
                            <div class="span12">
                                <a href="<?php echo site_url('facebook'); echo (isset($_GET['redirect'])) ? "?redirect=" . urlencode(urldecode($_GET['redirect'])) : ""; ?>">
                                    <div style="background-color:#3B5998" class="btn btn-primary btn-lg btn-block">
                                        <i class="fa fa-facebook fa-fw fa-lg"></i> <?php echo lang('login_facebook') ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fancy">
                    <span class="strUpper"><?php echo lang('or') ?></span>
                </div>

                <div class="span12">
                    <?php
                    /* Form validation error */
                    echo validation_errors();

                    if (isset($login_error) && !empty($login_error)) {
                        echo "<div class='alert alert-danger'>{$login_error}</div>";
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label sr-only"><?php //echo lang('email')        ?></label>
                    <div class="span10">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                            <input type="email" value="" id="email" name="email" autofocus="" required="" placeholder="<?php echo lang('email') ?>" class="form-control email required placeholder" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group password">
                    <label for="password" class="control-label sr-only"><?php //echo lang('password')        ?></label>
                    <div class="span10">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                            <input type="password" id="password" name="password" placeholder="<?php echo lang('password') ?>" required="" class="form-control required" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="login-buttons">
                    <div class="form-group">
                        <div class="span12">
                            <button class="btn btn-primary btn-lg btn-block btn-success" type="submit">
                                <i class="fa fa-sign-in"></i>
                                <?php echo lang('login') ?>
                            </button>
                        </div>
                    </div>
                </div>

                </form>

                <div class="forgot-password">
                    <a href="<?php echo site_url('user/forgot') ?>">
                        <small><?php echo lang('forget') ?></small>
                    </a>
                </div>
            </div>

            <div class="tos text-center">
                <small>
                    <?php echo lang('terms_agree') ?>
                    <a href="<?php echo site_url("pages/terms") ?>"><?php echo lang('terms') ?></a><br>
                    and <a href="<?php echo site_url("pages/privacy") ?>"><?php echo lang('privacy') ?></a>
                </small>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {

<?php if (isset($_GET['forgot']) && $_GET['forgot'] == 1) { ?>
            var resetPass = $(".resetpass.trymsg");
            resetPass.show();
            setTimeout(function() {
                resetPass.hide();
            }, 5000);
            
<?php } else if (isset($_GET['reset']) && $_GET['reset'] == 1) { ?>
    
            var resetPass = $(".resetpass.success");
            resetPass.show();
            setTimeout(function() {
                resetPass.hide();
            }, 5000);
<?php } ?>

    });
</script>