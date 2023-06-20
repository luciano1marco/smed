<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cidade extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Cidades");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
    public function index(){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                  
                  $this->data['cidade']= R::findAll('cidade');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/cidade/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Cidades", 'admin/cidade/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'cidade';
		/* Validate form input */
		$this->form_validation->set_rules('', 'descricao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("cidade");
			$resp->descricao  = strtoupper($this->input->post('descricao'));
                                    
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/cidade', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");

                       $this->data['descricao'] = array(
                            'name'  => 'descricao',
                            'id'    => 'descricao',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('descricao'),
                        );
                       
                    }
                    
			/* Load Template */
			$this->template->admin_render('admin/cidade/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/cidade', 'refresh');
		}

		$lixo = R::load("cidade", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/cidade', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "cidade", 'admin/cidade/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Cidades';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("cidade", $id);

            if ($this->form_validation->run()) {
                $resp->descricao  = strtoupper($this->input->post('descricao'));
               

                R::store($resp);

                redirect('admin/cidade', 'refresh');
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
                $this->template->admin_render('admin/cidade/edit', $this->data);
    }
}//fim classe
