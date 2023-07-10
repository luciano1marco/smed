<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/servidores'; ?>
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

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>

                        <?php echo form_fieldset('Dados'); ?>
                        
                        <!---campos da tabela servidorescola -->
                            <?php echo form_fieldset('Designações do Servidor'); ?>
                                <div class="form-group">
                                    <?php echo form_label('Designação', 'designacao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown($designacao); ?>
                                    </div>
                                </div> 
                                <div class="form-group">   
                                    <?php echo form_label('Turno', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown($turno); ?>
                                    </div>
                                    <?php echo form_label('Turmas que Atende', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_input($turmas_atende); ?>
                                    </div>
                                </div>    
                                <div class="form-group">    
                                    <?php echo form_label('Setor', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown($setor); ?>
                                    </div>
                                    <?php echo form_label('Licença', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown($licenca); ?>
                                    </div>
                                </div>    
                                <div class="form-group">   
                                    <?php echo form_label('Observação', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                    <div class="col-sm-3">
                                        <?php echo form_input($obsch); ?>
                                    </div>
                                                                        
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="area">Áreas de Autação:</label>
                                    <div class="col-sm-2">
                                        <select class="selectpicker" id="area" name="area[]" multiple data-live-search="true" />
                                            <option value = <?php echo form_dropdown($disciplina);?></option>
                                        </select> 
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right" for="anos">Anos que Atende:</label>
                                    <div class="col-sm-2">
                                        <select class="selectpicker" id="anos" name="anos[]" multiple data-live-search="true" />
                                            <option value = <?php echo form_dropdown($anosatende);?></option>
                                        </select> 
                                    </div>
                                </div> 
                            <?php echo form_fieldset_close(); ?>
                       
                        <!---Fim Campos--->
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
                                    <?php echo anchor($anchor1.'/view/'.$id, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>
                                    
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