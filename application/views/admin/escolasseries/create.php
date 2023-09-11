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
                        <h3 class="box-title"><?php echo  $texto_create; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>
                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-questionario')); ?>
                        <?php echo form_hidden('idescola', $idescola); ?>
                            <?php echo form_fieldset('Dados'); ?>

                            <?php $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';?>

                                <div class="form-group">
                                <label class="col-sm-2 col-form-label text-right" for="series">Áreas de Autação:</label>
                                    <div class="col-sm-2">
                                        <select class="selectpicker" id="series" name="series[]" multiple data-live-search="true" />
                                            <option value = <?php echo form_dropdown($serie);?></option>
                                        </select> 
                                    </div>
                                    <div class="col-sm-6">
                                            <?php
                                                $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';
                                            ?>
                                            <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-azul btn-flat', 'content' => $submit)); ?>
                                            <?php echo anchor($anchor1.'/'.$idescola, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                    </div>
                                </div>
                                <!-- mostra as areas selecionadas --> 
                                <?php echo form_fieldset('Series Selecionadas Anteriormente'); ?>
                                        <?php 
                                        foreach ($escseries as $row){
                                           // var_dump($row);
                                            echo $row['descricao'];
                                            echo anchor($anchor.'/apagarserie/'.$row['id'], $delete, array('class' => 'btn btn-light'));  
							                echo '</br>';
                                        }
                                        echo form_fieldset_close();
                                ?>
                                

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        
                                    </div>
                                </div>
                            <?php echo form_fieldset_close(); ?>
                        <?php echo form_close(); ?>
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

<!-- modal excluir arquivo-->            
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
                    <p>Deseja realmente excluir esse registro?</p>
                </div>

                <div class="modal-footer justify-content-between">
                <?php                                               
                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                     
                $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';                               
                ?>
                
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $cancel; ?></button>
                <button type="button" class="btn btn-danger" id="btExcluirarquivo"><?php echo $delete; ?></button> 
                
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->    