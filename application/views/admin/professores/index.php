<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>

	<!-- FLASH MESSAGE -->
	<div style="margin-top: 8px" id="alert_message">
		<?php
		if ($this->session->userdata("message") != null) {
		?>
			<div class="alert alert-info alert-dismissable" role="alert">
				<?php echo $this->session->userdata("message"); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php
		}
		?>
	</div>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">

					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Professores</h3>

							</div>
						</div>

					</div>

					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor('admin/professores/create', '<i class="fa fa-plus">Adicionar Professor</i> ' , array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Nome</th>
									<th>CPF</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Endereço</th>
									<th>Data_Nasc.</th>
									<th>Ativo</th>
									<th>Açoes</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($professor as $i) : ?>
									<?php 							
								
										$ativo   	= $i['ativo'];
										$id 		= $i['id'];
										// Para usar ID depois							
										$id_check['value'] = $i['id'];

										$sim = '<span class="label label-success">SIM</span>';
										$nao = '<span class="label label-default">NÃO</span>';
									?>
									<tr>
										<td><?php echo $i->nome; ?></td>
										<td><?php echo $i->cpf; ?></td>
										<td><?php echo $i->email; ?></td>
										<td><?php echo $i->telefone; ?></td>
										<td><?php echo $i->endereco; ?></td>
										<td><?php echo $i->data_nasc; ?></td>
										
										<!-- Publicado -->
										<td><?php echo ($ativo) ? anchor($anchor.'/deactivate/'.$id, $sim) : anchor($anchor.'/activate/'. $id, $nao); ?></td>

										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $i->id, "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
											<span>&nbsp;</span>
											<?php echo anchor($anchor . '/view/' . $i->id, "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Ver</button>"); ?>
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