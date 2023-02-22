<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mensalidades extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('Mensalidades'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');

        /* Breadcrumbs :: Common */
       // $this->breadcrumbs->unshift(1, 'apoiador', 'admin/apoiador');
    }
	///-----cruds--------------------------------
	public function index()	{ 
		
		 
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
			
			$sql="SELECT 	m.id,
							m.id_socio, 
							p.nome as socio,
							m.valor,
							m.ano,
							m.janeiro,
							m.fevereiro,
							m.marco,
							m.abril,
							m.maio,
							m.junho,
							m.julho,
							m.agosto,
							m.setembro,
							m.outubro,
							m.novembro,
							m.dezembro
					FROM `mensalidades` as m

					inner join pessoas as p
					on m.id_socio = p.id
																			
					";	

			$this->data['mensalidade'] = R::getAll($sql);
            
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Pagamento';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Pagamento", 'admin/mensalidades/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Pagamento';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('ano', 'ano', 'required');
		$this->form_validation->set_rules('valor', 'valor', 'required');
		$this->form_validation->set_rules('id_socio', 'socio', 'required');
		
		/* cria a tabela com seus campos */
			if ($this->form_validation->run() ) {
					$mensal = R::dispense("mensalidades");
					$mensal->id_socio = $this->input->post('id_socio');
					$mensal->ano = $this->input->post('ano');
					$mensal->valor = $this->input->post('valor');

					R::store($mensal);

					$this->session->set_flashdata('message', "Dados gravados");
					redirect('admin/mensalidades/', 'refresh');
			} 
			else {
				$this->data['message'] = (validation_errors() ? validation_errors() : "");

				$this->data['id_socio'] = array(
					'name'  => 'id_socio',
					'id'    => 'id_socio',
					'options' => $this->getsocio(),
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('id_socio'),
				);
				
				$this->data['ano'] = array(
					'name'  => 'ano',
					'id'    => 'ano',
					'type'  => 'int',
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('ano'),
				);
				
				$this->data['valor'] = array(
					'name'  => 'valor',
					'id'    => 'valor',
					'type'  => 'int',
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('valor'),
				);
				
			} 
		
				
        /* Load Template */
        $this->template->admin_render('admin/mensalidades/create', $this->data);
    }
	
	public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else{ 
			
			/* -- Breadcrumbs ----------------------------------------------------*/
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->anchor = 'admin/' . $this->router->class;
			/* -- Data -----------------------------------------------------------*/
            $this->data['error'] = NULL;

			$sql1 = "SELECT 
						f.id, 
						f.id_socio,
						f.id_grau,
						f.email,
						f.telefone,
						f.nome,
						f.cpf,
						f.data_nasc,
						g.descricao as nomegrau,
						p.nome as socio
				FROM familias as f
				
				inner join grau as g
				on f.id_grau = g.id
				
				inner join pessoas as p
				on p.id = f.id_socio
				
				where f.id = ".$id;

			$this->data['parente'] = R::getAll($sql1);

						
		/*--Load Template ---------------------------------------------------------*/
        	$this->template->admin_render('admin/familias/view', $this->data);
           }
	}    

	public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Parente", 'admin/mensalidades/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Pagamento';
		/* Validate form input */
		$this->form_validation->set_rules('id_socio', 'id_socio', 'required');
		
		$mensal = R::load("mensalidades", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$mensal->id_socio = $this->input->post('id_socio');
				$mensal->ano = $this->input->post('ano');
				$mensal->valor = $this->input->post('valor');
				R::store($mensal);

				redirect('admin/mensalidades/index/'.$familia->id_socio, 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $mensal->id,
		);

		$this->data['id_socio'] = array(
			'name'  => 'id_socio',
			'id'    => 'id_socio',
			'selected'=>$mensal->id_socio,
			'options' => $this->getsocio(),
			'class' => 'form-control',
			'value' => $mensal->id_socio,
		);
        
        $this->data['ano'] = array(
			'name'  => 'ano',
			'id'    => 'ano',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $mensal->ano,
		);
		
		$this->data['valor'] = array(
			'name'  => 'valor',
			'id'    => 'valor',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $mensal->valor,
		);
		

		/* Load Template */
		$this->template->admin_render('admin/mensalidades/edit', $this->data);
	}
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//---busca o id socio do parente
		$fam = R::load("mensalidades", $id);
				 
		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/mensalidades', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("mensalidades", $id);
			R::trash($lixo);
		}
		redirect('admin/mensalidades/', 'refresh');
	}
	//----ativado ou desativado-----------------

	//----janeiro------------------
	function active_jan($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->janeiro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_jan($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->janeiro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----fevereiro------------------
	function active_fev($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->fevereiro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_fev($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->fevereiro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----marco------------------
	function active_mar($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->marco = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_mar($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->marco = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}

	//----abril------------------
	function active_abr($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->abril = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_abr($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->abril = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----maio------------------
	function active_mai($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->maio = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_mai($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->maio = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----junho------------------
	function active_jun($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->junho = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_jun($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->junho = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----julho------------------
	function active_jul($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->julho = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_jul($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->julho = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----agosto------------------
	function active_ago($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->agosto = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_ago($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->agosto = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}

	//----setembro------------------
	function active_set($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->setembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_set($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->setembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----outubro------------------
	function active_out($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->outubro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_out($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->outubro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----novembro------------------
	function active_nov($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->novembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_nov($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->novembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//----dezembro------------------
	function active_dez($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->dezembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/mensalidades', 'refresh');
	}

	public function desactive_dez($id) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->dezembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/mensalidades', 'refresh');
	}
	//---gets-------------------------------------
	public function getsocio(){
        $sql = "SELECT * FROM pessoas";

        $options = array("0" => "Selecione Sócio");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['nome'];           
        }
		return $options;
    }
	
}
