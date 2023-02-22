<style>
    #meiogeral {
        background-color: #E9E9E9;
        color: black;
    }
    #meiogeral h1{
        font-weight: bold;
        font-size: 26px;
        text-align: center;
        margin-top: 5px;
        color: #FF6600;
    }
    #meiogeral h2{
        font-weight: bold;
        font-size: 40px;
        text-align: left;
        margin-top: 30px;
        color: #FF6600;
    }
    #meiogeral h3{
        font-weight: bold;
        font-size: 36px;
        text-align: center;
        margin-top: 30px;
        color: #FF6600;
    }
    #meiogeral h4{
        font-weight: bold;
        font-size: 26px;
        text-align: center;
        margin-top: 5px;
        color: #FF6600;
    }
    #meiogeral h5{
        font-size: 20px;
        text-align: center;
        margin-top: 5px;
        color: #FF6600;
    }
    #meiogeral h6{
        font-size: 16px;
        text-align: justify;
        margin-top: 5px;
        color: #995CB4;
    }
    #meiogeral h7{
    /* font-weight: bold;*/
        font-size: 20px;
        text-align: left;
        margin-top: 5px;
        color: #FF6600;
    }
    #meiogeral h8{
        font-weight: bold;
        font-size: 36px;
        text-align: left;
        margin-top: 30px;
        color: #400229;
    }
    #meiogeral h9{
        font-weight: bold;
        font-size: 16px;
        text-align: center;
        margin-top: 30px;
        color: #775B75;
    }
    #meiogeral h10{
        font-size: 14px;
        text-align: center;
        margin-top: 30px;
        color: #FF6600;
    }
    body{
    text-align: center;
    }
</style>

<div id="meiogeral">
    <section class="content">
        <div class="row">
             <!-- fundo rio grande por elas -->   
            <a href="#">
                <img class="img-responsive" src="public/images/fundomeio.png"  >
            </a>
            <!-- triangulo -->
            <a href="#">
                <img class="img-responsive" src="public/images/trian.png" >
            </a>
              <!-- o que é --> 
            <div class="container-fluid">
                <div class="row">       
                    <div class= "col-lg-12" id="oquee">
                        <h1>Nossa História</h1>
                        <h5>Zodíaco - 1978</h5><br><br><br><br><br><br>
                    </div>
                   
                    </div>
                    <div class="col-lg-12">
                        <div class="col-md-3">
                            <h1>Conceito</h1>
                        </div>
                        <div class="col-md-7">
                            <h5>Construimos e apoiamos iniciativas capazes de empoderar empreendedoras, possibilitando independência financeira e de decisão pessoal.</h5><br><br>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
           <!-- losango -->
            <div class="container-fluid">    
                    <div class="col-lg-12">
                        <a href="#">
                            <img class="img-responsive" src="public/images/losango.png" >
                        </a>
                    </div> 
            </div>
            <!-- pilares de atuação -->
            <div class="container-fluid">  
                    <div class="col-lg-12" id="atuacao">
                        <br><br><br><br> <h3>Pilares de Atuação</h3><br><br><br><br>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <h2>01</h2>
                                <h4>COLABORAÇÃO SOCIAL</h4>
                                <h6>Conexão com pessoas que compartilharão seu conhecimento.</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <h2>02</h2>
                                <h4>CAPACITAÇÃO ACESSÍVEL</h4>
                                <h6>Conhecimento e informação ao alcance de todas.</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <h2>03</h2>
                                <H4>DESCENTRALIZAÇÃO</H4>
                                <h6>Estimular a troca de experiências e oportunizar novos negócios nos diversos bairros do município.</h6><br><br><br><br><br>
                            </div>
                        </div>
                        
                    </div>
                    
            </div>
            <!-- lista laranja -->
            <div class="col-lg-12">
                <a href="#">
                    <img class="img-responsive" src="public/images/laranja.png">
                </a>
            </div> 
            
            <div class="col-md-12" id="imagens"><h3>Galeria de Fotos</h3>
                <!-- imagens  --->
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div id="quadro1" class="carousel slide " data-ride="carousel" >	
                        <div class="carousel-inner" >
                            <?php $count = 0; 
                                $indicators = ''; 
                                foreach ($imagem as $row): 
                                    $count++; 
                                    if ($count === 1)    { $class = 'active'; } 
                                    else                 { $class = '';       }?> 
                                    <?php  if($row['tipo'] == 3 || $row['tipo'] == 1 || $row['tipo'] == 2):
                                        $indicators .= '<li data-target="#quadro1" data-slide-to="' . $count . '" class="' . $class . '"></li>' ;?> 
                                        <div class="item <?php echo $class; ?>"> 
                                            <img class="d-block w-100" src="<?= base_url().'upload/ser/'.$row->nome?>" alt="Menu"> 
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?> 
                                <ol class="carousel-indicators"> 
                                    <?= $indicators; ?> 
                                </ol>
                        </div>
                        <a class="carousel-control-prev" href="#quadro1" role="button" data-slide="next">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#quadro1" role="button" data-slide="prev">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>  
                </div>   
                <!------fim carrocel----------->
                                      
            <!-- triangulo virado -->
            <div class="col-lg-12">
                <a href="#">
                    <img class="img-responsive" src="public/images/triangulovirado.png" >
                    </a>
            </div> 

            <!-- apoiadores -->

                    

        </div>   
    </section>
</div>

