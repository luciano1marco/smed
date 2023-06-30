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
    public function index($id){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                 
                  //$this->data['servidor']= R::findAll('servidores');   
                  $sql="SELECT 	m.descricao as Matricula , 
                                ss.nome as nome,
                                ss.telefone,
                                ss.email,
                                ss.id
          
                        FROM servidores as ss
                        
                        inner join servidorescola as sse
                        on ss.id = sse.idservidor 
                        
                        inner join matricula as m
                        on m.idservidor = ss.id
                        
                        where sse.escola_id =".$id."
                        GROUP BY ss.nome";
                 
                 
                  $this->data['servidor']= R::getAll($sql); 
                 
                    /* Load Template */
                   $this->template->admin_render('admin/servidores/index', $this->data);
                }

         
	}
    public function viewservidor($id){

       

        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else
            { /* Breadcrumbs */
              $this->data['breadcrumb'] = $this->breadcrumbs->show();
              /* Data */
              $this->data['error'] = NULL;
             
              //$this->data['servidor']= R::findAll('servidores');   
              $sql="    SELECT id,nome,telefone,email 
                        from servidores as ss
                        
                        inner join servidorescola as sse
                        on ss.id = sse.idservidor 

                        inner join matricula as m
                        on m.idservidor = ss.id

                        where sse.escola_id =".$id."
                        GROUP BY ss.nome ";
              $this->data['servidor']= R::getAll($sql); 
                    
             
               /* Load Template */
               $this->template->admin_render('admin/servidores/index', $this->data);
            }

     
}
    public function getServidores() {     
		/* POST data */
		$postData = $this->input->post();
   
		/* Get data */
		$data = $this->servidores_model->getServidores($postData);
   
		$resp = json_encode($data);
		
		echo $resp;		
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
            $resp->graduacao        = strtoupper($this->input->post('graduacao'));
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
                            'options'  => $this->getcidade(),
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
                        $this->data['graduacao'] = array(
                            'name'  => 'graduacao',
                            'id'    => 'graduacao',
                            'type'  => 'dropdown',
                            'options'  => $this->getpos(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('graduacao'),
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
            $this->breadcrumbs->unshift(2, "Servidor", 'admin/servidores/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Servidor';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("servidores", $id);

            if ($this->form_validation->run()) {
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
                $resp->graduacao        = strtoupper($this->input->post('graduacao'));
                $resp->pos              = strtoupper($this->input->post('pos'));
                $resp->nome_pos         = strtoupper($this->input->post('nome_pos'));
                $resp->area_concurso    = strtoupper($this->input->post('area_concurso'));
                $resp->ano_admissao     = strtoupper($this->input->post('ano_admissao'));
                $resp->regime           = strtoupper($this->input->post('regime'));
               
                R::store($resp);

                redirect('admin/servidores', 'refresh');
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
                    $this->data['cpf'] = array(
                        'name'  => 'cpf',
                        'id'    => 'cpf',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->cpf,
                    );
                    $this->data['cidade'] = array(
                        'name'  => 'cidade',
                        'id'    => 'cidade',
                        'type'  => 'text',
                        'options'  => $this->getcidade(),
                        'class' => 'form-control',
                        'selected'=> $resp->cidade,
                        'value' => $resp->cidade,
                    );
                    $this->data['telefone'] = array(
                        'name'  => 'telefone',
                        'id'    => 'telefone',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->telefone,
                    );
                    $this->data['endereco'] = array(
                        'name'  => 'endereco',
                        'id'    => 'endereco',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->endereco,
                    );
                    $this->data['dt_nascimento'] = array(
                        'name'  => 'dt_nascimento',
                        'id'    => 'dt_nascimento',
                        'type'  => 'date',
                        'class' => 'form-control',
                        'value' => $resp->dt_nascimento,
                    );
                    $this->data['sexo'] = array(
                        'name'  => 'sexo',
                        'id'    => 'sexo',
                        'type'  => 'int',
                        'options'  => $this->getsexo(),
                        'class' => 'form-control',
                        'selected'=> $resp->sexo,
                        'value' => $resp->sexo,
                    );
                    $this->data['email'] = array(
                        'name'  => 'email',
                        'id'    => 'email',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->email,
                    );
                    $this->data['ensino_medio'] = array(
                        'name'  => 'ensino_medio',
                        'id'    => 'ensino_medio',
                        'type'  => 'int',
                        'options'  => $this->getensinomedio(),
                        'class' => 'form-control',
                        'selected'=> $resp->ensino_medio,
                        'value' => $resp->ensino_medio,
                    );
                    $this->data['ensino_superior'] = array(
                        'name'  => 'ensino_superior',
                        'id'    => 'ensino_superior',
                        'type'  => 'int',
                        'options'  => $this->getensinosuperior(),
                        'class' => 'form-control',
                        'selected'=> $resp->ensino_superior,
                        'value' => $resp->ensino_superior,
                    );
                    $this->data['localizacao'] = array(
                        'name'  => 'localizacao',
                        'id'    => 'localizacao',
                        'type'  => 'dropdown',
                        'options'  => $this->getlocalizacao(),
                        'class' => 'form-control',
                        'selected'=> $resp->localizacao,
                        'value' => $resp->localizacao,
                    );
                    $this->data['graduacao'] = array(
                        'name'  => 'graduacao',
                        'id'    => 'graduacao',
                        'type'  => 'int',
                        'options'  => $this->getpos(),
                        'class' => 'form-control',
                        'selected'=> $resp->graduacao,
                        'value' => $resp->graduacao,
                    );
                    $this->data['nome_pos'] = array(
                        'name'  => 'nome_pos',
                        'id'    => 'nome_pos',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->nome_pos,
                    );
                    $this->data['area_concurso'] = array(
                        'name'  => 'area_concurso',
                        'id'    => 'area_concurso',
                        'type'  => 'int',
                        'options'  => $this->getareaconcurso(),
                        'class' => 'form-control',
                        'selected'=> $resp->area_concurso,
                        'value' => $resp->area_concurso,
                    );
                    $this->data['ano_admissao'] = array(
                        'name'  => 'ano_admissao',
                        'id'    => 'ano_admissao',
                        'type'  => 'int',
                        'class' => 'form-control',
                        'value' => $resp->ano_admissao,
                    );
                    $this->data['regime'] = array(
                        'name'  => 'regime',
                        'id'    => 'regime',
                        'type'  => 'int',
                        'options'  => $this->getregime(),
                        'class' => 'form-control',
                        'selected'=> $resp->regime,
                        'value' => $resp->regime,
                    );

                  }

                /* Load Template */
                $this->template->admin_render('admin/servidores/edit', $this->data);
    }
    public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else
            { /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                /* Data */
                $this->data['error'] = NULL;
                
                //--chama do banco a tabela servidores 
                $sqlser = "SELECT 		s.id,s.nome,s.cpf,s.cidade,s.telefone,s.endereco,s.dt_nascimento,
                                        s.sexo,s.email,s.ensino_medio,s.ensino_superior,s.graduacao,s.nome_pos,
                                        s.area_concurso,s.ano_de_admissao,s.regime_trabalho,s.id_quem_cadastrou,s.data_ultima_alteracao,
                                        c.descricao as desccidade,
                                        se.descricao as descsexo,
                                        em.descricao as descensinomedio,
                                        es.descricao as descensinosuperior,
                                        g.descricao as descgraduacao,
                                        ac.descricao as descareaconcurso,
                                        r.descricao as descregime
                
                            FROM servidores as s
                            
                            inner join cidade as c
                            on s.cidade = c.id
                            
                            inner join sexo as se
                            on s.sexo = se.id
                            
                            inner join ensinomedio as em
                            on s.ensino_medio = em.id
                            
                            inner join ensinosuperior as es
                            on s.ensino_superior = es.id
                            
                            inner join posgraduacao as g
                            on s.graduacao = g.id
                            
                            inner join areaconcurso as ac
                            on s.area_concurso = ac.id
                            
                            inner join regime as r
                            on s.regime_trabalho = r.id
                            
                            where s.id = " .$id ;
                
                $this->data['servidor']= R::getAll($sqlser); 
                
                //--chama do banco a tabela matriculas do servidor
                $sqlma="SELECT * from matricula 
                            where idservidor =".$id;

                $this->data['matricula']= R::getAll($sqlma); 
                
                //--chama do banco a tabela servidorescola(designações)
                $sql1=" SELECT  se.id, se.turmas_atende,se.obsch,se.dt_cadastro,
                                e.nome as escola,
                                c.descricao as designacao,
                                t.descricao as turno,
                                l.descricao as licenca,
                                st.descricao as setor,
                                u.username as users
                            FROM `servidorescola` as se
                            
                            inner join escolas as e
                            on se.escola_id = e.id
                            
                            inner join convocacao as c
                            on c.id = se.designacao
                            
                            inner join turnos as t
                            on t.id = se.turno
                            
                            inner join licencas as l
                            on l.id = se.licenca
                            
                            inner join setor as st
                            on st.id = se.setor
                            
                            inner join users as u
                            on u.id = se.iduser

                            where se.idservidor = ".$id;

                $this->data['designacao']= R::getAll($sql1); 
               
               
                  /* Load Template */
               $this->template->admin_render('admin/servidores/view', $this->data);
            }
}
    //--Gets-----------------------------------
    private function getpos() {
		$teste = R::findAll("posgraduacao");
       // $op = array("5" => $teste->graduacao);
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
		$teste = R::findAll("escolas", "order by nome asc");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
    private function getcidade() {
		$teste = R::findAll("cidade");
       // $op = array("3" => $teste->descricao);
    	foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getsexo() {
		$teste = R::findAll("sexo");
        //$op = array("3" => $teste->sexo);
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getensinomedio() {
		$teste = R::findAll("ensinomedio");
       // $op = array("2" => $teste->ensino_medio);
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getensinosuperior() {
		$teste = R::findAll("ensinosuperior");
       // $op = array("4" => $teste->ensino_superior);
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
    private function getlocalizacao() {
		$teste = R::findAll("localizacao");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
   
    //--

}//fim classe
