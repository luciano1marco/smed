<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
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
						<div class="panel panel-azul">
							<div class="panel-heading">
							<?php foreach ($escolas as $e) : ?>
									<h3 align="center" style="color:black">Cardapios da Escola: &nbsp;&nbsp; <?php echo $e['nome']; ?></h3>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create/'.$e['id'], '<i class="fa fa-plus"></i> ' . 'Novo Cardapio', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<th>De</th>
									<th>Ate</th>
									<th>Tipo</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cardapio as $i) : ?>
									<tr>
									<td><?php echo htmlspecialchars(date_format(date_create($i['semana_de']),"d/m/Y"), ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars(date_format(date_create($i['semana_ate']),"d/m/Y"), ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $i['id'].'/'.$i['idescola'], "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
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