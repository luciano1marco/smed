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
                        <h3 class="box-title"><?php echo  $texto_create; ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>
                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit')); ?>
                            <?php echo form_fieldset('Dados'); ?>
                                <!--campos demonstrativo mensal -->
                                <div class="form-group">
                                            <?php echo form_label('Mês', 'mes', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-2">
                                                    <?php echo form_dropdown($mes); ?>
                                                </div>
                                            <?php echo form_label('Periodo', 'periodo', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-3">
                                                    <?php echo form_input($periodo); ?>
                                                </div>    
                                        </div> 
                            <?php echo form_fieldset_close(); ?>
                            <!---Fim Campos pedidos mensal--->
                            <!--campos pedidos diario -->
                            <?php echo form_fieldset('Dias'); ?>
                                <?php $diasdomes = date('t');?>
                                <div class="panel-group" id="accordion">
                                    <?php for($i=1; $i<=$diasdomes;$i++){ ?>
                                        <div class="form-group">
                                            <?php echo form_label('Dia', 'numero', array('class' => 'col-sm-1 control-label')); ?>
                                                <div class="col-sm-1">
                                                    <?php echo ($i); ?>
                                                </div>
                                            <?php echo form_label('Genero', 'genero', array('class' => 'col-sm-1 control-label')); ?>
                                                <div class="col-sm-3">
                                                    <?php echo form_input($generos); ?>
                                                </div>
                                            <?php echo form_label('Quantidade', 'quantidade', array('class' => 'col-sm-1 control-label')); ?>
                                                <div class="col-sm-1">
                                                    <?php echo form_input($quantidade); ?>
                                                </div>
                                        </div>
                                    <?php } ?> 
                                </div>       
                                <!-- Fim campos demonstrativo diario -->
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
                                        <?php echo anchor($anchor.'/index/'.$idescola1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
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