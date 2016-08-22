<div class="subheader">
    <nav role="navigation" class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="row-fluid">
                <div class="span4 offset4">
                    <h3 class="page-title">&nbsp;</h3>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row-fluid">
        <div class="span4 offset4">
            <div class="card">
                <div class="row-fluid">
                    <div class="span12">
                        <h2 class="diet text-center">Password Reset</h2>

                        <h2 class="text-center mar-40-bottom">
                            <small>Almost there</small>
                        </h2>

                        <p>All we need now is the new password for your account:</p>
                        
                        <?php
                        echo form_open(site_url('user/resetpass/' . $code . '?mail=' . $mail));
                            echo validation_errors();
                            if (isset($forgot_error) && !empty($forgot_error)) {
                                echo "<div class='alert alert-danger'>{$forgot_error}</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input type="password" placeholder="Enter password" name="fpass" required="required" class="form-control email required placeholder" autocomplete="off">
                            </div>
                        
                            <div class="form-group">
                                <input type="password" placeholder="Confirm password" name="cpass" required="required" class="form-control email required placeholder" autocomplete="off">
                            </div>

                            <div class="row">
                                <div class="span12">
                                    <div class="form-group">
                                        <button class="btn green pull-right"><i class="icon fa fa-paper-plane"></i> Let's go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>