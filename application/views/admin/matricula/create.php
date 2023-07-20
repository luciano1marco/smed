<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/servidores/view/'.$id ?>
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
                        <?php $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';?>
                        <!--campos -->
                            <div class="form-group">
                                <?php echo form_label('Número da Matrícula', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-2">
                                    <?php echo form_input($descricao); ?>
                                </div>
                            </div>
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
                                    <?php echo anchor($anchor1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>
                                </div>
                            </div>
                        </div>
                            <!-- mostra as areas selecionadas --> 
                            <?php echo form_fieldset('Matricula(s) do Servidor'); ?>
                            <div class="col-md-3">
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($matricula as $row):?>
                                        <li class="list-group-item">
                                            <?php echo $row['descricao'];
                                                echo anchor($anchor.'/apagarmatricula/'.$row['id'], $delete, array('class' => 'btn btn-light'));  
                                            ?>
                                        </li>
                                    <?php endforeach; ?>	
                                </ul>
                            </div>
                            <!---Fim Campos--->
                            <?php echo form_fieldset_close(); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>