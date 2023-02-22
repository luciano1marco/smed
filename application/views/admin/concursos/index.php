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
					<li class="breadcrumb-item">Concurso</li>
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
						<h4 class="card-title">							
							<?php                        
                                $addpessoas = '<i class="fa fa-plus"></i> Criar Concurso '; 
								$publico = '<i class="fa fa-search"></i> Concurso Público ';
								$estagiario = '<i class="fa fa-search"></i>Processo Seletivo Estagiário ';
								$simplificado = '<i class="fa fa-search"></i> Processo Seletivo Simplificado ';
								$interno = '<i class="fa fa-search"></i> Processo Seletivo Interno ';
								$link = base_url($anchor.'/create/'); 
								$link1 = base_url($anchor.'/index/'); 
								                                                
                            ?>                               
                            <?php echo anchor($link, $addpessoas, array('class' => 'btn btn-primary no-print')); ?> 
							<?php echo anchor($link1.'3', $publico, array('class' => 'btn btn-danger no-print')); ?>  							
							<?php echo anchor($link1.'2', $estagiario, array('class' => 'btn btn-success no-print')); ?>  							
							<?php echo anchor($link1.'1', $simplificado, array('class' => 'btn btn-info no-print')); ?>  							
							<?php echo anchor($link1.'4', $interno, array('class' => 'btn btn-warning no-print')); ?>  							
				 							
						</h4>
					</div>

					<div class="card-body table-responsive">

					<table id="datatable" class="table table-striped ">
                        <thead>
                         	<tr>
								<!--<th>ID</th>-->
								<th>Titulo</th>
								<th>Sub-Titulo</th>
								<th>Departamento</th>
								<th>Núm. Processo</th>
                                <th>Ano</th>
                                <th>D.Publucação</th>
                                <th>D.Homologação</th>
								<th>D.Vigência</th>
								<th>Ativo</th>
                                <th>Ação</th>													
                            </tr>
                        </thead>

                        <tbody>						
							<?php foreach ($concursos as $p):?>
                                <?php 							
								$titulo     = $p['desctitulo'];
								$subtitulo     = $p['subtitulo'];
								$departamento     = $p['descdep'];
								$num 		= $p['num'];
								$ano 	    = $p['ano'];
								$publicado 	= $p['ativo'];
                                $data_p 	= $p['data_p'];
                                $data_e 	= $p['data_e'];
								$data_v 	= $p['data_v'];
								$responsavel= $p['responsavel'];
                                $criador 	= $p['criador'];
                                $empresa 	= $p['empresa'];
                                $link 	    = $p['link'];
                                $id 		= $p['idcon'];
								// Para usar ID depois							
								$id_check['value'] = $p['idcon'];

								$pill_success = '<span class="badge badge-pill badge-primary">SIM</span>';
								$pill_danger = '<span class="badge badge-pill badge-danger">NÃO</span>';

								$anchor_enable = anchor($anchor.'/activate/'.$id, $pill_danger);
								$anchor_disable = anchor($anchor.'/deactivate/'.$id, $pill_success);	
								?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['desctitulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($p['subtitulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($p['descdep'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($p['num'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($p['ano'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars(date_format(date_create($p['data_p']), "d/m/Y" ), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars(date_format(date_create($p['data_e']), "d/m/Y" ), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars(date_format(date_create($p['data_v']), "d/m/Y" ), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo ($publicado) ? $anchor_disable : $anchor_enable ?></td>
       	
									<?php                          
									$edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
									$view = '<i class="fa fa-search"></i> <span>Ver</span>';
									
                                    ?>
                                  
									<!-- Opções -->                                            
									<td>									   
                                        <?php echo anchor($anchor.'/edit/'.$id, $edit, array('class' => 'btn btn-primary')); ?> 
                                        <?php echo anchor($anchor.'/view/'.$id, $view, array('class' => 'btn btn-primary')); ?> 
									</td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>						
					</table>
             
			 		</div>
			</div>
			</div>
		</div>  
        </div>  
		<!--  content -->
    </section>  
    <!-- Main content -->
</div>
<!-- Content Wrapper. Contains page content -->