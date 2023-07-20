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
                 
                    //--chama do banco a tabela escolas
                   
                    $sqlescola = "SELECT * from escolas where id = ".$id;
                    $this->data['escolas']= R::getAll($sqlescola); 
                   
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
    public function getServidores() {     
		/* POST data */
		$postData = $this->input->post();
   
		/* Get data */
		$data = $this->servidores_model->getServidores($postData);
   
		$resp = json_encode($data);
		
		echo $resp;		
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Servidor", 'admin/servidores/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] =$id;
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Servidores';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
        $this->form_validation->set_rules('cpf', 'cpf', 'required');
        $this->form_validation->set_rules('matricula', 'matricula', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
           
			$resp = R::dispense("servidores");
            $resp->matricula        = strtoupper($this->input->post('matricula'));
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
            R::store($resp);

            //buscar idservidor cadastrado-----
            $ag = R::findAll("servidores", "cpf = ".$resp->cpf);
            
            foreach($ag as $re2){
                $idserv = $re2['id'];
            }
            //adicionar a tabela servidorescola------
             $resp1 = R::dispense("servidorescola");
             $resp1->escola_id  = $id;
             $resp1->iduser     = $this->session->user_id;
             $resp1->idservidor = $idserv;
             R::store($resp1);
            
             //adicionar a tabela matricula------
             $resp3 = R::dispense("matricula");
             $resp3->idservidor = $idserv;
             $resp3->descricao = $resp->matricula;
             R::store($resp3);
        
			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/escolas', 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");
                    //---dados do servidor-----------
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
                    //---designacoes do servidor
                        $this->data['designacao'] = array(
                            'name'  => 'designacao',
                            'id'    => 'designacao',
                            'type'  => 'int',
                            'options'  => $this->getdesignacao(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('designacao'),
                        );   
                        $this->data['turno'] = array(
                            'name'  => 'turno',
                            'id'    => 'turno',
                            'type'  => 'int',
                            'options'  => $this->getturno(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('turno'),
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
            $this->form_validation->set_rules('cpf', 'cpf', 'required');
            /* busca idescola pelo idservidor */
            $sql="SELECT se.escola_id from servidores as s
                  inner join servidorescola as se
                  on se.idservidor = s.id  
                  where s.id = ".$id;
            $this->data['idescola']= R::getAll($sql);

            /* consulta para editar o servidor */
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
                $resp->idcadastrou      = $this->session->user_id;

                R::store($resp);

                //apagar area de atuacao e anosqueatende
                //para adicionar as novas

                redirect('admin/servidores/view/'.$id, 'refresh');
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
                $this->data['id'] =$id;//idservidor
                
                //--chama do banco a tabela servidores 
                $sqlser = " SELECT 		s.id,s.nome as nome,s.cpf,s.cidade,s.telefone,s.endereco,s.dt_nascimento,
                                        s.sexo,s.email,s.ensino_medio,s.ensino_superior,s.graduacao,s.nome_pos,
                                        s.area_concurso,s.ano_admissao,s.regime,s.idcadastrou,
                                        s.dataalteracao,
                                        c.descricao as desccidade,
                                        se.descricao as descsexo,
                                        em.descricao as descensinomedio,
                                        es.descricao as descensinosuperior,
                                        g.descricao as descgraduacao,
                                        ac.descricao as descareaconcurso,
                                        r.descricao as descregime,
                                        ses.escola_id as idescola,
                                        ses.id as idservesc
                            FROM servidores as s

                            left join servidorescola as ses
                            on ses.idservidor = s.id
                            
                            LEFT join cidade as c
                            on s.cidade = c.id
                            
                            LEFT join sexo as se
                            on s.sexo = se.id
                            
                            LEFT join ensinomedio as em
                            on s.ensino_medio = em.id
                            
                            LEFT join ensinosuperior as es
                            on s.ensino_superior = es.id
                            
                            LEFT join posgraduacao as g
                            on s.graduacao = g.id
                            
                            LEFT join areaconcurso as ac
                            on s.area_concurso = ac.id
                            
                            LEFT join regime as r
                            on s.regime = r.id
                            
                            where s.id = '$id'
                            GROUP BY nome" ;
                            
                
                $this->data['servidor']= R::getAll($sqlser); 
                
                //--chama do banco a tabela matriculas do servidor
                $sqlma="SELECT * from matricula 
                            where idservidor =".$id;
                $this->data['matricula']= R::getAll($sqlma); 
                
                //--chama do banco a tabela servidorescola(designações)
                $sql1=" SELECT  se.id, se.turmas_atende,se.obsch,se.dt_cadastro,
                                e.id as idescola,
                                e.nome as escola,
                                c.descricao as designacao,
                                t.descricao as turno,
                                l.descricao as licenca,
                                st.descricao as setor,
                                u.username as users,
                                se.id as idservesc
                               
                            FROM `servidorescola` as se
                            
                            LEFT join escolas as e
                            on se.escola_id = e.id
                            
                            LEFT join designacao as c
                            on c.id = se.designacao
                            
                            LEFT join turnos as t
                            on t.id = se.turno
                            
                            LEFT join licencas as l
                            on l.id = se.licenca
                            
                            LEFT join setor as st
                            on st.id = se.setor
                            
                            LEFT join users as u
                            on u.id = se.iduser

                            where se.idservidor = ".$id;

               // $this->data['designacao']= R::getAll($sql1); 
               
                $ae = R::getAll($sql1);
                foreach($ae as $a){
                    //chama a tabela servidordisciplina->disciplina
                     $sqld = "   SELECT   d.descricao as disciplina
                                from servidordisciplina as sd
                        
                                left join disciplinas as d
                                on d.id = sd.iddisciplina
                        
                                where   sd.idservidorescola = ".$a['idservesc'];
                     $sqla = "   SELECT   a.descricao as anos
                                from servidoranosatende as sa
                        
                                left join anosatende as a
                                on a.id = sa.idanosatende
                        
                                where   sa.idservidorescola = ".$a['idservesc'];           
                   
                   $a['disc'] = R::getAll($sqld); 
                   $a['atende']= R::getAll($sqla); 
                   
                   $etapas[] = $a;
                }
                $this->data['designacao']= $etapas;
   
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
    private function getdesignacao() {
		$teste = R::findAll("designacao");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getturno() {
		$teste = R::findAll("turnos");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
  
    

}//fim classe
