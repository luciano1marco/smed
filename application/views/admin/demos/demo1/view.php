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
                        <h1>Pessoas</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="fa fa-tachometer-alt"></i> Painel Principal</a></li>
                        <li class="breadcrumb-item">Usuários</li>
                        <li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body">
                <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                            <?php echo form_hidden($id);?>

                            <div class="form-group row">                                           
                                <?php echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label')); ?>       

                                <div class="col-sm-10">
                                    <?php echo form_input($nome);?>
                                </div>
                            </div>

                            <div class="form-group row">                                           
                                <?php echo form_label('Idade', 'idade', array('class' => 'col-sm-2 control-label')); ?>       

                                <div class="col-sm-10">
                                    <?php echo form_input($idade);?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php echo form_label('Publicado', 'publicado', array('class' => 'col-sm-2 control-label')); ?>       
                                    
                                    <div class="col-sm-10">
                                        <?php echo form_checkbox($publicado);?>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="offset-2 col-sm-10">
                                    <div class="btn-group">             
                                        <?php
                                        $edit   = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                        $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                        $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                     
                                        ?>
                                        <?php echo anchor($anchor.'/edit/'.$id['id'], $edit, array('class' => 'btn btn-primary btn-flat')); ?>                                    
                                        <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                        <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger', 'content' => $delete, "id" => "btExcluir")); ?>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    
                </div>
            
                <div class="card-footer">            
                </div>
                
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- modal -->            
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
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar"><?php echo $delete; ?></button> 
                
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->  