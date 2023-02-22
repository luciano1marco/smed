<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
a {
    color:black; 
}
a:hover{
	color:brown;
}
   
</style>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="card">
			<div class="card-body login-card-body">

				<h3><p class="login-box-msg">Login do Candidato</p></h3>

				<!-- Form Open -->  
				<?php echo form_open('home/login', array('class' => 'form-horizontal', 'id' => 'form-login')); ?>
					<div class="form-group has-feedback">
						<?php echo form_input($email);?>
					</div>
					<div class="form-group has-feedback">
						<?php echo form_input($senha);?>
					</div>
					<div class="row">
						<div class=" col-sm-12 text-center">
							<div class="btn-group">
								<?php echo form_submit('submit', "Enviar", array('id' => 'testalogin', 'class' => 'btn btn-primary btn-block btn-flat'));?>
							</div>        
						</div>
					</div>		
				</form>
			</div>
			<p class="mb-1 text-center">
				<a href="/concursos/home/esqueciminhasenha">Esqueceu a senha</a>
			</p>
			<p class="mb-0 text-center">
				<a href="/concursos/home/createPessoas" class="text-center">Não tem Cadastro</a>
			</p>
			<p class="text-center"> <a href="<?= base_url('./') ?>"><span class="badge badge-primary">Voltar</span></a> 
			</p>     

		</div>
		<!-- /.login-card-body -->
	</div>
		<!-- /.card -->

    <?php echo form_close();?>
    
</body>
</html>


