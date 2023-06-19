<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class servidores extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Servidores");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

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
                  
                  $this->data['servidor']= R::findAll('servidores');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/servidores/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Servidor", 'admin/servidores/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Servidores';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("servidores");
			$resp->matricula        = strtoupper($this->input->post('matricula'));
            $resp->nome             = strtoupper($this->input->post('nome'));
            $resp->cpf              = strtoupper($this->input->post('cpf'));
            $resp->cidade_residencia= strtoupper($this->input->post('cidade_residencia'));
            $resp->telefone         = strtoupper($this->input->post('telefone'));
            $resp->endereco         = strtoupper($this->input->post('endereco'));
            $resp->dt_nascimento    = strtoupper($this->input->post('dt_nascimento'));
            $resp->sexo             = strtoupper($this->input->post('sexo'));
            $resp->email            = strtoupper($this->input->post('email'));
            $resp->ensino_medio     = strtoupper($this->input->post('ensino_medio'));
            $resp->ensino_superior  = strtoupper($this->input->post('ensino_superior'));
            $resp->especializacao   = strtoupper($this->input->post('especializacao'));
            $resp->pos              = strtoupper($this->input->post('pos'));
            $resp->nome_pos         = strtoupper($this->input->post('nome_pos'));
            $resp->area_concurso    = strtoupper($this->input->post('area_concurso'));
            $resp->ano_admissao     = strtoupper($this->input->post('ano_admissao'));
            $resp->regime           = strtoupper($this->input->post('regime'));
            $resp->id_user          = $this->session->user_id;
           // $resp->dt_alteracao     = strtoupper($this->input->post('dt_alteracao'));
            
                        
			R::store($resp);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/servidores', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");

                       $this->data['idescola'] = array(
                        'name'  => 'idescola',
                        'id'    => 'idescola',
                        'type'  => 'dropdown',
                        'options'  => $this->getescola(),
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('idescola'),
                    );
                      
                       $this->data['matricula'] = array(
                        'name'  => 'matricula',
                        'id'    => 'matricula',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('matricula'),
                        );
                       $this->data['nome'] = array(
                            'name'  => 'nome',
                            'id'    => 'nome',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('nome'),
                        );
                        $this->data['cpf'] = array(
                            'name'  => 'cpf',
                            'id'    => 'cpf',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('cpf'),
                        );
                        $this->data['cidade_residencia'] = array(
                            'name'  => 'cidade_residencia',
                            'id'    => 'cidade_residencia',
                            'type'  => 'text',
                            'options'  => $this->getcidade(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('cidade_residencia'),
                        );
                        $this->data['telefone'] = array(
                            'name'  => 'telefone',
                            'id'    => 'telefone',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('telefone'),
                        );
                        $this->data['endereco'] = array(
                            'name'  => 'endereco',
                            'id'    => 'endereco',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('endereco'),
                        );
                        $this->data['dt_nascimento'] = array(
                            'name'  => 'dt_nascimento',
                            'id'    => 'dt_nascimento',
                            'type'  => 'date',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('dt_nascimento'),
                        );
                        $this->data['sexo'] = array(
                            'name'  => 'sexo',
                            'id'    => 'sexo',
                            'type'  => 'int',
                            'options'  => $this->getsexo(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sexo'),
                        );
                        $this->data['email'] = array(
                            'name'  => 'email',
                            'id'    => 'email',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('email'),
                        );
                        
                        $this->data['ensino_medio'] = array(
                            'name'  => 'ensino_medio',
                            'id'    => 'ensino_medio',
                            'type'  => 'int',
                            'options'  => $this->getensinomedio(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('ensino_medio'),
                        );
                        $this->data['ensino_superior'] = array(
                            'name'  => 'ensino_superior',
                            'id'    => 'ensino_superior',
                            'type'  => 'int',
                            'options'  => $this->getensinosuperior(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('ensino_superior'),
                        );
                        $this->data['especializacao'] = array(
                            'name'  => 'especializacao',
                            'id'    => 'especializacao',
                            'type'  => 'dropdown',
                            'options'  => $this->getespecializacao(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('especializacao'),
                        );
                        $this->data['nome_pos'] = array(
                            'name'  => 'nome_pos',
                            'id'    => 'nome_pos',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('nome_pos'),
                        );
                        $this->data['area_concurso'] = array(
                            'name'  => 'area_concurso',
                            'id'    => 'area_concurso',
                            'type'  => 'int',
                            'options'  => $this->getareaconcurso(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('area_concurso'),
                        );
                        $this->data['ano_admissao'] = array(
                            'name'  => 'ano_admissao',
                            'id'    => 'ano_admissao',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('ano_admissao'),
                        );
                        $this->data['regime'] = array(
                            'name'  => 'regime',
                            'id'    => 'regime',
                            'type'  => 'int',
                            'options'  => $this->getregime(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('regime'),
                        );
                        
                    }
                    
			/* Load Template */
			$this->template->admin_render('admin/servidores/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/servidores', 'refresh');
		}

		$lixo = R::load("servidores", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/servidores', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Anos/Niveis", 'admin/servidores/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Anos/Niveis';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("servidores", $id);

            if ($this->form_validation->run()) {
                $resp->matricula    = strtoupper($this->input->post('matricula'));
                $resp->nome             = strtoupper($this->input->post('nome'));
                $resp->cpf              = strtoupper($this->input->post('cpf'));
                $resp->cidade           = strtoupper($this->input->post('cidade'));
                $resp->telefone         = strtoupper($this->input->post('telefone'));
                $resp->endereco         = strtoupper($this->input->post('endereco'));
                $resp->dt_nascimento    = strtoupper($this->input->post('dt_nascimento'));
                $resp->sexo             = strtoupper($this->input->post('sexo'));
                $resp->email            = strtoupper($this->input->post('email'));
                $resp->ensino_medio     = strtoupper($this->input->post('ensino_medio'));
                $resp->ensino_superior  = strtoupper($this->input->post('ensino_superior'));
                $resp->especializacao   = strtoupper($this->input->post('especializacao'));
                $resp->pos              = strtoupper($this->input->post('pos'));
                $resp->nome_pos          = strtoupper($this->input->post('nome_pos'));
                $resp->area_concurso    = strtoupper($this->input->post('area_concurso'));
                $resp->ano_admissao     = strtoupper($this->input->post('ano_admissao'));
                $resp->regime           = strtoupper($this->input->post('regime'));
               
                R::store($resp);

                redirect('admin/servidores', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $resp->id);
                
                $this->data['matricula'] = array(
                    'name'  => 'matricula',
                    'id'    => 'matricula',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('matricula'),
                    );
                   $this->data['nome'] = array(
                        'name'  => 'nome',
                        'id'    => 'nome',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('nome'),
                    );
                    $this->data['cpf'] = array(
                        'name'  => 'cpf',
                        'id'    => 'cpf',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('cpf'),
                    );
                    $this->data['cidade'] = array(
                        'name'  => 'cidade',
                        'id'    => 'cidade',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('cidade'),
                    );
                    $this->data['telefone'] = array(
                        'name'  => 'telefone',
                        'id'    => 'telefone',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('telefone'),
                    );
                    $this->data['endereco'] = array(
                        'name'  => 'endereco',
                        'id'    => 'endereco',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('endereco'),
                    );
                    $this->data['dt_nascimento'] = array(
                        'name'  => 'dt_nascimento',
                        'id'    => 'dt_nascimento',
                        'type'  => 'date',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('dt_nascimento'),
                    );
                    $this->data['sexo'] = array(
                        'name'  => 'sexo',
                        'id'    => 'sexo',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('sexo'),
                    );
                    $this->data['email'] = array(
                        'name'  => 'email',
                        'id'    => 'email',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('email'),
                    );
                    
                    $this->data['ensino_medio'] = array(
                        'name'  => 'ensino_medio',
                        'id'    => 'ensino_medio',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('ensino_medio'),
                    );
                    $this->data['ensino_superior'] = array(
                        'name'  => 'ensino_superior',
                        'id'    => 'ensino_superior',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('ensino_superior'),
                    );
                    $this->data['localizacao'] = array(
                        'name'  => 'localizacao',
                        'id'    => 'localizacao',
                        'type'  => 'dropdown',
                        'options'  => $this->getlocalizacao(),
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('localizacao'),
                    );
                    $this->data['pos'] = array(
                        'name'  => 'pos',
                        'id'    => 'pos',
                        'type'  => 'int',
                        //'options'  => $this->gettipo(),
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('pos'),
                    );
                    $this->data['nome_pos'] = array(
                        'name'  => 'nome_pos',
                        'id'    => 'nome_pos',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('nome_pos'),
                    );
                    $this->data['area_concurso'] = array(
                        'name'  => 'area_concurso',
                        'id'    => 'area_concurso',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('area_concurso'),
                    );
                    $this->data['ano_admissao'] = array(
                        'name'  => 'ano_admissao',
                        'id'    => 'ano_admissao',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('ano_admissao'),
                    );
                    $this->data['regime'] = array(
                        'name'  => 'regime',
                        'id'    => 'regime',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('regime'),
                    );

                  }

                /* Load Template */
                $this->template->admin_render('admin/servidores/edit', $this->data);
    }
    //--Gets-----------------------------------
    private function getespecializacao() {
		$teste = R::findAll("especializacao");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function gettipos() {
		$teste = R::findAll("tipos");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getescola() {
		$teste = R::findAll("escolas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
    private function getcidade() {
		$teste = R::findAll("cidade", "order by descricao desc");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getsexo() {
		$teste = R::findAll("sexo");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getensinomedio() {
		$teste = R::findAll("ensinomedio");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getensinosuperior() {
		$teste = R::findAll("ensinosuperior");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getareaconcurso() {
		$teste = R::findAll("areaconcurso");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getregime() {
		$teste = R::findAll("regime");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}

    //--

}//fim classe
