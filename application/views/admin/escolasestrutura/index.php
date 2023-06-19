<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/escolas' ?>
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Estrutura da Escola</h3>
							</div>
						</div>
					</div>
					<?php foreach ($escolas_estrutura as $i) : ?>
						<div class="box-header with-border">
							<!--<h3 class="box-title"><?php echo anchor($anchor . '/create/'. $i['escola_id'], '<i class="fa fa-plus"></i> ' . 'Estrutura', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;--->
							<div class="card text-center" >
								<div class="card-header">
									<h2><?php echo $i['nome']; ?></h2>
								</div>
							
								<div class="card-body">
									<div class="col-md-3">
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Salas de Aulas Existentes:&nbsp;&nbsp;	 
													<?php echo $i['sala_existentes']; ?></li>
											<li class="list-group-item">Salas de Recursos:&nbsp;&nbsp;	 
													<?php echo $i['sala_recursos']; ?></li>
											<li class="list-group-item">Acessibilidade/Rampa:&nbsp;&nbsp;	 
													<?php echo $i['rampa']; ?></li>
											<li class="list-group-item">Salas de Aulas em Uso:&nbsp;&nbsp;	 
													<?php echo $i['sala_uso']; ?></li>
											<li class="list-group-item">Salas de Multimeios:&nbsp;&nbsp;	 
													<?php echo $i['sala_multimeios']; ?></li>
											<li class="list-group-item">Acessibilidade/Banheiros Adaptados:&nbsp;&nbsp;	 
													<?php echo $i['banheiro_adaptado']; ?></li>
										</ul>
									</div>
									<div class="col-md-2">
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Secretaria:&nbsp;&nbsp;	 
													<?php echo $i['secretaria']; ?></li>
											<li class="list-group-item">Brinquedoteca:&nbsp;&nbsp;	 
													<?php echo $i['brinquedoteca']; ?></li>
											<li class="list-group-item">Sala de Video:&nbsp;&nbsp;	 
													<?php echo $i['sala_video']; ?></li>
											<li class="list-group-item">Sala da Direção:&nbsp;&nbsp;	 
													<?php echo $i['sala_direcao']; ?></li>
											<li class="list-group-item">Biblioteca:&nbsp;&nbsp;	 
													<?php echo $i['biblioteca']; ?></li>
													<li class="list-group-item">Refeitório:&nbsp;&nbsp;	 
													<?php echo $i['refeitorio']; ?></li>
											</ul>
									</div>
									<div class="col-md-2">
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Salas dos Professores:&nbsp;&nbsp;	 
													<?php echo $i['sala_professores']; ?></li>
											<li class="list-group-item">Ginásio:&nbsp;&nbsp;	 
													<?php echo $i['ginasio']; ?></li>
											<li class="list-group-item">Despensa:&nbsp;&nbsp;	 
													<?php echo $i['despensa']; ?></li>
											<li class="list-group-item">Sala de Orientação Pedagógica:&nbsp;&nbsp;	 
													<?php echo $i['sala_orientacao']; ?></li>
											<li class="list-group-item">Quadra Desportiva Aberta:&nbsp;&nbsp;	 
													<?php echo $i['quadra_aberta']; ?></li>
													<li class="list-group-item">Depósito:&nbsp;&nbsp;	 
													<?php echo $i['deposito']; ?></li>
											</ul>
									</div>
									<div class="col-md-3">
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Sala de Supervisão Escolar:&nbsp;&nbsp;	 
													<?php echo $i['sala_supervisao']; ?></li>
											<li class="list-group-item">Quadra Desportiva Coberta:&nbsp;&nbsp;	 
													<?php echo $i['quadra_coberta']; ?></li>
											<li class="list-group-item">Auditório:&nbsp;&nbsp;	 
													<?php echo $i['auditorio']; ?></li>
											<li class="list-group-item">Sala de Coordenação Pedagógica:&nbsp;&nbsp;	 
													<?php echo $i['sala_coordenacao']; ?></li>
											<li class="list-group-item">Laboratório de Informática:&nbsp;&nbsp;	 
													<?php echo $i['lab_informatica']; ?></li>
													<li class="list-group-item">Internet da Oi:&nbsp;&nbsp;	 
													<?php echo $i['internet_oi']; ?></li>
											</ul>
									</div>
									<div class="col-md-2">
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Sala de Leitura:&nbsp;&nbsp;	 
													<?php echo $i['sala_leitura']; ?></li>
											<li class="list-group-item">Laboratório de Ciências:&nbsp;&nbsp;	 
													<?php echo $i['lab_ciencias']; ?></li>
											<li class="list-group-item">Internet da PMRG:&nbsp;&nbsp;	 
													<?php echo $i['internet_pmrg']; ?></li>
											<li class="list-group-item">Sala de Artes:&nbsp;&nbsp;	 
													<?php echo $i['sala_artes']; ?></li>
											<li class="list-group-item">Ambiente de Aprendizagem:&nbsp;&nbsp;	 
													<?php echo $i['amb_aprendizagem']; ?></li>
													<li class="list-group-item">Laboratório de Matemática:&nbsp;&nbsp;	 
													<?php echo $i['lab_matematica']; ?></li>
											</ul>
									</div>
								</div>
   								<div class="card-footer text-muted">
									<!--<h3 class="box-title"><?php echo anchor($anchor . '/edit/'. $i['escola_id'], '<i class="fa fa-pencil"></i> ' . 'Editar', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>--->
									<?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';?>
									<?php echo anchor($anchor1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                       			</div>	
							</div>
							


						</div>	
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</div>