<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- meiogeral.css -->
<link rel="stylesheet" href="<?php echo base_url($public_css . '/meiogeral.css'); ?>"> 

<!-- botões de chamada -->

<div class="meiogeral text-center pb-4">
       
    <a type="button" class="btn btn-danger btn-lg" href='<?php echo site_url("/home/3"); ?>'  ><i class="fa fa-search"></i> Concurso Público</a>
    <a type="button" class="btn btn-success btn-lg" href='<?php echo site_url("/home/2"); ?>' ><i class="fa fa-search"></i> Processo Seletivo Estagiário</a>
    <a type="button" class="btn btn-info btn-lg" href='<?php echo site_url("/home/1"); ?>'    ><i class="fa fa-search"></i> Processo Seletivo Simplificado</a>
    <a type="button" class="btn btn-warning btn-lg" href='<?php echo site_url("/home/4"); ?>' ><i class="fa fa-search"></i> Processo Seletivo Interno</a>
        
</div>


<div  class="meiogeral " >
    <section class="container ">
            <!-- concursos -->
        <div class="row">
            <div class="card-columns">
            <?php
            if(!empty($conhome)) { ?>                
                <?php foreach ($conhome as $concurso) { ?>
                    <div class="card bg-light" style="border-radius: 3%;">
                        <!--cabeçalho do cartão-->
                        <div class="card-header text-center">
                            <h4><?= $concurso['desctitulo']; ?> </h4>
                        </div>
                        <!--corpo do cartão-->
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 ><?= $concurso['subtitulo']; ?> </h6>
                                </div> 
                            </div>    
                        </div>
                        <!--corpo do cartão-->
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-sm-4">   
                                    <img src="/concursos/upload/brasão.svg" style='width:100%; height:100%;' >
                                </div>
                                <div class="col-sm-8">
                                    <a class="btn btn-outline-secondary" data-toggle="tooltip" title="<?= $concurso['descdesc']; ?>" href='<?= base_url('/Home/mostrar/' . $concurso['idcon']) ?>'>
                                        <h5 ><?= $concurso['descdep']; ?> </h5>
                                        <h4> <?= $concurso['num'] . "/" . $concurso['ano']; ?></h4>
                                    </a>
                                </div> 
                            </div>    
                        </div>
                        <!--rodape do cartão-->
                        <div class="card-footer">
                            <div class="text-center text-bold">
                               <!-- <p><?= date_format(date_create($concurso['data_p']), "d/m/Y") . " até " . date_format(date_create($concurso['data_e']), "d/m/Y"); ?></p>-->
                               <p>Publicação do Edital <?= date_format(date_create($concurso['data_p']), "d/m/Y");?></p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
           
            </div>
        </div>
        <?php }  else { ?>
                <div class="meiogeral text-center">
                    <button type="button" class="btn btn-outline-primary btn-block">Não foi encontrado nenhum Item para esta Consulta</button>
                </div>
            <?php  }  ?>
    </section>
</div>

<div class="row ">
    <div class="col-md-12" id="sociais">
        <div class="container">
            <span><h3>
                <ul class="list-inline">
                    <li><a target="_blank"  data-toggle="tooltip" title="facebook" href="http://www.facebook.com/PrefeituraMunicipaldoRG"           class="facebook"> <i class="fa fa-facebook" > </i></a>
                        <a target="_blank"  data-toggle="tooltip" title="twitter" href="http://twitter.com/PMRGoficial"                            class="twitter">  <i class="fa fa-twitter" >  </i></a>
                        <a target="_blank"  data-toggle="tooltip" title="instagram" href="https://www.instagram.com/prefeituradoriogrande/"          class="instagram"><i class="fa fa-instagram"> </i></a>
                        <a target="_blank"  data-toggle="tooltip" title="youtube" href="https://www.youtube.com/channel/UCKp-F9htcpRVXTJUzEaSxzA"  class="youtube">  <i class="fa fa-youtube" >  </i></a>
                    </li>
                </ul>
            </h3></span>
        </div>
    </div>
</div>