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

<body>

    <section class="container questionario">
        <main role="main">
            <div id="register">
                <h2>Cadastre-se para ser Socio</h2>
                <h6>*Após o envio Aguarde aprovação da Diretoria</h6>
            </div>
        </main>
    
        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-questionario', 'name' => 'questionario'  )); ?>
            <div class="row clearfix"></div>
            <div class="col-md-12 column">
                <!-- chama os forms em /public/questoes/ -->
                <?php echo $form_socio; ?>
                        
                <?php
                    $submit     = '<i class="fa fa-check" id="btEnviar"></i> Associar';               
                ?>

                <div class="row mx-auto" style="width: 120px;">            
                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success btn-flat btn-lg float-right', 'content' => $submit)); ?>                           
                </div>

            </div>    
            <!--col-md-12 column-->
        <div class="row clearfix"></div>

        <?php echo form_close();?>
    </section>    

    <!-- Modal -->
    <div class="modal fade" id="modalsucesso" tabindex="-1" role="dialog" aria-labelledby="modalsucesso" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">            
                <div class="modal-header">
                    <h4 class="modal-title" id="modalsucesso">SUCESSO
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('message'); ?>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>           
                </div>
            </div>
        </div>
    </div>
</body>

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