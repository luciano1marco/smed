<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php  $anchor = 'admin/'.$this->router->class; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<!-- Content Header (Page header) -->
		<div class="content-header">        
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark"><?php echo $pagetitle; ?></h1>		
					</div>            
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard"><i class="fa fa-tachometer-alt"></i> Painel Principal</a></li>
						<li class="breadcrumb-item">Professores</li>
						<li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
						</ol>
					</div>           
				</div>          
			</div>     
		</div>

		<?php if($this->session->userdata("message") != null) { ?>		
			<div class="alert alert-primary alert-dismissable" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h5><i class="icon fas fa-info"></i> Informações</h5>    
				<?php echo $this->session->userdata("message"); ?>           			
			</div>		
		<?php } ?>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">           
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">							
								<?php                        
									$adduser = '<i class="fa fa-plus"></i> &nbsp;  Professor'; 
									$link = base_url($anchor.'/create/');                                                 
								?>                               
								<?php echo anchor($link, $adduser, array('class' => 'btn btn-primary no-print')); ?>  							
							</h3>
						</div>
						<div class="card-body table-responsive">
							<table class="table table-striped table-hover datatable">
								<thead>
									<tr>
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
								<?php foreach ($professor as $i):?>
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
										<td><?php echo htmlspecialchars($i['cpf'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['email'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['telefone'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['endereco'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['datanasc'], ENT_QUOTES, 'UTF-8'); ?></td>
											
										<!-- Publicado -->
										<td><?php echo ($ativo) ? anchor($anchor.'/deactivate/'.$id, $sim) : anchor($anchor.'/activate/'. $id, $nao); ?></td>

										<!-- Opções -->                                            
										<td>
											<?php echo anchor($anchor.'/edit/'.$i['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						</div> <!-- Card Body -->
					</div> 	<!-- Card -->
				</div> 	<!-- Col -->
			</div> 	<!-- Row -->
		</div> 	<!-- Container -->
	</section> 	<!-- Section -->
</div>  <!-- Content Wrapper. Contains page content -->
