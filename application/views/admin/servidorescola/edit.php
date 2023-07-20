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
                        <h3 class="box-title"><?php echo $texto_edit; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit')); ?>
                        <?php echo form_hidden('id',$id); ?>

                        <?php echo form_fieldset('Dados'); ?>
                            <!---Inicio campos  --->
                            <div class="form-group">
                                <?php echo form_label('Escola', 'escola_id', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($escola_id); ?>
                                </div>
                                <?php echo form_label('Designação', 'designacao', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($designacao); ?>
                                </div>
                                <?php echo form_label('Turno', 'turno', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($turno); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Setor', 'setor', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($setor); ?>
                                </div>    
                                <?php echo form_label('Licença', 'licenca', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($licenca); ?>
                                </div>
                                <?php echo form_label('Observação', 'obsch', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($obsch); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                
                            </div>
                            <div class="form-group row">
                                <?php echo form_label('Turmas que Atende', 'turmas_atende', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($turmas_atende); ?>
                                </div>
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
                                    <?php echo anchor($anchor1."/view/".$idserv, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
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

<!---modal delete---->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Atenção!</b></h4>
            </div>

            <div class="modal-body">
                <p>Deseja realmente excluir esse registro?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar">Excluir</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->