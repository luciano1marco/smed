<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<section class="content">
    <?php foreach ($nomeescola as $e) {} ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-azul">
							<div class="panel-heading">
								<h3 align="center" style="color:black">Relatorio - Vagas / Serie - Escola <?php echo $e['nome'];?></h3>
							</div>
						</div>
                        <?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';?>
						<?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
            		
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Turmas</th>
									<th>Capacidade Total</th>
									<th>Capacidade Pedagogica</th>
                                    <th>Regular</th>
                                    <th>PNESL</th>
                                    <th>PNECL</th>
                                    <th>Matriculados</th>
									<th>Vagas Restantes</th>
                                    <th>Turno</th>
                                  	
								</tr>
							</thead>
							<tbody>
								<?php foreach ($porescolas as $i) : ?>
									<tr>
										<td><?php echo htmlspecialchars($i['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['capacidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['capacidade_p'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['regular'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['pnesl'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['pnecl'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['matriculas'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($i['capacidade_p']-$i['matriculas'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($i['turno'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        
										<!-- Opções -->
										
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