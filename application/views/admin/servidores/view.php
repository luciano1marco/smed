<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/matricula' ?>
		<?php $anchor2 = 'admin/escolasseries' ?>
		<?php $anchor3 = 'admin/servidorescola' ?>
		<?php $anchor4 = 'admin/servidores' ?>
		
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Dados do Servidor</h3>
							</div>
						</div>
					</div>
						<div class="box-header with-border">
							<div class="card text-center" >
								
								<!--Dados do Servidor--->
								<section class="content">
									<div class="row">
										<div class="col-md-12">
											<div class="box">
												<div class="card ">
													<?php foreach ($servidor as $s) : ?>
														<?php $id1 = $s['id'];
														      $idescola = $s['idescola'];														      
														?>
														<div class="card-header text-center ">
															<h2><?php echo $s['nome']; ?></h2>
														</div>
														<div class="card-body text-left">	
															<div class="row">
																<label class="col-sm-2">CPF:</label>
																<div class="col-sm-2">
																	<p><?=($s['cpf']);?>  </p>
																</div>
																<label class="col-sm-2">Cidade de Residencia:</label>
																<div class="col-sm-2">
																	<p><?=($s['desccidade']);?>  </p>
																</div>
																<label class="col-sm-2">Telefone:</label>
																<div class="col-sm-2">
																	<p><?=($s['telefone']);?>  </p>
																</div>
															</div>
															<div class="row">
																<label class="col-sm-2">Endereço:</label>
																<div class="col-sm-2">
																	<p><?=($s['endereco']);?>  </p>
																</div>
																<label class="col-sm-2">Data de Nascimento:</label>
																<div class="col-sm-2">
																	<p><?=($s['dt_nascimento']);?>  </p>
																</div>
																<label class="col-sm-2">Sexo:</label>
																<div class="col-sm-2">
																	<p><?=($s['descsexo']);?>  </p>
																</div>
															</div>	
															<div class="row">
																<label class="col-sm-2">E-mail:</label>
																<div class="col-sm-2">
																	<p><?=($s['email']);?>  </p>
																</div>
																<label class="col-sm-2">Ensino Medio:</label>
																<div class="col-sm-2">
																	<p><?=($s['descensinomedio']);?>  </p>
																</div>
																<label class="col-sm-2">Ensino Superior:</label>
																<div class="col-sm-2">
																	<p><?=($s['descensinosuperior']);?>  </p>
																</div>
															</div>	
															<div class="row">
																<label class="col-sm-2">Graduação:</label>
																<div class="col-sm-2">
																	<p><?=($s['descgraduacao']);?>  </p>
																</div>
																<label class="col-sm-2">Nome da Graduação:</label>
																<div class="col-sm-2">
																	<p><?=($s['nome_pos']);?>  </p>
																</div>
																<label class="col-sm-2">Area do Concurso:</label>
																<div class="col-sm-2">
																	<p><?=($s['descareaconcurso']);?>  </p>
																</div>
															</div>
															<div class="row">
																<label class="col-sm-2">Ano de Admissão:</label>
																<div class="col-sm-2">
																	<p><?=($s['ano_admissao']);?></p>
																</div>
																<label class="col-sm-2">Regime de Trabalho:</label>
																<div class="col-sm-2">
																	<p><?=($s['descregime']);?>  </p>
																</div>
																<label class="col-sm-2">Ultima Alteração:</label>
																<div class="col-sm-2">
																	<p><?=($s['dataalteracao']);?>  </p>
																</div>
															</div>
															
														</div>
														<div class="box-header" style="text-align: center;">
															<?php echo anchor($anchor4 . '/edit/' . $id1, "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
														</div>
													<?php endforeach; ?>
												</div>					
											</div>
										</div>
									</div>
								</section> 

								<!--Matricula do servidor--->
								<div class="card-body">
									<section class="content">
										<div class="row">
											<div class="col-md-12">
												<div class="box">
													<?php echo form_fieldset('Matricula(s) do Servidor'); ?>
													<?php foreach ($matricula as $ee) : ?>
														<div class="box-header" style="text-align: left;">
															<h3 class="box-title" align=><?php echo anchor($anchor1 . '/create/'. $id, '<i class="fa fa-plus"></i> ' . 'Matriculas', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
														</div>
													
														<div class="col-md-3">
															<ul class="list-group list-group-flush">
																<li class="list-group-item">Matricula:&nbsp;&nbsp;	 
																		<?php echo $ee['descricao']; ?></li>
															</ul>
														</div>
													<?php endforeach; ?>
												</div>
											</div>
										</div>
									</section> 
								</div>
								
								<!--Designações do Servidor--->
								<section class="content">
									<div class="row">
										<div class="col-md-12">
											<div class="box">
												<div class="card ">
												<?php echo form_fieldset('Designações do Servidor'); ?>
													
													<div class="card-body text-left">
														<div class="box-header" style="text-align: left;">
															<h3 class="box-title" align=><?php echo anchor($anchor3 . '/create/'. $id.'/'.$idescola, '<i class="fa fa-plus"></i> ' . 'Designações', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
														</div>	
														<?php foreach ($designacao as $d) : ?>
															<section>
																<div class="box">
																	<div class="row">
																		<label class="col-sm-1">Escola:</label>
																		<div class="col-sm-3">
																			<p><?=($d['escola']);?>  </p>
																		</div>
																		<label class="col-sm-1">Designação:</label>
																		<div class="col-sm-3">
																			<p><?=($d['designacao']);?>  </p>
																		</div>
																		<label class="col-sm-1">Turno:</label>
																		<div class="col-sm-3">
																			<p><?=($d['turno']);?>  </p>
																		</div>
																	</div>
																	<div class="row">
																		<label class="col-sm-1">Turmas que Atende:</label>
																		<div class="col-sm-3">
																			<p><?=($d['turmas_atende']);?>  </p>
																		</div>
																		<label class="col-sm-1">Licença:</label>
																		<div class="col-sm-3">
																			<p><?=($d['licenca']);?>  </p>
																		</div>
																		<label class="col-sm-1">Observações:</label>
																		<div class="col-sm-3">
																			<p><?=($d['obsch']);?>  </p>
																		</div>
																	</div>	
																	<div class="row">
																		<label class="col-sm-1">Setor:</label>
																		<div class="col-sm-3">
																			<p><?=($d['setor']);?>  </p>
																		</div>
																		<label class="col-sm-1">Usuario de Cadastro:</label>
																		<div class="col-sm-3">
																			<p><?=($d['users']);?>  </p>
																		</div>
																		<label class="col-sm-1">Data de Modificação:</label>
																		<div class="col-sm-3">
																			<p><?=($d['dt_cadastro']);?>  </p>
																		</div>
																	</div>
																	<div class= "row">
																		<div class= "col-sm-12">
																			<div class= "col-sm-6">
																				<label class="col-sm-6">Areas de Atuação(Disciplinas):</label>
																					<?php  foreach($d['disc'] as $di) : ?>
																						<div class="col-sm-12">
																							<p><?=($di['disciplina']);?>  </p>
																						</div>
																					<?php endforeach; ?>
																			</div>
																			<div class= "col-sm-6">
																				<label class="col-sm-6">Anos que Atende:</label>
																					<?php  foreach($d['atende'] as $at) : ?>
																						<div class="col-sm-12">
																							<p><?=($at['anos']);?>  </p>
																						</div>
																					<?php endforeach; ?>
																			</div>
																		</div>
																	</div>
																</div>	
																<div class="box-header" style="text-align: center;">
																	<?php echo anchor($anchor3 . '/edit/' . $d['id'], "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
																</div>
															</section>		
														<?php endforeach; ?>
													</div>
												</div>					
											</div>
										</div>
									</div>
								</section> 
								
								<!--voltar--->
								<div class="card-footer text-muted">
									<?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';?>
									<?php echo anchor($anchor4.'/index/'.$s['idescola'], $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                    			</div>	
							</div>	
						</div>	
				</div>
			</div>
		</div>
	</section>
</div>