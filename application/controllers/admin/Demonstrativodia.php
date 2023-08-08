<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class demonstrativodia extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Demonstrativo dia");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
   
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/demonstrativo', 'refresh');
		}

		$lixo = R::load("demonstrativo", $id);
		R::trash($lixo);

		$this->session->set_flashdata('message', "Item removido");

		redirect('admin/demonstrativo', 'refresh');
	}
    public function edit($id) {    
            if ( ! $this->ion_auth->logged_in() ) 
                { return show_error('voce não esta logado'); }
                
            $this->data['id'] =$id;
        var_dump($id);die;
            /* Breadcrumbs */
            $this->breadcrumbs->unshift(2, "demonstrativodia", 'admin/demonstrativodia/edit');
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
           
            $tables = $this->config->item('tables', 'ion_auth');
            /* Nome do Botão Criar do INDEX */
            $this->data['texto_edit'] = 'demonstrativo dia';
            /* Validate form input */
            $this->form_validation->set_rules('generos', 'generos', 'required');
            
            //variaveis utilizadas
            //$diasdomes = date('t');//pega numero de dias do mes atual
            $resp1 = R::load("demonstrativodia", $id);
                        
            if ($this->form_validation->run()) {
                    //$resp->idescola  = $id;
                    $resp1->dia            = $resp1->dia;
                    $resp1->generos        = strtoupper($this->input->post('generos'));
                    $resp1->validade       = strtoupper($this->input->post('validade'));
                    $resp1->saldo_anterior = strtoupper($this->input->post('saldo_anterior'));
                    $resp1->nro_guia       = strtoupper($this->input->post('nro_guia'));
                    $resp1->entrada        = strtoupper($this->input->post('entrada'));
                    $resp1->saida          = strtoupper($this->input->post('saida'));
                    $resp1->saldo          = strtoupper($this->input->post('saldo'));
                R::store($resp1);
                
                //redirect('admin/demonstrativo/index/'.$idescola, 'refresh');
            } else {
                $this->data['message'] = (validation_errors() ? validation_errors() : "");
                
                    $this->data['generos'] = array(
                        'name'  => 'generos',
                        'id'    => 'generos',
                        'type'  => 'int',
                        'class' => 'form-control',	
                        'value' => $resp1->generos,
                    );
                    
                    $this->data['validade'] = array(
                        'name'  => 'validade',
                        'id'    => 'validade',
                        'type'  => 'text',
                        'class' => 'form-control',			
                        'value' => $resp1->validade,
                    );	
                    $this->data['dia'] = array(
                        'name'  => 'dia',
                        'id'    => 'dia',
                        'type'  => 'int',
                        'class' => 'form-control',	
                        'value' => $resp1->dia,
                    );
                   
                    $this->data['entrada'] = array(
                        'name'  => 'entrada',
                        'id'    => 'entrada',
                        'type'  => 'text',
                        'class' => 'form-control'	,		
                        'value' => $resp1->entrada,
                    );	
                    $this->data['saldo_anterior'] = array(
                        'name'  => 'saldo_anterior',
                        'id'    => 'saldo_anterior',
                        'type'  => 'text',
                        'class' => 'form-control',			
                        'value' => $resp1->saldo_anterior,
                    );	
                    $this->data['nro_guia'] = array(
                        'name'  => 'nro_guia',
                        'id'    => 'nro_guia',
                        'type'  => 'text',
                        'class' => 'form-control',			
                        'value' => $resp1->nro_guia,
                    );	
                    $this->data['saida'] = array(
                        'name'  => 'saida',
                        'id'    => 'saida',
                        'type'  => 'text',
                        'class' => 'form-control'	,		
                        'value' => $resp1->saida,
                    );	
                    $this->data['saldo'] = array(
                        'name'  => 'saldo',
                        'id'    => 'saldo',
                        'type'  => 'text',
                        'class' => 'form-control',			
                        'value' => $resp1->saldo,
                    );
               
             }//fim else
                /* Load Template */
            
        $this->template->admin_render('admin/demonstrativodia/edit');
    }//fim function
    
    private function getmes(){
        $teste = R::findAll("mes");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
    }

}//fim classe