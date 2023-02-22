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
								<h3 align="center">
									Mensalidades
								</h3>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<?php  $cancel = '<i class="fa fa-reply"></i> Voltar';?>
                                   
						<h3 class="box-title">
							<?php echo anchor($anchor. '/create' , '<i class="fa fa-plus"></i> ' . 'Adicionar Pagamento', array('class' => 'btn btn-block btn-orange btn-flat')); ?>
						</h3>
						
						<h3 class="box-title">
						&nbsp;&nbsp;&nbsp;&nbsp;
							<?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
						</h3>          
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Socio</th>
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
								<?php foreach ($mensalidade as $i) : ?>
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
										<td><?php echo htmlspecialchars($i['socio'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['ano'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['valor'], ENT_QUOTES, 'UTF-8'); ?></td>
										<!-- Publicado -->
										<td><?php echo ($janeiro) 	? anchor($anchor.'/desactive_jan/'.$id, $sim) : anchor($anchor.'/active_jan/'. $id, $nao); ?></td>	
										<td><?php echo ($fevereiro) ? anchor($anchor.'/desactive_fev/'.$id, $sim) : anchor($anchor.'/active_fev/'. $id, $nao); ?></td>	
										<td><?php echo ($marco) 	? anchor($anchor.'/desactive_mar/'.$id, $sim) : anchor($anchor.'/active_mar/'. $id, $nao); ?></td>	
										<td><?php echo ($abril) 	? anchor($anchor.'/desactive_abr/'.$id, $sim) : anchor($anchor.'/active_abr/'. $id, $nao); ?></td>	
										<td><?php echo ($maio) 		? anchor($anchor.'/desactive_mai/'.$id, $sim) : anchor($anchor.'/active_mai/'. $id, $nao); ?></td>	
										<td><?php echo ($junho) 	? anchor($anchor.'/desactive_jun/'.$id, $sim) : anchor($anchor.'/active_jun/'. $id, $nao); ?></td>	
										<td><?php echo ($julho) 	? anchor($anchor.'/desactive_jul/'.$id, $sim) : anchor($anchor.'/active_jul/'. $id, $nao); ?></td>	
										<td><?php echo ($agosto) 	? anchor($anchor.'/desactive_ago/'.$id, $sim) : anchor($anchor.'/active_ago/'. $id, $nao); ?></td>	
										<td><?php echo ($setembro) 	? anchor($anchor.'/desactive_set/'.$id, $sim) : anchor($anchor.'/active_set/'. $id, $nao); ?></td>	
										<td><?php echo ($outubro) 	? anchor($anchor.'/desactive_out/'.$id, $sim) : anchor($anchor.'/active_out/'. $id, $nao); ?></td>	
										<td><?php echo ($novembro) 	? anchor($anchor.'/desactive_nov/'.$id, $sim) : anchor($anchor.'/active_nov/'. $id, $nao); ?></td>	
										<td><?php echo ($dezembro) 	? anchor($anchor.'/desactive_dez/'.$id, $sim) : anchor($anchor.'/active_dez/'. $id, $nao); ?></td>	
										
										
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
