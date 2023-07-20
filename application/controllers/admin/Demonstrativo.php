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
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "demonstrativo", 'admin/demonstrativo/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Demonstrativo';
		/* Validate form input */
		$this->form_validation->set_rules('tipo', 'tipo', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("demonstrativo");
			$resp->idescola  = strtoupper($this->input->post('idescola'));
			$resp->mes_ano   = strtoupper($this->input->post('mes_ano'));
			$resp->nro_alunos= strtoupper($this->input->post('nro_alunos'));
			$resp->manha     = strtoupper($this->input->post('manha'));
			$resp->tarde     = strtoupper($this->input->post('tarde'));
			$resp->noite     = strtoupper($this->input->post('noite'));
			$resp->integral  = strtoupper($this->input->post('integral'));
			$resp->eja       = strtoupper($this->input->post('eja'));
			$resp->tipo      = strtoupper($this->input->post('tipo'));
                                    
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/demonstrativo', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");

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