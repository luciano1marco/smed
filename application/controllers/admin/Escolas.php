<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class escolas extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('Escolas'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index()	{  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
        }
        else
        {
			/* dados  */
			$this->data['escola'] = R::findAll("escolas");

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Escolas';

			/* Data */
			$this->data['error'] = NULL;

			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create()
    {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova escola", 'admin/escolas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Escolas';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("escolas");
            $resp->descricao =strtoupper($this->input->post('descricao'));
            $resp->endereco  = strtoupper($this->input->post('endereco')) ;
            
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/escolas', 'refresh');
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

           $this->data['endereco'] = array(
                'name'  => 'endereco',
                'id'    => 'endereco',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('endereco'),
			);
			
			
        }         
        /* Load Template */
        $this->template->admin_render('admin/escolas/create', $this->data);
    }
   
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/escolas', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("escolas", $id);
			R::trash($lixo);
		}
		redirect('admin/escolas', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar escolas", 'admin/escolas/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar escolas';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$resp = R::load("escolas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {

				$resp->descricao   = strtoupper($this->input->post('descricao'));
				$resp->endereco    = strtoupper($this->input->post('endereco'));
				
				R::store($resp);

				redirect('admin/escolas/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $resp->id,
		);

		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->descricao,
		);

		$this->data['endereco'] = array(
			'name'  => 'endereco',
			'id'    => 'endereco',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->endereco,
		);
		
		/* Load Template */
		$this->template->admin_render('admin/escolas/edit', $this->data);
	}


}//fim da classe escolas
