<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <?php $anchor1 = 'admin/pedidos'?>
        <?php $anchor2 = 'admin/escolas'?>
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
                        <!---Inicio campos  --->
                                <!--campos demonstrativo mensal -->
                                    <?php if($ano == 1000){$ano = "Ano, Não Informado";}  ?>
                                    <?php echo form_fieldset('Dados de ' .$ano); ?>
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
                                                                                
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-10">
                                                <div class="btn-group">
                                                    <?php
                                                    $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                                                    $edit = '<i class="fa fa-pencil"></i> <span>Editar</span>';
                                                    $redo = '<i class="fa fa-refresh"></i> <span>Reiniciar</span>';
                                                    $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                                    $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';
                                                    ?>
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-azul btn-flat', 'content' => $submit)); ?>
                                                    <?php echo anchor($anchor1.'/index/'.$idescola['value'], $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                                                    <?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger btn-flat', 'content' => $delete, "id" => "btExcluir")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_fieldset_close(); ?>
                                <!---Fim Campos demonstrativo mensal--->
                                <!--campos demonstrativo diario -->
                                 <div class="box-body">
                                    <table class="table table-striped table-hover datatable">
                                        <thead>
                                            <tr>
                                                <!--<th>ID</th>-->
                                                <th>Número</th>
                                                <th>Genero</th>
                                                <th>Quantidade</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($demodia as $de) : ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($de['numero']); ?></td>
                                                    <td><?php echo htmlspecialchars($de['generos']); ?></td>
                                                    <td><?php echo htmlspecialchars($de['quantidade']); ?></td>
                                                    
                                                
                                                    <!-- Opções -->
                                                    <td>
                                                    <?php echo anchor($anchor1.'/edit/'.$de['id'], $edit, array('class' => 'btn btn-azul btn-flat')); ?>
                                                            
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                        <!-- Fim campos demonstrativo diario -->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!---modal---->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Atenção!</b></h4>
            </div>

            <div class="modal-body">
                <p>Deseja realmente excluir esse registro?</p>
                <p>Ao excluir esse registro todos os registros vinculados seráo apagados.</p>
           
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btExcluirConfirmar">Excluir</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->