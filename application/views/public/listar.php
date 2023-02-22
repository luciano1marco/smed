<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    #register h2,h6 {
        text-align: center;
        font-size: 30px;
        color: #992691;
    }
</style>

<?php echo $modulo_menu; ?>
<?php echo $modulo_cabecalho; ?>

<?php $anchor = 'public/'.$this->router->class; ?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3 align="center">Quadro Social - <?php echo date('Y'); ?></h3>
							</div>
						</div>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<th>Socio</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    
                                    
								</tr>
							</thead>
							<tbody>
								<?php foreach ($socio as $apa) : ?>

                                    <?php 
                                    $sim = '<span class="label label-success">SIM</span>';
                                    $nao = '<span class="label label-default">NÃO</span>';
                                   
                                   // var_dump($apa['janeiro']);
                                   // die;
                                    if($apa['janeiro']  == 1){$janeiro= $sim;   }else{$janeiro= $nao;}
                                    if($apa['fevereiro']== 1){$fevereiro= $sim; }else{$fevereiro= $nao;}
                                    if($apa['marco']    == 1){$marco= $sim;     }else{$marco= $nao;}
                                    if($apa['abril']    == 1){$abril= $sim;     }else{$abril= $nao;}
                                    if($apa['maio']     == 1){$maio= $sim;      }else{$maio= $nao;}
                                    if($apa['junho']    == 1){$junho= $sim;     }else{$junho= $nao;}
                                    if($apa['julho']    == 1){$julho= $sim;     }else{$julho= $nao;}
                                    if($apa['agosto']   == 1){$agosto= $sim;    }else{$agosto= $nao;}
                                    if($apa['setembro'] == 1){$setembro= $sim;  }else{$setembro= $nao;}
                                    if($apa['outubro']  == 1){$outubro= $sim;   }else{$outubro= $nao;}
                                    if($apa['novembro'] == 1){$novembro= $sim;  }else{$novembro= $nao;}
                                    if($apa['dezembro'] == 1){$dezembro= $sim;  }else{$dezembro= $nao;}
                                    

                                     ?>
									<tr>
                                        <td><?php echo htmlspecialchars($apa['socio'], ENT_QUOTES, 'UTF-8'); ?></td>
										
                                        <td><?php echo ($janeiro)   ?></td>	
										<td><?php echo ($fevereiro) ?></td>	
										<td><?php echo ($marco)     ?></td>	
										<td><?php echo ($abril) 	?></td>	
										<td><?php echo ($maio) 		?></td>	
										<td><?php echo ($junho) 	?></td>	
										<td><?php echo ($julho) 	?></td>	
										<td><?php echo ($agosto) 	?></td>	
										<td><?php echo ($setembro) 	?></td>	
										<td><?php echo ($outubro) 	?></td>	
										<td><?php echo ($novembro) 	?></td>	
										<td><?php echo ($dezembro) 	?></td>	
										
                                    </tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php echo $modulo_rodape; ?>

</html>

<style>
    .error{
        color: red;
    }
</style>

<script>
    $(document).ready(function() {

        // Desliga o Validate para poder usar apenas validação SERVER CI
        $("#form-questionario").validate({ ignore: "*" });

        $.validator.setDefaults({     
            // O Select Picker precisa mudar o erro de local         
            errorPlacement: function (error, element) {     
                if (element.hasClass('especial')) {
                    error.insertAfter('.especial_erro');  
                }
                else if(element.hasClass('qtdpresencial')) {
                    error.insertAfter('.qtdpresencial_erro');         
                } else {
                    error.insertAfter(element);
                }          
            }
        });

        $("#form-questionario").validate({   
            errorClass: "error",
            validClass: "success",         
            rules: {
                logradouro: {
                    required: true,
                },
                email: {
                    required: true,
                } ,
                nome: {
                    required: true,
                } ,
                datanasc: {
                    required: true,
                } ,
                nomeusuario: {
                    required: true,
                } ,
                password: {
                    required: true,
                } ,
                cpf: {
                    required: true,
                } ,
                celular: {
                    required: true,
                } ,
            
            },
            messages: {
                email: 'O campo E-mail é obrigatório.',
                nome: 'O campo Nome Completo é obrigatório.',
                datanasc: 'O campo Data de Nascimento é obrigatório.',
                nomeusuario: 'O campo Nome de Usuário é obrigatório.',
                senha: 'O campo Senha é obrigatório.',
                logradouro: 'O campo Logradouro é obrigatório.',
                cpf: 'O campo CPF é obrigatório.',
                celular: 'O campo CPF é obrigatório.',
                
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        
        $("#form-questionario").submit(function(){
            if($("#form-questionario").valid()){   
                return true;
            }
        });
    });
</script>