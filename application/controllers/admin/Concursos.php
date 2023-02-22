<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class concursos extends Admin_Controller {

    public function __construct()  { 
        parent::__construct();
        /* Title Page :: Common */
         $this->lang->load('admin/users');
    
        $this->page_title->push('concursos');
        $this->data['pagetitle'] = $this->page_title->show();
        
        $this->anchor = $this->router->fetch_class();
        
        /*inicializando a classe do javascript no construtor    */
       // $this->load->library('javascript'); // to load JavaScript library
       // $this->load->library('javascript/jquery');

        /* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, lang('menu_files'), 'admin/concursos');
	}
    public function index($at = null){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else
           { /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            /* Data */
            $this->data['error'] = NULL;
            //$this->data['concursos']= R::findAll('concursos', 'order by id desc');   
			if($at == null){$teste = " order by num asc";}      //todos
			if($at == 1)   {$teste = " where con.titulo = 1";}  //ps simplificado
			if($at == 2)   {$teste = " where con.titulo = 2";}  //ps estagiario
			if($at == 3)   {$teste = " where con.titulo = 3";}  //concurso publico
			if($at == 4)   {$teste = " where con.titulo = 4";}  //ps interno

			$sql1 = "SELECT dep.sigla as descdep,
							ti.descricao as desctitulo,
							con.id as idcon,
							subtitulo,responsavel,empresa,link,criador, ativo,num,ano,data_p,data_e,data_v
	 
	 				FROM `concursos` as con
	 
	 				inner join titulos as ti
	 				on con.titulo = ti.id
	 
	 				inner join departamentos as dep
	 				on con.departamento = dep.id
					 
					".$teste;

			$this->data['concursos']= R::getAll($sql1); 

            /* Load Template */
            $this->template->admin_render('admin/concursos/index', $this->data);
           }
	}
	//----Edits------------------------------
	public function editetapa($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar etapa", 'admin/concursos/editetapa');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		
		$etapa = R::load("etapas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$etapa->titulo = $this->input->post('titulo');
				$etapa->tipo = $this->input->post('tipo');
				//$etapa->responsavel = $this->input->post('responsavel');
				$etapa->dataini = $this->input->post('dataini');
				$etapa->datafim = $this->input->post('datafim');
				$etapa->status = $this->input->post('status');
				
				R::store($etapa);

				redirect('admin/concursos/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $etapa->id
		);
		$this->data['titulo'] = array(
			'name'  => 'titulo',
			'id'    => 'titulo',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $etapa->titulo,
		);

		$this->data['tipo'] = array(
				'name'  => 'tipo',
				'id'    => 'tipo',
				'options'  => $this->getTipos(),
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('tipo'),
                        );

		$this->data['dataini'] = array(
			'name'  => 'dataini',
			'id'    => 'dataini',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $etapa->dataini,
			'style' => 'padding-top: 0px;'
		);

		$this->data['datafim'] = array(
			'name'  => 'datafim',
			'id'    => 'datafim',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $etapa->datafim,
			'style' => 'padding-top: 0px;'
		);

		 $this->data['responsavel'] = array(
			'name'  => 'responsavel',
			'id'    => 'responsavel',
			'type'  => 'dropdown',
			'class' => 'form-control',
			'options' => $this->getResponsaveis(),
			'selected' => $etapa->responsavel,
		);
		$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'options'  => $this->getStatus(),
                                'class' => 'form-control',
				'value' => $this->form_validation->set_value('status'),
                        );
		/* Load Template */
		$this->template->admin_render('admin/concursos/etapas/editetapa', $this->data);
	}
    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		$conc = R::load("concursos", $id);
		$usuario = R::load("users", $this->session->user_id);

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Concurso", 'admin/concursos/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		
		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$conc->titulo = $this->input->post('titulo');
				$conc->subtitulo = $this->input->post('subtitulo');
				$conc->departamento = $this->input->post('departamento');
				$conc->num =    $this->input->post('num');
				$conc->ano =    $this->input->post('ano');
				$conc->data_p = $this->input->post('data_p');
				$conc->data_e = $this->input->post('data_e');
				$conc->data_v = $this->input->post('data_v');
				$conc->ativo =  $this->input->post('ativo');

				R::store($conc);
               redirect('admin/concursos','refresh');
           		}
		}
	
		$erros = "";
		if (validation_errors()) {
			$erros = validation_errors();
		}

		$this->data['message'] = $erros;

		$this->data['id'] = array(
			'id' => $conc->id
		);
		$this->data['titulo'] = array(
			'name'  => 'titulo',
			'id'    => 'titulo',
			'type'  => 'checkbox',
			'options'  => $this->gettitulo(),
			'class' => 'form-control',
			'selected'=> $conc->titulo,
			'value' => $conc->titulo,
				   
		);
		$this->data['subtitulo'] = array(
			'name'  => 'subtitulo',
			'id'    => 'subtitulo',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $conc->subtitulo
		);
		$this->data['departamento'] = array(
			'name'  => 'departamento',
			'id'    => 'departamento',
			'type'  => 'checkbox',
			'options'  => $this->getdepartamento(),
			'class' => 'form-control',
			'selected'=> $conc->departamento,
			'value' => $conc->departamento,
				   
		);

		$this->data['num'] = array(
			'name'  => 'num',
			'id'    => 'num',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $conc->num
		);
		
        $this->data['ano'] = array(
			'name'  => 'ano',
			'id'    => 'ano',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $conc->ano
		);
                
        $this->data['data_p'] = array(
			'name'  => 'data_p',
			'id'    => 'data_p',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $conc->data_p
		);
                
        $this->data['data_e'] = array(
			'name'  => 'data_e',
			'id'    => 'data_e',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $conc->data_e
		);
		$this->data['data_v'] = array(
			'name'  => 'data_v',
			'id'    => 'data_v',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $conc->data_v
		);
               
		$responsaveis = $this->getResponsaveis();
		$this->data['responsavel'] = array(
			'name'  => 'responsavel',
			'id'    => 'responsavel',
			'type'  => 'dropdown',
			'class' => 'form-control',
			'options' => $responsaveis,
			'selected' => $conc->responsavel
		);
		$this->data['ativo'] = array(
                    'name'  => 'ativo',
                    'id'    => 'ativo',
                    'type'  => 'checkbox',
                    'value' => '1',
                    'style' => 'margin-top:10px',
                    'checked' => $conc->ativo?true:false
                    );
		
		/* Load Template */
		$this->template->admin_render('admin/concursos/edit', $this->data);
	}
    public function editArea($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		$conc = R::load("concursos", $id);
		$usuario = R::load("users", $this->session->user_id);

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Area do Concurso", 'admin/concursos/editArea');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
                
                /*inicio do commit*/
		R::begin();
                try{
                    if (isset($_POST) && ! empty($_POST)) {
		        $areas = $this->input->post('area');                            
                        
                        $lixoc = R::findAll("concarea", 'conc ='.$id);
                         R::trashAll($lixoc);
                        
                        foreach ($areas as $row){
                            //var_dump($row);
                            $ca = R::dispense("concarea");
                            $ca->conc = $id;
                            $ca->area = $row;
                            
                            R::store($ca);
                        } 
                        redirect('admin/concursos', 'refresh');
                    };
                    R::commit();
                }
                catch(Exception $e){
                    R::rollback();
                }    
                 /*fim do commit*/
		
                $erros = "";
		if (validation_errors()) {
			$erros = validation_errors();
		}

		$this->data['message'] = $erros;

		$this->data['id'] = array(
                    'id' => $conc->id
		);
                
                //$concareas = R::findAll('concarea','conc = 1');
                $sql = 'SELECT c.conc,c.area,a.descricao 
                        FROM concarea c
                    
                        inner join areas as a 
                        on a.id = c.area
                        
                        where c.conc = '.$id; 
                $concareas = R::getAll($sql);
                
                $this->data['concareas'] = $concareas;
                
		 $this->data['area'] = array(
			'name'  => 'area',
			'id'    => 'area',
			'type'  => 'checkbox',
			'options'  => $this->getAreas(),
			'class' => 'form-control'			                       
		);
                /*esta mostrando a seleção só do ultimo */ 
                foreach ($concareas as $c){                    
                    $this->data['area']['selected'] = $c['area'];
                }
                
            	/* Load Template */
		$this->template->admin_render('admin/concursos/editArea', $this->data);
	}    
	//---Views------------------------------------
    public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            { redirect('auth/login', 'refresh'); }
        else{ 
        /* -- Breadcrumbs ----------------------------------------------------*/
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        /* -- Data -----------------------------------------------------------*/
            $this->data['error'] = NULL;
        
        /* -- chama concursos pelo id  ---------------------------------------*/
            $concurso = R::load('concursos', $id);
            $this->data['p']= $concurso; 
            
        /*-- chama responsavel da tabela users -------------------------------*/
             $this->data['usuario']= R::load('users',$concurso->responsavel); 
            
        /* -- select para buscar etapas ---------------------------------------*/
            $sql= "SELECT  e.id, e.titulo,t.descricao as descrit, e.tipo, s.descricao, u.username, 
                           dataini, datafim, e.status, e.responsavel
                    from etapas as e 
                  
                    inner join tipos t
                    on e.tipo = t.id
        
                    inner join users u
                    on e.responsavel = u.id

                    inner join status s
                    on e.status = s.id

                    where e.con_et = ".$id ;
            $this->data['etapa']= R::getAll($sql); 
        
        /* -- Busca areas do concurso pelo id do concurso---------------------*/
            $asql =" select a.descricao 
                     from areas a

                    inner join concarea ca 
                    on a.id = ca.area

                    inner join concursos c
                    on ca.conc = c.id

                    where ca.conc = ".$id;
            
            $this->data['ar'] = R::getAll($asql);
     
        /* -- chama arquivos pelo id da etapa -------------------------------------------*/
        $sql = "select  e.id, e.titulo,t.descricao as descrit, e.tipo, s.descricao, u.username, 
                           dataini, datafim, e.status, e.responsavel
                    from etapas as e 
                  
                    inner join tipos t
                    on e.tipo = t.id
        
                    inner join users u
                    on e.responsavel = u.id

                    inner join status s
                    on e.status = s.id
                    
                    where e.con_et = " . $id;
        //$this->data['etapa']= R::getAll($sql); 

        $etapas = array();
        // arquivos etapas
        $ae = R::getAll($sql);
        foreach ($ae as $a) {
            $a['arquivos'] = R::findAll('arquivosetapas', 'etapa = ' . $a['id']);
            $etapas[] = $a;
        }
        $this->data['etapa'] = $etapas;
            
        /* -- Load Template --------------------------------------------------*/
        $this->template->admin_render('admin/concursos/view', $this->data);
           }
	}    
	//----Creates-----------------------------------
	function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Concurso", 'admin/concursos/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('num', 'num', 'required');
		$this->form_validation->set_rules('ano', 'ano', 'required');
		$this->form_validation->set_rules('data_p', 'data_p', 'required');
		

		if ($this->form_validation->run()) {
			
			$conc = R::dispense("concursos");
			$conc->titulo = $this->input->post('titulo');
            $conc->subtitulo = $this->input->post('subtitulo');
            $conc->departamento = $this->input->post('departamento');
            $conc->num = $this->input->post('num');
            $conc->ano = $this->input->post('ano');
			$conc->data_p = $this->input->post('data_p');
			$conc->data_e = $this->input->post('data_e');
			$conc->data_v = $this->input->post('data_v');
			$conc->ativo = true;
            $conc->responsavel = $this->session->user_id;
			$conc->criador = $this->session->user_id;
            $conc->empresa = $this->input->post('empresa');
            $conc->link = $this->input->post('link');
                        
			
            //var_dump($_POST);die;
            $id= R::store($conc);
            $this->session->set_flashdata('message', "Dados gravados");

			$areas = $this->input->post('area');  
			//var_dump($areas);
            //die;                        
            foreach ($areas as $row){
                $ca = R::dispense("concarea");
                $ca->conc = $id;
                $ca->area = $row;
                          
                R::store($ca);
            } 
                      
            redirect('admin/concursos', 'refresh');
			
        } else {
                         
			$erros = "";
			if (validation_errors()) {
				$erros = validation_errors();
			}

			$this->data['message'] = $erros;

			$this->data['titulo'] = array(
				'name'  => 'titulo',
				'id'    => 'titulo',
				'type'  => 'checkbox',
				'options'  => $this->gettitulo(),
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('titulo'),
                       
			);
			$this->data['subtitulo'] = array(
				'name'  => 'subtitulo',
				'id'    => 'subtitulo',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('subtitulo'),
			);
			$this->data['departamento'] = array(
				'name'  => 'departamento',
				'id'    => 'departamento',
				'type'  => 'checkbox',
				'options'  => $this->getdepartamento(),
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('departamento'),
                       
			);
			$this->data['num'] = array(
				'name'  => 'num',
				'id'    => 'num',
				'type'  => 'int',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('num'),
			);
            $this->data['ano'] = array(
				'name'  => 'ano',
				'id'    => 'ano',
				'type'  => 'int',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('ano'),
            );
            $this->data['data_p'] = array(
				'name'  => 'data_p',
				'id'    => 'data_p',
				'type'  => 'date',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('data_p'),
            );
            $this->data['data_e'] = array(
				'name'  => 'data_e',
				'id'    => 'data_e',
				'type'  => 'date',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('data_e'),
			);
			$this->data['data_v'] = array(
				'name'  => 'data_v',
				'id'    => 'data_v',
				'type'  => 'date',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('data_v'),
			);
			$responsaveis = $this->getResponsaveis();
			$this->data['responsavel'] = array(
				'name'  => 'responsavel',
				'id'    => 'responsavel',
				'type'  => 'dropdown',
				'class' => 'form-control',
				'options' => $responsaveis,
				//'selected' => $projeto->responsavel
			);
			$this->data['ativo'] = array(
				'name'  => 'ativo',
				'id'    => 'ativo',
				'type'  => 'checkbox',
				'value' => '1',
				'style' => 'margin-top:10px'
			);
                        
            $this->data['area'] = array(
				'name'  => 'area',
				'id'    => 'area',
				'type'  => 'checkbox',
				'options'  => $this->getAreas(),
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('area'),
                       
			);
            $this->data['empresa'] = array(
				'name'  => 'empresa',
				'id'    => 'empresa',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('empresa'),
			);
            $this->data['link'] = array(
				'name'  => 'link',
				'id'    => 'link',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('link'),
			);
                        
			/* Load Template */
			$this->template->admin_render('admin/concursos/create', $this->data);
		}
	}
    public function createetapa($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Concurso", 'admin/concursos/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('dataini', 'Início da etapa', 'required');
		$this->form_validation->set_rules('datafim', 'Previsão para o fim', 'required');

		if ($this->form_validation->run() ) {
			$etapa = R::dispense("etapas");
			$etapa->con_et = $id;
			$etapa->titulo = $this->input->post('titulo');
			$etapa->tipo = $this->input->post('tipo');
			$etapa->responsavel = $this->session->user_id;
            $etapa->dataini = $this->input->post('dataini');
			$etapa->datafim = $this->input->post('datafim');
			$etapa->status = $this->input->post('status');

			$idetapa = R::store($etapa);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/concursos/view/' . $id, 'refresh');

		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : "");
			
			if (!$this->validacaoResponsavel()) {
				$this->data['message'] .= "<p>Preencha o titulo, ou tipo</p>";
			}

			$this->data['titulo'] = array(
				'name'  => 'titulo',
				'id'    => 'titulo',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('titulo'),
			);

			$this->data['tipo'] = array(
				'name'  => 'tipo',
				'id'    => 'tipo',
				'options'  => $this->getTipos(),
                                'class' => 'form-control',
				'value' => $this->form_validation->set_value('tipo'),
                        );
                       
			$this->data['dataini'] = array(
				'name'  => 'dataini',
				'id'    => 'dataini',
				'type'  => 'date',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('dataini'),
				'style' => 'padding-top: 0px;'
			);

			$this->data['datafim'] = array(
				'name'  => 'datafim',
				'id'    => 'datafim',
				'type'  => 'date',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('datafim'),
				'style' => 'padding-top: 0px;'
			);
			$this->data['responsavel'] = array(
				'name'  => 'responsavel',
				'id'    => 'responsavel',
				'type'  => 'dropdown',
				'class' => 'form-control',
				'options' => $this->getResponsaveis(),
				'selected' => $this->form_validation->set_value('responsavel'),
			);
			$this->data['status'] = array(
				'name'  => 'status',
				'id'    => 'status',
				'options'  => $this->getStatus(),
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('status'),
            );

			/* Load Template */
			$this->template->admin_render('admin/concursos/etapas/create', $this->data);
		}
	}
    public function arquivosetapa($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Arquivos da etapa", 'admin/concursos/view');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		//$ae = R::findAll("arquivosetapas", "etapa = {$id}");
		$sql ="	SELECT *
				FROM arquivosetapas 
				where etapa =".$id;

		$this->data['etapa'] = R::load("etapas", $id);
		$this->data['concurso'] = R::load("concursos", $this->data['etapa']->concurso);
		//$this->data['arquivos'] = $ae;
		$this->data['arquivos'] = R::getAll($sql);
		
		/* Load Template */
		$this->template->admin_render('admin/concursos/etapas/arquivos', $this->data);
	}    
    //-----Deletar-----------------------------
	public function apagararquivoetapa($id) {
	
		$ae = R::load("arquivosetapas", $id);
		$etapa = R::load("etapas", $ae->etapa);//para fazer o refresh

		R::trash($ae);

		redirect('admin/concursos/arquivosetapa/' . $etapa->id, 'refresh');
	}
	public function deleteyes($id) {
		

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/concursos', 'refresh');
		}
		    /* deleta arquivos da etapa do concurso 
			$sql = "SELECT  ae.id, ae.etapa, ae.arquivo, ae.caminho 
					from arquivosetapas as ae
			
				inner join etapas as et
				on ae.etapa = et.id
				";
			
			$lixoae = R::findAll($sql,'con_et ='.$id );
			R::trash($lixoae);*/
			
			/*deleta as etapas do concurso */
			$lixoe = R::findAll("etapas", 'con_et ='.$id); 
			R::trashAll($lixoe);
			
			/*deleta as areas do concurso */
			$lixoc = R::findAll("concarea", 'conc ='.$id);
			R::trashAll($lixoc);    
			
			/*deleta o concurso */
			$lixo = R::load("concursos", $id);
			R::trash($lixo);

			$this->session->set_flashdata('message', "Concurso removido");            
		
            redirect('admin/concursos', 'refresh');
	}  
    public function deletapa($id) {
		 if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/concursos', 'refresh');
		}
        
		/*deleta etapa */
			$lixo = R::load("etapas", $id);
			R::trash($lixo);
				
	
            redirect('admin/concursos', 'refresh');
	    
	}
	//----Gets----------------------------------
	public function getdepartamento() {
		$tipo = R::findAll("departamentos");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
	public function gettitulo() {
		$tipo = R::findAll("titulos");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
	public function getTipos() {
		$tipo = R::findAll("tipos");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
	private function getResponsaveis() {
		$opts = R::findAll("users");
		$ret = array("0" => "Selecione");
		foreach ($opts as $o) {
			$ret[$o->id] = $o->first_name . " " . $o->last_name;
		}
		return $ret;
	}
    private function getStatus() {
		$teste = R::findAll("status");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
	public function getEtapas($id) {
		$id = (int) $id;
		
		$etap = R::findAll("etapas");
		foreach ($etap as $e) {
			$options[$e->id] = $e->nome;
		}
				
		return $options;
	}
	public function getAreas() {
		$tipo = R::findAll("areas");
		foreach ($tipo as $e) {
			$options[$e->id] = $e->descricao;
					
		}
		return $options;
	}
    //-----------------------------------------------
	private function validacaoResponsavel() {
		if (isset($_POST) && ! empty($_POST)
		&& $this->input->post("responsavel") == 0) {
			return false;
		}
		return true;
	}
    function activate($id) {
		$id = (int) $id;

		$conc = R::load("concursos", $id);
		$conc->ativo = 1;
		R::store($conc);
		
		$this->session->set_flashdata('message', "Concurso ativado");
		redirect('admin/concursos', 'refresh');
	}
    public function deactivate($id) {
    
		$id = (int) $id;

		$conc = R::load("concursos", $id);
		$conc->ativo = 0;
		R::store($conc);
		
		$this->session->set_flashdata('message', "Concurso Inativo");
		redirect('admin/concursos', 'refresh');    

    } 
	//------Uploads
	public function uploadarquivos($projeto) {
		$p = R::load("concursos", $projeto);

		if (!$this->usuarios_model->isAdmin($this->session->user_id) 
			&& $p->responsavel != $this->session->user_id) {
			redirect('admin');
		}

		$nomesarquivos = $_FILES['arquivos']['name'];

		for ($i=0; $i<count($nomesarquivos); $i++) {
			$_FILES['arquivo']['name'] = $_FILES['arquivos']['name'][$i];
			$_FILES['arquivo']['type'] = $_FILES['arquivos']['type'][$i];
			$_FILES['arquivo']['tmp_name'] = $_FILES['arquivos']['tmp_name'][$i];
			$_FILES['arquivo']['error'] = $_FILES['arquivos']['error'][$i];
			$_FILES['arquivo']['size'] = $_FILES['arquivos']['size'][$i];

			if (!is_dir("upload/arquivosetapas/etapa-".$projeto)) {
				mkdir("upload/arquivosetapas/etapa-".$projeto);
			}
			$config['upload_path'] = "upload/arquivosetapas/etapa-".$projeto;
			$config['allowed_types'] = '*';
			$config['max_size'] = 10240;
			$config['file_name'] = $_FILES['arquivos']['name'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("arquivo")) {
				$datafile = $this->upload->data();
				
				$ap = R::dispense("arquivosetapas");
				$ap->projeto = $projeto;
				$ap->arquivo = $datafile["file_name"];
				$ap->caminho = $datafile["full_path"];
				R::store($ap);
			}
		}

		redirect('admin/concursos/view/' . $projeto, 'refresh');
	}
    public function uploadarquivosetapa($id) {
		$nomesarquivos = $_FILES['arquivos']['name'];
                
		for ($i=0; $i<count($nomesarquivos); $i++) {
			$_FILES['arquivo']['name'] = $_FILES['arquivos']['name'][$i];
			$_FILES['arquivo']['type'] = $_FILES['arquivos']['type'][$i];
			$_FILES['arquivo']['tmp_name'] = $_FILES['arquivos']['tmp_name'][$i];
			$_FILES['arquivo']['error'] = $_FILES['arquivos']['error'][$i];
			$_FILES['arquivo']['size'] = $_FILES['arquivos']['size'][$i];

			if (!is_dir("upload/arquivosetapas/etapa-".$id)) {                                 
				mkdir("upload/arquivosetapas/etapa-".$id);
			}                        
			$config['upload_path'] = "upload/arquivosetapas/etapa-".$id;
			$config['allowed_types'] = '*';
			$config['max_size'] = 10240;
			$config['file_name'] = $_FILES['arquivos']['name'][$i];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload("arquivo")) {
				$datafile = $this->upload->data();
				
				$ae = R::dispense("arquivosetapas");
				$ae->etapa = $id;
				$ae->arquivo = $datafile["file_name"];
				$ae->caminho = $datafile["full_path"];
				R::store($ae);
			}
		}

		redirect('admin/concursos/arquivosetapa/' . $id, 'refresh');
	}       
       
    }/*fim classe*/
