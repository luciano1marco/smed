<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $anchor = 'home/'; ?>

 <head>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>    
<style>
    #mostra {
        background-color:#313A3D;
        color:black; 
    }
    .card{
        text-decoration-color:#313A3D ;
    }
   .a:hover{
        color:black;
        font-size: 18px;
   }
    #rolagem{
        padding: 15px;
        width: 100%;
        height: 300px;
        overflow: scroll;
        border: 1px solid #ccc;
    }
</style>

<div class="" id="mostra">
    <div class="container ">
        <div class="card ">
            <div class="row">
                <!--area do candidato -->    
                <div class="col-xl ">
                    <div class="card-header  ">
                        <label class="col-sm-4">
                            <a href="#"><img class="img-responsive" src='<?php echo site_url("public/images/brasao.png"); ?>'></a>
                        </label> 
                        <label class="col-sm-6 card-body ">
                           
                            <h3 class="badge-secundary">Area do Candidato</h3>
                            <h4>____________________________________ </h4>
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-thumbnail float-left" width="100px" height="100px" >
                            <h4>Olá <b> <?=($cand->nome);?></b></h4>
                            <h4 class="text-center"><a class="btn btn-outline-dark" href="<?= base_url('./') ?>">Sair</a></h4>
                                   
                        </label>

                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <!--menu lateral do candidato--->
                            <div class="col-sm-3">
                                <div class="btn-group-vertical">
                                    <div class="card">
                                        <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#meusdados" href="<?= base_url('./') ?>">Meus dados</a>
                                        <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#areadeinteresse" href="<?= base_url('./') ?>">Área de Interesse</a>
                                        <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#alterarsenha" href="<?= base_url('./') ?>">Alterar senha</a>
                                        <a class="btn btn-outline-secondary" href="<?= base_url('./') ?>">Sair</a>
                                    </div>    
                                </div>
                            </div>
                            <!-- historico de interesse  --->
                            <div class="col-sm-9">
                                <h4><i class="fas fa-search"></i> Histórico de Interesse</h4> 
                                    <!--Area de interesse do candidato  -->
                                    <div class="card-body table-responsive">
                                            <table id="datatable" class="table table-striped ">
                                                <thead>
                                                    <tr>
                                                        <!--<th>ID</th>-->
                                                        <th>Titulo</th>
                                                        <th>Nº do Processo</th>
                                                        <th>Ano</th>
                                                        <th>Publicado</th>
                                                                                                
                                                    </tr>
                                                </thead>

                                                <tbody>						
                                                    <?php foreach ($historico as $h):?>
                                                        <?php 							
                                                        $titulo     = $h['descricao'];
                                                        $num 		= $h['num'];
                                                        $ano 	    = $h['ano'];
                                                        $id 		= $h['id'];
                                                        // Para usar ID depois							
                                                        $id_check['value'] = $h['id'];

                                                        if($h['ativo']==1){ $ativo = 'Ativo';}
                                                        else {$ativo = 'Encerrado';}
                                                          
                                                        ?>
                                                        <tr>
                                                            <td><a href="<?= base_url('./home/mostrar/'.$id) ?>" class="btn btn-outline-Light" role="button">
                                                                <?php echo htmlspecialchars($h['descricao'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                            <td><?php echo htmlspecialchars($h['num'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                            <td><?php echo htmlspecialchars($h['ano'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                            <td><?php echo ($ativo) ?></td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>						
                                            </table>
                                    </div>                            
                                    <!-- fim area de interesse  -->
                            </div>
                        </div>
                    </div>
                    
                </div><!-- fim div area do candidato -->
            </div>
        </div>
    </div>
</div>
<!-- The Modal meus dados -->
<div class="modal" id="meusdados">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-body">
            <section >
                <div class="container"> 
                    <!--inicio-->
                    <div class="row">
                        <!--dados do candidato --> 
                          <div class="col-xl ">
                            <div class="card-header text-center ">
                                <h3 class="badge-secundary">Dados Pessoais</h3>
                            </div> 
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-sm-4">Nome:</label>
                                    <div class="col-sm-8">
                                        <p><?=($cand->nome);?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">E-mail:</label>
                                    <div class="col-sm-8">
                                            <p><?=($cand->email);?>&nbsp;</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">CPF:</label>
                                    <div class="col-sm-8">
                                        <p><?=($cand->cpf);?>&nbsp;</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4">Telefone:</label>
                                    <div class="col-sm-8">
                                        <p><?=($cand->telefone);?>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                            <?php                          
								$edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                                $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>'; 
                            ?>
							<!-- Opções -->                                            
							<p class="text-center">									   
								<?php echo anchor($anchor.'/editpessoas/'.$cand->id, $edit, array('class' => 'btn btn-primary')); ?> 
                                <?php echo anchor($anchor.'/candidatoarea/'.$cand->id, $cancel, array('class' => 'btn btn-default btn-flat')); ?>                            
                            </p>	 

                        </div>
                        <!--fim-->
                    </div>
                </div>
            </section>
        </div>
    </div>
 </div>
</div><!--fim modal meus dados  -->

<!-- Modal alterar senha -->
<div class="modal fade" id="alterarsenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="ModalLabel">Mudar senha</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <?php echo form_open('home/alterarsenha/'.$cand->id, array('class' => 'form-horizontal', 'id' => 'form-login')); ?>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-right" for="senha" id="imputsenha">Nova Senha</label>
                    <div class="col-sm-8">
                        <div class="form-group ">
                            <?php echo form_input($senha);?>
                        </div>
                    </div>
                    <label class="col-sm-4 col-form-label text-right" for="senha" id="inputconfirmar">Confirmar Senha</label>
                    <div class="col-sm-8">
                        <div class="form-group has-feedback">
                            <?php echo form_input($confirmarsenha);?>
                        </div>
                        <div class="modal-footer">
                            <?php  echo form_submit('submit', "Enviar",  array( 'id' => 'inputsubmit', 'class' => 'btn btn-primary btn-block btn-flat'));?>
                        </div>    
                    </div>
                </div>
                <?php echo form_close();?>                                           
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- The Modal alterar senha -->

<!-- The Modal area de interesse -->
<div class="modal" id="areadeinteresse">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
            <h6 class="modal-title" id="ModalLabel">Para adicionar Áreas de Interesse selecione na caixa abaixo </h6>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

            <section >
                <div class="container"> 
                    <!--inicio select da area de interesse-->
                    <?php echo form_open('home/createcandidatoarea/'.$cand->id, array('class' => 'form-horizontal', 'id' => 'form-login')); ?>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right" for="idarea">Selecione aqui</label>
                        <div class="col-sm-9">
                            <select class="selectpicker" id="idarea" name="idarea[]" multiple data-live-search="true" />
                                <option value = <?php echo form_dropdown($idarea);?></option>
                            </select> 
                            <div class="btn-group col-sm-3">
                                <?php echo form_submit('submit', "Enviar", array('id' => 'btEnviarareainteresse', 'class' => 'btn btn-primary btn-block btn-flat'));?>
                            </div>    
                        
                        </div>
                    </div>
                   
                    <?php echo form_close();?>
                    <!--fim-->
                    <!-- Mostra as areas selecionadas pelo candidato -->
                    <div class="modal-header">
                        <h5 class="modal-title">Áreas Selecionadas</h5> 
                        <div class="card-body">
                            <div class="row">
                                <div id='rolagem' >
                                    <div class="col-sm-12">
                                        <?php echo form_open('home/deletcandidatoarea/'.$cand->id, array('class' => 'form-horizontal', 'id' => 'form-login')); ?>
                                                <?php foreach ($areacand as $a){   ?>
                                                <p><input type="checkbox" class="form-check-input" name="iddel[]" value="<?= $a['idarea']  ?>"><?=($a['descricao']);?>    </p>
                                                <?php } ?>
                                    </div>  
                                </div><!-- fim da rolagem-->
                                <button type="submit" class="btn btn-primary">Remover Selecionados</button>  
                                        <?php echo form_close();?>
                            </div>
                        </div> 
                    </div>
                    <!-- fim areas selecionadas-->
                </div>
            </section>
        </div>
    </div>
 </div>
</div><!--fim modal area de interesse  -->

<script>// função que testa se as senhas são iguais   
   $(function(){
	$("#inputsubmit").click(function(){
      var senha = $("#senha").val();
      var senha2 = $("#confirmarsenha").val();
      //console.log(senha);
      //console.log(senha2);
      if(senha != senha2){
        event.preventDefault();
      	alert("As senhas não são iguais!");
        $("#senha").val(null);
        $("#confirmarsenha").val(null); 
        $('#senha').trigger('focus');     
      }
    });
  });
</script>
