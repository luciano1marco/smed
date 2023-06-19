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
								<h3 align="center" style="color:black">Series</h3>
							</div>
						</div>
					</div>
					<?php foreach ($escolasseries as $i) : ?>
						<div class="box-header with-border">
							<!--<h3 class="box-title"><?php echo anchor($anchor . '/create/'. $i['escola_id'], '<i class="fa fa-plus"></i> ' . 'Estrutura', array('class' => 'btn btn-block btn-azul btn-flat')); ?></h3>&nbsp;&nbsp;--->
							<div class="card text-center" >
								<div class="card-header">
									<h2><?php echo $i['nome']; ?></h2>
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