<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    #mostra {
        background-color:#313A3D;
        color:black; 
    }
    .card{
        background-color:#e8e3e3;
}

#rolagem{
  padding: 15px;
  width: 100%;
  height: 300px;
  overflow: scroll;
  border: 1px solid #ccc;
}
.jumbotron{
    background-color:#e8e3e3;
}
</style>

<?php  $anchor = 'public/'.$this->router->class; ?>

<div id="mostra">
    <div class="container text-center">
        <!-- cabeçalho  -->
        <div class="jumbotron">
            <?php foreach ($conmostra as $p) { ?>
                <h1 ><?=($p['desctitulo']);?> 
                <?=($p['num']);?>/<?=($p['ano']);?></h1>
            <?php } ?>   
        </div>
        <div class="card ">
            <div class="row mt-3">
                <!--concursos -->    
                <div class="col-xl ">
                    <div class="card-header text-center ">
                        <h3 class="badge-secundary">Dados do Concurso</h3>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <label class="col-sm-4">Título</label>
                            <div class="col-sm-8">
                                <p><?=($p['desctitulo']);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Sub-Título</label>
                            <div class="col-sm-8">
                                <p><?=($p['subtitulo']);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Departamento</label>
                            <div class="col-sm-8">
                                <p><?=($p['descdep']);?> (<?=($p['descsigla']);?>)</p>
                            </div>
                        </div>
                       
                        <div class="row">
                            <label class="col-sm-4">Publicação</label>
                            <div class="col-sm-8">
                                <p><?=($p['num']);?>/<?=($p['ano']);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Data da Publicação</label>
                            <div class="col-sm-8">
                                <p><?=date_format(date_create($p['data_p']),"d/m/Y");?>&nbsp;</p>
                            </div>
                        </div>
                        <!--<div class="row">
                            <label class="col-sm-4">Encerramento</label>
                            <div class="col-sm-8">
                                <p><?=date_format(date_create($p['data_e']),"d/m/Y");?>&nbsp;</p>
                            </div>
                        </div>-->
                        <div class="row">
                            <label class="col-sm-4">Organizadora</label>
                            <div class="col-sm-8">
                                <p><?=($p['empresa']);?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">link</label>
                            <div class="col-sm-8">
                                <a href="<?=($p['link']);?>" class="btn btn-link"><?=($p['link']);?></a>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4">Status atual</label>
                            <div class="col-sm-8">
                                <h5> <p>
                                <?php   if(($p['ativo']) == 1) echo 'Ativo';
                                        else                   echo 'Inativo'; 
                                ?></p></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Areas do concurso-->
                <div class="col-xl">
                    <div class="card-header text-center "  ><h3>Áreas do Concurso </h3></div>
                        <div class="card-body">
                        <div id='rolagem' >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php foreach ($ar as $a){   ?>
                                        <p><?=($a['descricao']);?>    </p>
                                        <?php } ?>  
                                    </div>
                                </div>  
                        </div>
                    </div>
                </div>                                
                <!-- etapas seleções -->    
                <div class="w-100">
                    <div class="card-header ">
                        <h3 class="card-secundary">Seleções</h3>
                    </div>
                    <div class="card-body">
                        <?php $conta = 1; ?>
                        <?php foreach ($etapa as $e) { ?>
                            <div class="card">
                                    <div class="badge-secondary" >
                                        <?php echo '<button class="btn"  data-toggle="collapse" href="#collapse'.$conta.'">';?>
                                            <h5> &nbsp;&nbsp;
                                                    <?php
                                                    if ($p || $e['responsavel'] == $this->session->user_id) { 
                                                       ?>
                                                        <a data-toggle='tooltip' title='Click para Ver'> <?php echo $e['titulo']; ?></a>
                                                   <?php } else {?>
                                                        <a data-toggle='tooltip' title='Click para Ver'> <?php echo $e['titulo']; ?></a>
                                                    <?php } ?>
                                            </h5>
                                        </button>     
                                    </div>
                                    <?php echo '<div id= "collapse'.$conta.'" class="collapse" >' ?>
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
                                                    <p><?=date_format(date_create($e['dataini']),"d/m/Y");?>&nbsp;</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label class="col-sm-4">Previsão para término</label>
                                                <div class="col-sm-8">
                                                    <p><?=date_format(date_create($e['datafim']),"d/m/Y");?>&nbsp;</p>
                                                </div>
                                            </div>

                                           <!-- <div class="row">
                                                <label class="col-sm-4">Tipo</label>
                                                <div class="col-sm-8">
                                                    <p><?=($e['descrit']);?>&nbsp;</p>
                                                </div>
                                            </div>-->
                                            <div class="row">
                                                <label class="col-sm-4">Arquivos</label>
                                                <?php foreach ($e['arquivos'] as $a) { ?>
                                                    <div class="col-sm-12">
                                                        <a class="btn btn-outline-dark btn-block" target="blank" href="<?= base_url("upload/arquivosetapas/etapa-".$e['id']."/".$a['arquivo']) ?>">
                                                            <?= $a['arquivo'] ?>
                                                        </a>
                                                    </div>
                                                <?php } ?> 
                                            </div>
                                        </div>
                                        
                                    </div> 
                                <?php $conta = $conta + 1; ?>      
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
      
    </div>
</div>
   <h3 class="text-center"> <a href="<?= base_url('./') ?>"><span class="badge badge-primary">Voltar</span></a> 
   </h3>                    

  
<!--modal arquivo -->
