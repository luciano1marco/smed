<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo1 extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push('Pessoas');
        $this->data['pageicon'] = 'ul-list';
		$this->data['pagetitle'] = $this->page_title->show();
		
		$this->anchor = 'admin/demos/'.$this->router->class;
		
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Pessoas', $this->anchor);
    }

	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Nome do Botão Criar do INDEX */
            $this->data['texto_btn_create'] = 'Criar Pessoas';

            /* Data */
            $this->data['error'] = NULL;

			/* Load */
            $pessoas = R::find( 'pessoas' );

            /* Carrega pessoas VIEW */
			$this->data['pessoas'] = $pessoas;
						
			$this->data['id_check'] = array(
				'name'          => 'id',
				'id'            => 'id_check[]',
				'value'         => null,
				'checked'       => FALSE,
				'style'         => 'margin:10px'
			);
						
			/* Load Template */		
            $this->template->admin_render($this->anchor.'/index', $this->data);
        }
	}
	
	public function form(){		
		
		$form['nome'] = array(
			'name'  				=> 'nome',
			'id'    				=> 'nome',
			'type'  				=> 'text',
			'class' 				=> 'form-control'			
		);
		$form['idade'] = array(
			'name'  				=> 'idade',
			'id'    				=> 'idade',
			'type'  				=> 'text',
			'class' 				=> 'form-control'		
		);				
		$form['publicado'] = array(
			'name'  				=> 'publicado',
            'id'    				=> 'publicado',
            'class'                 => 'icheck',
			'type'  				=> 'checkbox',
			'value' 				=> '1',
			'style' 				=> 'margin-top:10px'
		);
	
		return $form;
	}
    
    public function create()
	{
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Criar Pessoas', $this->anchor.'/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        /* Titulo Criar */
        $this->data['texto_create'] = 'Criar Pessoas';

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		$this->form_validation->set_rules('idade', 'idade', 'required');
					
		if ($this->form_validation->run() == TRUE)
		{
			$nome 	    = ucfirst($this->input->post('nome'));
			$idade 	    = intval($this->input->post('idade'));
			
			$publicado 	= $this->input->post('publicado');	
			
			$pessoas = R::dispense("pessoas");			
			$pessoas->nome 		= $nome;
			$pessoas->idade 	= $idade;			
            $pessoas->publicado 	= $publicado;
            
			R::store($pessoas);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect($this->anchor, 'refresh');
		}	
		else
		{
			$this->data['message'] = (validation_errors() ? validation_errors() : "");
			
			/* Recebe os dados do Form */
			$form = $this->form();
            
            /* Caso precise adicionar mais dados */
            $this->data = array_merge($this->data,$form);
            
            /* Publicado Sempre Ativo */
            $this->data['publicado']['checked'] = true;
														
			/* Load Template */
			$this->template->admin_render($this->anchor.'/create', $this->data);
		}
	}

	public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Tipo de Eventos", $this->anchor.'/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
               
        /* Titulo */
		$this->data['texto_edit'] = 'Editar Pessoa';

		/* Validate form input */				
		$this->form_validation->set_rules('nome', 'nome', 'required');
		$this->form_validation->set_rules('idade', 'idade', 'required');
		
		$pessoas = R::load("pessoas", $id);
		
		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$nome 	    = ucfirst($this->input->post('nome'));
                $idade 	    = intval($this->input->post('idade'));	
                		
				$publicado 	= intval($this->input->post('publicado'));	

				$pessoas->nome 		= $nome;
				$pessoas->idade 	= $idade;			
				$pessoas->publicado = $publicado;

				R::store($pessoas);

				$this->session->set_flashdata('message', "Dados atualizados");				
				redirect($this->anchor, 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		//Recebe os dados do Form
		$form = $this->form();
				
		$this->data = array_merge($this->data,$form);

		$this->data['id'] = array(
			'id' => $pessoas->id
		);

		$this->data['nome']['value'] 		= $pessoas->nome;
		$this->data['idade']['value'] 	    = $pessoas->idade;
		
		$this->data['publicado']['checked'] = $pessoas->publicado?true:false;
		$this->data['publicado']['value'] 	= $pessoas->publicado?1:0;
							
		/* Load Template */
		$this->template->admin_render($this->anchor.'/edit', $this->data);
	}

	public function view($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Visualizar Pessoa", $this->anchor.'/view');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Titulo */
		$this->data['texto_view'] = 'Visualizar Pessoas';
		
		/* Load */
		$pessoas = R::load("pessoas", $id);

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");
		
		//Recebe os dados do Form
		$form = $this->form();
				
		$this->data = array_merge($this->data,$form);

		$this->data['id'] = array(
			'id' => $pessoas->id
		);

		$this->data['nome']['value'] 		= $pessoas->nome;
		$this->data['idade']['value'] 	    = $pessoas->idade;		
		$this->data['publicado']['checked'] = $pessoas->publicado?true:false;
		$this->data['publicado']['value'] 	= $pessoas->publicado?1:0;

		$this->data['nome']['readonly']     = 'readonly';
		$this->data['nome']['disabled']     = 'disabled';

		$this->data['idade']['readonly']    = 'readonly';
		$this->data['idade']['disabled']    = 'disabled';

		$this->data['publicado']['readonly']= 'readonly';
		$this->data['publicado']['disabled']= 'disabled';
									
		/* Load Template */
		$this->template->admin_render($this->anchor.'/view', $this->data);
	}

	function activate($id) {
		$id = (int) $id;
	
		$pessoas = R::load("pessoas", $id);

		$pessoas->publicado = TRUE;
		
		R::store($pessoas);
		
		$this->session->set_flashdata('message', "Pessoa Ativada");
		redirect($this->anchor, 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$pessoas = R::load("pessoas", $id);
		$pessoas->publicado = FALSE;
		
		R::store($pessoas);
		
		$this->session->set_flashdata('message', "Pessoa Desativada");
		redirect($this->anchor, 'refresh');
	}

	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('you are not logged');
		}

		if (!isset($id) || $id == null) {
			redirect($this->anchor, 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("pessoas", $id);
			R::trash($lixo);
        }
        
        $this->session->set_flashdata('message', "Pessoa Excluída");
		redirect($this->anchor, 'refresh');
	}
}
