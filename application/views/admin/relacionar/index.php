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
	&nbsp;&nbsp;&nbsp;&nbsp;

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-orange">
							<div class="panel-heading">
								<h3 align="center">Relacionar Cargo</h3>

							</div>
						</div>

					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create', '<i class="fa fa-plus"></i> ' . 'Criar', array('class' => 'btn btn-block btn-orange btn-flat')); ?></h3>
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Sócio</th>
									<th>Cargo</th>
									<th>Data de Início</th>
									<th>Data de Término</th>
									<th>Ativo</th>
									<th>Ação</th>
								</tr>
							</thead>

							<tbody>

								<?php foreach ($relaciona as $i) : ?>
									<?php 							
								
										$ativo   	= $i['ativo'];
										$id 		= $i['id'];
										// Para usar ID depois							
										$id_check['value'] = $i['id'];

										$sim = '<span class="label label-success">SIM</span>';
										$nao = '<span class="label label-default">NÃO</span>';
									?>

									
									<tr>

										<td><?php echo htmlspecialchars($i['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['dt_inicio'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['dt_final'], ENT_QUOTES, 'UTF-8'); ?></td>
										<!-- Publicado -->
										<td><?php echo ($ativo) ? anchor($anchor.'/deactivate/'.$id, $sim) : anchor($anchor.'/activate/'. $id, $nao); ?></td>

										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $i['id'], "<button class=\"btn btn-orange\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
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