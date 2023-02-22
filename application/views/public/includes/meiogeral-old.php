<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- meiogeral.css -->
<link rel="stylesheet" href="<?php echo base_url($public_css . '/meiogeral.css'); ?>"> 
 
<div id="meiogeral">
    <section class="content">
            <!-- concursos -->
            <div class="row justify-content-center ">
                    <?php foreach ($p as $concurso) { ?>
                        <div class='card bg-secundary col-md-3' > 
                            <ul class='list-group list-group-flush'>
                                <h3><?= $concurso->titulo; ?></h3>
                                <div class="card-img">
                                    <li class='list-group-item'> 
                                        <a href='<?= base_url('/Home/mostrar/' . $concurso->id) ?>'>
                                            <img src="/concursos/upload/brasão.svg" style='width:30%; height:30%;' >
                                            <div class="card-caption">
                                                <span class="h2"><?= $concurso->num . "/" . $concurso->ano; ?></span></a>
                                                <p><?= date_format(date_create($concurso->data_p), "d/m/Y") . " até " . date_format(date_create($concurso->data_e), "d/m/Y"); ?></p>
                                            </div>
                                        </li>
                                </div>
                            </ul>  
                        </div>
                    <?php } ?>
            </div>
            
    </section>
    
</div>
<div class="row">
<div class="col-md-12" id="sociais">
        <span><h3>
            <ul class="list-inline">
                <li><a target="_blank" href="http://www.facebook.com/PrefeituraMunicipaldoRG"           class="facebook"> <i class="fa fa-facebook" > </i></a>
                    <a target="_blank" href="http://twitter.com/PMRGoficial"                            class="twitter">  <i class="fa fa-twitter" >  </i></a>
                    <a target="_blank" href="https://www.instagram.com/prefeituradoriogrande/"          class="instagram"><i class="fa fa-instagram"> </i></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCKp-F9htcpRVXTJUzEaSxzA"  class="youtube">  <i class="fa fa-youtube" >  </i></a>
                </li>
            </ul>
        </h3></span>
</div>
</div>