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
                  
                  $this->data['designacao']= R::findAll('servidorescola');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/designacao/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "designacao", 'admin/designacao/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] = $id;
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Designação';
		/* Validate form input */
		$this->form_validation->set_rules('Designacao', 'designacao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("designacao");
			$resp->designacao       = strtoupper($this->input->post('designacao'));
            $resp->escola_id        = strtoupper($this->input->post('escola_id'));
            $resp->turno            = strtoupper($this->input->post('turno'));
            $resp->turmas_atende    = strtoupper($this->input->post('turmas_atende'));
            $resp->setor            = strtoupper($this->input->post('setor'));
            $resp->licenca          = strtoupper($this->input->post('licenca '));
            $resp->obsch            = strtoupper($this->input->post('obsch'));
            $resp->iduser           = $this->session->user_id;
            $resp->idservidor       = strtoupper($this->input->post('idservidor'));
                                    
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/designacao', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");

                       $this->data['designacao'] = array(
                            'name'  => 'designacao',
                            'id'    => 'designacao',
                            'type'  => 'int',
                            'options'  => $this->getdesignacao(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('designacao'),
                        );
                        $this->data['escola_id'] = array(
                            'name'  => 'escola_id',
                            'id'    => 'escola_id',
                            'type'  => 'int',
                            'options'  => $this->getescola(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('escola_id'),
                        );
                        $this->data['turno'] = array(
                            'name'  => 'turno',
                            'id'    => 'turno',
                            'type'  => 'int',
                            'options'  => $this->getturno(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('turno'),
                        );
                        $this->data['turmas_atende'] = array(
                            'name'  => 'turmas_atende',
                            'id'    => 'turmas_atende',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('turmas_atende'),
                        );
                        $this->data['setor'] = array(
                            'name'  => 'setor',
                            'id'    => 'setor',
                            'type'  => 'int',
                            'options'  => $this->getsetor(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('setor'),
                        );
                        $this->data['licenca'] = array(
                            'name'  => 'licenca',
                            'id'    => 'licenca',
                            'type'  => 'int',
                            'options'  => $this->getlicenca(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('licenca'),
                        );
                        $this->data['obsch'] = array(
                            'name'  => 'obsch',
                            'id'    => 'obsch',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('obsch'),
                        );
                        
                        $this->data['idservidor'] = array(
                            'name'  => 'idservidor',
                            'id'    => 'idservidor',
                            'type'  => 'int',
                            'options'  => $this->getservidor(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('idservidor'),
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
                $resp->designacao       = strtoupper($this->input->post('designacao'));
                $resp->escola_id        = strtoupper($this->input->post('escola_id'));
                $resp->turno            = strtoupper($this->input->post('turno'));
                $resp->turmas_atende    = strtoupper($this->input->post('turmas_atende'));
                $resp->setor            = strtoupper($this->input->post('setor'));
                $resp->licenca          = strtoupper($this->input->post('licenca '));
                $resp->obsch            = strtoupper($this->input->post('obsch'));
                $resp->dt_cadastro      = strtoupper($this->input->post('dt_cadastro'));
                $resp->iduser           = strtoupper($this->input->post('iduser'));
                $resp->idservidor       = strtoupper($this->input->post('idservidor'));
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
                    $this->data['designacao'] = array(
                        'name'  => 'designacao',
                        'id'    => 'designacao',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->designacao,
                    );
                    $this->data['escola_id'] = array(
                        'name'  => 'escola_id',
                        'id'    => 'escola_id',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->escola_id,
                    );
                    $this->data['turno'] = array(
                        'name'  => 'turno',
                        'id'    => 'turno',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->turno,
                    );
                    $this->data['turmas_atende'] = array(
                        'name'  => 'turmas_atende',
                        'id'    => 'turmas_atende',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->turmas_atende,
                    );
                    $this->data['setor'] = array(
                        'name'  => 'setor',
                        'id'    => 'setor',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->setor,
                    );
                    $this->data['licenca'] = array(
                        'name'  => 'licenca',
                        'id'    => 'licenca',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->licenca,
                    );
                    $this->data['obsch'] = array(
                        'name'  => 'obsch',
                        'id'    => 'obsch',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->obsch,
                    );
                    $this->data['iduser'] = array(
                        'name'  => 'iduser',
                        'id'    => 'iduser',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->iduser,
                    );
                    $this->data['idservidor'] = array(
                        'name'  => 'idservidor',
                        'id'    => 'idservidor',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->idservidor,
                    );
                   
                  }

                /* Load Template */
                $this->template->admin_render('admin/designacao/edit', $this->data);
    }
    private function getdesignacao() {
		$teste = R::findAll("convocacao");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getturno() {
		$teste = R::findAll("turnos");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getlicenca() {
		$teste = R::findAll("licencas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getsetor() {
		$teste = R::findAll("setor");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getservidor() {
		$teste = R::findAll("servidores");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
    private function getescola() {
		$teste = R::findAll("escolas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
}//fim classe
