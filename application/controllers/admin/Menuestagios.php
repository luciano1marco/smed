<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuestagios extends Admin_Controller {

	public function __construct(){
		parent::__construct();

		/* Title Page :: Common */
		$this->page_title->push("Menu Estagios");
		$this->data['pagetitle'] = $this->page_title->show();

		/* Anchor */
		$this->anchor = 'admin/'.$this->router->class;

		/* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		$this->fa_icons = getFontAwesomeIcons();

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, "Itens de Menu de Estagios", 'admin/menuestagios');
	}
	public function index()	{

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			$this->data['menuestagio'] = R::findAll('menuestagio');
			
			/* Load Template */
			$this->template->admin_render('admin/menuestagios/index', $this->data);
		}
	}
	public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Novo Menu de Estagios', 'admin/menuestagios/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('controller', 'Controlador', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$menuestagio = R::dispense("menuestagio");
			$menuestagio->descricao 	= $this->input->post("descricao");
			$menuestagio->controller 	= $this->input->post("controller");
			$menuestagio->publicado 	= !empty($this->input->post("publicado"))?1:0;
			
			R::store($menuestagio);

			$this->session->set_flashdata('message', 'Item de Menu de Estagio criado');
						
			redirect('admin/menuestagios', 'refresh');
		} 
		else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('descricao'),
			);

			$this->data['controller'] = array(
				'name'  => 'controller',
				'id'    => 'controller',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('controller'),
			);

			
			$this->data['publicado'] = array(
				'name' 				=> 'publicado',
				'id'    			=> 'publicado',
				'class' 			=> 'icheck',
				'type'  			=> 'checkbox',
				'value' 			=> 1,
				'checked' 			=> $this->form_validation->set_value('publicado', 1),
				'style' 			=> 'margin-top:10px'
			);

					
			/* Load Template */
			$this->template->admin_render('admin/menuestagios/create', $this->data);
		}
	}
	public function edit($id) {
		$id = (int) $id;

		$this->data['id'] = $id;

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Novo Item de Menu Estagios', 'admin/menuestagios/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('controller', 'Controlador', 'required');

		$menuitem = R::load("menuestagio", $id);
		if ($this->form_validation->run() == TRUE) {
			
			$menuitem->descricao = $this->input->post("descricao");
			$menuitem->controller = $this->input->post("controller");
			//$menuitem->icone = "fa fa-user";

			R::store($menuitem);
	

			redirect('admin/menuestagios', 'refresh');
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['descricao'] = array(
				'name'  => 'descricao',
				'id'    => 'descricao',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('descricao', $menuitem->descricao),
			);

			$this->data['controller'] = array(
				'name'  => 'controller',
				'id'    => 'controller',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('controller', $menuitem->controller),
			);

			$this->data['publicado'] = array(
				'name' 				=> 'publicado',
				'id'    			=> 'publicado',
				'class' 			=> 'icheck',
				'type'  			=> 'checkbox',
				'value' 			=> $this->form_validation->set_value('publicado', $menuitem->publicado?1:0),
				'checked' 			=> $this->form_validation->set_value('publicado', 1),
				'style' 			=> 'margin-top:10px'
			);

			$this->data['groups'] = R::findAll("groups");
			$this->data['currentGroups'] = R::findAll("menugroups", "menu = {$id}");
			
			/* Load Template */
			$this->template->admin_render('admin/menuestagios/edit', $this->data);
		}
	}
	public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/menuestagios', 'refresh');
		}

		$lixo = R::load("menuestagio", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item de Menu removido");

		redirect('admin/menuestagios', 'refresh');
	}
	public function profile($id){
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/menuestagios/profile');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Data */
		$id = (int) $id;

		/* Variables */
		$groups = $this->ion_auth->group($id)->row();
	
		/* Data */
		$this->data['menuestagio'] = R::load("menuestagio", $id);
	
		/* Load Template */
		$this->template->admin_render('admin/menuestagios/profile', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$menuestagio = R::load("menuestagio", $id);

		$menuestagio->publicado = 1;
		
		R::store($menuestagio);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/menuestagios', 'refresh');
	}
	public function deactivate($id) {
		$id = (int) $id;

		$menuitens = R::load("menuestagios", $id);
		$menuitens->publicado = 0;
		
		R::store($menuitens);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/menuestagios', 'refresh');
	}
	//--Aexar Arquivos-------------------------------- 
	public function arquivos($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Arquivos do Menu", 'admin/menuestagios/');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		//$ae = R::findAll("arquivosetapas", "etapa = {$id}");
		$sql ="	SELECT *
				FROM arquivosestagio 
				where idmenu =".$id;

		$this->data['menuestagio'] = R::load("menuestagio", $id);
		//$this->data['arquivos'] = $ae;
		$this->data['arquivos'] = R::getAll($sql);
		
		/* Load Template */
		$this->template->admin_render('/admin/menuestagios/arquivos', $this->data);
	}    
	public function uploadestagio($id) {
		$nomesarquivos = $_FILES['arquivos']['name'];
		

		for ($i=0; $i<count($nomesarquivos); $i++) {
			$_FILES['arquivo']['name'] = $_FILES['arquivos']['name'][$i];
			$_FILES['arquivo']['type'] = $_FILES['arquivos']['type'][$i];
			$_FILES['arquivo']['tmp_name'] = $_FILES['arquivos']['tmp_name'][$i];
			$_FILES['arquivo']['error'] = $_FILES['arquivos']['error'][$i];
			$_FILES['arquivo']['size'] = $_FILES['arquivos']['size'][$i];

			if (!is_dir("upload/arquivos/estagio-".$id)) {                                 
				mkdir("upload/arquivos/estagio-".$id);
			}                        
			$config['upload_path'] = "upload/arquivos/estagio-".$id;
			$config['allowed_types'] = '*';
			$config['max_size'] = 10240;
			$config['file_name'] = $_FILES['arquivos']['name'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("arquivo")) {
				$datafile = $this->upload->data();
				
				$ae = R::dispense("arquivosestagio");
				$ae->idmenu = $id;
				$ae->arquivo = $datafile["file_name"];
				$nome = explode(".",$ae->arquivo);
				$ae->arquivo = $nome[0];
			
				$ae->caminho = $datafile["full_path"];
				R::store($ae);
			}
		}

		redirect('admin/menuestagios/arquivos/'.$id, 'refresh');
	}  
	//-----Deletar arquivos-----------------------------
 	public function apagararquivoestagio($id) {
	
		$ae = R::load("arquivosestagio", $id);
		$estagio = R::load("menuestagios", $ae->idmenu);//para fazer o refresh

		R::trash($ae);

		redirect('admin/menuestagios/arquivos/' .$ae->idmenu, 'refresh');
	}

}//fim da class