<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php  $anchor = 'admin/'.$this->router->class; ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

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
				<li class="breadcrumb-item">Itens de Menu</li>
				<li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
				</ol>
			</div>           
			</div>          
		</div>     
	</div>

	<?php
	if($this->session->userdata("message") != null)
	{
	?>		
		<div class="alert alert-primary alert-dismissable" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h5><i class="icon fas fa-info"></i> Informações</h5>    
			<?php echo $this->session->userdata("message"); ?>           			
		</div>		
	<?php
	}
	?>

	<!-- Main content -->
    <section class="content">
	
        <div class="container-fluid">           
            <div class="row">
				<div class="col-12">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">							
							<?php                        
                                $additem = '<i class="fa fa-plus"></i> Criar Itens';
                                $link = base_url($anchor.'/create/');                                                 
                            ?>                               
                            <?php echo anchor($link, $additem, array('class' => 'btn btn-primary no-print')); ?>  							
						</h3>
					</div>

					<div class="card-body table-responsive">
						<table id="datatable" class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Descrição</th>
									<th>Controlador</th>
									<th>Publicado</th>
									<th>Açoes</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach ($menuestagio as $i):?>
							<?php 							
								$descricao = $i['descricao'];
								$controller = $i['controller'];
								$publicado 	= $i['publicado'];
								$id 		= $i['id'];
								// Para usar ID depois							
								$id_check['value'] = $i['id'];

								$pill_success = '<span class="badge badge-pill badge-primary">SIM</span>';
								$pill_danger = '<span class="badge badge-pill badge-danger">NÃO</span>';

								$anchor_enable = anchor($anchor.'/activate/'.$id, $pill_danger);
								$anchor_disable = anchor($anchor.'/deactivate/'.$id, $pill_success);	
								?>
							
								<tr>
									<!--<td><?php echo form_checkbox($id_check);?></td>-->			
									<!--<td><?php echo $controller; ?></td>-->
																											
									<td><?php echo anchor($anchor.'/profile/'.$id, $descricao); ?></td>
									<td><?php echo $controller; ?></td>
									
									<!-- Publicado -->																		
									<td><?php echo ($publicado) ? $anchor_disable : $anchor_enable ?></td>

									<?php                          
									$edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
									$view = '<i class="fa fa-search"></i> <span>Ver</span>'; 
									$arquivo = '<i class="fa fa-paperclip"></i> <span>Arquivar</span>'; 
									?>
								<!-- Opções -->                                            
									<td>									   
										<?php echo anchor($anchor.'/arquivos/'.$id, $arquivo, array('class' => 'btn btn-primary')); ?> 
										<?php echo anchor($anchor.'/edit/'.$id, $edit, array('class' => 'btn btn-primary')); ?> 
										<?php echo anchor($anchor.'/profile/'.$id, $view, array('class' => 'btn btn-primary')); ?> 					
									</td>	
								</tr>
								
							<?php endforeach;?>
							</tbody>		
						</table>             
			 		</div>
				</div>
				</div>
				</div>  
			<!-- Row -->
        </div>  
		<!-- Content -->
    </section>  
    <!-- Main content -->
	</div>
    <!-- Content Wrapper. Contains page content -->