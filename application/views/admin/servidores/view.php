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
		<?php $anchor3 = 'admin/designacao' ?>
		
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
					<?php foreach ($servidor as $i) : ?>
						<?php $id1 = $i['id']; ?>
						<div class="box-header with-border">
							<!--<h3 class="box-title"><?php echo anchor($anchor . '/create/'. $i['id'], '<i class="fa fa-plus"></i> ' . 'Estrutura', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;--->
							<div class="card text-center" >
								
								<!--Dados do Servidor--->
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
															<label class="col-sm-1">CPF:</label>
															<div class="col-sm-3">
																<p><?=($i['cpf']);?>  </p>
															</div>
															<label class="col-sm-1">Cidade de Residencia:</label>
															<div class="col-sm-3">
																<p><?=($i['desccidade']);?>  </p>
															</div>
															<label class="col-sm-1">Telefone:</label>
															<div class="col-sm-3">
																<p><?=($i['telefone']);?>  </p>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-1">Endereço:</label>
															<div class="col-sm-3">
																<p><?=($i['endereco']);?>  </p>
															</div>
															<label class="col-sm-1">Data de Nascimento:</label>
															<div class="col-sm-3">
																<p><?=($i['dt_nascimento']);?>  </p>
															</div>
															<label class="col-sm-1">Sexo:</label>
															<div class="col-sm-3">
																<p><?=($i['descsexo']);?>  </p>
															</div>
														</div>	
														<div class="row">
															<label class="col-sm-1">E-mail:</label>
															<div class="col-sm-3">
																<p><?=($i['email']);?>  </p>
															</div>
															<label class="col-sm-1">Ensino Medio:</label>
															<div class="col-sm-3">
																<p><?=($i['descensinomedio']);?>  </p>
															</div>
															<label class="col-sm-1">Ensino Superior:</label>
															<div class="col-sm-3">
																<p><?=($i['descensinosuperior']);?>  </p>
															</div>
														</div>	
														<div class="row">
															<label class="col-sm-1">Graduação:</label>
															<div class="col-sm-3">
																<p><?=($i['descgraduacao']);?>  </p>
															</div>
															<label class="col-sm-2">Nome da Graduação:</label>
															<div class="col-sm-2">
																<p><?=($i['nome_pos']);?>  </p>
															</div>
															<label class="col-sm-1">Area do Concurso:</label>
															<div class="col-sm-3">
																<p><?=($i['descareaconcurso']);?>  </p>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-2">Ano de Admissão:</label>
															<div class="col-sm-1">
																<p><?=($i['ano_de_admissao']);?></p>
															</div>
															<label class="col-sm-3">Regime de Trabalho:</label>
															<div class="col-sm-1">
																<p><?=($i['descregime']);?>  </p>
															</div>
															
														</div>
														<label class="col-sm-2">Data da Ultima Alteração:&nbsp;&nbsp;
															<p><?=($i['data_ultima_alteracao']);?>  </p>
														<?php endforeach; ?>
													</div>
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
													<div class="box-header" style="text-align: left;">
														<h3 class="box-title" align=><?php echo anchor($anchor1 . '/create/'. $id1, '<i class="fa fa-plus"></i> ' . 'Matriculas', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
														
													</div>
													<?php foreach ($matricula as $ee) : ?>
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
													<div class="box-header" style="text-align: left;">
														<h3 class="box-title" align=><?php echo anchor($anchor3 . '/create/'. $id1, '<i class="fa fa-plus"></i> ' . 'Designações', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;
													</div>
													<div class="card-body text-left">	
														<?php foreach ($designacao as $i) : ?>
															<section>
																<div class="box">
																	<div class="row">
																		<label class="col-sm-1">Escola:</label>
																		<div class="col-sm-3">
																			<p><?=($i['escola']);?>  </p>
																		</div>
																		<label class="col-sm-1">Designação:</label>
																		<div class="col-sm-3">
																			<p><?=($i['designacao']);?>  </p>
																		</div>
																		<label class="col-sm-1">Turno:</label>
																		<div class="col-sm-3">
																			<p><?=($i['turno']);?>  </p>
																		</div>
																	</div>
																	<div class="row">
																		<label class="col-sm-1">Turmas que Atende:</label>
																		<div class="col-sm-3">
																			<p><?=($i['turmas_atende']);?>  </p>
																		</div>
																		<label class="col-sm-1">Licença:</label>
																		<div class="col-sm-3">
																			<p><?=($i['licenca']);?>  </p>
																		</div>
																		<label class="col-sm-1">Observações:</label>
																		<div class="col-sm-3">
																			<p><?=($i['obsch']);?>  </p>
																		</div>
																	</div>	
																	<div class="row">
																		<label class="col-sm-1">Setor:</label>
																		<div class="col-sm-3">
																			<p><?=($i['setor']);?>  </p>
																		</div>
																		<label class="col-sm-1">Usuario de Cadastro:</label>
																		<div class="col-sm-3">
																			<p><?=($i['users']);?>  </p>
																		</div>
																		<label class="col-sm-1">Data de Modificação:</label>
																		<div class="col-sm-3">
																			<p><?=($i['dt_cadastro']);?>  </p>
																		</div>
																	</div>
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
									<?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                    			</div>	
							</div>	
						
						</div>	
					
				</div>
			</div>
		</div>
	</section>
</div>