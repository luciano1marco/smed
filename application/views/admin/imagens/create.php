<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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
                    <div class="content">
                        <?php echo $message; ?>
                            <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                            <?php echo form_fieldset('Dados'); ?>
                        <div class="form-group">  
                            <?php echo form_label('', 'arquivo', array('class' => 'col-sm-2 control-label')); ?>  
                            <div class="col-sm-4"> 
                            <!--<input type="file" name="arquivo[]" multiple /> -->
                            <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#modalImagem">
                                Anexar Arquivo
                            </button>   
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

<!-- modal anexar arquivoetapa -->
    <div class="modal" id="modalImagem">
        <form enctype="multipart/form-data" id="arquivosetapa" method="post" action="<?= base_url("admin/imagens/uploadarquivos") ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php echo form_label('Descrição', 'descricao', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input($descricao); ?>
                        </div>
                    </div>
                    <div class="modal-header">
                        <?php echo form_label('Tipo', 'tipo', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-4">
                            <?php echo form_input($tipo); ?>
                        </div>
                    </div>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  ><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Anexo de arquivos</h4>
                    </div>
                    <div class="modal-body">
                        <label>Selecione os arquivos (Tamanho máximo: 5 MB)</label>
                        <input type="file" name="arquivos[]" multiple />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-orange" value="Enviar" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- modal excluir arquivo-->            
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
                <button type="button" class="btn btn-danger" id="btExcluirarquivo"><?php echo $delete; ?></button> 
                
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->    