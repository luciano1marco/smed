<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?> ">             
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- menu.css -->
    <link rel="stylesheet" href="<?php echo base_url($public_css . '/menu.css'); ?>"> 
  </head>

 <!--div do menu  --->
<div id="Mymenu">  
<section class="content-fluid" >
    <div class="row ">
        <div class="col-md-4" ></div>
        <div class="col-md-4" ></div>
        <!-- Menu -->
        <div class="col-md-4" >
            <div class="btn-group">
                <div class="dropdown">
                    <button type="button" class="btn btn-dark"> 
                        <a id="cormenu">Home</a>
                    </button>
                </div>
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a id="cormenu">Concursos </a>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div>
                            <a class="dropdown-item" href='<?php echo site_url("home/"); ?>'  >Todos</a>
                            <a class="dropdown-item" href='<?php echo site_url("home/index/a"); ?>'>Concursos Ativos</a>
                            <a class="dropdown-item" href='<?php echo site_url("home/index/i"); ?>'>Concursos Inativos</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a id="cormenu">Estagios </a>
                    </button>
                    <!-- menu dinamico---->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php  foreach($menuestagio as $i){ ?>
                            <button type="button" class="btn btn-light btn-block text-left" data-toggle="modal" data-target="#<?= $i['controller'];?>"><?= $i['descricao'];?></button>
                        <?php }?>
                    </div>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-dark">
                        <a id="cormenu" href="/concursos/home/login">Login</a>    
                    </button>
                </div>              
            </div>  <!--fim btn-group-->
        </div><!--fim col-md-4-->
        <!-- concurso -->
        <div class="col-lg-12">
                <p> <a href="#">
                    <img class="img-responsive" src='<?php echo site_url("public/images/brasao.png"); ?>'>
                    </a>
                    <h3>CONCURSOS PÚBLICOS</h3>
                    <h4>___________________________________</h4>
                    <h5> PREFEITURA MUNICIPAL DO RIO GRANDE</h5>
                    <h4>___________________________________</h4>
                </p>
              
        </div>  
    </div><!--fim row-->
    </section>
</div><!--fim Mymenu-->
<body>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

<!-- Modal do menu dinamico -->
<?php  foreach($menuarquivo as $e){ ?>
<div class="modal" id="<?= $e['controller'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- Modal  -->
            <div class="modal-body">
            <!-- Form -->
            <?php include($e['caminho']) ;?>  
            </div>
        <!-- fim modal-->
    </div>
 </div>
</div>
<?php }?>