<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>

    <!---Dados da Escola----->
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

                        <?php echo form_fieldset('Dados da Escola'); ?>
                        <!--campos -->
                                               
                        <div class="form-group">
                            <?php echo form_label('Nome da Escola', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($nome); ?>
                            </div>
                            
                            <?php echo form_label('Endereço', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($endereco); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Complemento', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($complemento); ?>
                            </div>
                            <?php echo form_label('Bairro', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($bairro); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('CEP', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($cep); ?>
                                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" class="link-primary" target="blank">Buscar CEP</a>
                            </div>
                        
                            <?php echo form_label('Telefone', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-2">
                                <?php echo form_input($telefone); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Fax', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-3">
                                <?php echo form_input($fax); ?>
                            </div>
                            <?php echo form_label('Localização Geográfica', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-2">
                                <?php echo form_dropdown($localizacao); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Tipo de Convenio', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-2">
                                <?php echo form_dropdown($tipo); ?>
                            </div>
                            <?php echo form_label('Endereço de Pagina ou Blog', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-4">
                                <?php echo form_input($pagina); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Email', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-4">
                                <?php echo form_input($email); ?>
                            </div>
                            <?php echo form_label('Número do NIS( Censo Escolar)', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-2">
                                <?php echo form_input($nis); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Diretor', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-2">
                                <?php echo form_dropdown($diretor); ?>
                            </div>
                            <?php echo form_label('Número Total de Alunos', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                                <div class="col-sm-1">
                                    <?php echo form_input($alunos); ?>
                                </div> 
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Participa das Matriculas On-line', 'nome', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-1">
                                <?php echo form_dropdown($participa); ?>
                            </div>
                        </div>
                       <!----fim campos dados da escola---->
                      
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