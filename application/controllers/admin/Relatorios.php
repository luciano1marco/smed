<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class relatorios extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push('Relatórios');
        $this->data['pageicon'] = 'ul-list';
		$this->data['pagetitle'] = $this->page_title->show();
        
        /* Pega controller */
		$this->anchor = 'admin/'.$this->router->class;
		
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
        
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Questionário', $this->anchor);
    }
	public function index(){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            $questionarios = R::find( 'questionarios' );
            //mostra todas escolas
            $sql = "SELECT  				
                        s.nome as nome,s.id as id,
                        SUM(t.capacidade)   as capacidade,
                        SUM(t.capacidade_p) as capacidade_p,
                        SUM(t.regular)      as regular,
                        SUM(t.pnesl)        as pnesl,
                        SUM(t.pnecl)        as pnecl,
                        SUM(t.matriculas)   as matriculas,
                        SUM(t.capacidade_p - t.matriculas)   as restantes
                    from turmas as t
                    inner join escolas as s
                    on s.id = t.idescola

                    group by t.idescola  
                    ORDER BY `s`.`nome` ASC
                ";

            $this->data['escolas']= R::getAll($sql); 
            
            
            /* Carrega os Tipos de Eventos */
			$this->data['questionarios'] = $questionarios;
			
			$this->data['id_check'] = array(
				'name'          => 'id',
				'id'            => 'id_check[]',
				'value'         => null,
				'checked'       => FALSE,
				'style'         => 'margin:10px'
			);
						
			/* Load Template */		
            $this->template->admin_render($this->anchor.'/index', $this->data);
        }
    }
    public function view($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['error'] = NULL;

            $sqle = "SELECT * from escolas where id = '$id'";
            $this->data["nomeescola"] = R::getAll($sqle);	
            //mostra todas escolas - vagas / serie da escola
            $sql = "SELECT  t.descricao as nome,
                            t.capacidade,
                            t.capacidade_p,
                            t.regular,
                            t.pnesl,
                            t.pnecl,
                            t.matriculas,
                            tu.descricao as turno
                    FROM `turmas` as t
            
                    inner join escolas as e
                    on e.id = t.idescola
                    
                    inner join turnos as tu
                    on t.idturno = tu.id
                    
                    where t.idescola = '$id'  
                    ORDER BY `t`.`descricao` ASC" ;
            $this->data['porescolas']= R::getAll($sql); 
           
            /* Carrega os Tipos de Eventos */
			$this->data['id_check'] = array(
				'name'          => 'id',
				'id'            => 'id_check[]',
				'value'         => null,
				'checked'       => FALSE,
				'style'         => 'margin:10px'
			);
						
			/* Load Template */		
            $this->template->admin_render($this->anchor.'/view', $this->data);
        }
    }
    public function relat($id){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            {   redirect('auth/login', 'refresh'); }
        else
            { /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                /* Data */
                $this->data['error'] = NULL;
                //mostra todas escolas
                $sqle = "SELECT * from escolas where id = '$id'";
                $this->data["escolas"] = R::getAll($sqle);	
                /* Load Template */
                $this->template->admin_render('admin/relatorios/relat', $this->data);
            }

    }
    
    public function gettotal($id){ 
         var_dump($id);die;
        header('Content-Type: application/json');
        $sql="SELECT 
                    SUM(capacidade) AS capacidade,
                    SUM(capacidade_p) AS capacidade_p,				
                    SUM(regular) AS regular,
                    SUM(pnesl) AS pnesl,
                    SUM(pnecl) AS pnecl,				
                    SUM(matriculas) AS matriculas,
                    SUM(capacidade_p - turmas.matriculas) AS restante
                FROM turmas
                WHERE idescola =" .$id
                ;
    
        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
    }
    public function getserie($id){      
        header('Content-Type: application/json');
        $sql="SELECT *, s.descricao as nomeserie, 
                        t.descricao as nometurno,
                        (tu.capacidade_p - tu.matriculas) as restante
                from turmas as tu
        
                inner join series as s
                on tu.idserie = s.id
                
                inner join turnos as t
                on tu.idturno = t.id 
        
                where tu.idescola = '$id' order by nomeserie";
        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
    }
    //---fim dos getrel...()-------------
 
}