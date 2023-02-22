<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class departamentos extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Departamentos");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		$this->fa_icons = getFontAwesomeIcons();

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
                  
                  $this->data['departamentos']= R::findAll('departamentos');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/departamentos/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Departamento", 'admin/departamentos/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$dep = R::dispense("departamentos");
			$dep->descricao = strtoupper($this->input->post('descricao'));
            $dep->sigla = strtoupper($this->input->post('sigla'));
                        
			R::store($dep);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/departamentos', 'refresh');
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
            $this->data['sigla'] = array(
				'name'  => 'sigla',
				'id'    => 'sigla',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('sigla'),
			);
                    }
                    
			/* Load Template */
			$this->template->admin_render('admin/departamentos/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/departamentos', 'refresh');
		}

		$lixo = R::load("departamentos", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/departamentos', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Editar Departamento", 'admin/areas/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $dep = R::load("departamentos", $id);

            if ($this->form_validation->run()) {
                $dep->descricao = strtoupper($this->input->post('descricao'));
                $dep->sigla = strtoupper($this->input->post('sigla'));
                R::store($dep);

                redirect('admin/departamentos', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $dep->id);
                
                $this->data['descricao'] = array(
                    'name'  => 'descricao',
                    'id'    => 'descricao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $dep->descricao
                    );
                $this->data['sigla'] = array(
                    'name'  => 'sigla',
                    'id'    => 'sigla',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $dep->sigla
                    );
                
                  }

                /* Load Template */
                $this->template->admin_render('admin/departamentos/edit', $this->data);
    }
}//fim classe
