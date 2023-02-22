<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php $icon = '<i class="fa fa-' . $pageicon . '"></i>'; ?>
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/pessoas'?>
		<?php $anchor2 = 'admin/mensalidades'?>
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
<!----Filiacao---------------------------->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-orange">
							<div class="panel-heading">
								<h3 align="center">
									<?php foreach ($socio as $f) : ?>
										<?php echo htmlspecialchars($f['nome'], ENT_QUOTES, 'UTF-8'); ?>
									<?php endforeach; ?>
								</h3>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
							<?php  $cancel = '<i class="fa fa-reply"></i> Voltar';?>
                                   
							<h3 class="box-title">
								<?php echo anchor($anchor . '/create/'.$f['id'], '<i class="fa fa-plus"></i> ' . 'Adicionar Parente', array('class' => 'btn btn-block btn-orange btn-flat')); ?>
							</h3>
							
							<h3 class="box-title">
							&nbsp;&nbsp;&nbsp;&nbsp;
								<?php echo anchor($anchor1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
							</h3> 
							<h3 class="text-center">Filiação</h3>         
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Nome</th>
									<th>Grau Parentesco</th>
									<th>Açoes</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($familia as $i) : ?>
									<?php
                                     $visualiza = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                                      ?>
									<tr>
										<td><?php echo htmlspecialchars($i['parente'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
										<!-- Opções -->                                            
										<td>
											<?php echo anchor($anchor.'/edit/'.$i['id'], "<button class=\"btn btn-orange\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>&nbsp;&nbsp;&nbsp;&nbsp;
											<?php echo anchor($anchor.'/view/'.$i['id'], "<button class=\"btn btn-orange\"><i class=\"fa fa-search\"></i> Visualizar</button>"); ?>
											
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
<!----Mensalidade---------------------------->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						
					</div>
					<div class="box-header with-border">
						<?php  $cancel = '<i class="fa fa-reply"></i> Voltar';?>
                                   
						<h3 class="box-title">
							<?php echo anchor($anchor2 . '/create/'.$f['id'], '<i class="fa fa-plus"></i> ' . 'Adicionar Pagamento', array('class' => 'btn btn-block btn-orange btn-flat')); ?>
						</h3>
						
						<h3 class="box-title">
						&nbsp;&nbsp;&nbsp;&nbsp;
							<?php echo anchor($anchor1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
						</h3> 
						<h3 class="text-center">Mensalidades</h3>             
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Ano</th>
									<th>Valor</th>
									<th>Jan</th>
									<th>Fev</th>
									<th>Mar</th>
									<th>Abr</th>
									<th>Mai</th>
									<th>Jun</th>
									<th>Jul</th>
									<th>Ago</th>
									<th>Set</th>
									<th>Out</th>
									<th>Nov</th>
									<th>Dez</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mensalida as $i) : ?>
									<?php 
										$janeiro   		= $i['janeiro'];
										$fevereiro   	= $i['fevereiro'];
										$marco		   	= $i['marco'];
										$abril   		= $i['abril'];
										$maio 		  	= $i['maio'];
										$junho   		= $i['junho'];
										$julho   		= $i['julho'];
										$agosto   		= $i['agosto'];
										$setembro   	= $i['setembro'];
										$outubro   		= $i['outubro'];
										$novembro   	= $i['novembro'];
										$dezembro   	= $i['dezembro'];

										 
										$id 		= $i['id'];
										// Para usar ID depois							
										$id_check['value'] = $i['id'];

										$sim = '<span class="label label-success">SIM</span>';
										$nao = '<span class="label label-default">NÃO</span>';
									?>  
									<tr>
										<td><?php echo htmlspecialchars($i['ano'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['valor'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo ($janeiro) 	? anchor($anchor.'/desactive_jan/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_jan/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($fevereiro) ? anchor($anchor.'/desactive_fev/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_fev/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($marco) 	? anchor($anchor.'/desactive_mar/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_mar/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($abril) 	? anchor($anchor.'/desactive_abr/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_abr/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($maio) 		? anchor($anchor.'/desactive_mai/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_mai/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($junho) 	? anchor($anchor.'/desactive_jun/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_jun/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($julho) 	? anchor($anchor.'/desactive_jul/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_jul/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($agosto) 	? anchor($anchor.'/desactive_ago/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_ago/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($setembro) 	? anchor($anchor.'/desactive_set/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_set/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($outubro) 	? anchor($anchor.'/desactive_out/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_out/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($novembro) 	? anchor($anchor.'/desactive_nov/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_nov/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										<td><?php echo ($dezembro) 	? anchor($anchor.'/desactive_dez/'.$id. '/'. $i['id_socio'], $sim) : anchor($anchor.'/active_dez/'. $id. '/'. $i['id_socio'], $nao); ?></td>	
										
										
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
