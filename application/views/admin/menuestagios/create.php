<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php $anchor = 'admin/'.$this->router->class; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                <div class="col-sm-6">
                    <h1><?php echo $pagetitle; ?></h1>
                </div>
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard"><i class="fa fa-tachometer-alt"></i> Painel Principal</a></li>
                    <li class="breadcrumb-item">Itens do Menu de Estagio</li>
                    <li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card card-primary card-outline">
                <div class="card-header">     
                    <h3 class="card-title">Criar Itens de Menu</h3>      
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>                
                    </div>

                </div>

                <div class="card-body">

                <!-- Alerta de Validação CODE IGNITER -->                    
               
                  
                <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create')); ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right" for="controller">Controlador</label>
                        <div class="col-sm-10">
                            <?php echo form_input($controller);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right" for="descricao">Descrição</label>
                        <div class="col-sm-10">
                            <?php echo form_input($descricao);?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right" for="publicado">Publicado</label>                                        
                        <div class="col-sm-10">
                            <?php echo form_checkbox($publicado);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-2 col-sm-10">
                            <div class="btn-group">
                                <?php
                                $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                $redo = '<i class="fa fa-redo"></i> <span>Reiniciar</span>';
                                $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
                               	
                                ?>
                               <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>
                                <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>                                                   
                                <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
                
                </div>
                <!-- /.card-body -->        
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
