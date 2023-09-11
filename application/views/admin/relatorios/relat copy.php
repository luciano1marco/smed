<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="<?php echo base_url($plugins_dir . '/chartjs/Chart.min.js'); ?>"></script>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>
    <section class="content">
        
        <?php 	foreach($escolas as $e){
        	      	$nome = $e['nome'];
					$id   = $e['id'];
		    	} 
        
		?>
		<?php echo form_hidden($id); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Relatórios da Escola <?php echo $nome;?></h3>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Total</a></li>
                        <li><a data-toggle="tab" href="#tab2">Vagas Por Série</a></li>
                        <li><a data-toggle="tab" href="#tab3">Teste</a></li>
                        
                    </ul>
                    <div class="box-body">
                        <div class="tab-content">
                            <!--relatorio total-->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Quantidade Total da Escola </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="chart-container">
                                                    <canvas id="reltotal"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div>    
                            <!--Relatorio por serie-->
                            <div id="tab2" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Vagas por Serie</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-8">
                                                <div id="chart-container">
                                                    <canvas id="relserie"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div>
                            <!--Relatório Retorno Escolar-->
                            <div id="tab3" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Teste</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div id="chart-container">
                                                    <canvas id="relteste"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <!-----------fim--------------------------------->
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>