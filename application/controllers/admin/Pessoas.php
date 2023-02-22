<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pessoas extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('pessoas'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');

        /* Breadcrumbs :: Common */
       // $this->breadcrumbs->unshift(1, 'apoiador', 'admin/apoiador');
    }
	
	public function index()	{ 
		 
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
            
            $this->data['pessoa'] = R::findAll("pessoas");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Criar Socios';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova Pessoa", 'admin/pessoas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Criar Socio';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			
			$pessoa = R::dispense("pessoas");
            $pessoa->nome =strtoupper($this->input->post('nome'));
            $pessoa->email = $this->input->post('email');
            $pessoa->telefone = $this->input->post('telefone');
			$pessoa->cpf = $this->input->post('cpf');
			$pessoa->endereco = $this->input->post('endereco');
            $pessoa->datanasc = $this->input->post('datanasc');
            
			R::store($pessoa);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/pessoas', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['nome'] = array(
                'name'  => 'nome',
                'id'    => 'nome',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('nome'),
            );
            
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['telefone'] = array(
                'name'  => 'telefone',
                'id'    => 'telefome',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('telefone'),
            );
			$this->data['cpf'] = array(
                'name'  => 'cpf',
                'id'    => 'cpf',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('cpf'),
            );
			$this->data['endereco'] = array(
                'name'  => 'endereco',
                'id'    => 'endereco',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('endereco'),
            );
			$this->data['datanasc'] = array(
                'name'  => 'datanasc',
                'id'    => 'datanasc',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('datanasc'),
            );

        }         
        /* Load Template */
        $this->template->admin_render('admin/pessoas/create', $this->data);
    }
    
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/pessoas', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("pessoas", $id);
			R::trash($lixo);
		}
		redirect('admin/pessoas', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Socios", 'admin/pessoas/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Socios';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$pessoa = R::load("pessoas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$pessoa->nome = strtoupper($this->input->post('nome'));
				$pessoa->email = $this->input->post('email');
				$pessoa->telefone = $this->input->post('telefone');
				$pessoa->cpf = $this->input->post('cpf');
				$pessoa->endereco = $this->input->post('endereco');
				$pessoa->datanasc = $this->input->post('datanasc');
				
				R::store($pessoa);

				redirect('admin/pessoas/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $pessoa->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $pessoa->nome,
		);

        $this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $pessoa->email,
        );
        
        $this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefone',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $pessoa->telefone,
		);
		$this->data['cpf'] = array(
			'name'  => 'cpf',
			'id'    => 'cpf',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $pessoa->cpf,
		);
		$this->data['endereco'] = array(
			'name'  => 'endereco',
			'id'    => 'endereco',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $pessoa->endereco,
		);
		$this->data['datanasc'] = array(
			'name'  => 'datanasc',
			'id'    => 'datanasc',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $pessoa->datanasc,
		);

		/* Load Template */
		$this->template->admin_render('admin/pessoas/edit', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("pessoas", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/pessoas', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("pessoas", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/pessoas', 'refresh');
	}

}
