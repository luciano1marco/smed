<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class designacao extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Designação");
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
                  
                  $this->data['designacao']= R::findAll('designacao');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/designacao/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "designacao", 'admin/designacao/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] = $id;
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Designação';
		/* Validate form input */
		$this->form_validation->set_rules('escola_id', 'escola_id', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("designacao");
			$resp->descricao       = strtoupper($this->input->post('descricao'));
            
            R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/servidores/view/'.$id, 'refresh');
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
			$this->template->admin_render('admin/designacao/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/designacao', 'refresh');
		}

		$lixo = R::load("designacao", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/designacao', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "designacao", 'admin/designacao/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'designacao';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("designacao", $id);

            if ($this->form_validation->run()) {
                $resp->descricao       = strtoupper($this->input->post('descricao'));
                R::store($resp);

                redirect('admin/designacao', 'refresh');
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
                $this->template->admin_render('admin/designacao/edit', $this->data);
    }
    
   
}//fim classe
