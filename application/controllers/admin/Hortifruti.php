<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hortifruti extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Hortifruti");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
    public function index($id, $at = null){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                 
                if($at == null){
                    $teste = "where  substring(mes_ano, 1,4) = YEAR(CURRENT_TIMESTAMP) and    idescola  = ".$id;
                 }else{
                    $teste = "where idescola  = ".$id; 
                 } 

                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  
                  $this->data['escolas']= R::getAll($sqlescola); 
                  //$this->data['hortifruti']= R::findAll('hortifruti');   
                  $sql ="SELECT  *
                           from hortifruti
                            ".$teste;
                           
                  $this->data['hortifruti']= R::getAll($sql);    
                   /* Load Template */
                   $this->template->admin_render('admin/hortifruti/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "hortifruti", 'admin/hortifruti/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        //variaveis utilizadas
        $idescola = $id;
        $this->data['idescola1'] = $idescola;
        $diasdomes = date('t');

        $mes   = strtoupper($this->input->post('mes'));
        $ano = date('Y');
        $mes_ano = $ano.'-'.$mes;
                
        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'hortifruti';
		/* Validate form input */
		$this->form_validation->set_rules('tipo', 'tipo', 'required');
           //definindo valores para nro_alunos, tarde, manha,noite, integral,eja
         $sql_qde_al    ="SELECT SUM(matriculas) nro_alunos FROM turmas  WHERE  idescola = ".$idescola;
         $sqlTarde      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 2 and idescola = ".$idescola.") AS tarde      FROM escolas WHERE id =". $idescola;
         $sqlnoite      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 4 and idescola = ".$idescola.") AS noite      FROM escolas WHERE id =". $idescola;
         $sqleja        ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 3 and idescola = ".$idescola.") AS eja        FROM escolas WHERE id =". $idescola;
         $sqlintegral   ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 5 and idescola = ".$idescola.") AS integral   FROM escolas WHERE id =". $idescola;
         $sqlmanha      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 1 and idescola = ".$idescola.") AS manha      FROM escolas WHERE id =". $idescola;
 
         $nro_alunos = R::getAll($sql_qde_al);        
         $tarde      = R::getAll($sqlTarde);
         $noite      = R::getAll($sqlnoite);
         $eja        = R::getAll($sqleja);
         $integral   = R::getAll($sqlintegral);
         $manha      = R::getAll($sqlmanha);

        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {

           	$resp = R::dispense("hortifruti");
                $resp->idescola       = $idescola;
                $resp->mes_ano        = $mes_ano;
                $resp->soma_atendidos = strtoupper($this->input->post('soma_atendidos'));
                $resp->total_dias     = strtoupper($this->input->post('total_dias'));
                $resp->media_alunos   = strtoupper($this->input->post('media_alunos'));
                $resp->tipo           = strtoupper($this->input->post('tipo'));
            R::store($resp);
            
            $idinserido = $resp->id; //pega o id inserido na tabela hortifruti 
            $diasdomes = date('t');//pega numero de dias do mes atual
            //pea os dados do input
            $generos        = $this->input->post(['generos']);
            $nro_guia       = $this->input->post(['nro_guia']);
            $entrada        = $this->input->post(['entrada']);
            $saida          = $this->input->post(['saida']);
            $saldo          = $this->input->post(['saldo']);
            //separa os dados do input 
            foreach($generos        as $ge){}
            foreach($nro_guia       as $ng){}
            foreach($entrada        as $en){}
            foreach($saida          as $sd){}
            foreach($saldo          as $so){}
            //grava os dados 
            for($i=0;$i<$diasdomes;$i++){
                $resp1 = R::dispense("hortifrutidia");
                    $resp1->idhortifruti = $idinserido;
                    $resp1->dia           = $i + 1;
                    $resp1->generos       = $ge[$i];
                    $resp1->nro_guia      = $ng[$i];
                    $resp1->entrada       = $en[$i];
                    $resp1->saida         = $sd[$i];
                    $resp1->saldo         = $so[$i];
                R::store($resp1); 
            }
			
            $this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/hortifruti/index/'.$id, 'refresh');
		} 
        else{
                $this->data['message'] = (validation_errors() ? validation_errors() : "");
                //dados hortifruti    
                $this->data['idescola'] = array(
                    'name'  => 'idescola',
                    'id'    => 'idescola',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('idescola'),
                );
                $this->data['mes'] = array(
                    'name'  => 'mes',
                    'id'    => 'mes',
                    'type'  => 'text',
                    'options'  => $this->getmes(),
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('mes'),
                );
                $this->data['soma_atendidos'] = array(
                    'name'  => 'soma_atendidos',
                    'id'    => 'soma_atendidos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('soma_atendidos'),
                );
                $this->data['total_dias'] = array(
                    'name'  => 'total_dias',
                    'id'    => 'total_dias',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('total_dias'),
                );
                $this->data['media_alunos'] = array(
                    'name'  => 'media_alunos',
                    'id'    => 'media_alunos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('media_alunos'),
                );
                $this->data['nro_alunos'] = array(
                    'name'  => 'nro_alunos',
                    'id'    => 'nro_alunos',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $nro_alunos[0]['nro_alunos'],
                );
                $this->data['manha'] = array(
                    'name'  => 'manha',
                    'id'    => 'manha',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $manha[0]['manha'],
                );
                $this->data['tarde'] = array(
                    'name'  => 'tarde',
                    'id'    => 'tarde',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $tarde[0]['tarde'],
                );
                $this->data['noite'] = array(
                    'name'  => 'noite',
                    'id'    => 'noite',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $noite[0]['noite'],
                );
                $this->data['integral'] = array(
                    'name'  => 'integral',
                    'id'    => 'integral',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $integral[0]['integral'],
                );
                $this->data['eja'] = array(
                    'name'  => 'eja',
                    'id'    => 'eja',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $eja[0]['eja'],
                );
               
                $this->data['tipo'] = array(
                    'name'  => 'tipo',
                    'id'    => 'tipo',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('tipo'),
                );
                $this->data['idhortifruti'] = array(
                    'name'  => 'idhortifruti[]',
                    'id'    => 'idhortifruti[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('idhortifruti'),		
                );
                $this->data['dia'] = array(
                    'name'  => 'dia[]',
                    'id'    => 'dia[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('dia'),
                );		
                $this->data['generos'] = array(
                    'name'  => 'generos[]',
                    'id'    => 'generos[]',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('generos'),
                );
                $this->data['nro_guia'] = array(
                    'name'  => 'nro_guia[]',
                    'id'    => 'nro_guia[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $this->form_validation->set_value('nro_guia'),
                );		
                $this->data['entrada'] = array(
                    'name'  => 'entrada[]',
                    'id'    => 'entrada[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $this->form_validation->set_value('entrada'),
                );	
                $this->data['saida'] = array(
                    'name'  => 'saida[]',
                    'id'    => 'saida[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $this->form_validation->set_value('saida'),
                );	
                $this->data['saldo'] = array(
                    'name'  => 'saldo[]',
                    'id'    => 'saldo[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $this->form_validation->set_value('saldo'),
                );	
            }
                    
			/* Load Template */
			$this->template->admin_render('admin/hortifruti/create', $this->data);
		
	}
    
    public function edit($id) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "hortifruti", 'admin/hortifruti/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'hortifruti';
        /* Validate form input */
        $this->form_validation->set_rules('generos', 'generos', 'required');
        
        $resp = R::load("hortifrutidia", $id);

        $this->data['iddemo'] = $resp->idhortifruti;
        if ($this->form_validation->run()) {
            $resp->idhortifruti=$resp->idhortifruti;
            $resp->generos        = strtoupper($this->input->post('generos'));
            $resp->nro_guia       = strtoupper($this->input->post('nro_guia'));
            $resp->entrada        = strtoupper($this->input->post('entrada'));
            $resp->saida          = strtoupper($this->input->post('saida'));
            $resp->saldo          = strtoupper($this->input->post('saldo'));
          
            R::store($resp);

            redirect('admin/hortifruti/view/'.$resp->idhortifruti, 'refresh');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['t_id'] = array('id' => $resp->id);
            
            $this->data['dia'] = array(
                'name'  => 'dia',
                'id'    => 'dia',
                'type'  => 'int',
                'class' => 'form-control',	
                'value' => $resp->dia,
            );		
            $this->data['generos'] = array(
                'name'  => 'generos',
                'id'    => 'generos',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $resp->generos,
            );	
            $this->data['nro_guia'] = array(
                'name'  => 'nro_guia',
                'id'    => 'nro_guia',
                'type'  => 'text',
                'class' => 'form-control',			
                'value' => $resp->nro_guia,
            );
            $this->data['entrada'] = array(
                'name'  => 'entrada',
                'id'    => 'entrada',
                'type'  => 'text',
                'class' => 'form-control'	,		
                'value' => $resp->entrada,
            );	
            $this->data['saida'] = array(
                'name'  => 'saida',
                'id'    => 'saida',
                'type'  => 'text',
                'class' => 'form-control'	,		
                'value' => $resp->saida,
            );	
            $this->data['saldo'] = array(
                'name'  => 'saldo',
                'id'    => 'saldo',
                'type'  => 'text',
                'class' => 'form-control',			
                'value' => $resp->saldo,
            );	
               
        }

            /* Load Template */
            $this->template->admin_render('admin/hortifruti/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/hortifruti', 'refresh');
		}
   
		$lixo = R::load("hortifruti", $id);
        $idescola = $lixo->idescola;//pega idescola para redirecionar a pagina
        $id= $lixo->id;//pega id hortifruti da tabela hortifruti 
        R::trash($lixo);//deleta da tabela hortifruti
        
        $lixo1 = R::findAll("hortifrutidia",'idhortifruti ='. $id);
        R::trashAll($lixo1);//deleta da tabela hortifrutidia
       
		$this->session->set_flashdata('message', "Itens removidos");
        redirect('admin/hortifruti/index/'.$idescola, 'refresh');
		
	}
    public function view($id) {   
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "hortifruti", 'admin/hortifruti/view');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'Editar hortifruti';
        /* Validate form input */
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        
        //variaveis utilizadas
        //$diasdomes = date('t');//pega numero de dias do mes atual
        $resp = R::load("hortifruti", $id);
        $this->data['idescola'] = $resp->idescola;
       
        // $resp1 = R::load("hortifrutidia", "idhortifruti = " .$resp->id);
        $sql="SELECT * from hortifrutidia where idhortifruti = ".$id;
        $resp1 = R::getAll($sql);
        $this->data['demodia']= R::getAll($sql);
        
        //definindo valores para nro_alunos, tarde, manha,noite, integral,eja
        $sql_qde_al    ="SELECT SUM(matriculas) nro_alunos  FROM turmas  WHERE  idescola = ".$resp->idescola;
        $sqlTarde      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 2 and idescola = ".$resp->idescola.") AS tarde      FROM escolas WHERE id =". $resp->idescola;
        $sqlnoite      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 4 and idescola = ".$resp->idescola.") AS noite      FROM escolas WHERE id =". $resp->idescola;
        $sqleja        ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 3 and idescola = ".$resp->idescola.") AS eja        FROM escolas WHERE id =". $resp->idescola;
        $sqlintegral   ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 5 and idescola = ".$resp->idescola.") AS integral   FROM escolas WHERE id =". $resp->idescola;
        $sqlmanha      ="SELECT  * ,(SELECT SUM(matriculas) FROM turmas   WHERE idturno = 1 and idescola = ".$resp->idescola.") AS manha      FROM escolas WHERE id =". $resp->idescola;

        $nro_alunos = R::getAll($sql_qde_al);        
        $tarde      = R::getAll($sqlTarde);
        $noite      = R::getAll($sqlnoite);
        $eja        = R::getAll($sqleja);
        $integral   = R::getAll($sqlintegral);
        $manha      = R::getAll($sqlmanha);
        
       // var_dump($teste[0]['tarde']);die;

        if ($this->form_validation->run()) {

            $mes = $this->input->post('mes');
            $ano = date('Y');
            $mes_ano = $ano.'-'.$mes;
            //var_dump($resp->idescola);die;
                $resp->idescola  = $resp->idescola;
                $resp->mes_ano   = $mes_ano;
                $resp->nro_alunos= strtoupper($this->input->post('nro_alunos'));
                $resp->manha     = strtoupper($this->input->post('manha'));
                $resp->tarde     = strtoupper($this->input->post('tarde'));
                $resp->noite     = strtoupper($this->input->post('noite'));
                $resp->integral  = strtoupper($this->input->post('integral'));
                $resp->eja       = strtoupper($this->input->post('eja'));
                $resp->tipo      = strtoupper($this->input->post('tipo'));
            R::store($resp);
           
            redirect('admin/hortifruti/index/'.$resp->idescola, 'refresh');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");
                //para mostrar o mes que esta no banco
                $mes1 = explode('-',$resp->mes_ano);
                $mes = $mes1[1];
                $ano = $mes1[0];
                $this->data['ano'] = $ano;

                $this->data['idescola'] = array(
                    'name'  => 'idescola',
                    'id'    => 'idescola',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->idescola,
                );
                $this->data['mes'] = array(
                    'name'  => 'mes',
                    'id'    => 'mes',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'options'  => $this->getmes(),
                    'selected' => $mes,
                );
                $this->data['nro_alunos'] = array(
                    'name'  => 'nro_alunos',
                    'id'    => 'nro_alunos',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $nro_alunos[0]['nro_alunos'],
                );
                $this->data['manha'] = array(
                    'name'  => 'manha',
                    'id'    => 'manha',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $manha[0]['manha'],
                );
                $this->data['tarde'] = array(
                    'name'  => 'tarde',
                    'id'    => 'tarde',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $tarde[0]['tarde'],
                );
                $this->data['noite'] = array(
                    'name'  => 'noite',
                    'id'    => 'noite',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $noite[0]['noite'],
                );
                $this->data['integral'] = array(
                    'name'  => 'integral',
                    'id'    => 'integral',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $integral[0]['integral'],
                );
                $this->data['eja'] = array(
                    'name'  => 'eja',
                    'id'    => 'eja',
                    'type'  => 'text',
                    'disabled'    => 'disabled',
                    'class' => 'form-control',
                    'value' => $eja[0]['eja'],
                );
                $this->data['soma_atendidos'] = array(
                    'name'  => 'soma_atendidos',
                    'id'    => 'soma_atendidos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->soma_atendidos,
                );
                $this->data['total_dias'] = array(
                    'name'  => 'total_dias',
                    'id'    => 'total_dias',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->total_dias,
                );
                $this->data['media_alunos'] = array(
                    'name'  => 'media_alunos',
                    'id'    => 'media_alunos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->media_alunos,
                );
                $this->data['tipo'] = array(
                    'name'  => 'tipo',
                    'id'    => 'tipo',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->tipo,
                );
            //fim dados demosntrativo    
            $ultimo = date('d', mktime(0, 0, 0, $mes+1, 0, $ano ));
            
            $diasdomes = date($mes);//pega numero de dias do mes atual
                
            for($i=0;$i<$diasdomes;$i++){
            //var_dump($resp1[$i]);
           
            $this->data['generos'] = array(
                    'name'  => 'generos',
                    'id'    => 'generos',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $resp1[$i]['generos'],
                );
                $this->data['dia'] = array(
                    'name'  => 'dia[]',
                    'id'    => 'dia[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $resp1[$i]['dia'],
                );
                $this->data['nro_guia'] = array(
                    'name'  => 'nro_guia[]',
                    'id'    => 'nro_guia[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $resp1[$i]['nro_guia'],
                );
                $this->data['entrada'] = array(
                    'name'  => 'entrada[]',
                    'id'    => 'entrada[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $resp1[$i]['entrada'],
                );	
               $this->data['saida'] = array(
                    'name'  => 'saida[]',
                    'id'    => 'saida[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $resp1[$i]['saida'],
                );	
                $this->data['saldo'] = array(
                    'name'  => 'saldo[]',
                    'id'    => 'saldo[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $resp1[$i]['saldo'],
                );
            }//die;

         }//fim else
            /* Load Template */
        $this->template->admin_render('admin/hortifruti/view', $this->data);
    }//fim function
    
    private function getmes(){
        $teste = R::findAll("mes");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
    }

}//fim classe