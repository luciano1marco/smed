<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php  $anchor = 'admin/'.$this->router->class; ?>

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
					<li class="breadcrumb-item">Concursos</li>
					<li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
					</ol>
				</div>           
				</div>          
			</div>     
		</div>


    <div class="content">
        <div class="row">
            <!--concursos -->    
                <div class="card w-50">
                    <div class="card-row">
                        <h4 class="badge-secundary">Concurso
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php if ($p) { ?>
                                <a href="<?= base_url('admin/concursos/edit/'.$p->id) ?>"><span class="badge badge-primary">Editar</span></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?= base_url('admin/concursos/') ?>"            ><span class="badge badge-primary">Voltar</span></a> 
                            
                            <?php } ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-4">Título</label>
                            <div class="col-sm-8">
                                <p><?=($p->titulo);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">numero</label>
                            <div class="col-sm-8">
                                <p><?=($p->num);?>&nbsp;</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Ano</label>
                            <div class="col-sm-8">
                                <p><?=($p->ano);?>&nbsp;</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Data da Publicação</label>
                            <div class="col-sm-8">
                                <p><?= date_format(date_create($p->data_p), "d/m/Y");?>&nbsp;</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Data de Homologação</label>
                            <div class="col-sm-8">
                            <p><?= date_format(date_create($p->data_e), "d/m/Y");?>&nbsp;</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Data de Vigência</label>
                            <div class="col-sm-8">
                            <p><?= date_format(date_create($p->data_v), "d/m/Y");?>&nbsp;</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Criado por</label>
                            <div class="col-sm-8">
                                <p><?=($usuario->username);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Empresa Organizadora</label>
                            <div class="col-sm-8">
                                <p><?=($p->empresa);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">link</label>
                            <div class="col-sm-8">
                                <a href="<?=($p->link);?>" class="btn btn-link"><?=($p->link);?></a>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Status atual</label>
                            <h4>
                            <div class="col-sm-12">
                                <p><?php 
                                        if($p['ativo']==1)
                                          echo 'Ativo' ;
                                        else
                                          echo 'Inativo';  
                                 ?></p>
                            </div>
                            </h4>
                        </div>
                       
                    </div>
                </div>
           
            <!--Areas do concurso-->    
                 <div class="card w-50">
                    <div class="card-body">
                        <h4 class="card-secundary">Areas do Concurso
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php if ($p) { ?>
                                <a href="<?= base_url('admin/concursos/editArea/'.$p->id) ?>"> <span class="badge badge-primary">Editar</span></a>
                                
                            <?php } ?>
                        </h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php foreach ($ar as $a){   ?>
                                     <p><?=($a['descricao']);?>    </p>
                                   <?php } ?>  
                                </div>
                            </div>
                    </div>
                 </div>       
              
             <!-- etapas -->    
                <div class="card w-100">
                    <div class="card-header">
                        <h3 class="card-secundary">Etapas
                            &nbsp;&nbsp;
                            <a href="<?= base_url('admin/concursos/createetapa/'.$p->id) ?>" ><span class="badge badge-primary"> + Etapa</span></a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($etapa as $e) { ?>
                            <div class="card">
                                <div class="badge-secondary">
                                    <h5> &nbsp;&nbsp;
                                        <?php
                                        if ($p || $e['responsavel'] == $this->session->user_id) { 
                                            echo $e['titulo'];
                                        } else {
                                            echo $e['titulo'];
                                        }
                                        ?>
                                    </h5>    
                                </div>
                                <div class="card-body">
                                    <div class="row"> 
                                        <label class="col-sm-4">Status</label>
                                        <div class="col-sm-8">
                                            <p><?=($e['descricao']);?>       </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <label class="col-sm-4">Início</label>
                                    <div class="col-sm-8">
                                        <p><?= date_format(date_create($e['dataini']), "d/m/Y");?>&nbsp;</p>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <label class="col-sm-4">Previsão para término</label>
                                    <div class="col-sm-8">
                                        <p><?= date_format(date_create($e['datafim']), "d/m/Y");?>&nbsp;</p>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <label class="col-sm-4">Tipo</label>
                                    <div class="col-sm-8">
                                        <p><?=($e['descrit']);?>&nbsp;</p>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-4">Responsável</label>
                                        <div class="col-sm-8">
                                            <p><?=($e['username']);?>
                                            &nbsp;&nbsp;
                                        </div>
                                    </div>  
                                    
                                    <div class="row">
                                            <div class="col-sm-4">
                                                <a href="<?= base_url('admin/concursos/arquivosetapa/'.$e['id']) ?>"class="btn btn-primary">+ Arquivos</a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                <?php                          
                                                $editetapa = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                                                                            
                                                ?>
                                            
                                                <?php echo anchor($anchor.'/editetapa/'.$e['id'], $editetapa, array('class' => 'btn btn-primary')); ?> 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                               
                                            </div>
                                           
                                            <div class="col-sm-8">
                                                <?php foreach ($e['arquivos'] as $a) { ?>
                                                    <a target="blank" href="<?= base_url("upload/arquivosetapas/etapa-".$e['id']."/".$a['arquivo']) ?>">
                                                        <?= $a['arquivo'] ?>
                                                    </a><br>
                                                <?php } ?> 
                                            </div>     
                                    </div>
                                </div>    
                            </div>
                        <?php } ?>
                    </div>
                </div>
        </div>
    </div>
</div> 