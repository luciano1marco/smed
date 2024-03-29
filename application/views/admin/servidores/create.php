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

                        <?php echo form_fieldset('Dados do Servidor'); ?>
                        <!--campos -->
                            <div class="form-group">
                                <?php echo form_label('Matricula', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($matricula); ?>
                                </div>
                                <?php echo form_label('CPF', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($cpf); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Nome do Servidor', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-3">
                                    <?php echo form_input($nome); ?>
                                </div>
                                <?php echo form_label('Data de Nascimento', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($dt_nascimento); ?>
                                </div>
                            </div>
                            <div class="form-group">   
                                <?php echo form_label('Cidade de Residencia', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($cidade); ?>
                                </div>
                                <?php echo form_label('Telefone', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($telefone); ?>
                                </div>
                            </div>
                            <div class="form-group">   
                                <?php echo form_label('Endereço', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-5">
                                    <?php echo form_input($endereco); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Sexo', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($sexo); ?>
                                </div>
                                <?php echo form_label('E-mail', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-4">
                                    <?php echo form_input($email); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Ensino Médio', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($ensino_medio); ?>
                                </div>
                                <?php echo form_label('Ensino Superior', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($ensino_superior); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Graduação', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($graduacao); ?>
                                </div>
                                <?php echo form_label('Nome da Graduação', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-4">
                                    <?php echo form_input($nome_pos); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Area do Concurso', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($area_concurso); ?>
                                </div>
                                <?php echo form_label('Ano de Admissão', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-1">
                                    <?php echo form_input($ano_admissao); ?>
                                </div>
                                <?php echo form_label('Regime de Trabalho', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_dropdown($regime); ?>
                                </div>
                            </div>
                            <!---Fim Campos--->
                        
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
                                    <?php echo anchor($anchor1.'/index/'.$id, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
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