<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class demonstrativo extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Demonstrativo");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
    public function index($id){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                 
                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  
                  $this->data['escolas']= R::getAll($sqlescola); 
                  //$this->data['demonstrativo']= R::findAll('demonstrativo');   
                  $sql ="SELECT  *
                           from demonstrativo
                           where  substring(mes_ano, 1,4) = YEAR(CURRENT_TIMESTAMP)  
                           and    idescola  = ".$id;
                           
                  $this->data['demonstrativo']= R::getAll($sql);    
                   /* Load Template */
                   $this->template->admin_render('admin/demonstrativo/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "demonstrativo", 'admin/demonstrativo/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        //variaveis utilizadas
        $idescola = $id;
        $this->data['idescola1'] = $idescola;
        $diasdomes = date('t');
        
        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Demonstrativo';
		/* Validate form input */
		$this->form_validation->set_rules('tipo', 'tipo', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {

           	$resp = R::dispense("demonstrativo");
                $resp->idescola  = $idescola;
                $resp->mes_ano   = strtoupper($this->input->post('mes_ano'));
                $resp->nro_alunos= strtoupper($this->input->post('nro_alunos'));
                $resp->manha     = strtoupper($this->input->post('manha'));
                $resp->tarde     = strtoupper($this->input->post('tarde'));
                $resp->noite     = strtoupper($this->input->post('noite'));
                $resp->integral  = strtoupper($this->input->post('integral'));
                $resp->eja       = strtoupper($this->input->post('eja'));
                $resp->tipo      = strtoupper($this->input->post('tipo'));
            R::store($resp);
            
            $idinserido = $resp->id; //pega o id inserido na tabela demonstrativo 
            $diasdomes = date('t');//pega numero de dias do mes atual
            
            $generos        = $this->input->post(['generos']);
            $validade       = $this->input->post(['validade']);
            $saldo_anterior = $this->input->post(['saldo_anterior']);
            $nro_guia       = $this->input->post(['nro_guia']);
            $entrada        = $this->input->post(['entrada']);
            $saida          = $this->input->post(['saida']);
            $saldo          = $this->input->post(['saldo']);

            foreach($generos        as $ge){}
            foreach($validade       as $va){}
            foreach($saldo_anterior as $sa){}
            foreach($nro_guia       as $ng){}
            foreach($entrada        as $en){}
            foreach($saida          as $sd){}
            foreach($saldo          as $so){}
            
            for($i=0;$i<$diasdomes;$i++){
                $resp1 = R::dispense("demonstrativodia");
                
                $resp1->iddemonstrativo = $idinserido;
                $resp1->dia           = $i + 1;
                $resp1->generos       = $ge[$i];
                $resp1->validade      = $va[$i];
                $resp1->saldo_anterior= $sa[$i];
                $resp1->nro_guia      = $ng[$i];
                $resp1->entrada       = $en[$i];
                $resp1->saida         = $sd[$i];
                $resp1->saldo         = $so[$i];
               
                R::store($resp1); 
            }
			
            $this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/demonstrativo/index/'.$id, 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");
                    //dados demonstrativo    
                       $this->data['idescola'] = array(
                            'name'  => 'idescola',
                            'id'    => 'idescola',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('idescola'),
                        );
                        $this->data['mes_ano'] = array(
                            'name'  => 'mes_ano',
                            'id'    => 'mes_ano',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('mes_ano'),
                        );
                        $this->data['nro_alunos'] = array(
                            'name'  => 'nro_alunos',
                            'id'    => 'nro_alunos',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('nro_alunos'),
                        );
                        $this->data['manha'] = array(
                            'name'  => 'manha',
                            'id'    => 'manha',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('manha'),
                        );
                        $this->data['tarde'] = array(
                            'name'  => 'tarde',
                            'id'    => 'tarde',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('tarde'),
                        );
                        $this->data['noite'] = array(
                            'name'  => 'noite',
                            'id'    => 'noite',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('noite'),
                        );
                        $this->data['integral'] = array(
                            'name'  => 'integral',
                            'id'    => 'integral',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('integral'),
                        );
                        $this->data['eja'] = array(
                            'name'  => 'eja',
                            'id'    => 'eja',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('eja'),
                        );
                        $this->data['tipo'] = array(
                            'name'  => 'tipo',
                            'id'    => 'tipo',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('tipo'),
                        );
                        $this->data['iddemonstrativo'] = array(
                            'name'  => 'iddemonstrativo[]',
                            'id'    => 'iddemonstrativo[]',
                            'type'  => 'int',
                            'class' => 'form-control',	
                            'value' => $this->form_validation->set_value('iddemonstrativo'),		
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
                        $this->data['validade'] = array(
                            'name'  => 'validade[]',
                            'id'    => 'validade[]',
                            'type'  => 'text',
                            'class' => 'form-control',			
                            'value' => $this->form_validation->set_value('validade'),
                        );	
                        $this->data['entrada'] = array(
                            'name'  => 'entrada[]',
                            'id'    => 'entrada[]',
                            'type'  => 'text',
                            'class' => 'form-control'	,		
                            'value' => $this->form_validation->set_value('entrada'),
                        );	
                        $this->data['saldo_anterior'] = array(
                            'name'  => 'saldo_anterior[]',
                            'id'    => 'saldo_anterior[]',
                            'type'  => 'text',
                            'class' => 'form-control',			
                            'value' => $this->form_validation->set_value('saldo_anterior'),
                        );	
                        $this->data['nro_guia'] = array(
                            'name'  => 'nro_guia[]',
                            'id'    => 'nro_guia[]',
                            'type'  => 'text',
                            'class' => 'form-control',			
                            'value' => $this->form_validation->set_value('nro_guia'),
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
                       
                    //fim dados demonstrativo    
                    //dados demonstrativo dia    
                               			
                }
                    
			/* Load Template */
			$this->template->admin_render('admin/demonstrativo/create', $this->data);
		
	}
 	
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/demonstrativo', 'refresh');
		}

		$lixo = R::load("demonstrativo", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/demonstrativo', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "demonstrativo", 'admin/demonstrativo/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'demonstrativo';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("demonstrativo", $id);

            if ($this->form_validation->run()) {
                $resp->descricao  = strtoupper($this->input->post('descricao'));
               

                R::store($resp);

                redirect('admin/demonstrativo', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $resp->id);
                
                    $this->data['descricao'] = array(
                        'name'  => 'descricao',
                        'id'    => 'descricao',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->descricao,
                    );
                   
                  }

                /* Load Template */
                $this->template->admin_render('admin/demonstrativo/edit', $this->data);
    }
}//fim classe