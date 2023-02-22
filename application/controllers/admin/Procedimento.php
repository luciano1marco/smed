<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procedimento extends Admin_Controller {

	public function __construct(){
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('procedimento'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');


	}
	public function index(){  
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
        }
        else
        {
			/* dados  */
			// pega o id do usuário logado----($user_id)
			//$user_id = $this->session->user_id;
			
		    $this->data['procede'] = R::findAll("procedimento");
		   

           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Criar Procedimento';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function create($id){
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Procedimento", 'admin/procedimento/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Criar Procedimento';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$procede = R::dispense("procedimento");
            $procede->idpa = $id;
			$procede->descricao = $this->input->post('descricao');
           
			R::store($procede);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pacientes', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

			$this->data['id'] = array(
				'id' => $id,
			);

            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
            
            $this->data['idpa'] = array(
                'name'  => 'idpa',
                'id'    => 'idpa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idpa'),
            );

			
        }         
        /* Load Template */
        $this->template->admin_render('admin/procedimento/create', $this->data);
    }
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/pacientes', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("procedimento", $id);
			R::trash($lixo);
		}
		redirect('admin/pacientes', 'refresh');
	}
	public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Procedimento", 'admin/procedimento/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Procedimento';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$procede = R::load("procedimento", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$procede->descricao = $this->input->post('descricao');
								
				R::store($procede);

				redirect('admin/pacientes/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $procede->id,
		);

		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $procede->descricao,
		);

        $this->data['dprocede'] = array(
			'name'  => 'dprocede',
			'id'    => 'dprocede',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $procede->dprocede,
        );
		$this->data['idpa'] = array(
			'name'  => 'idpa',
			'id'    => 'idpa',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('idpa'),
		);
        
		
		/* Load Template */
		$this->template->admin_render('admin/procedimento/edit', $this->data);
	}

}
