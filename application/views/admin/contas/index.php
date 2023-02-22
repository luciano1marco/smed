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
								<h3 align="center">Contas</h3>

							</div>
						</div>

					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create', '<i class="fa fa-plus"></i> ' . 'Criar Conta', array('class' => 'btn btn-block btn-orange btn-flat')); ?></h3>
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Descrição</th>
									<th>Ação</th>
								</tr>
							</thead>

							<tbody>

								<?php foreach ($conta as $ti) : ?>
									<tr>

										<td><?php echo htmlspecialchars($ti['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
										
										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $ti['id'], "<button class=\"btn btn-orange\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
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