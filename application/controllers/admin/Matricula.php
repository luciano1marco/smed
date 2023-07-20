<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class matricula extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Matricula");
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
                  
                  $this->data['matricula']= R::findAll('matricula');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/matricula/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "matricula", 'admin/matricula/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] = $id;
        
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Matricula';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
        $sql="SELECT  *  from matricula as m
                
                    where m.idservidor =".$id;

        $this->data['matricula']= R::getAll($sql);  


        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("matricula");
            
			$resp->descricao  = strtoupper($this->input->post('descricao'));
            $resp->idservidor = $id;                        
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/matricula/create/'.$id, 'refresh');
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
			$this->template->admin_render('admin/matricula/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/matricula', 'refresh');
		}

		$lixo = R::load("matricula", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/matricula', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Matricula", 'admin/matricula/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Matricula';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("matricula", $id);

            if ($this->form_validation->run()) {
                $resp->descricao  = strtoupper($this->input->post('descricao'));
                R::store($resp);

                redirect('admin/matricula', 'refresh');
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
                $this->template->admin_render('admin/matricula/edit', $this->data);
    }
    public function apagarmatricula($id) {
	
		$ae = R::load("matricula", $id);
        //var_dump($ae);die;        
		$etapa = R::load("matricula", $ae->idservidor);//para fazer o refresh
        $idesc = $ae->idservidor;
		R::trash($ae);
        //var_dump($idesc);die;
		redirect('admin/matricula/create/'. $idesc, 'refresh');
	}
}//fim classe
