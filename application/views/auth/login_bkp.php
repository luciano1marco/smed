<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

    <body class="text-center fullpage">

    <!-- Form Open -->  
    <?php echo form_open('auth/login', array('class' => 'form-horizontal', 'id' => 'form-login')); ?>

    <!-- Logo -->   
    <img class="mb-4" data-src="holder.js/300x200?font=FontAwesome" alt="Card image cap" width="72" height="72">
            
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <p class="login-box-msg"><strong><?php echo lang('auth_sign_session'); ?></strong></p>
        <?php echo $message;?>

        <input type="hidden" id="auth_mode" name="auth_mode" value="<?php echo $auth_mode; ?>">

        <div class="form-group">           
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                </div>                
                <?php echo form_input($identity);?>
            </div>               
        </div>

        <div class="form-group">           
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <?php echo form_input($password);?>
            </div>               
        </div>

        <div class="col-sm-6">
            <div class="icheck-primary d-inline">                       
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                <label for="remember">
                    <?php echo lang('auth_remember_me'); ?>
                </label>
            </div>        
        </div>

       <br/>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      
        <br/>
        
        <div class="checkbox mb-3">
            <?php                        
            $addproj = '<i class="fa fa-user"></i> <span>Não tenho cadastro</span>'; 
            $link = base_url('auth/newuser');                                                 
            ?>                                    
            <?php echo anchor($link, $addproj, array('class' => 'btn btn-lg btn-primary btn-block')); ?>
        </div>
        
    <p class="mt-5 mb-3 text-muted">PMRG &copy; 2020</p>

    <?php echo form_close();?>
    
</body>
</html>

<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>