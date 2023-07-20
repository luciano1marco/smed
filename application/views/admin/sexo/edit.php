<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $texto_edit; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit')); ?>
                        <?php echo form_hidden('id',$id); ?>

                        <?php echo form_fieldset('Dados'); ?>
                        <!---Inicio campos  --->
                        <div class="form-group">
                            <?php echo form_label('Descrição', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-6">
                            <?php echo form_input($descricao); ?>
                            </div>
                        </div>
                       
                        <!--fim campos---->
                        
                        <?php echo form_fieldset_close(); ?>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="btn-group">
                                    <?php
                                    $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                    $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                    $redo = '<i class="fa fa-refresh"></i> <span>Reiniciar</span>';
                                    $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                    $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';
                                    ?>

                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-azul btn-flat', 'content' => $submit)); ?>
                                    <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                    <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, "id" => "btExcluir")); ?>
                                   
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modal -->            
<div class="modal fade" id="modal_delete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Atenção!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir esse tipo de registro?</p>
            </div>
            <div class="modal-footer justify-content-between">
            <?php                                               
            $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                     
            $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';                               
            ?>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $cancel; ?></button>
            <button type="button" class="btn btn-danger" id="btExcluirConfirmar"><?php echo $delete; ?></button> 
            </div>
        </div>  <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>  <!-- /.modal -->    

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
            required: true,
        }            
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
       

</script>