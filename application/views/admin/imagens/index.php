<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header">
		<?php $icon = '<i class="fa fa-' . $pageicon . '"></i>'; ?>
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-orange">
							<div class="panel-heading">
								<h3 align="center">Imagens</h3>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<button type="button" class="btn btn-orange" data-toggle="modal" data-target="#modalImagem">
						Adicionar Imagem     
					</button> 
					</div>

					<?php $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';?>

					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Descrição</th>
									<th>tipo</th>
									<th>Caminho</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($imagem as $ima) : ?>
									<tr>
										<td><?php echo htmlspecialchars($ima['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($ima['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($ima['caminho'], ENT_QUOTES, 'UTF-8'); ?></td>
										
										<!-- Opções -->
										<td>
											<?php echo anchor($anchor.'/apagararquivo/'.$ima['id'], $delete, array('class' => 'btn btn-orange')); ?> 
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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
                            <?php echo form_dropdown($tipo); ?>
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
