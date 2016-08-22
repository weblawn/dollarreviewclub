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
        <div class="span6 offset3">
            <div class="card">
                <div class="row-fluid">
                    <div class="span12">
                        <h2 class="diet text-center">Forgot your password?</h2>

                        <h2 class="text-center mar-40-bottom">
                            <small>Don't worry. It happens.</small>
                        </h2>

                        <p>
                            All we need is the email address used to register your
                            account. After submitting it, we will send an email
                            with further instructions on how to access your account:
                        </p>
                        
                        <?php
                        echo form_open(site_url('user/forgot'));
                            echo validation_errors();
                            if (isset($forgot_error) && !empty($forgot_error)) {
                                echo "<div class='alert alert-danger'>{$forgot_error}</div>";
                            }
                            ?>
                            <div class="form-group">
                                <input type="email" placeholder="bob@email.com" name="email" required="required" class="form-control email required placeholder" pattern="^(?:(?:[\w!#$%&amp;'*+/=?^`{|}~-]+)(?:\.[\w!#$%&amp;'*+/=?^`{|}~-]+)*@(?:[a-zA-Z0-9][-a-zA-Z0-9]{0,61}[a-zA-Z0-9]\.)+[a-zA-Z]{2,6})$" autocomplete="off">
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