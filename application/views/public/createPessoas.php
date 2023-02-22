<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

	<body class="hold-transition login-page">
		
		
		<div class="card">
			<div class="card-body login-card-body">

			<p class="login-box-msg">Preencha seus dados e em seguide clique em Enviar</p>
			<?php echo $message;?>

			<!-- Form Open -->  
			<?php echo form_open('home/createPessoas', array('class' => 'form-horizontal', 'id' => 'form-login')); ?>
			
			<div class="form-group has-feedback">
                        <?php echo form_input($nome);?>
                    </div>
                    <div class="form-group has-feedback">
                        <?php echo form_input($cpf);?>
                    </div>
					<div class="form-group has-feedback">
                        <?php echo form_input($telefone);?>
                    </div>
                    <div class="form-group has-feedback">
                        <?php echo form_input($email);?>
                    </div>
                   <div class="form-group has-feedback">
                        <?php echo form_input($senha);?>
                    </div>
                   
					<div class="row">
                        <div class=" col-sm-6">
                            <div class="btn-group">
                              <a href="<?= base_url('./') ?>">   
                                <?php echo form_button('./', "Voltar", array('class' => 'btn btn-default btn-flat'));?>
                             </a> 
                            
                            </div>        
                        </div>
                        <div class=" col-sm-6">
                            <div class="btn-group">
                                <?php echo form_submit('submit', "Enviar", array('id' => 'btEnviarcreatePessoas', 'class' => 'btn btn-primary btn-block btn-flat'));?>
                            </div>        
                        </div>
                    </div>		
				</div>

			</form>

			<!--
			<p class="mb-1">
				<a href="forgot-password.html">I forgot my password</a>
			</p>
			<p class="mb-0">
				<a href="register.html" class="text-center">Register a new membership</a>
			</p>
			-->

			</div>
			<!-- /.login-card-body -->
		</div>
		<!-- /.card -->
		</div>
		<!-- /.login-box -->

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
		}		
	},
    messages: {
      	email: {
        	required: "Please enter a email address",
        	email: "Please enter a vaild email address"
      	},
      	password: {
        	required: "Please provide a password",
        	minlength: "Your password must be at least 5 characters long"
      	}      	
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