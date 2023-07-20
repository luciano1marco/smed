<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/escolasestrutura' ?>
		<?php $anchor2 = 'admin/escolasseries' ?>
		
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Dados da Escola</h3>
							</div>
						</div>
					</div>
					<?php foreach ($escolas as $i) : ?>
						<?php $id1 = $i['id']; ?>
						<div class="box-header with-border">
							<!--<h3 class="box-title"><?php echo anchor($anchor . '/create/'. $i['id'], '<i class="fa fa-plus"></i> ' . 'Estrutura', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;--->
							<div class="card text-center" >
								
								<!--Dados da Escola--->
								<section class="content">
									<div class="row">
										<div class="col-md-12">
											<div class="box">
												<div class="card ">
													<div class="card-header text-center ">
														<h2><?php echo $i['nome']; ?></h2>
													</div>
													<div class="card-body text-left">	
														<div class="row">
															<label class="col-sm-1">Endereço:</label>
															<div class="col-sm-3">
																<p><?=($i['endereco']);?>  </p>
															</div>
															<label class="col-sm-1">Complemento:</label>
															<div class="col-sm-3">
																<p><?=($i['complemento']);?>  </p>
															</div>
															<label class="col-sm-1">Bairro:</label>
															<div class="col-sm-3">
																<p><?=($i['bairro']);?>  </p>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-1">CEP:</label>
															<div class="col-sm-3">
																<p><?=($i['cep']);?>  </p>
															</div>
															<label class="col-sm-1">Telefone:</label>
															<div class="col-sm-3">
																<p><?=($i['telefone']);?>  </p>
															</div>
															<label class="col-sm-1">Fax:</label>
															<div class="col-sm-3">
																<p><?=($i['fax']);?>  </p>
															</div>
														</div>	
														<div class="row">
															<label class="col-sm-1">Localização:</label>
															<div class="col-sm-3">
																<p><?=($i['deslocalizacao']);?>  </p>
															</div>
															<label class="col-sm-1">Tipo:</label>
															<div class="col-sm-3">
																<p><?=($i['destipos']);?>  </p>
															</div>
															<label class="col-sm-1">Pagina:</label>
															<div class="col-sm-3">
																<p><?=($i['pagina']);?>  </p>
															</div>
														</div>	
														<div class="row">
															<label class="col-sm-1">Email:</label>
															<div class="col-sm-3">
																<p><?=($i['email']);?>  </p>
															</div>
															<label class="col-sm-2">Numero do NIS:</label>
															<div class="col-sm-2">
																<p><?=($i['nis']);?>  </p>
															</div>
															<label class="col-sm-1">Diretor(a):</label>
															<div class="col-sm-3">
																<p><?=($i['desdiretor']);?>  </p>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-2">Numero de Alunos:</label>
															<div class="col-sm-1">
																<p><?=($i['alunos']);?></p>
															</div>
															<label class="col-sm-3">Participa das Matriculas On-line  :</label>
															<div class="col-sm-1">
																<p><?=($i['desparticipa']);?>  </p>
															</div>
															
														</div>
														<label class="col-sm-2">Data de Cadastro:&nbsp;&nbsp;<?= $data = implode("/",array_reverse(explode("-",$i['dt_cad'])));?></label>
														<?php endforeach; ?>
													</div>
												</div>					
											</div>
										</div>

									</div>
								</section> 

								<!--Estrutura da Escola--->
								<div class="card-body">
									<section class="content">
										<div class="row">
											<div class="col-md-12">
												<div class="box">
													<?php echo form_fieldset('Estrutura da Escola'); ?>
													<div class="box-header" style="text-align: left;">
														<h3 class="box-title" align=><?php echo anchor($anchor1 . '/create/'. $id1, '<i class="fa fa-plus"></i> ' . 'Nova Estrutura', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
														<?php echo anchor($anchor1 . '/edit/' . $id1, "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i>Editar</button>"); ?>
													</div>
													<?php foreach ($escolasestrutura as $ee) : ?>
														<div class="col-md-3">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Salas de Aulas Existentes:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_existentes']; ?></li>
																<li class="list-group-item">Salas de Recursos:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_recursos']; ?></li>
																<li class="list-group-item">Acessibilidade/Rampa:&nbsp;&nbsp;	 
																		<?php echo $ee['rampa']; ?></li>
																<li class="list-group-item">Salas de Aulas em Uso:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_uso']; ?></li>
																<li class="list-group-item">Salas de Multimeios:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_multimeios']; ?></li>
																<li class="list-group-item">Acessibilidade/Banheiros Adaptados:&nbsp;&nbsp;	 
																		<?php echo $ee['banheiro_adaptado']; ?></li>
															</ul>
														</div>
														<div class="col-md-2">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Secretaria:&nbsp;&nbsp;	 
																		<?php echo $ee['secretaria']; ?></li>
																<li class="list-group-item">Brinquedoteca:&nbsp;&nbsp;	 
																		<?php echo $ee['brinquedoteca']; ?></li>
																<li class="list-group-item">Sala de Video:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_video']; ?></li>
																<li class="list-group-item">Sala da Direção:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_direcao']; ?></li>
																<li class="list-group-item">Biblioteca:&nbsp;&nbsp;	 
																		<?php echo $ee['biblioteca']; ?></li>
																		<li class="list-group-item">Refeitório:&nbsp;&nbsp;	 
																		<?php echo $ee['refeitorio']; ?></li>
																</ul>
														</div>
														<div class="col-md-2">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Salas dos Professores:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_professores']; ?></li>
																<li class="list-group-item">Ginásio:&nbsp;&nbsp;	 
																		<?php echo $ee['ginasio']; ?></li>
																<li class="list-group-item">Despensa:&nbsp;&nbsp;	 
																		<?php echo $ee['despensa']; ?></li>
																<li class="list-group-item">Sala de Orientação Pedagógica:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_orientacao']; ?></li>
																<li class="list-group-item">Quadra Desportiva Aberta:&nbsp;&nbsp;	 
																		<?php echo $ee['quadra_aberta']; ?></li>
																		<li class="list-group-item">Depósito:&nbsp;&nbsp;	 
																		<?php echo $ee['deposito']; ?></li>
																</ul>
														</div>
														<div class="col-md-3">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Sala de Supervisão Escolar:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_supervisao']; ?></li>
																<li class="list-group-item">Quadra Desportiva Coberta:&nbsp;&nbsp;	 
																		<?php echo $ee['quadra_coberta']; ?></li>
																<li class="list-group-item">Auditório:&nbsp;&nbsp;	 
																		<?php echo $ee['auditorio']; ?></li>
																<li class="list-group-item">Sala de Coordenação Pedagógica:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_coordenacao']; ?></li>
																<li class="list-group-item">Laboratório de Informática:&nbsp;&nbsp;	 
																		<?php echo $ee['lab_informatica']; ?></li>
																		<li class="list-group-item">Internet da Oi:&nbsp;&nbsp;	 
																		<?php echo $ee['internet_oi']; ?></li>
																</ul>
														</div>
														<div class="col-md-2">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Sala de Leitura:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_leitura']; ?></li>
																<li class="list-group-item">Laboratório de Ciências:&nbsp;&nbsp;	 
																		<?php echo $ee['lab_ciencias']; ?></li>
																<li class="list-group-item">Internet da PMRG:&nbsp;&nbsp;	 
																		<?php echo $ee['internet_pmrg']; ?></li>
																<li class="list-group-item">Sala de Artes:&nbsp;&nbsp;	 
																		<?php echo $ee['sala_artes']; ?></li>
																<li class="list-group-item">Ambiente de Aprendizagem:&nbsp;&nbsp;	 
																		<?php echo $ee['amb_aprendizagem']; ?></li>
																		<li class="list-group-item">Laboratório de Matemática:&nbsp;&nbsp;	 
																		<?php echo $ee['lab_matematica']; ?></li>
																</ul>
														</div>
													<?php endforeach; ?>
												</div>
											</div>
										</div>
									</section> 
								</div>
								
								
								<!--Series da Escola(Anos/Niveis)--->
								<section class="content">
									<div class="row">
										<div class="col-md-12">
											<div class="box">
											<?php echo form_fieldset('Anos/Niveis que a Escola Oferece:'); ?>
											</div>
											
											<?php $teste = 'teste de impressao'; ?>
											<div class="box-header" style="text-align: left;">
												<h3 class="box-title" align=><?php echo anchor($anchor2 . '/create/'. $id1, '<i class="fa fa-plus"></i> ' . 'Novo Ano/Niveis', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
												
											</div>
											<?php foreach ($escolasseries as $es) : ?>
												
												<div class="col-md-2">
													<ul class="list-group list-group-flush">
														<li class="list-group-item"><?php if(($es)) echo $es['descricao']; else echo $teste; ?></li>
													</ul>		
												</div>		
											<?php endforeach; ?>	
										</div>
									</div>
								</section> 
								
								<!--voltar--->
								<div class="card-footer text-muted">
									<?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';?>
									<?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                    			</div>	
							</div>	
						
						</div>	
					
				</div>
			</div>
		</div>
	</section>
</div>