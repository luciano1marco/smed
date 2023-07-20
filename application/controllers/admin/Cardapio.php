<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cardapio extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Cardápio");
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
                 
                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  
                  $this->data['escolas']= R::getAll($sqlescola); 
                
                  //sql para mostra as cardapio da escola
                  $sql ="SELECT  *
                           from cardapio
                           where idescola  = ".$id;
                  $this->data['cardapio']= R::getAll($sql);        

                    /* Load Template */
                   $this->template->admin_render('admin/cardapio/index', $this->data);
                }
	}
    public function create($idescola) {
		/* Breadcrumbs */
		//var_dump($id,$idescola);die;
        
        $this->breadcrumbs->unshift(2, "cardapio", 'admin/cardapio/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['idescola1'] = $idescola;
        
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Cardápio';
		/* Validate form input */
		$this->form_validation->set_rules('tipo', 'tipo', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
		  $resp = R::dispense("cardapio");
			$resp->idescola         = $idescola;
            $resp->semana_de        = strtoupper($this->input->post('semana_de'));
            $resp->semana_ate       = strtoupper($this->input->post('semana_ate'));
            $resp->tipo             = strtoupper($this->input->post('tipo'));
            //segunda
            $resp->seg_m_preparacao       = strtoupper($this->input->post('seg_m_preparacao'));
            $resp->seg_m_qtde_gasta       = strtoupper($this->input->post('seg_m_qtde_gasta'));
            $resp->seg_t_preparacao       = strtoupper($this->input->post('seg_t_preparacao'));
            $resp->seg_t_qtde_gasta       = strtoupper($this->input->post('seg_t_qtde_gasta'));
            $resp->seg_n_preparacao       = strtoupper($this->input->post('seg_n_preparacao'));
            $resp->seg_n_qtde_gasta       = strtoupper($this->input->post('seg_n_qtde_gasta'));
            //terca
            $resp->ter_m_preparacao       = strtoupper($this->input->post('ter_m_preparacao'));
            $resp->ter_m_qtde_gasta       = strtoupper($this->input->post('ter_m_qtde_gasta'));
            $resp->ter_t_preparacao       = strtoupper($this->input->post('ter_t_preparacao'));
            $resp->ter_t_qtde_gasta       = strtoupper($this->input->post('ter_t_qtde_gasta'));
            $resp->ter_n_preparacao       = strtoupper($this->input->post('ter_n_preparacao'));
            $resp->ter_n_qtde_gasta       = strtoupper($this->input->post('ter_n_qtde_gasta'));
            //quarta
            $resp->qua_m_preparacao       = strtoupper($this->input->post('qua_m_preparacao'));
            $resp->qua_m_qtde_gasta       = strtoupper($this->input->post('qua_m_qtde_gasta'));
            $resp->qua_t_preparacao       = strtoupper($this->input->post('qua_t_preparacao'));
            $resp->qua_t_qtde_gasta       = strtoupper($this->input->post('qua_t_qtde_gasta'));
            $resp->qua_n_preparacao       = strtoupper($this->input->post('qua_n_preparacao'));
            $resp->qua_n_qtde_gasta       = strtoupper($this->input->post('qua_n_qtde_gasta'));
            //quinta
            $resp->qui_m_preparacao       = strtoupper($this->input->post('qui_m_preparacao'));
            $resp->qui_m_qtde_gasta       = strtoupper($this->input->post('qui_m_qtde_gasta'));
            $resp->qui_t_preparacao       = strtoupper($this->input->post('qui_t_preparacao'));
            $resp->qui_t_qtde_gasta       = strtoupper($this->input->post('qui_t_qtde_gasta'));
            $resp->qui_n_preparacao       = strtoupper($this->input->post('qui_n_preparacao'));
            $resp->qui_n_qtde_gasta       = strtoupper($this->input->post('qui_n_qtde_gasta'));
            //sexta
            $resp->sex_m_preparacao       = strtoupper($this->input->post('sex_m_preparacao'));
            $resp->sex_m_qtde_gasta       = strtoupper($this->input->post('sex_m_qtde_gasta'));
            $resp->sex_t_preparacao       = strtoupper($this->input->post('sex_t_preparacao'));
            $resp->sex_t_qtde_gasta       = strtoupper($this->input->post('sex_t_qtde_gasta'));
            $resp->sex_n_preparacao       = strtoupper($this->input->post('sex_n_preparacao'));
            $resp->sex_n_qtde_gasta       = strtoupper($this->input->post('sex_n_qtde_gasta'));
            //sabado
            $resp->sab_m_preparacao       = strtoupper($this->input->post('sab_m_preparacao'));
            $resp->sab_m_qtde_gasta       = strtoupper($this->input->post('sab_m_qtde_gasta'));
           R::store($resp);
            
           	$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/cardapio/index/'.$idescola, 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['idescola'] = array(
                'name'  => 'idescola',
                'id'    => 'idescola',
                'type'  => 'int',
                'options'  => $this->getescola(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('idescola'),
            );
            $this->data['semana_de'] = array(
                'name'  => 'semana_de',
                'id'    => 'semana_de',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('semana_de'),
            );
            $this->data['semana_ate'] = array(
                'name'  => 'semana_ate',
                'id'    => 'semana_ate',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('semana_ate'),
            );
            $this->data['tipo'] = array(
                'name'  => 'tipo',
                'id'    => 'tipo',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('tipo'),
            );
            //segunda
                $this->data['seg_m_preparacao'] = array(
                    'name'  => 'seg_m_preparacao',
                    'id'    => 'seg_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('seg_m_preparacao'),
                );
                $this->data['seg_m_qtde_gasta'] = array(
                    'name'  => 'seg_m_qtde_gasta',
                    'id'    => 'seg_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('seg_m_qtde_gasta'),
                );
                $this->data['seg_t_preparacao'] = array(
                    'name'  => 'seg_t_preparacao',
                    'id'    => 'seg_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' =>$this->form_validation->set_value('seg_t_preparacao'),
                );
                $this->data['seg_t_qtde_gasta'] = array(
                    'name'  => 'seg_t_qtde_gasta',
                    'id'    => 'seg_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('seg_t_qtde_gasta'),
                );
                $this->data['seg_n_preparacao'] = array(
                    'name'  => 'seg_n_preparacao',
                    'id'    => 'seg_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' =>$this->form_validation->set_value('seg_n_preparacao'),
                );
                $this->data['seg_n_qtde_gasta'] = array(
                    'name'  => 'seg_n_qtde_gasta',
                    'id'    => 'seg_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('seg_n_qtde_gasta'),
                );
            //terca
                $this->data['ter_m_preparacao'] = array(
                    'name'  => 'ter_m_preparacao',
                    'id'    => 'ter_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_m_preparacao'),
                );
                $this->data['ter_m_qtde_gasta'] = array(
                    'name'  => 'ter_m_qtde_gasta',
                    'id'    => 'ter_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_m_qtde_gasta'),
                );
                $this->data['ter_t_preparacao'] = array(
                    'name'  => 'ter_t_preparacao',
                    'id'    => 'ter_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_t_preparacao'),
                );
                $this->data['ter_t_qtde_gasta'] = array(
                    'name'  => 'ter_t_qtde_gasta',
                    'id'    => 'ter_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_t_qtde_gasta'),
                );
                $this->data['ter_n_preparacao'] = array(
                    'name'  => 'ter_n_preparacao',
                    'id'    => 'ter_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_n_preparacao'),
                );
                $this->data['ter_n_qtde_gasta'] = array(
                    'name'  => 'ter_n_qtde_gasta',
                    'id'    => 'ter_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('ter_n_qtde_gasta'),
                );
            //quarta  
                $this->data['qua_m_preparacao'] = array(
                    'name'  => 'qua_m_preparacao',
                    'id'    => 'qua_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_m_preparacao'),
                );
                $this->data['qua_m_qtde_gasta'] = array(
                    'name'  => 'qua_m_qtde_gasta',
                    'id'    => 'qua_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_m_qtde_gasta'),
                );
                $this->data['qua_t_preparacao'] = array(
                    'name'  => 'qua_t_preparacao',
                    'id'    => 'qua_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_t_preparacao'),
                );
                $this->data['qua_t_qtde_gasta'] = array(
                    'name'  => 'qua_t_qtde_gasta',
                    'id'    => 'qua_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_t_qtde_gasta'),
                );
                $this->data['qua_n_preparacao'] = array(
                    'name'  => 'qua_n_preparacao',
                    'id'    => 'qua_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_n_preparacao'),
                );
                $this->data['qua_n_qtde_gasta'] = array(
                    'name'  => 'qua_n_qtde_gasta',
                    'id'    => 'qua_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qua_n_qtde_gasta'),
                ); 
            //quinta  
                $this->data['qui_m_preparacao'] = array(
                    'name'  => 'qui_m_preparacao',
                    'id'    => 'qui_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_m_preparacao'),
                );
                $this->data['qui_m_qtde_gasta'] = array(
                    'name'  => 'qui_m_qtde_gasta',
                    'id'    => 'qui_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_m_qtde_gasta'),
                );
                $this->data['qui_t_preparacao'] = array(
                    'name'  => 'qui_t_preparacao',
                    'id'    => 'qui_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_t_preparacao'),
                );
                $this->data['qui_t_qtde_gasta'] = array(
                    'name'  => 'qui_t_qtde_gasta',
                    'id'    => 'qui_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_t_qtde_gasta'),
                );
                $this->data['qui_n_preparacao'] = array(
                    'name'  => 'qui_n_preparacao',
                    'id'    => 'qui_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_n_preparacao'),
                );
                $this->data['qui_n_qtde_gasta'] = array(
                    'name'  => 'qui_n_qtde_gasta',
                    'id'    => 'qui_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('qui_n_qtde_gasta'),
                );
            //sexta  
                $this->data['sex_m_preparacao'] = array(
                    'name'  => 'sex_m_preparacao',
                    'id'    => 'sex_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_m_preparacao'),
                );
                $this->data['sex_m_qtde_gasta'] = array(
                    'name'  => 'sex_m_qtde_gasta',
                    'id'    => 'sex_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_m_qtde_gasta'),
                );
                $this->data['sex_t_preparacao'] = array(
                    'name'  => 'sex_t_preparacao',
                    'id'    => 'sex_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_t_preparacao'),
                );
                $this->data['sex_t_qtde_gasta'] = array(
                    'name'  => 'sex_t_qtde_gasta',
                    'id'    => 'sex_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_t_qtde_gasta'),
                );
                $this->data['sex_n_preparacao'] = array(
                    'name'  => 'sex_n_preparacao',
                    'id'    => 'sex_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_n_preparacao'),
                );
                $this->data['sex_n_qtde_gasta'] = array(
                    'name'  => 'sex_n_qtde_gasta',
                    'id'    => 'sex_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('sex_n_qtde_gasta'),
                );
            //sabado  
            $this->data['sab_m_preparacao'] = array(
                'name'  => 'sab_m_preparacao',
                'id'    => 'sab_m_preparacao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('sab_m_preparacao'),
            );
            $this->data['sab_m_qtde_gasta'] = array(
                'name'  => 'sab_m_qtde_gasta',
                'id'    => 'sab_m_qtde_gasta',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('sab_m_qtde_gasta'),
            );
           

        }
                    
        /* Load Template */
        $this->template->admin_render('admin/cardapio/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/cardapio', 'refresh');
		}

		$lixo = R::load("cardapio", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/cardapio', 'refresh');
	}
    public function edit($id,$idescola) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
        
        $this->data['id'] =$id; //idcardapio->tabela cardapio
        $this->data['idescola1'] = $idescola;
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "cardapio", 'admin/cardapio/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'cardapio';
        /* Validate form input */
        $this->form_validation->set_rules('descricao', 'descricao', 'required');
        
        $resp = R::load("cardapio", $id);
       
        if ($this->form_validation->run()) {
            $resp->idescola         = $idescola;
            $resp->semana_de        = strtoupper($this->input->post('semana_de'));
            $resp->semana_ate       = strtoupper($this->input->post('semana_ate'));
            $resp->tipo             = strtoupper($this->input->post('tipo'));
            //segunda
            $resp->seg_m_preparacao       = strtoupper($this->input->post('seg_m_preparacao'));
            $resp->seg_m_qtde_gasta       = strtoupper($this->input->post('seg_m_qtde_gasta'));
            $resp->seg_t_preparacao       = strtoupper($this->input->post('seg_t_preparacao'));
            $resp->seg_t_qtde_gasta       = strtoupper($this->input->post('seg_t_qtde_gasta'));
            $resp->seg_n_preparacao       = strtoupper($this->input->post('seg_n_preparacao'));
            $resp->seg_n_qtde_gasta       = strtoupper($this->input->post('seg_n_qtde_gasta'));
            //terca
            $resp->ter_m_preparacao       = strtoupper($this->input->post('ter_m_preparacao'));
            $resp->ter_m_qtde_gasta       = strtoupper($this->input->post('ter_m_qtde_gasta'));
            $resp->ter_t_preparacao       = strtoupper($this->input->post('ter_t_preparacao'));
            $resp->ter_t_qtde_gasta       = strtoupper($this->input->post('ter_t_qtde_gasta'));
            $resp->ter_n_preparacao       = strtoupper($this->input->post('ter_n_preparacao'));
            $resp->ter_n_qtde_gasta       = strtoupper($this->input->post('ter_n_qtde_gasta'));
            //quarta
            $resp->qua_m_preparacao       = strtoupper($this->input->post('qua_m_preparacao'));
            $resp->qua_m_qtde_gasta       = strtoupper($this->input->post('qua_m_qtde_gasta'));
            $resp->qua_t_preparacao       = strtoupper($this->input->post('qua_t_preparacao'));
            $resp->qua_t_qtde_gasta       = strtoupper($this->input->post('qua_t_qtde_gasta'));
            $resp->qua_n_preparacao       = strtoupper($this->input->post('qua_n_preparacao'));
            $resp->qua_n_qtde_gasta       = strtoupper($this->input->post('qua_n_qtde_gasta'));
            //quinta
            $resp->qui_m_preparacao       = strtoupper($this->input->post('qui_m_preparacao'));
            $resp->qui_m_qtde_gasta       = strtoupper($this->input->post('qui_m_qtde_gasta'));
            $resp->qui_t_preparacao       = strtoupper($this->input->post('qui_t_preparacao'));
            $resp->qui_t_qtde_gasta       = strtoupper($this->input->post('qui_t_qtde_gasta'));
            $resp->qui_n_preparacao       = strtoupper($this->input->post('qui_n_preparacao'));
            $resp->qui_n_qtde_gasta       = strtoupper($this->input->post('qui_n_qtde_gasta'));
            //sexta
            $resp->sex_m_preparacao       = strtoupper($this->input->post('sex_m_preparacao'));
            $resp->sex_m_qtde_gasta       = strtoupper($this->input->post('sex_m_qtde_gasta'));
            $resp->sex_t_preparacao       = strtoupper($this->input->post('sex_t_preparacao'));
            $resp->sex_t_qtde_gasta       = strtoupper($this->input->post('sex_t_qtde_gasta'));
            $resp->sex_n_preparacao       = strtoupper($this->input->post('sex_n_preparacao'));
            $resp->sex_n_qtde_gasta       = strtoupper($this->input->post('sex_n_qtde_gasta'));
            //sabado
            $resp->sab_m_preparacao       = strtoupper($this->input->post('sab_m_preparacao'));
            $resp->sab_m_qtde_gasta       = strtoupper($this->input->post('sab_m_qtde_gasta'));
           
            R::store($resp);
            
            redirect('admin/cardapio/index'.$resp->idescola, 'refresh');
        
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['t_id'] = array('id' => $resp->id);
            
            $this->data['idescola'] = array(
                'name'  => 'idescola',
                'id'    => 'idescola',
                'type'  => 'int',
                'options'  => $this->getescola(),
                'class' => 'form-control',
                'value' => $resp->idescola,
            );
            $this->data['semana_de'] = array(
                'name'  => 'semana_de',
                'id'    => 'semana_de',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $resp->semana_de,
            );
            $this->data['semana_ate'] = array(
                'name'  => 'semana_ate',
                'id'    => 'semana_ate',
                'type'  => 'date',
                'class' => 'form-control',
                'value' => $resp->semana_ate,
            );
            $this->data['tipo'] = array(
                'name'  => 'tipo',
                'id'    => 'tipo',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $resp->tipo,
            );
            //segunda
                $this->data['seg_m_preparacao'] = array(
                    'name'  => 'seg_m_preparacao',
                    'id'    => 'seg_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_m_preparacao,
                );
                $this->data['seg_m_qtde_gasta'] = array(
                    'name'  => 'seg_m_qtde_gasta',
                    'id'    => 'seg_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_m_qtde_gasta,
                );
                $this->data['seg_t_preparacao'] = array(
                    'name'  => 'seg_t_preparacao',
                    'id'    => 'seg_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_t_preparacao,
                );
                $this->data['seg_t_qtde_gasta'] = array(
                    'name'  => 'seg_t_qtde_gasta',
                    'id'    => 'seg_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_t_qtde_gasta,
                );
                $this->data['seg_n_preparacao'] = array(
                    'name'  => 'seg_n_preparacao',
                    'id'    => 'seg_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_n_preparacao,
                );
                $this->data['seg_n_qtde_gasta'] = array(
                    'name'  => 'seg_n_qtde_gasta',
                    'id'    => 'seg_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->seg_n_qtde_gasta,
                );
            //terca
                $this->data['ter_m_preparacao'] = array(
                    'name'  => 'ter_m_preparacao',
                    'id'    => 'ter_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_m_preparacao,
                );
                $this->data['ter_m_qtde_gasta'] = array(
                    'name'  => 'ter_m_qtde_gasta',
                    'id'    => 'ter_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_m_qtde_gasta,
                );
                $this->data['ter_t_preparacao'] = array(
                    'name'  => 'ter_t_preparacao',
                    'id'    => 'ter_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_t_preparacao,
                );
                $this->data['ter_t_qtde_gasta'] = array(
                    'name'  => 'ter_t_qtde_gasta',
                    'id'    => 'ter_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_t_qtde_gasta,
                );
                $this->data['ter_n_preparacao'] = array(
                    'name'  => 'ter_n_preparacao',
                    'id'    => 'ter_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_n_preparacao,
                );
                $this->data['ter_n_qtde_gasta'] = array(
                    'name'  => 'ter_n_qtde_gasta',
                    'id'    => 'ter_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->ter_n_qtde_gasta,
                );
            //quarta  
                $this->data['qua_m_preparacao'] = array(
                    'name'  => 'qua_m_preparacao',
                    'id'    => 'qua_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_m_preparacao,
                );
                $this->data['qua_m_qtde_gasta'] = array(
                    'name'  => 'qua_m_qtde_gasta',
                    'id'    => 'qua_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_m_qtde_gasta,
                );
                $this->data['qua_t_preparacao'] = array(
                    'name'  => 'qua_t_preparacao',
                    'id'    => 'qua_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_t_preparacao,
                );
                $this->data['qua_t_qtde_gasta'] = array(
                    'name'  => 'qua_t_qtde_gasta',
                    'id'    => 'qua_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_t_qtde_gasta,
                );
                $this->data['qua_n_preparacao'] = array(
                    'name'  => 'qua_n_preparacao',
                    'id'    => 'qua_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_n_preparacao,
                );
                $this->data['qua_n_qtde_gasta'] = array(
                    'name'  => 'qua_n_qtde_gasta',
                    'id'    => 'qua_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qua_n_qtde_gasta,
                ); 
            //quinta  
                $this->data['qui_m_preparacao'] = array(
                    'name'  => 'qui_m_preparacao',
                    'id'    => 'qui_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_m_preparacao,
                );
                $this->data['qui_m_qtde_gasta'] = array(
                    'name'  => 'qui_m_qtde_gasta',
                    'id'    => 'qui_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_m_qtde_gasta,
                );
                $this->data['qui_t_preparacao'] = array(
                    'name'  => 'qui_t_preparacao',
                    'id'    => 'qui_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_t_preparacao,
                );
                $this->data['qui_t_qtde_gasta'] = array(
                    'name'  => 'qui_t_qtde_gasta',
                    'id'    => 'qui_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_t_qtde_gasta,
                );
                $this->data['qui_n_preparacao'] = array(
                    'name'  => 'qui_n_preparacao',
                    'id'    => 'qui_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_n_preparacao,
                );
                $this->data['qui_n_qtde_gasta'] = array(
                    'name'  => 'qui_n_qtde_gasta',
                    'id'    => 'qui_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->qui_n_qtde_gasta,
                );
            //sexta  
                $this->data['sex_m_preparacao'] = array(
                    'name'  => 'sex_m_preparacao',
                    'id'    => 'sex_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_m_preparacao,
                );
                $this->data['sex_m_qtde_gasta'] = array(
                    'name'  => 'sex_m_qtde_gasta',
                    'id'    => 'sex_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_m_qtde_gasta,
                );
                $this->data['sex_t_preparacao'] = array(
                    'name'  => 'sex_t_preparacao',
                    'id'    => 'sex_t_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_t_preparacao,
                );
                $this->data['sex_t_qtde_gasta'] = array(
                    'name'  => 'sex_t_qtde_gasta',
                    'id'    => 'sex_t_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_t_qtde_gasta,
                );
                $this->data['sex_n_preparacao'] = array(
                    'name'  => 'sex_n_preparacao',
                    'id'    => 'sex_n_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_n_preparacao,
                );
                $this->data['sex_n_qtde_gasta'] = array(
                    'name'  => 'sex_n_qtde_gasta',
                    'id'    => 'sex_n_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sex_n_qtde_gasta,
                );
            //sabado  
                $this->data['sab_m_preparacao'] = array(
                    'name'  => 'sab_m_preparacao',
                    'id'    => 'sab_m_preparacao',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sab_m_preparacao,
                );
                $this->data['sab_m_qtde_gasta'] = array(
                    'name'  => 'sab_m_qtde_gasta',
                    'id'    => 'sab_m_qtde_gasta',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->sab_m_qtde_gasta,
                );
               
        }

        /* Load Template */
        $this->template->admin_render('admin/cardapio/edit', $this->data);
    }
    private function getescola() {
		$teste = R::findAll("escolas");
		foreach ($teste as $o) {
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
  
}//fim classe
