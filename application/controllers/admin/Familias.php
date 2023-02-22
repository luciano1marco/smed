<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class familias extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('Familias'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');

        /* Breadcrumbs :: Common */
       // $this->breadcrumbs->unshift(1, 'apoiador', 'admin/apoiador');
    }
	///-----cruds--------------------------------
	public function index($id)	{ 
		
		 
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
			$sql1 = "SELECT nome,id FROM pessoas where id = ".$id;
			$this->data['socio'] = R::getAll($sql1);
           
		    $sql = "SELECT 	f.id,
							f.id_socio, 
							f.id_grau,
							f.nome as parente,
							p.nome as socio,
							g.descricao
					FROM `familias` as f
			
					inner join pessoas as p
					on f.id_socio = p.id
					
					inner join grau as g
					on g.id = f.id_grau
					
					where f.id_socio = ".$id;
			
			$this->data['familia'] = R::getAll($sql);
           
			$sql2="SELECT 	m.id,
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
																			
					where id_socio = ".$id;
			$this->data['mensalida'] = R::getAll($sql2);
			
			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Adicionar Parente';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create($id) {

		$id = (int) $id;
		
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Parente", 'admin/familias/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Adicionar Parente';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$familia = R::dispense("familias");
            $familia->nome = $this->input->post('nome');
            $familia->email = $this->input->post('email');
            $familia->telefone = $this->input->post('telefone');
			$familia->cpf = $this->input->post('cpf');
			$familia->id_grau = $this->input->post('id_grau');
            $familia->data_nasc = $this->input->post('data_nasc');
			$familia->id_socio = $id;
			
			R::store($familia);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/familias/index/'.$id, 'refresh');
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
			$this->data['id_grau'] = array(
                'name'  => 'id_grau',
                'id'    => 'id_grau',
                'options' => $this->getgrau(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('id_grau'),
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
        $this->template->admin_render('admin/familias/create', $this->data);
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
		$this->breadcrumbs->unshift(2, "Editar Parente", 'admin/familias/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Parente';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$familia = R::load("familias", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$familia->nome = $this->input->post('nome');
				$familia->email = $this->input->post('email');
				$familia->telefone = $this->input->post('telefone');
				$familia->id_grau = $this->input->post('id_grau');
				$familia->cpf = $this->input->post('cpf');
				$familia->id_socio = $this->input->post('id_socio');
				$familia->data_nasc = $this->input->post('data_nasc');
				
				R::store($familia);

				redirect('admin/familias/index/'.$familia->id_socio, 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $familia->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $familia->nome,
		);

        $this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $familia->email,
        );
        
        $this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefone',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $familia->telefone,
		);
		$this->data['cpf'] = array(
			'name'  => 'cpf',
			'id'    => 'cpf',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $familia->cpf,
		);
		$this->data['id_grau'] = array(
			'name'  => 'id_grau',
			'id'    => 'id_grau',
			'selected'=>$familia->id_grau,
			'options' => $this->getgrau(),
			'class' => 'form-control',
			'value' => $familia->id_grau,
		);
		$this->data['id_socio'] = array(
			'name'  => 'id_socio',
			'id'    => 'id_socio',
			'selected'=>$familia->id_socio,
			'options' => $this->getsocio(),
			'class' => 'form-control',
			'value' => $familia->id_socio,
		);
		$this->data['data_nasc'] = array(
			'name'  => 'data_nasc',
			'id'    => 'data_nasc',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $familia->data_nasc,
		);

		/* Load Template */
		$this->template->admin_render('admin/familias/edit', $this->data);
	}
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//---busca o id socio do parente
		$fam = R::load("familias", $id);
		$id_socio = $fam->id_socio;
		 
		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/familias', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("familias", $id);
			R::trash($lixo);
		}
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----ativado ou desativado-----------------
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("familias", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("familias", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias', 'refresh');
	}

	//---gets-------------------------------------
	public function getgrau(){
        $sql = "SELECT * FROM grau ";
		
        $options = array("0" => "Selecione Grau de Parentesco");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['descricao'];           
        }
		return $options;
    }
	
	public function getsocio(){
        $sql = "SELECT * FROM pessoas";

        $options = array("0" => "Selecione Sócio");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['nome'];           
        }
		return $options;
    }
	public function getmes(){
        $sql = "SELECT * FROM meses ";
		
        $options = array("0" => "Selecione Mes");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['descricao'];           
        }
		return $options;
    }

     //----ativado ou desativado-----------------

	//----janeiro------------------
	function active_jan($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->janeiro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_jan($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->janeiro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----fevereiro------------------
	function active_fev($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->fevereiro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_fev($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->fevereiro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----marco------------------
	function active_mar($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->marco = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_mar($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->marco = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	//----abril------------------
	function active_abr($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->abril = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_abr($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->abril = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----maio------------------
	function active_mai($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->maio = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_mai($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->maio = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----junho------------------
	function active_jun($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->junho = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_jun($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->junho = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----julho------------------
	function active_jul($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->julho = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_jul($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->julho = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----agosto------------------
	function active_ago($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->agosto = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_ago($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->agosto = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	//----setembro------------------
	function active_set($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->setembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_set($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->setembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----outubro------------------
	function active_out($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->outubro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_out($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->outubro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----novembro------------------
	function active_nov($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->novembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_nov($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->novembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}
	//----dezembro------------------
	function active_dez($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->dezembro = 1;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

	public function desactive_dez($id,$id_socio) {
		$id = (int) $id;
		$item = R::load("mensalidades", $id);
		$item->dezembro = 0;
		R::store($item);
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/familias/index/'.$id_socio, 'refresh');
	}

}
