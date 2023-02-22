<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cargos extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();

         /* Title Page :: Common */
         $this->page_title->push(lang('cargos'));
         $this->data['pageicon'] = 'ul-list';
         $this->data['pagetitle'] = $this->page_title->show();
 
         $this->anchor = 'admin/' . $this->router->class;
 
         $this->load->helper('utilidades');
 
         $this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');
      
     
    }
    public function index(){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                  
                  $this->data['cargo']= R::findAll('cargos');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/cargos/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Cargo", 'admin/cargos/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['texto_create'] = 'Criar Cargo';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
                    /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$area = R::dispense("cargos");
			$area->descricao = strtoupper($this->input->post('descricao'));
                        
			R::store($area);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/cargos', 'refresh');
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
			$this->template->admin_render('admin/cargos/create', $this->data);
		
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
            
            $this->data['id'] =$id;
               
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Editar Cargos", 'admin/cargos/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $ti = R::load("cargos", $id);

            if ($this->form_validation->run()) {
                $ti->descricao = strtoupper($this->input->post('descricao'));
                R::store($ti);

                redirect('admin/cargos', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $ti->id);
               
                $this->data['descricao'] = array(
                    'name'  => 'descricao',
                    'id'    => 'descricao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $ti->descricao
                    );
                  }

                /* Load Template */
                $this->template->admin_render('admin/cargos/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/cargos', 'refresh');
		}

		$lixo = R::load("cargos", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/cargos', 'refresh');
	}
}//fim da classe
