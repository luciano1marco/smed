<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipos extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();

         /* Title Page :: Common */
         $this->page_title->push(lang('tipos'));
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
                  
                  $this->data['tipo']= R::findAll('tipos');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/tipos/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova Área", 'admin/tipos/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['texto_create'] = 'Criar Tipo';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
                    /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$area = R::dispense("tipos");
			$area->descricao = strtoupper($this->input->post('descricao'));
                        
			R::store($area);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/tipos', 'refresh');
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
			$this->template->admin_render('admin/tipos/create', $this->data);
		
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
            
            $this->data['id'] =$id;
               
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Editar Tipos", 'admin/tipos/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $ti = R::load("tipos", $id);

            if ($this->form_validation->run()) {
                $ti->descricao = strtoupper($this->input->post('descricao'));
                R::store($ti);

                redirect('admin/tipos', 'refresh');
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
                $this->template->admin_render('admin/tipos/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/tipos', 'refresh');
		}

		$lixo = R::load("tipos", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/tipos', 'refresh');
	}
}//fim da classe
