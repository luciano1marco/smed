<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    /* ---css faleconosco----*/

    #fale {
        background-image: url("public/images/banner.png");
        /*overflow: hidden; /* para que não tenha rolagem se a imagem de fundo for maior que a tela */
        width: 100%;
        height: 100%;
        position:initial;
        /* criamos um contexto para posicionamento */
    }

    .form-group {
        border-color: #2F3337;
    }

    #fale h3 {
        font-weight: bold;
        font-size: 56px;
        text-align: center;
        margin-top: 30px;
        color: #992691;
    }

    #fale h5 {
        font-size: 26px;
        font-weight: bold;
        text-align: center;
        margin-top: 5px;
        color: #350B31;
    }

    #fale label {
        text-align: right;
        color: #fff;
    }

    #bt {
        background-color: #A72AA0;
        text-align: center;
        color: aliceblue;
        font-weight: bold;
        font-size: 20px;
    }

    #bt:hover {
        background-color: #350B31;
    }

    #botao {
        text-align: center;
        margin: -10;
    }

    #apoio {
        width: 100%;
        height: 900px;
        /*same height as jumbotron */
        top: 0;
        min-height: 900px;
        left: 0;
    }

    #apoio h3{
        font-weight: bold;
        font-size: 26px;
        text-align: center;
        color: #FF6600;
    }
   
    #apoio h5{
        font-weight: bold;
        font-size: 18px;
        text-align: center;
        color: #000; 
    }

    .bg {
        background: url('public/images/fundofinal.png') no-repeat center center;
        position: fixed;
        width: 100%;
        left: 0;
        z-index: -1;
        padding: 0;
        margin: 0;
        border: 0;
    }

    .jumbotron {
        margin-bottom: 0px;
        height: 1200px;
    }

    #imagens {
        width: 100%;
        height: 650px;
    }

    #figuras {
        padding: 100;
    }


    /* ---fim css faleconosco ---*/
</style>

<div class="bg">
    <div class="jumbotron">
    </div>
</div>    
  
<div id="apoio">
    <h1>Apoiadores</h1><br><br><br>
    <section class="content-fluid">
        
            <div class="row">
                <div class="col-md-12" >
                    <div class="col-lg-4">
                        <h3>Diretoria Atual</h3>
                        <br>   
                        <?php foreach ($diretoria as $row): ?>
                            <h5><?php echo $row['descricao']; ?>: <?php echo $row['nome'];?> </h5><br>
                        <?php endforeach;?> 
                           
                    </div>
                    <div class="col-md-6" >
                        <h3> </h3>
                        <div class="col-md-6">
                                <a href="#">
                                    <img class="img-responsive" src="public/images/brasao.png"  width="300" height="200" >
                                </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#">
                                <img class="img-responsive" src="public/images/telerig.jpg"  width="300" height="200">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
       
    </section>    
</div>

<div id="fale">
    <section class="content-fluid">
        <main role="main">
            <div class="row ">
                <div class="col-lg-12">
                    <h3>Fale com a gente</h3><br>
                   
                </div>
                <div class="col-lg-12">
                    <div class="col-md-3"> </div>

                    <div class="col-md-9" >
                        <div class="container">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-1 col-xs-12">
                                    <label >Nome</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" size="12" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-1 col-xs-12">
                                        <label >Email</label><input type="text" name="titulo" size="48" class="form-control" placeholder="Digite seu email" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-1 col-xs-12">
                                        <label >Assunto</label>
                                            <input type="text" name="assunto" size="48" class="form-control" placeholder="Digite um Assunto" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-1 col-xs-12">
                                        <br>
                                        <label>Mensagem</label> 
                                        <textarea name="mensagem" id="input" class="form-control" rows="5" cols="13" placeholder="Deixe sua Mensagem" required="required" ></textarea>
                                        <div id="botao" >
                                            <br>
                                            <button type="submit" id="bt"> Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>       
    </section>    
</div>
