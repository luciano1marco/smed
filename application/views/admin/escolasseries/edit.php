<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script>
  $(document).ready(function() {
      $('select').selectpicker();
});
</script>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/escolas/view/' ?>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo  $texto_edit; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>
                        
                                <!-- mostra as areas selecionadas --> 
                                <?php echo form_fieldset('Series Selecionadas'); ?>
                                        <?php 
                                        foreach ($escseries as $row){
                                           // var_dump($row);
                                            echo $row['nome'];
                                            echo '</br>';
                                        }
                                        echo form_fieldset_close();
                                        ?>
                                

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
                                            <?php echo anchor($anchor1.'/'.$row['id_escola'], $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                            <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>
                                        </div>
                                    </div>
                                </div>
                           
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

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
               
                qtdpresencial: {           
                    required: true,                 
                },                     
            },
            messages: {
                  qtdpresencial: 'O Campo Trabalhando de forma presencial é obrigatorio'                   
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