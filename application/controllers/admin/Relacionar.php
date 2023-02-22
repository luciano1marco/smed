<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class relacionar extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();

         /* Title Page :: Common */
         $this->page_title->push(lang('Relacionar'));
         $this->data['pageicon'] = 'ul-list';
         $this->data['pagetitle'] = $this->page_title->show();
 
         $this->anchor = 'admin/' . $this->router->class;
 
         $this->load->helper('utilidades');
 
         $this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');
      
     
    }
    public function index(){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                  
                  $sql="    SELECT r.id, p.nome,r.ativo, c.descricao, r.dt_inicio,r.dt_final
                            FROM relacionar as r
                  
                            inner join pessoas as p
                            on p.id = r.id_socio
                            
                            inner join cargos as c
                            on c.id = r.id_cargo
                            
                             ";  

                    $this->data['relaciona'] = R::getAll($sql);
                  
                   /* Load Template */
                   $this->template->admin_render('admin/relacionar/index', $this->data);
                }
	}
    public function create() {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova Área", 'admin/relacionar/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['texto_create'] = 'Relacionar Cargo';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('id_socio', 'id_socio', 'required');
                
                    /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			$result = R::dispense("relacionar");
			$result->id_socio = $this->input->post('id_socio');
            $result->id_cargo = $this->input->post('id_cargo');
            $result->dt_inicio = $this->input->post('dt_inicio');
            $result->dt_final = $this->input->post('dt_final');
                        
			R::store($result);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/relacionar', 'refresh');
		} 
                else {
                    $this->data['message'] = (validation_errors() ? validation_errors() : "");

                    $this->data['id_socio'] = array(
                        'name'  => 'id_socio',
                        'id'    => 'id_socio',
                        'options' => $this->getsocio(),
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('id_socio'),
                    );
                    $this->data['id_cargo'] = array(
                        'name'  => 'id_cargo',
                        'id'    => 'id_cargo',
                        'options' => $this->getcargo(),
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('id_cargo'),
                    );
                    $this->data['dt_inicio'] = array(
                        'name'  => 'dt_inicio',
                        'id'    => 'dt_inicio',
                        'type'  => 'date',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('dt_inicio'),
                    );
                    $this->data['dt_final'] = array(
                        'name'  => 'dt_final',
                        'id'    => 'dt_final',
                        'type'  => 'date',
                        'class' => 'form-control',
                        'value' => $this->form_validation->set_value('dt_final'),
                    );
                }
                    
			/* Load Template */
			$this->template->admin_render('admin/relacionar/create', $this->data);
		
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
            
            $this->data['id'] =$id;
               
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Editar", 'admin/relacionar/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            
            /* Validate form input */
            $this->form_validation->set_rules('id_socio', 'id_socio', 'required');
            
            $ti = R::load("relacionar", $id);

            if ($this->form_validation->run()) {
                $ti->id_socio = $this->input->post('id_socio');
                $ti->id_cargo = $this->input->post('id_cargo');
                
                R::store($ti);

                redirect('admin/relacionar', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $ti->id);
               
                $this->data['id_socio'] = array(
                    'name'  => 'id_socio',
                    'id'    => 'id_socio',
                    'selected'=>$ti->id_socio,
                    'options' => $this->getsocio(),
                    'class' => 'form-control',
                    'value' => $ti->id_socio,
                );
                $this->data['id_cargo'] = array(
                    'name'  => 'id_cargo',
                    'id'    => 'id_cargo',
                    'selected'=>$ti->id_cargo,
                    'options' => $this->getcargo(),
                    'class' => 'form-control',
                    'value' => $ti->id_cargo,
                );
                $this->data['dt_inicio'] = array(
                    'name'  => 'dt_inicio',
                    'id'    => 'dt_inicio',
                    'type'  => 'date',
                    'class' => 'form-control',
                    'value' => $ti->dt_inicio,
                );
                $this->data['dt_final'] = array(
                    'name'  => 'dt_final',
                    'id'    => 'dt_final',
                    'type'  => 'date',
                    'class' => 'form-control',
                    'value' => $ti->dt_final,
                );
                                       
            }

                /* Load Template */
                $this->template->admin_render('admin/relacionar/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/relacionar', 'refresh');
		}

		$lixo = R::load("relacionar", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/relacionar', 'refresh');
	}
    //-----Gets---------------
    public function getsocio(){
        $sql = "SELECT * FROM pessoas";

        $options = array("0" => "Selecione Sócio");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['nome'];           
        }
		return $options;
    }
	public function getcargo(){
        $sql = "SELECT * FROM cargos";

        $options = array("0" => "Selecione Cargo");
                
        $result = R::getAll($sql);        

		foreach ($result as $r) {   
            $options[$r['id']] = $r['descricao'];           
        }
		return $options;
    }
    //----active e desactive---
    function activate($id) {
		$id = (int) $id;
	
		$item = R::load("relacionar", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu ativado");
		redirect('admin/relacionar', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("relacionar", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Menu desativado");		
		redirect('admin/relacionar', 'refresh');
	}


}//fim da classe
