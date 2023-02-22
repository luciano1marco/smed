<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
        <h3 class="box-title" align="center">Dados Pessoais</h3>

    </section>

    <!------------------------------------------------------------------------------->
    <section class="content">
        <div class="row">
            <?php foreach ($parente as $p) : ?>
                <div class="col-md-6">
                    <!--1-dados do usuario da rede ------------------------------------------>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados do Parente  </h3>
                            &nbsp;&nbsp;
                              
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <label class="col-sm-4">Nome</label>
                                <div class="col-sm-8">
                                    <p> <?= $p['nome'] ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Email</label>
                                <div class="col-sm-8">
                                    <p><?= ($p['email']); ?>&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Telefone</label>
                                <div class="col-sm-8">
                                    <p><?= ($p['telefone']); ?>&nbsp;</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4">Data de Nascimento</label>
                                <div class="col-sm-8">
                                    <p><?= ($p['data_nasc']); ?>&nbsp;</p>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4">CPF</label>
                                <div class="col-sm-8">
                                    <p><?= ($p['cpf']); ?>&nbsp;</p>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4">Grau Parentesco </label>
                                <div class="col-sm-8">
                                    <p><?= ($p['nomegrau']); ?>&nbsp;</p>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-4">Socio</label>
                                <div class="col-sm-8">
                                    <p><?php echo $p['socio']; ?>&nbsp;</p>

                                </div>
                            </div>

                            <?php echo anchor('admin/familias/index/'.$p['id_socio'], "<button class=\"btn btn-default\"><i class=\"fa fa-reply\"></i> Voltar</button>"); ?>  
                        </div>

                    </div>
                </div>
               
            <?php endforeach; ?>
        </div>
    </section>
    <!---------------------------------------------------------------------------------->
</div>

<!----Modal para deletar usuariorede----------------------------------------------------->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atenção!</h4>
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