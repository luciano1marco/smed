<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class escolasseries extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Series");
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
                  
                  $this->data['escolasseries']= R::findAll('escolasseries');   

                   /* Load Template */
                   $this->template->admin_render('admin/escolas', $this->data);
                }
	}
    public function create($id) {
       	/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova serie", 'admin/escolasseries/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Escolas Serie';

        $this->data['idescola'] = $id;
		/* Validate form input */
        //$this->data['series']= R::findAll('escolasseries');   
        $sql="SELECT    es.id, es.id_escola,es.id_serie,s.id as serieid,s.nome

                        from escolasseries as es
                    
                        inner join series as s
                        on s.id = es.id_serie  
                
                        where es.id_escola =".$id;

        $this->data['escseries']= R::getAll($sql); 

        $this->form_validation->set_rules('idescola', 'idescola', 'required');
		
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
            //var_dump($_POST);
            $series = $this->input->post('serie'); 
            if(isset($series)) {
                foreach ($series as $row ) {
                   // var_dump($row);
                   // R::fancyDebug(true);
                  // $lixo = R::findAll("escolasseries", 'id_escola ='.$id);
                  // R::trashAll($lixo);

                    $resp = R::dispense("escolasseries");
                    $resp->id_escola = $id;
                    $resp->id_serie = $row;
                    $id_serie = R::store($resp);
                   // die;
                }
            } 

			$this->session->set_flashdata('message', "Dados gravados");
			//var_dump($resp->id_escola);die;
            redirect('admin/escolas/view/'. $id, 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");
                       
                        //----escola serie --------
                        $this->data['serie'] = array(
                            'name'  => 'serie',
                            'id'    => 'serie',
                            'type'  => 'checkbox',
                            'options'  => $this->getserie(),
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('serie'),
                        );

                       // foreach ($series as $c){                    
                       //     $this->data['nome']['selected'] = $c['nome'];
                       // }
    
                    }
                    
			    /* Load Template */
			$this->template->admin_render('admin/escolasseries/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/escolasseries', 'refresh');
		}

		$lixo = R::load("escolasseries", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/escolas', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;

            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "Anos/Niveis", 'admin/escolasseries/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'Anos/Niveis';
            /* Validate form input */
            $this->form_validation->set_rules('descricao', 'descricao', 'required');
            
            $resp = R::load("escolasseries", $id);

            if ($this->form_validation->run()) {
                $resp->id_escola  = $id;
                $resp->id_serie   = strtoupper($this->input->post('id_serie'));
               
                R::store($resp);

                redirect('admin/escolasseries', 'refresh');
            } else {
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : "");

                $this->data['t_id'] = array('id' => $resp->id);
                
                    $this->data['id_escola'] = array(
                        'name'  => 'id_escola',
                        'id'    => 'id_escola',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->id_escola,
                    );
                    $this->data['id_serie'] = array(
                        'name'  => 'id_serie',
                        'id'    => 'id_serie',
                        'type'  => 'text',
                        'class' => 'form-control',
                        'value' => $resp->id_serie,
                    );
                }

                /* Load Template */
                $this->template->admin_render('admin/escolasseries/edit', $this->data);
    }
    public function apagarserie($id) {
	
		$ae = R::load("escolasseries", $id);
        //var_dump($ae);die;        
		$etapa = R::load("escolasseries", $ae->id_escola);//para fazer o refresh
        $idesc = $ae->id_escola;
		R::trash($ae);
        //var_dump($idesc);die;
		redirect('admin/escolasseries/create/'. $idesc, 'refresh');
	}
    //--Gets-----------------------------------
   
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
			$op[$o->id] = $o->nome;
		}
		return $op;
	}
    //--

}//fim classe
