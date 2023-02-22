<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        
        <?php $anchor = 'home'; ?>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card card-primary card-outline">
        <div class="card-header">     
            <h3 class="card-title">Preencha seu Email, e em seguide clique em Enviar</h3>      
        </div>
        <div class="card-body">
            <?php echo $message;?>

            <?php echo form_open('home/esqueciminhasenha');?>
                <div class="form-group has-feedback">
                    <?php echo form_input($email);?>
                </div>
                <div class="form-group row">
                        <div class="offset-3 col-sm-9">                            
                            <div class="btn-group">
                                <?php
                                $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
                                ?>
                                
                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>
                                <?php echo anchor($anchor.'/login/', $cancel, array('class' => 'btn btn-default btn-flat')); ?>                            
                            </div>
                        </div>
              
            <?php echo form_close();?>
        </div>
        <!-- /.card-body -->        
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
                   
<script>
    $(document).ready(function() {

    // Desliga o Validate para poder usar apenas validação SERVER CI
    //$("#form-edit").validate({ ignore: "*" });

    $.validator.setDefaults({     
    // O Select Picker precisa mudar o erro de local         
    errorPlacement: function (error, element) {     
        if (element.hasClass('icone')) {
            error.insertAfter('.icone_erro');            
        } else if(element.hasClass('familiar')) {
            error.insertAfter('.section_erro');    
        } else {
            error.insertAfter(element);
        }          
    }
    });

    $('.icheck').on('ifChecked', function(event){      
    $('#'+this.name).validate();       
    });

    $("#form-edit").validate({   
    errorClass: "is-invalid",
    validClass: "is-valid",   
    errorElement: 'p',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },       
    highlight: function(element, errorClass) {
        $(element).fadeOut(function() {
            $(element).addClass(errorClass);
            $(element).fadeIn();                                
        });
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
        $(element.form).find("label[for=" + element.id + "]")
        .removeClass(errorClass);
    },
    rules: {
    
        descricao: {
            required: true
        },
        
    },
    messages: {
    
        descricao:  'O campo Descrição é obrigatório.'
                    
    },
    submitHandler: function(form) {
        form.submit();
    }
    });

    // No Editar é bom já chamar a validação
    $("#form-edit").validate().form();

    });

//envia mensagem   'id' => 'enviamensagem',
$(function(){
	$("#enviamensagem").click(function(){
      //console.log(senha);
        event.preventDefault();
      	alert("Tudo certo! Se seu e-mail está cadastrado, lhe encaminhamos uma mensagem com uma nova senha temporaria.");
        window.location.href='./';       
    });
   
  });
</script> 