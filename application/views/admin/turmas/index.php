<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
		<?php $anchor1 = 'admin/escolas'; ?>
		<?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>'; ?>
		<?php $leg = '<i class="fa fa-search"></i> <span>Legenda</span>'; ?>
	
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
							<?php foreach ($escolas as $e) : ?>
									<h3 align="center" style="color:black">Turmas da Escola: &nbsp;&nbsp; <?php echo $e['nome']; ?></h3>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create/'.$e['id'], '<i class="fa fa-plus"></i> ' . 'Nova Turma', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo anchor($anchor1, $cancel, array('class' => 'btn btn-default btn-flat')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-azul btn-flat', 'content' => $leg, "id" => "btExcluir")); ?>
								
					</div>

					<div class="box-body">
						
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<?php foreach ($turmatotal as $tt) : ?>
										<th>Descrição</th>
										<th>CF(<?=$tt['tcapacidade']?>)</th>
										<th>CP(<?=$tt['tcapacidade_p']?>)</th>
										<th>R(<?=$tt['tregular']?>)</th>
										<th>PNESL(<?=$tt['tpnesl']?>)</th>
										<th>PNECL(<?=$tt['tpnecl']?>)</th>
										<th>M(<?=$tt['tmatriculas']?>)</th>
										<th>Rest.(<?=$tt['trestantes']?>)</th>
										<th>Turno</th>
										<th>Data</th>
										<th>Ação</th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($turmas as $i) : ?>
									<tr>
									<td><?php echo htmlspecialchars($i['descturma'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['capacidade'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['capacidade_p'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['regular'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['pnesl'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['pnecl'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['matriculas'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo intval($i['capacidade_p']) - intval($i['matriculas'])  ; ?></td>
									<td><?php echo htmlspecialchars($i['descturno'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($i['dt_cad'], ENT_QUOTES, 'UTF-8'); ?></td>
									<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $i['idturma'].'/'.$i['idescola'], "<button class=\"btn btn-azul\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
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

<!----modal Legenda-------->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Legenda:</b></h4>
            </div>

            <div class="modal-body">
				<h4 style="color:blue">PNESL - Pessoa com Necessidade Educacional Especifica Sem Laudo</h4>		
				<h4 style="color:blue">PNECL - Pessoa com Necessidade Educacional Especifica Com Laudo</h4>		
				<h4 style="color:blue">CF    - Capacidade Fisica</h4>		
				<h4 style="color:blue">CP    - Capacidade Pedagogica</h4>		
				<h4 style="color:blue">R     - Regular</h4>		
				<h4 style="color:blue">M     - Número de Matriculados</h4>		
				<h4 style="color:blue">Rest  - Matriculas Restantes</h4>	
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->