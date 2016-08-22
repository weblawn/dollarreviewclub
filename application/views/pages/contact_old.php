<style>
input:focus:invalid:focus, textarea:focus:invalid:focus {
                border-color: #66afe9;
                outline: 0;
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
        }
body{
        background-color: #f7f7f7;
}
h2, h2 a {
    font-size: 30px;
}
form {
    margin: 0px 20px 20px;
}
.m-wrap-large {
    padding: 7px 12px!important;
    font-size: 14px;
    line-height: 1.42857;
    width: 95%;
}
        </style>
        
        
        <?php /* <div class="row-fluid breadcrumbs">
    <div class="container">
        <div class="span4">
            <h1><?php echo lang('contact') ?></h1>
        </div>
        <div class="span8">
            <ul class="pull-right breadcrumb">
                <?php echo get_breadcrumbs($breadcrumbs); ?>
            </ul>
        </div>
    </div>
</div> */ ?>
<?php
        $user = get_active_user();
        //echo $user->fname."</br>".$user->lname."</br>".$user->email."</br>";
        if($user->fname==''){$name_type="text";$user_name = '';}else{$name_type="hidden";$user_name = $user->fname." ".$user->lname;}
        if($user->email==''){$email_type="text";}else{$email_type="hidden";}
        ?>
        
<!-- BEGIN CONTAINER -->   
<div class="container elegant"><!-- BEGIN SERVICE BOX -->
    <div class="deal row-fluid">        
        <div class="span7 offset2 pages">
            <?php /* <h1><?php echo lang('contact') ?></h1> */?>
            <div class="card" style="width: auto;">
                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="span11">
                            <?php
                            if(isset($captcha_err) && strlen($captcha_err) > 0){
                                echo "<div class='alert alert-danger'>{$captcha_err}</div>";
                            }
                                echo validation_errors();
                                if(isset($success_msg)){
                                    echo "<div class='alert alert-success'>{$success_msg}</div>";
                                }                                
                            ?>
                        </div>
                        
                        <?php echo form_open('pages/contact', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'contact_form')) ?>

                            <div class="form-group">
                                <h2 class="diet">Contact</h2><br/>
                                <p>Got a question? Get in touch with us!</p><br/>
                            </div>
 
                            <div class="form-group">
                            <?php /*<label class="sr-only" for="name">Name</label> */ ?>
                                <input type="<?php echo $name_type;  ?>" placeholder="Name" class="m-wrap-large" name="name" id="name" required="" autocomplete="off" value="<?php echo $user_name; ?>"/>
                            </div><br/>

                            <div class="form-group">
                            <?php /*<label class="sr-only" for="email">Email</label> */ ?>
                                <input type="<?php echo $email_type;  ?>" placeholder="Email" class="m-wrap-large" name="email" id="email" required="" autocomplete="off" value="<?php echo $user->email; ?>"/>
                            </div><br/> 

                            <div class="form-group">
                            <?php /* <label class="sr-only" for="subject">Subject</label> */ ?>
                                <input type="text" placeholder="Subject" class="m-wrap-large" name="subject" id="subject" required="" autocomplete="off">
                            </div><br/>

                            <div class="form-group">
                             <?php /*<label class="sr-only" for="message">Message</label> */ ?>
                                <textarea placeholder="How can we help?" class="m-wrap-large" name="message" id="message" rows="5" required="" autocomplete="off"></textarea>
                            </div><br/>
                            
                            <div class="form-group">
                                <?php echo $recaptcha; ?>
                            </div>
                
                            <div class="form-group" style="padding-right: 48%;">
                                <button class="btn btn-primary pull-right buy-btn">
                                    <i class="icon fa fa-send"></i> Send
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php /* <div class="span6 text-center">
                        <h4 class="upper">
                            <small>Proudly located in Athens, GA</small>
                        </h4>

                        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAyKRGbuGITEguy3G-BrH8DFmriV0hCE_I&q=Space+Needle,Seattle+WA"></iframe>

                        <hr>

                        <h4 class="upper">
                            <small>Address</small>
                        </h4>

                        <p>
                            1 Press Place<br>
                            Athens, GA 30601
                        </p>
                    </div> */ ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- END homepage  -->
<!-- END CONTAINER -->