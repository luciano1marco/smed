<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class escolas extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Escolas");
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
                  //mostra todas escolas
                  $this->data['escolas']= R::findAll('escolas');  
                //--vagas na escola
                   $sqlv = "SELECT sum(capacidade_p - matriculas) as vagas
                            from turmas 
                            ";
                    $this->data['vagas']= R::getAll($sqlv);  
                   /* Load Template */
                   $this->template->admin_render('admin/escolas/index', $this->data);
                }
	}
    public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else
            { /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                /* Data */
                $this->data['error'] = NULL;
                
                //$this->data['escolas']= R::findAll('escolas','id='.$id);   
                //--chama do banco a tabela escolas 
                $sqlesc = "SELECT   e.id,e.nome, e.endereco,e.complemento,e.bairro,e.cep,e.telefone,e.fax,e.localizacao,e.tipo,e.pagina,e.email,e.nis,e.diretor,e.alunos,e.series,e.participa,e.dt_cad,
                                    l.descricao as deslocalizacao,
                                    t.descricao as destipos,
                                    p.descricao as desparticipa,
                                    d.descricao as desdiretor
                                    
                            FROM escolas as e
                            
                            inner join localizacao as l
                            on l.id = e.localizacao
                            
                            inner join tipos as t
                            on t.id = e.tipo
                            
                            inner join participa as p
                            on p.id = e.participa
                            
                            inner join diretor as d
                            on d.id = e.diretor
                            
                            where e.id = " .$id ;
                $this->data['escolas']= R::getAll($sqlesc); 
                
                //--chama do banco a tabela escola_estrutura
                $sql="SELECT *
                        from escolasestrutura as ee 
                            where ee.escolaid =".$id;

                $this->data['escolasestrutura']= R::getAll($sql); 
                
                 //--chama do banco a tabela escola_series
                $sql1=" SELECT * FROM escolasseries as es

                            inner join series as s
                            on s.id = es.id_serie
                                                    
                            where es.id_escola = ".$id;

                $this->data['escolasseries']= R::getAll($sql1); 
               // var_dump($this->data['vagas']);die;
                  /* Load Template */
               $this->template->admin_render('admin/escolas/view', $this->data);
            }
    }
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova Escola", 'admin/escolas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Escola';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("escolas");
			$resp->nome         = strtoupper($this->input->post('nome'));
            $resp->endereco     = strtoupper($this->input->post('endereco'));
            $resp->complemento  = strtoupper($this->input->post('complemento'));
            $resp->bairro       = strtoupper($this->input->post('bairro'));
            $resp->cep          = strtoupper($this->input->post('cep'));
            $resp->telefone     = strtoupper($this->input->post('telefone'));
            $resp->fax          = strtoupper($this->input->post('fax'));
            $resp->localizacao  = strtoupper($this->input->post('localizacao'));
            $resp->tipo         = strtoupper($this->input->post('tipo'));
            $resp->pagina       = strtoupper($this->input->post('pagina'));
            $resp->email        = strtoupper($this->input->post('email'));
            $resp->nis          = strtoupper($this->input->post('nis'));
            $resp->diretor      = strtoupper($this->input->post('diretor'));
            $resp->alunos       = strtoupper($this->input->post('alunos'));
            $resp->series       = strtoupper($this->input->post('series'));
            $resp->participa    = strtoupper($this->input->post('participa'));
          	R::store($resp);

            $this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/escolas', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");
                    //----escola--------
                       
                       $this->data['nome'] = array(
                            'name'  => 'nome',
                            'id'    => 'nome',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('nome'),
                        );
                        $this->data['endereco'] = array(
                            'name'  => 'endereco',
                            'id'    => 'endereco',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('endereco'),
                        );
                        $this->data['complemento'] = array(
                            'name'  => 'complemento',
                            'id'    => 'complemento',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('complemento'),
                        );
                        $this->data['bairro'] = array(
                            'name'  => 'bairro',
                            'id'    => 'bairro',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('bairro'),
                        );
                        $this->data['cep'] = array(
                            'name'  => 'cep',
                            'id'    => 'cep',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('cep'),
                        );
                        $this->data['telefone'] = array(
                            'name'  => 'telefone',
                            'id'    => 'telefone',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('telefone'),
                        );
                        $this->data['fax'] = array(
                            'name'  => 'fax',
                            'id'    => 'fax',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('fax'),
                        );
                       
                        $this->data['localizacao'] = array(
                            'name'  => 'localizacao',
                            'id'    => 'localizacao',
                            'type'  => 'int',
                            'options'  => $this->getlocalizacao(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('localizacao'),
                        );
                        $this->data['tipo'] = array(
                            'name'  => 'tipo',
                            'id'    => 'tipo',
                            'type'  => 'text',
                            'options'  => $this->gettipo(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('tipo'),
                        );
                        $this->data['pagina'] = array(
                            'name'  => 'pagina',
                            'id'    => 'pagina',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('pagina'),
                        );
                        $this->data['email'] = array(
                            'name'  => 'email',
                            'id'    => 'email',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('email'),
                        );
                        $this->data['nis'] = array(
                            'name'  => 'nis',
                            'id'    => 'nis',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('nis'),
                        );
                        $this->data['diretor'] = array(
                            'name'  => 'diretor',
                            'id'    => 'diretor',
                            'type'  => 'dropdown',
                            'options'  => $this->getdiretor(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('diretor'),
                        );
                        $this->data['alunos'] = array(
                            'name'  => 'alunos',
                            'id'    => 'alunos',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('alunos'),
                        );
                        $this->data['series'] = array(
                            'name'  => 'series',
                            'id'    => 'series',
                            'type'  => 'text',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('series'),
                        );
                        $this->data['participa'] = array(
                            'name'  => 'participa',
                            'id'    => 'participa',
                            'type'  => 'text',
                            'options'  => $this->getparticipa(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('participa'),
                        );
                                               
                    }
                    
			/* Load Template */
			$this->template->admin_render('admin/escolas/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/escolas', 'refresh');
		}

		$lixo = R::load("escolas", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/escolas', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Anos/Niveis", 'admin/escolas/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Anos/Niveis';
            /* Validate form input */
            $this->form_validation->set_rules('nome', 'nome', 'required');
            
            $resp = R::load("escolas", $id);
            if ($this->form_validation->run()) {
                $resp->nome        = strtoupper($this->input->post('nome'));
                $resp->endereco    = strtoupper($this->input->post('endereco'));
                $resp->complemento = strtoupper($this->input->post('complemento'));
                $resp->bairro      = strtoupper($this->input->post('bairro'));
                $resp->cep         = strtoupper($this->input->post('cep'));
                $resp->telefone    = strtoupper($this->input->post('telefone'));
                $resp->fax         = strtoupper($this->input->post('fax'));
                $resp->localizacao = strtoupper($this->input->post('localizacao'));
                $resp->tipo        = strtoupper($this->input->post('tipo'));
                $resp->pagina      = strtoupper($this->input->post('pagina'));
                $resp->email       = strtoupper($this->input->post('email'));
                $resp->nis         = strtoupper($this->input->post('nis'));
                $resp->diretor     = strtoupper($this->input->post('diretor'));
                $resp->alunos      = strtoupper($this->input->post('alunos'));
                $resp->participa   = strtoupper($this->input->post('participa'));
                
                R::store($resp);

                redirect('admin/escolas', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $resp->id);
                
                    $this->data['nome'] = array(
                        'name'  => 'nome',
                        'id'    => 'nome',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->nome,
                    );
                    $this->data['endereco'] = array(
                        'name'  => 'endereco',
                        'id'    => 'endereco',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->endereco,
                    );
                    $this->data['complemento'] = array(
                        'name'  => 'complemento',
                        'id'    => 'complemento',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->complemento,
                    );
                    $this->data['bairro'] = array(
                        'name'  => 'bairro',
                        'id'    => 'bairro',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->bairro,
                    );
                    $this->data['cep'] = array(
                        'name'  => 'cep',
                        'id'    => 'cep',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->cep,
                    );
                    $this->data['telefone'] = array(
                        'name'  => 'telefone',
                        'id'    => 'telefone',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->telefone,
                    );
                    $this->data['fax'] = array(
                        'name'  => 'fax',
                        'id'    => 'fax',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->fax,
                    );
                    $this->data['localizacao'] = array(
                        'name'  => 'localizacao',
                        'id'    => 'localizacao',
                        'type'  => 'text',
                        'class' => 'form-control',
                        //'value' => $resp->localizacao,
                        'options' => $this->getlocalizacao(),
			            'selected' => $resp->localizacao,
                    );
                    $this->data['tipo'] = array(
                        'name'  => 'tipo',
                        'id'    => 'tipo',
                        'type'  => 'text',
                        'class' => 'form-control',
                        //'value' => $resp->tipo,
                        'options' => $this->gettipo(),
			            'selected' => $resp->tipo,
                    );
                    $this->data['pagina'] = array(
                        'name'  => 'pagina',
                        'id'    => 'pagina',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->pagina,
                    );
                    $this->data['email'] = array(
                        'name'  => 'email',
                        'id'    => 'email',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->email,
                    );
                    $this->data['nis'] = array(
                        'name'  => 'nis',
                        'id'    => 'nis',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->nis,
                    );
                    $this->data['diretor'] = array(
                        'name'  => 'diretor',
                        'id'    => 'diretor',
                        'type'  => 'text',
                        'class' => 'form-control',
                        //'value' => $resp->diretor,
                        'options' => $this->getdiretor(),
			            'selected' => $resp->diretor,
                    );
                    $this->data['alunos'] = array(
                        'name'  => 'alunos',
                        'id'    => 'alunos',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->alunos,
                    );
                    
                    $this->data['participa'] = array(
                        'name'  => 'participa',
                        'id'    => 'participa',
                        'type'  => 'text',
                        'class' => 'form-control',
                        //'value' => $resp->participa,
                        'options' => $this->getparticipa(),
			            'selected' => $resp->participa,
                    );

                  }

                /* Load Template */
                $this->template->admin_render('admin/escolas/edit', $this->data);
    }
   
    //--Gets-----------------------------------
    private function getlocalizacao() {
		$teste = R::findAll("localizacao");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function gettipo() {
		$teste = R::findAll("tipos");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getdiretor() {

        $teste = R::findAll("diretor");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getparticipa() {

        $teste = R::findAll("participa");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
   
    //--

}//fim classe
