<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class atendimento extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Atendimento");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
    public function index($id,$at = null){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                 if($at == null){
                    $teste = "where  substring(mes_ano, 1,4) = YEAR(CURRENT_TIMESTAMP) and    idescola  = ".$id;
                 }else{
                    $teste = "where idescola  = ".$id; 
                 }  

                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  $this->data['escolas']= R::getAll($sqlescola); 
                  //$this->data['atendimento']= R::findAll('atendimento');   
                  $sql ="SELECT  *
                           from atendimento
                            ".$teste;
                 
                 $this->data['atendimento']= R::getAll($sql); 
                  //mostra todos da tabela atendimento
                  
                  
                  
                   /* Load Template */
                   $this->template->admin_render('admin/atendimento/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "atendimento", 'admin/atendimento/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
        //variaveis utilizadas
        $idescola = $id;
        $this->data['idescola1'] = $idescola;
        $diasdomes = date('t');

        $mes   = strtoupper($this->input->post('mes'));
        $ano = date('Y');
        $mes_ano = $ano.'-'.$mes;
                
        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_create'] = 'atendimento';
		/* Validate form input */
		$this->form_validation->set_rules('nro_alunos', 'nro_alunos', 'required');
                
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {

           	$resp = R::dispense("atendimento");
                $resp->idescola  = $idescola;
                $resp->mes_ano   = $mes_ano;
                $resp->nro_alunos= strtoupper($this->input->post('nro_alunos'));
                $resp->manha     = strtoupper($this->input->post('manha'));
                $resp->tarde     = strtoupper($this->input->post('tarde'));
                $resp->noite     = strtoupper($this->input->post('noite'));
                $resp->integral  = strtoupper($this->input->post('integral'));
                $resp->eja       = strtoupper($this->input->post('eja'));
                
            R::store($resp);
            
            $idinserido = $resp->id; //pega o id inserido na tabela atendimento 
            $diasdomes = date('t');//pega numero de dias do mes atual
            //pega os dados do input
            $alunos_atendidos  = $this->input->post(['alunos_atendidos']);
            $repeticoes        = $this->input->post(['repeticoes']);
            //separa os dados do input 
            foreach($alunos_atendidos  as $aa){}
            foreach($repeticoes        as $re){}
            //grava os dados 
            for($i=0;$i<$diasdomes;$i++){
                $resp1 = R::dispense("atendimentodia");
                    $resp1->idatendimento     = $idinserido;
                    $resp1->dia               = $i + 1;
                    $resp1->alunos_atendidos  = $aa[$i];
                    $resp1->repeticoes        = $re[$i];
                   R::store($resp1); 
            }
			
            $this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/atendimento/index/'.$id, 'refresh');
		} 
        else{
                $this->data['message'] = (validation_errors() ? validation_errors() : "");
                //dados atendimento    
                $this->data['idescola'] = array(
                    'name'  => 'idescola',
                    'id'    => 'idescola',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('idescola'),
                );
                $this->data['mes'] = array(
                    'name'  => 'mes',
                    'id'    => 'mes',
                    'type'  => 'text',
                    'options'  => $this->getmes(),
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('mes'),
                );
                $this->data['nro_alunos'] = array(
                    'name'  => 'nro_alunos',
                    'id'    => 'nro_alunos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('nro_alunos'),
                );
                $this->data['manha'] = array(
                    'name'  => 'manha',
                    'id'    => 'manha',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('manha'),
                );
                $this->data['tarde'] = array(
                    'name'  => 'tarde',
                    'id'    => 'tarde',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('tarde'),
                );
                $this->data['noite'] = array(
                    'name'  => 'noite',
                    'id'    => 'noite',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('noite'),
                );
                $this->data['integral'] = array(
                    'name'  => 'integral',
                    'id'    => 'integral',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('integral'),
                );
                $this->data['eja'] = array(
                    'name'  => 'eja',
                    'id'    => 'eja',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('eja'),
                );
               
                $this->data['idatendimento'] = array(
                    'name'  => 'idatendimento[]',
                    'id'    => 'idatendimento[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('idatendimento'),		
                );
                $this->data['dia'] = array(
                    'name'  => 'dia[]',
                    'id'    => 'dia[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('dia'),
                );		
                $this->data['alunos_atendidos'] = array(
                    'name'  => 'alunos_atendidos[]',
                    'id'    => 'alunos_atendidos[]',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('alunos_atendidos'),
                );	
                $this->data['repeticoes'] = array(
                    'name'  => 'repeticoes[]',
                    'id'    => 'repeticoes[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $this->form_validation->set_value('repeticoes'),
                );	
                               			
        }
                    
			/* Load Template */
			$this->template->admin_render('admin/atendimento/create', $this->data);
		
	}
    public function edit($id) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "atendimento", 'admin/atendimento/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'atendimento';
        /* Validate form input */
        $this->form_validation->set_rules('alunos_atendidos', 'alunos_atendidos', 'required');
        
        $resp = R::load("atendimentodia", $id);

        $this->data['iddemo'] = $resp->idatendimento;
        if ($this->form_validation->run()) {
            $resp->idatendimento  = $resp->idatendimento;
            $resp->alunos_atendidos = strtoupper($this->input->post('alunos_atendidos'));
            $resp->repeticoes       = strtoupper($this->input->post('repeticoes'));
          
            R::store($resp);

            redirect('admin/atendimento/view/'.$resp->idatendimento, 'refresh');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['t_id'] = array('id' => $resp->id);
            
            $this->data['dia'] = array(
                'name'  => 'dia',
                'id'    => 'dia',
                'type'  => 'int',
                'class' => 'form-control',	
                'value' => $resp->dia,
            );		
            $this->data['alunos_atendidos'] = array(
                'name'  => 'alunos_atendidos',
                'id'    => 'alunos_atendidos',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $resp->alunos_atendidos,
            );	
            $this->data['repeticoes'] = array(
                'name'  => 'repeticoes',
                'id'    => 'repeticoes',
                'type'  => 'text',
                'class' => 'form-control',			
                'value' => $resp->repeticoes,
            );	
        }

            /* Load Template */
            $this->template->admin_render('admin/atendimento/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/atendimento', 'refresh');
		}
   
		$lixo = R::load("atendimento", $id);
        $idescola = $lixo->idescola;//pega idescola para redirecionar a pagina
        $id= $lixo->id;//pega id atendimento da tabela atendimento 
        R::trash($lixo);//deleta da tabela atendimento
        
        $lixo1 = R::findAll("atendimentodia",'idatendimento ='. $id);
        R::trashAll($lixo1);//deleta da tabela atendimentodia
       
		$this->session->set_flashdata('message', "Itens removidos");
        redirect('admin/atendimento/index/'.$idescola, 'refresh');
		
	}
    public function view($id) {   
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "atendimento", 'admin/atendimento/view');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'Editar atendimento';
        /* Validate form input */
        $this->form_validation->set_rules('nro_alunos', 'nro_alunos', 'required');
        
        //variaveis utilizadas
        //$diasdomes = date('t');//pega numero de dias do mes atual
        $resp = R::load("atendimento", $id);
        $this->data['idescola'] = $resp->idescola;
       
        // $resp1 = R::load("atendimentodia", "idatendimento = " .$resp->id);
        $sql="SELECT * from atendimentodia where idatendimento = ".$id;
        $resp1 = R::getAll($sql);
        
        $this->data['demodia']= R::getAll($sql);
        
        if ($this->form_validation->run()) {

            $mes = $this->input->post('mes');
            $mes1 = explode('-',$resp->mes_ano);
            $ano = $mes1[0];

            //$ano = date('Y');
            $mes_ano = $ano.'-'.$mes;
            //var_dump($resp->idescola);die;
                $resp->idescola  = $resp->idescola;
                $resp->mes_ano   = $mes_ano;
                $resp->nro_alunos= strtoupper($this->input->post('nro_alunos'));
                $resp->manha     = strtoupper($this->input->post('manha'));
                $resp->tarde     = strtoupper($this->input->post('tarde'));
                $resp->noite     = strtoupper($this->input->post('noite'));
                $resp->integral  = strtoupper($this->input->post('integral'));
                $resp->eja       = strtoupper($this->input->post('eja'));
               
            R::store($resp);
           
            redirect('admin/atendimento/index/'.$resp->idescola, 'refresh');
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");
                //para mostrar o mes que esta no banco
                $mes1 = explode('-',$resp->mes_ano);
                $mes = $mes1[1];
                $ano = $mes1[0];
            $this->data['ano'] = $ano;
                $this->data['idescola'] = array(
                    'name'  => 'idescola',
                    'id'    => 'idescola',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->idescola,
                );
                $this->data['mes'] = array(
                    'name'  => 'mes',
                    'id'    => 'mes',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'options'  => $this->getmes(),
                    'selected' => $mes,
                );
                $this->data['nro_alunos'] = array(
                    'name'  => 'nro_alunos',
                    'id'    => 'nro_alunos',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->nro_alunos,
                );
                $this->data['manha'] = array(
                    'name'  => 'manha',
                    'id'    => 'manha',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->manha,
                );
                $this->data['tarde'] = array(
                    'name'  => 'tarde',
                    'id'    => 'tarde',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->tarde,
                );
                $this->data['noite'] = array(
                    'name'  => 'noite',
                    'id'    => 'noite',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->noite,
                );
                $this->data['integral'] = array(
                    'name'  => 'integral',
                    'id'    => 'integral',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->integral,
                );
                $this->data['eja'] = array(
                    'name'  => 'eja',
                    'id'    => 'eja',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->eja,
                );
               
            //fim dados demosntrativo 
            $ultimo = date('d', mktime(0, 0, 0, $mes+1, 0, $ano ));
            $diasdomes = date($mes);//pega numero de dias do mes atual
            
            for($i=0;$i<$diasdomes;$i++){
                       
            $this->data['alunos_atendidos'] = array(
                    'name'  => 'alunos_atendidos',
                    'id'    => 'alunos_atendidos',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $resp1[$i]['alunos_atendidos'],
                );
                
                $this->data['repeticoes'] = array(
                    'name'  => 'repeticoes[]',
                    'id'    => 'repeticoes[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $resp1[$i]['repeticoes'],
                );	
                $this->data['dia'] = array(
                    'name'  => 'dia[]',
                    'id'    => 'dia[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $resp1[$i]['dia'],
                );
            }//die;

         }//fim else
            /* Load Template */
        $this->template->admin_render('admin/atendimento/view', $this->data);
    }//fim function
    private function getmes(){
        $teste = R::findAll("mes");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
    }

}//fim classe