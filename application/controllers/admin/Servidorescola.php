<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class servidorescola extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Designação");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

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
                  
                  $this->data['servidorescola']= R::findAll('servidorescola');   
                  
                   /* Load Template */
                   $this->template->admin_render('admin/servidorescola/index', $this->data);
                }
	}
    public function create($id,$idescola) {
		/* Breadcrumbs */
		//var_dump($id,$idescola);die;
        
        $this->breadcrumbs->unshift(2, "servidorescola", 'admin/servidorescola/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] = $id;
        $this->data['idescola'] = $idescola;
        
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Designação';
		/* Validate form input */
		$this->form_validation->set_rules('designacao', 'designacao', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$resp = R::dispense("servidorescola");
			$resp->escola_id        = $idescola;
            $resp->designacao       = strtoupper($this->input->post('designacao'));
            $resp->turno            = strtoupper($this->input->post('turno'));
            $resp->turmas_atende    = strtoupper($this->input->post('turmas_atende'));
            $resp->setor            = strtoupper($this->input->post('setor'));
            $resp->licenca          = strtoupper($this->input->post('licenca'));
            $resp->obsch            = strtoupper($this->input->post('obsch'));
            $resp->iduser           = $this->session->user_id;
            $resp->idservidor       = $id;
        	R::store($resp);

             //--busca idservidorescola
             $respse = R::findAll("servidorescola", "idservidor = ".$id);
             foreach($resse as $se){
                 $idservesc = $se['id'];
             }

            //-- insere na tabela servidordisciplina
            $areas = $this->input->post('area');  
            foreach ($areas as $row){
                $respd = R::dispense("servidordisciplina");
                $respd->idservidorescola = $idservesc;
                $respd->iddisciplina = $row;
                R::store($respd);
            } 
            //-- insere na tabela servidoranosatende
            $anos = $this->input->post('anos');  
            foreach ($anos as $row){
                $respa = R::dispense("servidoranosatende");
                $respa->idservidorescola = $idservesc;
                $respa->idanosatende = $row;
                R::store($respd);
            }

           	$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/servidores/view/'.$id, 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['designacao'] = array(
                'name'  => 'designacao',
                'id'    => 'designacao',
                'type'  => 'int',
                'options'  => $this->getdesignacao(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('designacao'),
            );
            $this->data['escola_id'] = array(
                'name'  => 'escola_id',
                'id'    => 'escola_id',
                'type'  => 'int',
                'options'  => $this->getescola(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('escola_id'),
            );
            $this->data['turno'] = array(
                'name'  => 'turno',
                'id'    => 'turno',
                'type'  => 'int',
                'options'  => $this->getturno(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('turno'),
            );
            $this->data['turmas_atende'] = array(
                'name'  => 'turmas_atende',
                'id'    => 'turmas_atende',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('turmas_atende'),
            );
            $this->data['setor'] = array(
                'name'  => 'setor',
                'id'    => 'setor',
                'type'  => 'int',
                'options'  => $this->getsetor(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('setor'),
            );
            $this->data['licenca'] = array(
                'name'  => 'licenca',
                'id'    => 'licenca',
                'type'  => 'int',
                'options'  => $this->getlicenca(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('licenca'),
            );
            $this->data['obsch'] = array(
                'name'  => 'obsch',
                'id'    => 'obsch',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('obsch'),
            );
            
            $this->data['idservidor'] = array(
                'name'  => 'idservidor',
                'id'    => 'idservidor',
                'type'  => 'int',
                'options'  => $this->getservidor(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idservidor'),
            );
            $this->data['disciplina'] = array(
                'name'  => 'disciplina',
                'id'    => 'disciplina',
                'type'  => 'int',
                'options'  => $this->getdisciplina(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('disciplina'),
            );
            $this->data['disciplina'] = array(
                'name'  => 'disciplina',
                'id'    => 'disciplina',
                'type'  => 'int',
                'options'  => $this->getdisciplina(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('disciplina'),
            );
            $this->data['anosatende'] = array(
                'name'  => 'anosatende',
                'id'    => 'anosatende',
                'type'  => 'int',
                'options'  => $this->getanosatende(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('anosatende'),
            );
        }
                    
        /* Load Template */
        $this->template->admin_render('admin/servidorescola/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/servidorescola', 'refresh');
		}

		$lixo = R::load("servidorescola", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/servidorescola', 'refresh');
	}
    public function edit($id) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
        
        $this->data['id'] =$id; //idservidorescola->tabela servidorescola

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "servidorescola", 'admin/servidorescola/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'servidorescola';
        /* Validate form input */
        $this->form_validation->set_rules('designacao', 'designacao', 'required');
        
        $resp = R::load("servidorescola", $id);
        $idserv = $resp->idservidor;//idservidor->tabela servidores
        $this->data['idserv'] = $idserv;
        
        if ($this->form_validation->run()) {
            $resp->designacao       = strtoupper($this->input->post('designacao'));
            $resp->escola_id        = strtoupper($this->input->post('escola_id'));
            $resp->turno            = strtoupper($this->input->post('turno'));
            $resp->turmas_atende    = strtoupper($this->input->post('turmas_atende'));
            $resp->setor            = strtoupper($this->input->post('setor'));
            $resp->licenca          = strtoupper($this->input->post('licenca'));
            $resp->obsch            = strtoupper($this->input->post('obsch'));
            $resp->iduser           = $this->session->user_id;
            R::store($resp);

            //-- insere na tabela servidordisciplina
             $areas = $this->input->post('area'); 
             if(isset($areas)){ 
                foreach ($areas as $row){
                    $resp1 = R::dispense("servidordisciplina");
                    $resp1->idservidorescola = $id;
                    $resp1->iddisciplina = $row;
                    R::store($resp1);
                } 
            }
             //-- insere na tabela servidoranosatende
             $anos = $this->input->post('anos'); 
             if(isset($anos)){ 
                foreach ($anos as $row){
                    $respa = R::dispense("servidoranosatende");
                    $respa->idservidorescola = $id;
                    $respa->idanosatende = $row;
                    R::store($respa);
                }               
            }
            redirect('admin/servidores/view/'.$idserv, 'refresh');
        
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['t_id'] = array('id' => $resp->id);
            
                $this->data['designacao'] = array(
                    'name'  => 'designacao',
                    'id'    => 'designacao',
                    'type'  => 'int',
                    'options'  => $this->getdesignacao(),
                    'class' => 'form-control',
                    'selected'=> $resp->designacao,
                    'value' => $resp->designacao,
                );
                $this->data['escola_id'] = array(
                    'name'  => 'escola_id',
                    'id'    => 'escola_id',
                    'type'  => 'int',
                    'options'  => $this->getescola(),
                    'class' => 'form-control',
                    'selected'=> $resp->escola_id,
                    'value' => $resp->escola_id,
                );
                $this->data['turno'] = array(
                    'name'  => 'turno',
                    'id'    => 'turno',
                    'type'  => 'int',
                    'options'  => $this->getturno(),
                    'class' => 'form-control',
                    'selected'=> $resp->turno,
                    'value' => $resp->turno,
                );
                $this->data['turmas_atende'] = array(
                    'name'  => 'turmas_atende',
                    'id'    => 'turmas_atende',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->turmas_atende,
                );
                $this->data['setor'] = array(
                    'name'  => 'setor',
                    'id'    => 'setor',
                    'type'  => 'int',
                    'options'  => $this->getsetor(),
                    'class' => 'form-control',
                    'selected'=> $resp->setor,
                    'value' => $resp->setor,
                );
                $this->data['licenca'] = array(
                    'name'  => 'licenca',
                    'id'    => 'licenca',
                    'type'  => 'int',
                    'options'  => $this->getlicenca(),
                    'class' => 'form-control',
                    'selected'=> $resp->licenca,
                    'value' => $resp->licenca,
                );
                $this->data['obsch'] = array(
                    'name'  => 'obsch',
                    'id'    => 'obsch',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->obsch,
                );
                $this->data['disciplina'] = array(
                    'name'  => 'disciplina',
                    'id'    => 'disciplina',
                    'type'  => 'int',
                    'options'  => $this->getdisciplina(),
                    'class' => 'form-control',
                    'value' => $resp->disciplina,
                );
                $this->data['anosatende'] = array(
                    'name'  => 'anosatende',
                    'id'    => 'anosatende',
                    'type'  => 'int',
                    'options'  => $this->getanosatende(),
                    'class' => 'form-control',
                    'value' => $resp->anosatende,
                );
        }

        /* Load Template */
        $this->template->admin_render('admin/servidorescola/edit', $this->data);
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
    private function getlicenca() {
		$teste = R::findAll("licencas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getsetor() {
		$teste = R::findAll("setor");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getservidor() {
		$teste = R::findAll("servidores");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
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
    private function getdisciplina() {
		$teste = R::findAll("disciplinas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}
    private function getanosatende() {
		$teste = R::findAll("anosatende");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
	}


}//fim classe
