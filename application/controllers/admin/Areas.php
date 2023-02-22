<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class areas extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Áreas");
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
                  
                  $this->data['areas']= R::findAll('areas');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/areas/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova Área", 'admin/areas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$area = R::dispense("areas");
			$area->descricao = strtoupper($this->input->post('descricao'));
                        
			R::store($area);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/areas', 'refresh');
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
			$this->template->admin_render('admin/areas/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/areas', 'refresh');
		}

		$lixo = R::load("areas", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/areas', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Editar Area", 'admin/areas/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $area = R::load("areas", $id);

            if ($this->form_validation->run()) {
                $area->descricao = strtoupper($this->input->post('descricao'));
                R::store($area);

                redirect('admin/areas', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $area->id);
                
                $this->data['descricao'] = array(
                    'name'  => 'descricao',
                    'id'    => 'descricao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $area->descricao
                    );
                  }

                /* Load Template */
                $this->template->admin_render('admin/areas/edit', $this->data);
    }
}//fim classe
