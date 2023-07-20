<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class turmas extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Turmas");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

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
                  //sql para soma dos valores
                  $sqltotal = "SELECT   SUM(t.capacidade)   as tcapacidade,
                                        SUM(t.capacidade_p) as tcapacidade_p,
                                        SUM(t.regular)      as tregular,
                                        SUM(t.pnesl)        as tpnesl,
                                        SUM(t.pnecl)        as tpnecl,
                                        SUM(t.matriculas)   as tmatriculas,
                                        SUM(t.capacidade_p - t.matriculas)   as trestantes
        
                            from turmas as t
                            where t.idescola = ".$id;

                  $this->data['turmatotal']= R::getAll($sqltotal); 
                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  
                  $this->data['escolas']= R::getAll($sqlescola); 
                
                  //sql para mostra as turmas da escola
                  $sql ="SELECT     t.id as idturma,t.descricao as descturma,t.capacidade,t.capacidade_p,
                                    t.regular,t.pnesl,t.pnecl,t.matriculas,t.idserie,
                                    t.dt_cad,t.user_cad,tu.id,t.idescola,
                                    tu.descricao as descturno
                                          from turmas as t
                  
                                          inner join turnos as tu
                                          on tu.id = t.idturno
                                          
                                          where t.idescola  = ".$id;
                  $this->data['turmas']= R::getAll($sql);        

                  //$this->data['turmas']= R::findAll('turmas', 'idescola = '.$id);   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/turmas/index', $this->data);
                }
	}
    public function create($idescola) {
		/* Breadcrumbs */
		//var_dump($id,$idescola);die;
        
        $this->breadcrumbs->unshift(2, "turmas", 'admin/turmas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['idescola1'] = $idescola;
        
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Turmas';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("turmas");
			$resp->idescola         = $idescola;
            $resp->descricao        = strtoupper($this->input->post('descricao'));
            $resp->capacidade       = strtoupper($this->input->post('capacidade'));
            $resp->capacidade_p     = strtoupper($this->input->post('capacidade_p'));
            $resp->regular          = strtoupper($this->input->post('regular'));
            $resp->pnesl            = strtoupper($this->input->post('pnesl'));
            $resp->pnecl            = strtoupper($this->input->post('pnecl'));
            $resp->matriculas       = strtoupper($this->input->post('matriculas'));
            $resp->idserie          = strtoupper($this->input->post('idserie'));
            $resp->idturno          = strtoupper($this->input->post('idturno'));
            $resp->user_cad         = $this->session->user_id;
          	R::store($resp);

            
           	$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/turmas/index/'.$idescola, 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
            $this->data['idescola'] = array(
                'name'  => 'idescola',
                'id'    => 'idescola',
                'type'  => 'int',
                'options'  => $this->getescola(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idescola'),
            );
            $this->data['capacidade'] = array(
                'name'  => 'capacidade',
                'id'    => 'capacidade',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('capacidade'),
            );
            $this->data['capacidade_p'] = array(
                'name'  => 'capacidade_p',
                'id'    => 'capacidade_p',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('capacidade_p'),
            );
            $this->data['regular'] = array(
                'name'  => 'regular',
                'id'    => 'regular',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('regular'),
            );
            $this->data['pnesl'] = array(
                'name'  => 'pnesl',
                'id'    => 'pnesl',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('pnesl'),
            );
            $this->data['pnecl'] = array(
                'name'  => 'pnecl',
                'id'    => 'pnecl',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('pnecl'),
            );
            $this->data['matriculas'] = array(
                'name'  => 'matriculas',
                'id'    => 'matriculas',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('matriculas'),
            );
            $this->data['idturno'] = array(
                'name'  => 'idturno',
                'id'    => 'idturno',
                'type'  => 'int',
                'options'  => $this->getturno(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idturno'),
            );
            $this->data['idserie'] = array(
                'name'  => 'idserie',
                'id'    => 'idserie',
                'type'  => 'int',
                'options'  => $this->getserie(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idserie'),
            );
        }
                    
        /* Load Template */
        $this->template->admin_render('admin/turmas/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/turmas', 'refresh');
		}

		$lixo = R::load("turmas", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/escolas', 'refresh');
	}
    public function edit($id,$idescola) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
        
        $this->data['id'] =$id; //idturmas->tabela turmas
        $this->data['idescola1'] = $idescola;
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "turmas", 'admin/turmas/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'turmas';
        /* Validate form input */
        $this->form_validation->set_rules('descricao', 'descricao', 'required');
        
        $resp = R::load("turmas", $id);
        
        if ($this->form_validation->run()) {
            $resp->descricao    = strtoupper($this->input->post('descricao'));
            $resp->capacidade   = strtoupper($this->input->post('capacidade'));
            $resp->capacidade_p = strtoupper($this->input->post('capacidade_p'));
            $resp->regular      = strtoupper($this->input->post('regular'));
            $resp->pnesl        = strtoupper($this->input->post('pnesl'));
            $resp->pnecl        = strtoupper($this->input->post('pnecl'));
            $resp->matriculas   = strtoupper($this->input->post('matriculas'));
            $resp->idserie      = strtoupper($this->input->post('idserie'));
            $resp->idturno      = strtoupper($this->input->post('idturno'));
            $resp->idescola     = $idescola;
            $resp->iduser       = $this->session->user_id;
            R::store($resp);
            
            redirect('admin/turmas/index/'.$idescola, 'refresh');
        
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['t_id'] = array('id' => $resp->id);
            
                $this->data['descricao'] = array(
                    'name'  => 'descricao',
                    'id'    => 'descricao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->descricao,
                );
                $this->data['capacidade'] = array(
                    'name'  => 'capacidade',
                    'id'    => 'capacidade',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->capacidade,
                );
                $this->data['capacidade_p'] = array(
                    'name'  => 'capacidade_p',
                    'id'    => 'capacidade_p',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->capacidade_p,
                );
                $this->data['regular'] = array(
                    'name'  => 'regular',
                    'id'    => 'regular',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->regular,
                );
                $this->data['pnesl'] = array(
                    'name'  => 'pnesl',
                    'id'    => 'pnesl',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->pnesl,
                );
                $this->data['pnecl'] = array(
                    'name'  => 'pnecl',
                    'id'    => 'pnecl',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->pnecl,
                );
                $this->data['matriculas'] = array(
                    'name'  => 'matriculas',
                    'id'    => 'matriculas',
                    'type'  => 'int',
                    'class' => 'form-control',
                    'value' => $resp->matriculas,
                );
                $this->data['idserie'] = array(
                    'name'  => 'idserie',
                    'id'    => 'idserie',
                    'type'  => 'int',
                    'options'  => $this->getserie(),
                    'class' => 'form-control',
                    'selected'=> $resp->idserie,
                    'value' => $resp->idserie,
                );
                $this->data['idturno'] = array(
                    'name'  => 'idturno',
                    'id'    => 'idturno',
                    'type'  => 'int',
                    'options'  => $this->getturno(),
                    'class' => 'form-control',
                    'selected'=> $resp->idturno,
                    'value' => $resp->idturno,
                );
                $this->data['idescola'] = array(
                    'name'  => 'idescola',
                    'id'    => 'idescola',
                    'type'  => 'int',
                    'options'  => $this->getescola(),
                    'class' => 'form-control',
                    'value' => $resp->idescola,
                );
        }

        /* Load Template */
        $this->template->admin_render('admin/turmas/edit', $this->data);
    }
    private function getturno() {
		$teste = R::findAll("turnos");
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
    private function getserie() {
		$teste = R::findAll("series");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}


}//fim classe
