<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/escolas/view'; ?>
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

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                        <?php echo form_hidden($id); ?>

                        <?php echo form_fieldset('Dados'); ?>
                        <!---Inicio campos  --->
                            <div class="form-group">
                                <div class="card-body">
                                    <div class="form-group">
                                        <?php echo form_label('Salas de Aulas Existentes:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_existentes); ?>
                                        </div>    
                                        <?php echo form_label('Salas de Recursos:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($sala_recursos); ?>
                                        </div>
                                        <?php echo form_label('Acessibilidade/Rampa:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($rampa); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Salas de Aulas em Uso:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_uso); ?>
                                        </div>    
                                        <?php echo form_label('Salas de Multimeios:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($sala_multimeios); ?>
                                        </div>
                                        <?php echo form_label('Acessibilidade/Banheiros Adaptados:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($banheiro_adaptado); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Secretaria:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($secretaria); ?>
                                        </div>    
                                        <?php echo form_label('Brinquedoteca:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($brinquedoteca); ?>
                                        </div>
                                        <?php echo form_label('Sala de Video:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($sala_video); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala da Direção:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_direcao); ?>
                                        </div>    
                                        <?php echo form_label('Biblioteca:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($biblioteca); ?>
                                        </div>
                                        <?php echo form_label('Refeitório:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($refeitorio); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Salas dos Professores:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_professores); ?>
                                        </div>    
                                        <?php echo form_label('Ginásio:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($ginasio); ?>
                                        </div>
                                        <?php echo form_label('Despensa:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($despensa); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala de Orientação Pedagógica:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_orientacao); ?>
                                        </div>    
                                        <?php echo form_label('Quadra Desportiva Aberta:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($quadra_aberta); ?>
                                        </div>
                                        <?php echo form_label('Depósito:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($deposito); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala de Supervisão Escolar:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_supervisao); ?>
                                        </div>    
                                        <?php echo form_label('Quadra Desportiva Coberta:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($quadra_coberta); ?>
                                        </div>
                                        <?php echo form_label('Auditório:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($auditorio); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala de Coordenação Pedagógica:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_coordenacao); ?>
                                        </div>    
                                        <?php echo form_label('Laboratório de Informática:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($lab_informatica); ?>
                                        </div>
                                        <?php echo form_label('Internet da Oi:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($internet_oi); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala de Leitura:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_leitura); ?>
                                        </div>    
                                        <?php echo form_label('Laboratório de Ciências:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($lab_ciencias); ?>
                                        </div>
                                        <?php echo form_label('Internet da PMRG:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($internet_pmrg); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Sala de Artes:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-1">
                                                <?php echo form_input($sala_artes); ?>
                                        </div>    
                                        <?php echo form_label('LAmbiente de Aprendizagem:', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($amb_aprendizagem); ?>
                                        </div>
                                        <?php echo form_label('Laboratório de Matemática:', 'nome', array('class' => 'col-sm-3 control-label')); ?>
                                        <div class="col-sm-1">
                                            <?php echo form_input($lab_matematica); ?>
                                        </div>
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
                                    <?php echo anchor($anchor1.'/'.$id, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
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

<!-- /.modal -->
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