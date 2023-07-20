<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

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

                            <?php echo form_fieldset('Editar Dados'); ?>
                                <!---Inicio campos  --->
                                    <div class="form-group">
                                        <?php echo form_label('De', 'semana_de', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-2">
                                            <?php  echo form_input($semana_de); ?>
                                        </div>
                                        <?php echo form_label('Ate', 'semana_ate', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-2">
                                            <?php echo form_input($semana_ate); ?>
                                        </div>
                                    </div>
                                    <div>    
                                        <?php echo form_label('Tipo', 'tipo', array('class' => 'col-sm-2 control-label')); ?>
                                        <div class="col-sm-6">
                                            <?php echo form_input($tipo); ?>&nbsp; &nbsp; 
                                        </div>
                                    </div>
                                <!----fim dos campos---->
                                
                                 <section class="content">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <div class="box"> 
                                                    <div class="row">
                                                        <?php echo form_fieldset('Semana'); ?>    
                                                        <!---inicio do acordeon---->
                                                        <div class="panel-group" id="accordion">
                                                            <!--segunda------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Segunda</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse1" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'seg_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_m_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Tarde', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_t_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'seg_t_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_t_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Noite', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_n_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'seg_n_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($seg_n_qtde_gasta); ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim segunda---->
                                                            <!--terca------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Terça</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse2" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'ter_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_m_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Tarde', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_t_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'ter_t_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_t_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Noite', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_n_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'ter_n_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($ter_n_qtde_gasta); ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim terca---->
                                                            <!--quarta------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Quarta</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse3" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qua_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_m_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Tarde', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_t_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qua_t_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_t_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Noite', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_n_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qua_n_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qua_n_qtde_gasta); ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim quarta---->
                                                            <!--quinta------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Quinta</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse4" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qui_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_m_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Tarde', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_t_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qui_t_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_t_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Noite', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_n_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'qui_n_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($qui_n_qtde_gasta); ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim quinta---->
                                                            <!--sexta------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Sexta</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse5" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'sex_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_m_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Tarde', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_t_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'sex_t_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_t_qtde_gasta); ?>
                                                                                </div>
                                                                            <?php echo form_label('Noite', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_n_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'sex_n_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sex_n_qtde_gasta); ?>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim sexta---->
                                                            <!--sabado------>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Sabado</a>
                                                                    </h4>
                                                                    </div>
                                                                    <div id="collapse6" class="panel-collapse collapse ">
                                                                        <div class="panel-body">
                                                                            <?php echo form_label('Manhã', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <?php echo form_label('Preparação', 'preparacao', array('class' => 'col-sm-1 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sab_m_preparacao); ?>
                                                                                </div>
                                                                                <?php echo form_label('Quantidade Gasta', 'sab_m_qtde_gasta', array('class' => 'col-sm-2 control-label')); ?>
                                                                                <div class="col-sm-4">
                                                                                    <?php echo form_input($sab_m_qtde_gasta); ?>
                                                                                </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!---fim sabado---->
                                                        </div>
                                                        <!---fim acordeon-------->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                <!---fim section acordeon----------->
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10 ">
                                        <div class="btn-group">
                                            <?php
                                            $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                            $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                            $redo = '<i class="fa fa-refresh"></i> <span>Reiniciar</span>';
                                            $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                            $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';
                                            ?>
                                            <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-azul btn-flat', 'content' => $submit)); ?>
                                            <?php echo anchor($anchor."/index/".$idescola1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                            <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, "id" => "btExcluir")); ?>
                                        </div>
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

<!----modal--------->
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