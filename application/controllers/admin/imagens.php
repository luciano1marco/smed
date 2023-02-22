<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class imagens extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('imagens'));
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
            
            $this->data['imagem'] = R::findAll("imagens");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Imagem';

			/* Data */
			$this->data['error'] = NULL;

			$this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
            
            $this->data['tipo'] = array(
                'name'  => 'tipo',
                'id'    => 'tipo',
                'type'  => 'checkbox',
				'options'  => $this->getTipos(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('tipo'),
            );
			
			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/imagens', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("imagens", $id);
			R::trash($lixo);
		}
		redirect('admin/imagens', 'refresh');
	}
	public function apagararquivo($id) {
	
		$ae = R::load("imagens", $id);
		//$etapa = R::load("etapas", $ae->etapa);//para fazer o refresh

		R::trash($ae);

		redirect('admin/imagens/', 'refresh');
	}
    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Imagem", 'admin/imagens/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Imagem';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$imagem = R::load("imagens", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$imagem->nome = $this->input->post('nome');
				$imagem->caminho = $this->input->post('caminho');
				$imagem->tipo = $this->input->post('tipo');
				$imagem->descricao = $this->input->post('descricao');
				
				R::store($imagem);

				redirect('admin/imagens/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $imagem->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $imagem->nome,
		);

        $this->data['caminho'] = array(
			'name'  => 'caminho',
			'id'    => 'caminho',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $imagem->caminho,
        );
        
        $this->data['tipo'] = array(
			'name'  => 'tipo',
			'id'    => 'tipo',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $imagem->tipo,
		);
		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $imagem->descricao,
		);
		/* Load Template */
		$this->template->admin_render('admin/imagens/edit', $this->data);
	}
	//------Uploads
	public function uploadarquivos() {
		$nomesarquivos = $_FILES['arquivos']['name'];
			
		for ($i=0; $i<count($nomesarquivos); $i++) {
			$_FILES['arquivo']['name'] = $_FILES['arquivos']['name'][$i];
			$_FILES['arquivo']['type'] = $_FILES['arquivos']['type'][$i];
			$_FILES['arquivo']['tmp_name'] = $_FILES['arquivos']['tmp_name'][$i];
			$_FILES['arquivo']['error'] = $_FILES['arquivos']['error'][$i];
			$_FILES['arquivo']['size'] = $_FILES['arquivos']['size'][$i];

			if (!is_dir("upload/ser")) {                                 
				mkdir("upload/ser");
			}                        
			$config['upload_path'] = "upload/ser";
			$config['allowed_types'] = '*';
			$config['max_size'] = 10240;
			$config['file_name'] = $_FILES['arquivos']['name'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("arquivo")) {
				$datafile = $this->upload->data();
				
				$dadosImg = R::dispense("imagens");
				$dadosImg->nome = $datafile["file_name"];
				$dadosImg->caminho = $datafile["full_path"];
				$dadosImg->descricao = $this->input->post('descricao');
				$dadosImg->tipo = $this->input->post('tipo');
			
				R::store($dadosImg);
			}
		}

		redirect('admin/imagens/' , 'refresh');
	}  
	public function getTipos() {
		$tipo = R::findAll("tipos");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }

}
