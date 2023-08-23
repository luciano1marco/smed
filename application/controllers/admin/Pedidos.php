<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pedidos extends Admin_Controller {
    
    public function __construct()  { 
        parent::__construct();
       
       /* Title Page :: Common */
		$this->page_title->push("Pedidos");
		$this->data['pagetitle'] = $this->page_title->show();
       
        /* Error Delimiter */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

		/* FA Icons */
		//$this->fa_icons = getFontAwesomeIcons();

        /* Anchor */
		$this->anchor = 'admin/'.$this->router->class;
      
    }
    public function index($id, $at = null){
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                { redirect('auth/login', 'refresh'); }
            else
                { 
                    if($at == null){
                        $teste = "where  substring(mes_ano, 1,4) = YEAR(CURRENT_TIMESTAMP) and    idescola  = ".$id;
                    }else{
                        $teste = "where idescola  = ".$id; 
                    }   
                    
                  /* Breadcrumbs */
                  $this->data['breadcrumb'] = $this->breadcrumbs->show();
                  /* Data */
                  $this->data['error'] = NULL;
                
                  //sql para mostrar a escola selecionada  
                  $sqlescola = "SELECT * from escolas where id = ".$id;
                  
                  $this->data['escolas']= R::getAll($sqlescola); 
                  //$this->data['pedidos']= R::findAll('pedidos'); 
                  $sql ="SELECT  *
                           from pedidos
                            ".$teste;
                  $this->data['pedidos']= R::getAll($sql);    
                   /* Load Template */
                   $this->template->admin_render('admin/pedidos/index', $this->data);
                }
	}
    public function create($id) {
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "pedidos", 'admin/pedidos/create');
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
        $this->data['texto_create'] = 'Novo pedidos';
		/* Validate form input */
		$this->form_validation->set_rules('periodo', 'periodo', 'required');
         
        /* cria a tabela editais com seus campos */
		if ($this->form_validation->run()) {

           	$resp = R::dispense("pedidos");
                $resp->idescola  = $idescola;
                $resp->mes_ano   = $mes_ano;
                $resp->periodo   = strtoupper($this->input->post('periodo'));
            R::store($resp);
            
            $idinserido = $resp->id; //pega o id inserido na tabela pedidos 
            $diasdomes = date('t');//pega numero de dias do mes atual
            //pea os dados do input
            $generos        = $this->input->post(['generos']);
           // $numero         = $this->input->post(['numero']);
            $quantidade     = $this->input->post(['quantidade']);
            //separa os dados do input 
            foreach($generos        as $ge){}
            //foreach($numero         as $nu){}
            foreach($quantidade     as $qu){}
            //grava os dados 
            for($i=0;$i<$diasdomes;$i++){
                $resp1 = R::dispense("pedidosdia");
                    $resp1->idpedidos = $idinserido;
                   // $resp1->dia           = $i + 1;
                    $resp1->generos       = $ge[$i];
                    $resp1->numero        = $i + 1;
                    $resp1->quantidade    = $qu[$i];
                R::store($resp1); 
            }
			
            $this->session->set_flashdata('message', "Dados gravados");
			redirect('admin/pedidos/index/'.$id, 'refresh');
		} 
        else{
                $this->data['message'] = (validation_errors() ? validation_errors() : "");
                //dados pedidos    
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
                $this->data['periodo'] = array(
                    'name'  => 'periodo',
                    'id'    => 'periodo',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('periodo'),
                );
                $this->data['idpedidos'] = array(
                    'name'  => 'idpedidos[]',
                    'id'    => 'idpedidos[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('idpedidos'),		
                );
                $this->data['dia'] = array(
                    'name'  => 'dia[]',
                    'id'    => 'dia[]',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $this->form_validation->set_value('dia'),
                );		
                $this->data['generos'] = array(
                    'name'  => 'generos[]',
                    'id'    => 'generos[]',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $this->form_validation->set_value('generos'),
                );	
                $this->data['numero'] = array(
                    'name'  => 'numero[]',
                    'id'    => 'numero[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' =>$this->form_validation->set_value('numero'),
                );	
                $this->data['quantidade'] = array(
                    'name'  => 'quantidade[]',
                    'id'    => 'quantidade[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $this->form_validation->set_value('quantidade'),
                );	
                //fim dados pedidos    
                //dados pedidos dia    
        }
                    
			/* Load Template */
			$this->template->admin_render('admin/pedidos/create', $this->data);
		
	}
    public function edit($id) {    
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "pedidos", 'admin/pedidos/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'pedidos';
        /* Validate form input */
        $this->form_validation->set_rules('generos', 'generos', 'required');
        
        $resp = R::load("pedidosdia", $id);

        $this->data['iddemo'] = $resp->idpedidos;
        if ($this->form_validation->run()) {
            $resp->idpedidos=$resp->idpedidos;
            $resp->generos        = strtoupper($this->input->post('generos'));
            $resp->nuemro         = strtoupper($this->input->post('numero'));
            $resp->quantidade     = strtoupper($this->input->post('quantidade'));
            
            R::store($resp);

            redirect('admin/pedidos/view/'.$resp->idpedidos, 'refresh');
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
            $this->data['generos'] = array(
                'name'  => 'generos',
                'id'    => 'generos',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $resp->generos,
            );	
            $this->data['numero'] = array(
                'name'  => 'numero',
                'id'    => 'numero',
                'type'  => 'text',
                'class' => 'form-control',			
                'value' => $resp->numero,
            );	
            $this->data['quantidade'] = array(
                'name'  => 'quantidade',
                'id'    => 'quantidade',
                'type'  => 'text',
                'class' => 'form-control'	,		
                'value' => $resp->quantidade,
            );	
        }

            /* Load Template */
            $this->template->admin_render('admin/pedidos/edit', $this->data);
    }
    public function deleteyes($id)  {
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}

		if (!isset($id) || $id == null) {
			redirect('admin/pedidos', 'refresh');
		}
   
		$lixo = R::load("pedidos", $id);
        $idescola = $lixo->idescola;//pega idescola para redirecionar a pagina
        $id= $lixo->id;//pega id pedidos da tabela pedidos 
        R::trash($lixo);//deleta da tabela pedidos
        
        $lixo1 = R::findAll("pedidosdia",'idpedidos ='. $id);
        R::trashAll($lixo1);//deleta da tabela pedidosdia
       
		$this->session->set_flashdata('message', "Itens removidos");
        redirect('admin/pedidos/index/'.$idescola, 'refresh');
		
	}
    public function view($id) {   
        if ( ! $this->ion_auth->logged_in() ) 
            { return show_error('voce não esta logado'); }
            
        $this->data['id'] =$id;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, "pedidos", 'admin/pedidos/view');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
       
        $tables = $this->config->item('tables', 'ion_auth');
        /* Nome do Botão Criar do INDEX */
        $this->data['texto_edit'] = 'Editar pedidos';
        /* Validate form input */
        $this->form_validation->set_rules('periodo', 'periodo', 'required');
        
        //variaveis utilizadas
        //$diasdomes = date('t');//pega numero de dias do mes atual
        $resp = R::load("pedidos", $id);
        $this->data['idescola'] = $resp->idescola;
       
        // $resp1 = R::load("pedidosdia", "idpedidos = " .$resp->id);
        $sql="SELECT * from pedidosdia where idpedidos = ".$id;
        $resp1 = R::getAll($sql);
       //var_dump($resp1);die;
        $this->data['demodia']= R::getAll($sql);
       
        if ($this->form_validation->run()) {

            $mes = $this->input->post('mes');
            $ano = date('Y');
            $mes_ano = $ano.'-'.$mes;
            //var_dump($resp->idescola);die;
                $resp->idescola  = $resp->idescola;
                $resp->mes_ano   = $mes_ano;
                $resp->periodo   = strtoupper($this->input->post('periodo'));
            R::store($resp);
           
            redirect('admin/pedidos/index/'.$resp->idescola, 'refresh');
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
                $this->data['periodo'] = array(
                    'name'  => 'periodo',
                    'id'    => 'periodo',
                    'type'  => 'text',
                    'class' => 'form-control',
                    'value' => $resp->periodo,
                );
            //fim dados demosntrativo    
            $ultimo = date('d', mktime(0, 0, 0, $mes+1, 0, $ano ));
            
            $diasdomes = date($mes);//pega numero de dias do mes atual
                
            for($i=0;$i<$diasdomes;$i++){
            //var_dump($resp1[$i]);
           
            $this->data['generos'] = array(
                    'name'  => 'generos',
                    'id'    => 'generos',
                    'type'  => 'int',
                    'class' => 'form-control',	
                    'value' => $resp1[$i]['generos'],
                );
                
                $this->data['numero'] = array(
                    'name'  => 'numero[]',
                    'id'    => 'numero[]',
                    'type'  => 'text',
                    'class' => 'form-control',			
                    'value' => $resp1[$i]['numero'],
                );	
                
                $this->data['quantidade'] = array(
                    'name'  => 'quantidade[]',
                    'id'    => 'quantidade[]',
                    'type'  => 'text',
                    'class' => 'form-control'	,		
                    'value' => $resp1[$i]['quantidade'],
                );	
                
            }//die;

         }//fim else
            /* Load Template */
        $this->template->admin_render('admin/pedidos/view', $this->data);
    }//fim function
    
    private function getmes(){
        $teste = R::findAll("mes");
		foreach ($teste as $o) {
			$op[$o->id] = $o->descricao;
		}
		return $op;
    }

}//fim classe