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

        $this->load->library('geradoc');

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

    public function imprimirturmas($id) {
        $sqlescola = "SELECT * from escolas where id = ".$id;
        $escolas= R::getAll($sqlescola); 
        
        $sqltotal = "SELECT   SUM(t.capacidade)   as tcapacidade,
                                        SUM(t.capacidade_p) as tcapacidade_p,
                                        SUM(t.regular)      as tregular,
                                        SUM(t.pnesl)        as tpnesl,
                                        SUM(t.pnecl)        as tpnecl,
                                        SUM(t.matriculas)   as tmatriculas,
                                        SUM(t.capacidade_p - t.matriculas)   as trestantes
        
                            from turmas as t
                            where t.idescola = ".$id;

        $turmatotal = R::getAll($sqltotal); 
        
        $sql ="SELECT   t.id as idturma,t.descricao as descturma,t.capacidade,t.capacidade_p,
                        t.regular,t.pnesl,t.pnecl,t.matriculas,t.idserie,
                        t.dt_cad,t.user_cad,tu.id,t.idescola,
                        tu.descricao as descturno,
                        u.username as usuario
                from turmas as t

                inner join turnos as tu
                on tu.id = t.idturno

                inner join users as u
                on u.id = t.user_cad

                where t.idescola  = '$id'
                ORDER BY `descturma` ASC;";
        
        $turmas= R::getAll($sql);   
        //var_dump($turmas);die;
        $cont = count($turmas) ;
        //var_dump($escolas[0]['nome']);die;
        //$img_path = 'http://localhost/smed/public/images/brasao.jpg'; // converte a imagem em base64 
        //$img_data = base64_encode(file_get_contents($img_path)); 

        $html = '
        <html>    
            <head>
                <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                <title>SMEd</title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <style>
                    *{font-family:Times New Roman, Tinos, serif;}
                    @import url("https://fonts.googleapis.com/css2?family=Tinos&display=swap");
                    @page { 
                        margin: 15px; 
                        padding: 15px; }
                    body { 
                        margin: 1px; 
                    }
                   
                    h1,h2,h3,h4{
                        text-align:center;
                    }
                    h5{
                        text-align:right;
                    }	
                    td, th {
                        border: 1px solid #ccc;
                         background-color: #EEE;
                      }
                    table{
                        width: 100%;
                        margin-bottom : .3em;
                        text-align: left;
                        border: 5px solid #ccc;
                      }
                    #legendas{
                        width: 100%;
                        margin-bottom : .1em;
                        text-align: left;
                        border: 0px solid #ccc;
                      }  
                                       
                </style>										
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
            <body lang="pt-BR" class="container">';
            
        //$Imagen = "C:\\xampp\\htdocs\\smed\\public\\images\\brasao.png";
       // $html .= '<img src="' . $Imagen . ' height="10%" width="10%">';
            
            $html .= '<div title="header" class="text-center content">
                        <h3 class="top-header-principal">PREFEITURA MUNICIPAL DO RIO GRANDE</h3>
                        <h3 class="top-header-secundario">Secretaria de Município da Educação - SMEd</h3>
                </div>	
                <h3 >Relatório Vagas / Escola / Série</h3>											
                <h2 >ESCOLA '.$escolas[0]['nome'].'</h2>
                <h5>'.$turmas[0]['usuario'].'-'.date('d/m/Y h:i').'</h5>
                  
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Turmas       </th>
                            <th>CF          </th>
                            <th>CP          </th>
                            <th>R           </th>
                            <th>PNESL       </th>
                            <th>PNECL       </th>
                            <th>M           </th>
                            <th>Rest        </th>
                            <th>Turno       </th>
                            <th>Data        </th>

                        </tr>
                       
                    </thead>
                    <tbody>';
                        for($i=0;$i<$cont;$i++) { 
                            $html .=
                            '<tr>
                                <td>'.$turmas[$i]['descturma'].   '</td>
                                <td>'.$turmas[$i]['capacidade'].  '</td>
                                <td>'.$turmas[$i]['capacidade_p'].'</td>
                                <td>'.$turmas[$i]['regular'].     '</td>
                                <td>'.$turmas[$i]['pnesl'].       '</td>
                                <td>'.$turmas[$i]['pnecl'].       '</td>
                                <td>'.$turmas[$i]['matriculas'].  '</td>
                                <td>'.$turmas[$i]['capacidade_p'] - $turmas[$i]['matriculas'].'</td>
                                <td>'.$turmas[$i]['descturno'].   '</td>
                                <td>';
                            $html.= $data = implode("/",array_reverse(explode("-",$turmas[$i]['dt_cad'])));
                         $html.= '</td></tr>';
                        }; 
                        
                    $html .= '<tr><th>Total</th>
                                
                                <td>'.$turmatotal[0]['tcapacidade'].   '</td>
                                <td>'.$turmatotal[0]['tcapacidade_p']. '</td>
                                <td>'.$turmatotal[0]['tregular'].      '</td>
                                <td>'.$turmatotal[0]['tpnesl'].        '</td>
                                <td>'.$turmatotal[0]['tpnecl'].        '</td>
                                <td>'.$turmatotal[0]['tmatriculas'].   '</td>
                                <td>'.$turmatotal[0]['trestantes'].    '</td>
                                <td>  ------                            </td>
                                <td>  ------                            </td>
                                
                            </tr>
                    </tbody>
                </table>
                <div>
                    <table id="legendas">
                        <h4>Legendas</h4>    
                        <thead>
                            <tr><th>CF    - Capacidade Física</th></tr>
                            <tr><th>CP    - Capacidade Pedagógica</th></tr>
                            <tr><th>R     - Regular</th></tr>
                            <tr><th>PNESL - Pessoa com Necessidade Educacional Especifica Sem Laudo</th></tr>
                            <tr><th>PNECL - Pessoa com Necessidade Educacional Especifica Com Laudo</th></tr>
                            <tr><th>M     - Número de Matriculados</th></tr>
                            <tr><th>Rest  - Matriculas Restantes</th></tr>
                            <tr><th>Data  - Data de Cadastro</th></tr>
                            
                        </thead>    
                    </table>   
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>							
            </body>
        </html>';
     
    $this->geradoc->imprimeturmas($html,$id);
    }
}//fim classe?>
