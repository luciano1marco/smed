<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/servidores' ?>
		<?php $anchor2 = 'admin/turmas' ?>
		<?php $anchor3 = 'admin/cardapio' ?>
		<?php $anchor4 = 'admin/demonstrativo' ?>
		<?php $anchor5 = 'admin/atendimento' ?>
		
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Escolas</h3>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create', '<i class="fa fa-plus"></i> ' . 'Nova Escola', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Nome</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($escolas as $i) : ?>
									<tr>
										<td><?php echo htmlspecialchars($i['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar Escola</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor . '/view/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Dados Escola</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor1 . '/index/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Servidores</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor2 . '/index/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Turmas</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor3 . '/index/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Cardapios</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor4 . '/index/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Demonstrativo</button>"); ?>&nbsp;&nbsp;
											<?php echo anchor($anchor5 . '/index/' . $i['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-search\"></i> Atendimento</button>"); ?>&nbsp;&nbsp;
											
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