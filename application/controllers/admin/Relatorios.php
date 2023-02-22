<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends Admin_Controller {

    public function __construct()
    {
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

	public function index()
	{
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

    public function getrelqdq(){      
        header('Content-Type: application/json');
                    
        $sql = "SELECT q.data AS dt,count(q.id) AS id 
                FROM questionarios AS q
                GROUP BY dt
               ";        

        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
      
    }

    public function getrelqtotal(){      
        header('Content-Type: application/json');
                    
        $sql = "SELECT COUNT(q.id) AS total 
                FROM questionarios AS q
                 ";        

        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
      
    }

    public function getrelestudante(){      
        header('Content-Type: application/json');
                    
        $sql = "SELECT SUM(q.especial) AS qespecial, SUM(q.qts_est) AS qestudantes FROM questionarios AS q";        

        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
      
    }

    public function getrelespecial(){      
        header('Content-Type: application/json');
                    
        $sql = "SELECT SUM(q.especial) AS qespecial, SUM(q.qts_est) AS qestudantes FROM questionarios AS q";        

        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        } 
      
    }

    public function getrelrisco(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT COUNT(q.id) AS total,SUM(q.derisco) AS qtd from questionarios AS q";
       
        $rows = R::getAll($sql);

        $relatorio = $rows;       

        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelretorno(){      
        header('Content-Type: application/json');
                    
       $sql="SELECT COUNT(qv.ordem) AS ordem,v.descricao  from qvoltar as qv 
               inner join voltar as v 
               on qv.id_voltar = v.id
      
               where ordem = 1 GROUP BY id_voltar ORDER BY ordem DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelretorno2(){      
        header('Content-Type: application/json');
                    
        //$sql="SELECT COUNT(q.id) AS total,SUM(q.derisco) AS qtd from questionarios AS q";
       // $sql="SELECT COUNT(ordem) as ordem, COUNT(id_voltar) AS qtd from qvoltar where ordem = '1'";
       $sql="SELECT COUNT(qv.ordem) AS ordem,v.descricao  from qvoltar as qv 
               inner join voltar as v 
               on qv.id_voltar = v.id
      
               where ordem = 2 GROUP BY id_voltar ORDER BY ordem DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelretorno3(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT COUNT(qv.ordem) AS ordem,v.descricao  from qvoltar as qv 
               inner join voltar as v 
               on qv.id_voltar = v.id
      
               where ordem = 3 GROUP BY id_voltar ORDER BY ordem DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelpresencial(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT COUNT(qn.id_npresencial) AS presencial,n.descricao 
         from qnpresencial as qn 
        inner join npresencial as n 
        on qn.id_npresencial = n.id

        GROUP BY id_npresencial ORDER BY presencial DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getreltrabalho(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT q.qtdpresencial AS descricao, COUNT(q.tempresencial) AS qtd
              from questionarios as q 
              where tempresencial = 1
              GROUP BY descricao
              ORDER BY qtd DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }


    public function getreltrabalho1(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT SUM(q.tempresencial) AS tem, COUNT(q.id) AS qtd
              from questionarios as q 
              ";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelacesso(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT q.qtdacesso AS descricao, COUNT(q.temacesso) AS qtd 
              from questionarios as q 
              where temacesso = 1
              GROUP BY descricao
              ORDER BY qtd DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelacesso1(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT q.qualacesso AS descricao, COUNT(q.temacesso) AS qtd 
              from questionarios as q 
              where temacesso = 1
              GROUP BY descricao
              ORDER BY qtd DESC";
       

        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    public function getrelaparelho(){      
        header('Content-Type: application/json');
                    
        $sql="SELECT COUNT(qa.id_aparelho) AS ordem,a.descricao
              from qaparelho as qa 
               inner join aparelhos as a 
               on qa.id_aparelho = a.id
      
               GROUP BY id_aparelho ORDER BY ordem DESC";
 
        $rows = R::getAll($sql);

        $relatorio = $rows;       
        
        if($relatorio !== NULL) {		
			$j = json_encode($relatorio);
			echo $j;			
        }       
    }

    //---fim dos getrel...()-------------
 
}