
</div> <!-- landingbg -->	
	<div class="contentbox page">
	
	<div class="container">
		<h1 class="page-title">Contact us</h1>
	<div class="content">
<?php
        $user = get_active_user();
        //echo $user->fname."</br>".$user->lname."</br>".$user->email."</br>";
        if($user->fname==''){$name_type="text";$user_name = '';}else{$name_type="hidden";$user_name = $user->fname;}
        if($user->email==''){$email_type="email";}else{$email_type="hidden";}
        /*$this->data['data']=array(
  'name' =>   $this->input->post('name', TRUE),
  'email' =>   $this->input->post('email', TRUE),
  'subject' =>   $this->input->post('subject', TRUE),
  'message' =>   $this->input->post('message', TRUE),
);*/
if($open_popup != "yes"){
        if(isset($data['name'])){$user_name = $data['name'] ; }
        if(isset($data['email'])){$user_email = $data['email'] ; }else{$user_email = $user->email ; }
        if(isset($data['subject'])){$user_subject = $data['subject'] ; }
        if(isset($data['message'])){$user_message = $data['message'] ; }
        }
        ?>
        <?php
                            /*if(isset($captcha_err) && strlen($captcha_err) > 0){
                                echo "<div class='alert alert-danger'>{$captcha_err}</div>";
                            }*/
                                echo validation_errors();
                                /*if(isset($success_msg)){
                                    echo "<div class='alert alert-success'>{$success_msg}</div>";
                                }            */                    
                            ?>
		<?php echo form_open('pages/contact', array('class' => 'form-horizontal', 'role' => 'form', 'name' => 'contact_form', 'class' => 'contact_us')) ?>
              <div class="form-group">
				<input type="<?php echo $name_type;  ?>" class="form-control" id="name" name="name" placeholder="Your name" required="" autocomplete="off" value="<?php echo $user_name; ?>">
			  </div>

			  <div class="form-group">
				<input type="<?php echo $email_type;  ?>" class="form-control" name="email" id="email" required="" autocomplete="off" value="<?php echo $user_email; ?>" placeholder="Your email address">
			  </div>
	
			  <div class="form-group">
				<input type="text" class="form-control" name="subject" id="subject" required="" autocomplete="off" placeholder="Subject" value="<?php echo $user_subject; ?>">
			  </div>
	

			  <div class="form-group">
				<textarea class="form-control" rows="14" style="padding-top: 30px;" placeholder="Please write your comments or questions here"  name="message" id="message" required="" autocomplete="off"><?php echo $user_message; ?></textarea>
			  </div>
	
 
              <?php /* <div class="form-group">
                <?php echo $recaptcha; ?>
              </div>      */ ?>       
			  
			  <button type="submit" class="btn btn-default smt-btn" data-toggle="modal" data-target="#myModal3" >Submit</button>
			</form>
	
	</div>
	</div>
	
	</div>
    

 <?php if($open_popup == "yes"){ ?> 
    <!-- Thankyou Popup Modal -->
<div id="popup_content">
    <div class="modal fade thank_you in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
    			<h3>Thank you for contacting us !</h3>
    			<p>We appreciate your comment and will 
                contact you as soon as possible.</p>
    			<button type="button" class="btn btn185_73" data-dismiss="modal" onclick="close_popup()" >Ok</button>
    			
          </div>
    
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade in"></div>
</div>
 <?php } ?> 
 