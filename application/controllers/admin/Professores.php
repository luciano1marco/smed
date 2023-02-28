<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class professores extends Admin_Controller {

	public function __construct()    {
        parent::__construct();
        /* Title Page :: Common */
		$this->page_title->push("Professores");
		$this->data['pagetitle'] = $this->page_title->show();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;

        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
    }
	
	public function index()	{ 
		 
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
            
            $this->data['professor'] = R::findAll("professores");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Professor';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Professor", 'admin/professores/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Professor';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("professores");
            $resp->nome = $this->input->post('nome');
            $resp->email = $this->input->post('email');
            $resp->telefone = $this->input->post('telefone');
			$resp->cpf = $this->input->post('cpf');
			$resp->endereco = $this->input->post('endereco');
            $resp->data_nasc = $this->input->post('data_nasc');
            
			R::store($resp);

		//---envio de email--------
				
		$this->load->library('email');

		$this->email->from('luciano.correa@riogrande.rs.gov.br', 'Administrador SMED');
		$this->email->to($resp->email);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Cadastro SMED');
		$this->email->message('teste envio de email');

		$this->email->send();



			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/professores', 'refresh');
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
			$this->data['data_nasc'] = array(
                'name'  => 'data_nasc',
                'id'    => 'data_nasc',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('data_nasc'),
            );

        }         
        /* Load Template */
        $this->template->admin_render('admin/professores/create', $this->data);
    }
    
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/professores', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("professores", $id);
			R::trash($lixo);
		}
		redirect('admin/professores', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Professor", 'admin/professores/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Professor';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$resp = R::load("professores", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$resp->nome = $this->input->post('nome');
				$resp->email = $this->input->post('email');
				$resp->telefone = $this->input->post('telefone');
				$resp->cpf = $this->input->post('cpf');
				$resp->endereco = $this->input->post('endereco');
				$resp->data_nasc = $this->input->post('data_nasc');
				
				R::store($resp);

				redirect('admin/professores/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $resp->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->nome,
		);

        $this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->email,
        );
        
        $this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefone',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->telefone,
		);
		$this->data['cpf'] = array(
			'name'  => 'cpf',
			'id'    => 'cpf',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->cpf,
		);
		$this->data['endereco'] = array(
			'name'  => 'endereco',
			'id'    => 'endereco',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $resp->endereco,
		);
		$this->data['data_nasc'] = array(
			'name'  => 'data_nasc',
			'id'    => 'data_nasc',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $resp->data_nasc,
		);

		/* Load Template */
		$this->template->admin_render('admin/professores/edit', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("professores", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/professores', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("professores", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/professores', 'refresh');
	}

}
