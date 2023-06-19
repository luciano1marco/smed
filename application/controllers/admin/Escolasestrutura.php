<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class escolasestrutura extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Estrutura da Escola");
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
                  
                  //$this->data['escolasestrutura']= R::findAll('escolasestrutura');   
                  $sql="SELECT * from escolasestrutura as ee 
                  inner join escolas as e
                  on e.id = ee.escolaid
                  
                  where escolaid = ".$id;
                  
                  //$sql="SELECT * from escolasestrutura where escolaid = ".$id; 
                  $this->data['escolasestrutura']= R::getAll($sql);  


                   /* Load Template */
                   $this->template->admin_render('admin/escolasestrutura/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Nova s", 'admin/escolasestrutura/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['idescola'] = $id;
		//var_dump($id);die;
        
        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'Escolas Estrutura';
		/* Validate form input */
		//$this->form_validation->set_rules('sala_existente', 'sala_existente', 'required');
        $this->form_validation->set_rules('idescola', 'idescola', 'required');
		  
        
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {
			//var_dump($_POST);die;
            $resp1 = R::dispense("escolasestrutura");
            $resp1->escolaid          = $id;
            $resp1->sala_existentes   = strtoupper($this->input->post('sala_existentes'));
            $resp1->sala_recursos     = strtoupper($this->input->post('sala_recursos'));
            $resp1->rampa             = strtoupper($this->input->post('rampa'));
            $resp1->sala_uso          = strtoupper($this->input->post('sala_uso'));
            $resp1->sala_multimeios   = strtoupper($this->input->post('sala_multimeios'));
            $resp1->banheiro_adaptado = strtoupper($this->input->post('banheiro_adaptado'));
            $resp1->secretaria        = strtoupper($this->input->post('secretaria'));
            $resp1->brinquedoteca     = strtoupper($this->input->post('brinquedoteca'));
            $resp1->sala_video        = strtoupper($this->input->post('sala_video'));
            $resp1->sala_direcao      = strtoupper($this->input->post('sala_direcao'));
            $resp1->biblioteca        = strtoupper($this->input->post('biblioteca'));
            $resp1->refeitorio        = strtoupper($this->input->post('refeitorio'));
            $resp1->sala_professores  = strtoupper($this->input->post('sala_professores'));
            $resp1->ginasio           = strtoupper($this->input->post('ginasio'));
            $resp1->despensa          = strtoupper($this->input->post('despensa'));
            $resp1->sala_orientacao   = strtoupper($this->input->post('sala_orientacao'));
            $resp1->quadra_aberta     = strtoupper($this->input->post('quadra_aberta'));
            $resp1->deposito          = strtoupper($this->input->post('deposito'));
            $resp1->sala_supervisao   = strtoupper($this->input->post('sala_supervisao'));
            $resp1->quadra_coberta    = strtoupper($this->input->post('quadra_coberta'));
            $resp1->auditorio         = strtoupper($this->input->post('auditorio'));
            $resp1->sala_coordenacao  = strtoupper($this->input->post('sala_coordenacao'));
            $resp1->lab_informatica   = strtoupper($this->input->post('lab_informatica'));
            $resp1->internet_oi       = strtoupper($this->input->post('internet_oi'));
            $resp1->sala_leitura      = strtoupper($this->input->post('sala_leitura'));
            $resp1->lab_ciencias      = strtoupper($this->input->post('lab_ciencias'));
            $resp1->internet_pmrg     = strtoupper($this->input->post('internet_pmrg'));
            $resp1->sala_artes        = strtoupper($this->input->post('sala_artes'));
            $resp1->amb_aprendizagem  = strtoupper($this->input->post('amb_aprendizagem'));
            $resp1->lab_matematica    = strtoupper($this->input->post('lab_matematica'));
            
           //var_dump($resp1);die;
            $idteste = R::store($resp1);

			$this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/escolas/view/'.$id, 'refresh');
		} 
                else {
                       $this->data['message'] = (validation_errors() ? validation_errors() : "");
                       
                        //----estrutura escola--------
                        
                        $this->data['sala_existentes'] = array(
                            'name'  => 'sala_existentes',
                            'id'    => 'sala_existentes',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_existentes'),
                        );
                        $this->data['sala_recursos'] = array(
                            'name'  => 'sala_recursos',
                            'id'    => 'sala_recursos',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_recursos'),
                        );
                        $this->data['rampa'] = array(
                            'name'  => 'rampa',
                            'id'    => 'rampa',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('rampa'),
                        );
                        $this->data['sala_uso'] = array(
                            'name'  => 'sala_uso',
                            'id'    => 'sala_uso',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_uso'),
                        );
                        $this->data['sala_multimeios'] = array(
                            'name'  => 'sala_multimeios',
                            'id'    => 'sala_multimeios',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_multimeios'),
                        );
                        $this->data['banheiro_adaptado'] = array(
                            'name'  => 'banheiro_adaptado',
                            'id'    => 'banheiro_adaptado',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('banheiro_adaptado'),
                        );
                        $this->data['secretaria'] = array(
                            'name'  => 'secretaria',
                            'id'    => 'secretaria',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('secretaria'),
                        );
                        $this->data['brinquedoteca'] = array(
                            'name'  => 'brinquedoteca',
                            'id'    => 'brinquedoteca',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('brinquedoteca'),
                        );
                        $this->data['sala_video'] = array(
                            'name'  => 'sala_video',
                            'id'    => 'sala_video',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_video'),
                        );
                        $this->data['sala_direcao'] = array(
                            'name'  => 'sala_direcao',
                            'id'    => 'sala_direcao',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_direcao'),
                        );
                        $this->data['biblioteca'] = array(
                            'name'  => 'biblioteca',
                            'id'    => 'biblioteca',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('biblioteca'),
                        );
                        $this->data['refeitorio'] = array(
                            'name'  => 'refeitorio',
                            'id'    => 'refeitorio',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('refeitorio'),
                        );
                        $this->data['sala_professores'] = array(
                            'name'  => 'sala_professores',
                            'id'    => 'sala_professores',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_professores'),
                        );
                        $this->data['ginasio'] = array(
                            'name'  => 'ginasio',
                            'id'    => 'ginasio',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('ginasio'),
                        );
                        $this->data['despensa'] = array(
                            'name'  => 'despensa',
                            'id'    => 'despensa',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('despensa'),
                        );
                        $this->data['sala_orientacao'] = array(
                            'name'  => 'sala_orientacao',
                            'id'    => 'sala_orientacao',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_orientacao'),
                        );
                        $this->data['quadra_aberta'] = array(
                            'name'  => 'quadra_aberta',
                            'id'    => 'quadra_aberta',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('quadra_aberta'),
                        );
                        $this->data['deposito'] = array(
                            'name'  => 'deposito',
                            'id'    => 'deposito',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('deposito'),
                        );
                        $this->data['sala_supervisao'] = array(
                            'name'  => 'sala_supervisao',
                            'id'    => 'sala_supervisao',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_supervisao'),
                        );
                        $this->data['quadra_coberta'] = array(
                            'name'  => 'quadra_coberta',
                            'id'    => 'quadra_coberta',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('quadra_coberta'),
                        );
                        $this->data['auditorio'] = array(
                            'name'  => 'auditorio',
                            'id'    => 'auditorio',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('auditorio'),
                        );
                        $this->data['sala_coordenacao'] = array(
                            'name'  => 'sala_coordenacao',
                            'id'    => 'sala_coordenacao',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_coordenacao'),
                        );
                        $this->data['lab_informatica'] = array(
                            'name'  => 'lab_informatica',
                            'id'    => 'lab_informatica',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('lab_informatica'),
                        );
                        $this->data['internet_oi'] = array(
                            'name'  => 'internet_oi',
                            'id'    => 'internet_oi',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('internet_oi'),
                        );
                        $this->data['sala_leitura'] = array(
                            'name'  => 'sala_leitura',
                            'id'    => 'sala_leitura',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_leitura'),
                        );
                        $this->data['lab_ciencias'] = array(
                            'name'  => 'lab_ciencias',
                            'id'    => 'lab_ciencias',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('lab_ciencias'),
                        );
                        $this->data['internet_pmrg'] = array(
                            'name'  => 'internet_pmrg',
                            'id'    => 'internet_pmrg',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('internet_pmrg'),
                        );
                        $this->data['sala_artes'] = array(
                            'name'  => 'sala_artes',
                            'id'    => 'sala_artes',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('sala_artes'),
                        );
                        $this->data['amb_aprendizagem'] = array(
                            'name'  => 'amb_aprendizagem',
                            'id'    => 'amb_aprendizagem',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('amb_aprendizagem'),
                        );
                        $this->data['lab_matematica'] = array(
                            'name'  => 'lab_matematica',
                            'id'    => 'lab_matematica',
                            'type'  => 'int',
                            'class' => 'form-control',
                            'value' => $this->form_validation->set_value('lab_matematica'),
                        );
                        
                    }
                    
			    /* Load Template */
			$this->template->admin_render('admin/escolasestrutura/create', $this->data);
		
	}
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/escolasestrutura', 'refresh');
		}

		$lixo = R::load("escolasestrutura", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/escolasestrutura', 'refresh');
	}
    public function edit($id) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "Estruturs da Escola", 'admin/escolasestruturas/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'Editar Estrutura da Escola';
        /* Validate form input */
        $this->form_validation->set_rules('sala_existentes', 'sala_existentes', 'required');
        
        $resp = R::findAll("escolasestrutura", 'escolaid ='.$id);
        foreach($resp as $row){ 
                $idescolaestrutura = $row['id'];
            }
        //var_dump($id1);die;

        $resp = R::load("escolasestrutura", $idescolaestrutura);
         //var_dump($resp);die;

        if ($this->form_validation->run()) {
            $resp->escolaid          = $id;
            $resp->sala_existentes   = $this->input->post('sala_existentes');
            $resp->sala_recursos     = $this->input->post('sala_recursos');
            $resp->rampa             = $this->input->post('rampa');
            $resp->sala_uso          = $this->input->post('sala_uso');
            $resp->sala_multimeios   = $this->input->post('sala_multimeios');
            $resp->banheiro_adaptado = $this->input->post('banheiro_adaptado');
            $resp->secretaria        = $this->input->post('secretaria');
            $resp->brinquedoteca     = $this->input->post('brinquedoteca');
            $resp->sala_video        = $this->input->post('sala_video');
            $resp->sala_direcao      = $this->input->post('sala_direcao');
            $resp->biblioteca        = $this->input->post('biblioteca');
            $resp->refeitorio        = $this->input->post('refeitorio');
            $resp->sala_professores  = $this->input->post('sala_professores');
            $resp->ginasio           = $this->input->post('ginasio');
            $resp->despensa          = $this->input->post('despensa');
            $resp->sala_orientacao   = $this->input->post('sala_orientacao');
            $resp->quadra_aberta     = $this->input->post('quadra_aberta');
            $resp->deposito          = $this->input->post('deposito');
            $resp->sala_supervisao   = $this->input->post('sala_supervisao');
            $resp->quadra_coberta    = $this->input->post('quadra_coberta');
            $resp->auditorio         = $this->input->post('auditorio');
            $resp->sala_coordenacao  = $this->input->post('sala_coordenacao');
            $resp->lab_informatica   = $this->input->post('lab_informatica');
            $resp->internet_oi       = $this->input->post('internet_oi');
            $resp->sala_leitura      = $this->input->post('sala_leitura');
            $resp->lab_ciencias      = $this->input->post('lab_ciencias');
            $resp->internet_pmrg     = $this->input->post('internet_pmrg');
            $resp->sala_artes        = $this->input->post('sala_artes');
            $resp->amb_aprendizagem  = $this->input->post('amb_aprendizagem');
            $resp->lab_matematica    = $this->input->post('lab_matematica');
            
            R::store($resp);

            redirect('admin/escolas', 'refresh');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            //$this->data['escolaid'] = $id;
            $this->data['t_id'] = array('id' => $idescolaestrutura);
            
            $this->data['sala_existentes'] = array(
                'name'  => 'sala_existentes',
                'id'    => 'sala_existentes',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_existentes, 
            );
            $this->data['sala_recursos'] = array(
                'name'  => 'sala_recursos',
                'id'    => 'sala_recursos',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_recursos,
            );
            $this->data['rampa'] = array(
                'name'  => 'rampa',
                'id'    => 'rampa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->rampa,
            );
            $this->data['sala_uso'] = array(
                'name'  => 'sala_uso',
                'id'    => 'sala_uso',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_uso,
            );
            $this->data['sala_multimeios'] = array(
                'name'  => 'sala_multimeios',
                'id'    => 'sala_multimeios',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_multimeios,
            );
            $this->data['banheiro_adaptado'] = array(
                'name'  => 'banheiro_adaptado',
                'id'    => 'banheiro_adaptado',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->banheiro_adaptado,
            );
            $this->data['secretaria'] = array(
                'name'  => 'secretaria',
                'id'    => 'secretaria',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->secretaria,
            );
            $this->data['brinquedoteca'] = array(
                'name'  => 'brinquedoteca',
                'id'    => 'brinquedoteca',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->brinquedoteca,
            );
            $this->data['sala_video'] = array(
                'name'  => 'sala_video',
                'id'    => 'sala_video',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_video,
            );
            $this->data['sala_direcao'] = array(
                'name'  => 'sala_direcao',
                'id'    => 'sala_direcao',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_direcao,
            );
            $this->data['biblioteca'] = array(
                'name'  => 'biblioteca',
                'id'    => 'biblioteca',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->biblioteca,
            );
            $this->data['refeitorio'] = array(
                'name'  => 'refeitorio',
                'id'    => 'refeitorio',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->refeitorio,
            );
            $this->data['sala_professores'] = array(
                'name'  => 'sala_professores',
                'id'    => 'sala_professores',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_professores,
            );
            $this->data['ginasio'] = array(
                'name'  => 'ginasio',
                'id'    => 'ginasio',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->ginasio,
            );
            $this->data['despensa'] = array(
                'name'  => 'despensa',
                'id'    => 'despensa',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->despensa,
            );
            $this->data['sala_orientacao'] = array(
                'name'  => 'sala_orientacao',
                'id'    => 'sala_orientacao',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_orientacao,
            );
            $this->data['quadra_aberta'] = array(
                'name'  => 'quadra_aberta',
                'id'    => 'quadra_aberta',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->quadra_aberta,
            );
            $this->data['deposito'] = array(
                'name'  => 'deposito',
                'id'    => 'deposito',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->deposito,
            );
            $this->data['sala_supervisao'] = array(
                'name'  => 'sala_supervisao',
                'id'    => 'sala_supervisao',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_supervisao,
            );
            $this->data['quadra_coberta'] = array(
                'name'  => 'quadra_coberta',
                'id'    => 'quadra_coberta',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->quadra_coberta,
            );
            $this->data['auditorio'] = array(
                'name'  => 'auditorio',
                'id'    => 'auditorio',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->auditorio,
            );
            $this->data['sala_coordenacao'] = array(
                'name'  => 'sala_coordenacao',
                'id'    => 'sala_coordenacao',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_coordenacao,
            );
            $this->data['lab_informatica'] = array(
                'name'  => 'lab_informatica',
                'id'    => 'lab_informatica',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->lab_informatica,
            );
            $this->data['internet_oi'] = array(
                'name'  => 'internet_oi',
                'id'    => 'internet_oi',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->internet_oi,
            );
            $this->data['sala_leitura'] = array(
                'name'  => 'sala_leitura',
                'id'    => 'sala_leitura',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_leitura,
            );
            $this->data['lab_ciencias'] = array(
                'name'  => 'lab_ciencias',
                'id'    => 'lab_ciencias',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->lab_ciencias,
            );
            $this->data['internet_pmrg'] = array(
                'name'  => 'internet_pmrg',
                'id'    => 'internet_pmrg',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->internet_pmrg,
            );
            $this->data['sala_artes'] = array(
                'name'  => 'sala_artes',
                'id'    => 'sala_artes',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->sala_artes,
            );
            $this->data['amb_aprendizagem'] = array(
                'name'  => 'amb_aprendizagem',
                'id'    => 'amb_aprendizagem',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->amb_aprendizagem,
            );
            $this->data['lab_matematica'] = array(
                'name'  => 'lab_matematica',
                'id'    => 'lab_matematica',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $resp->lab_matematica,
            );

              }

            /* Load Template */
            $this->template->admin_render('admin/escolasestrutura/edit', $this->data);
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
