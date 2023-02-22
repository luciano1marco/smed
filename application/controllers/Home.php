<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        //$this->load->helper("url");
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
    }
	public function index() {
        $cfg = configuracao();
        $php = configuracao_PHP();

        //carregar dados 
        $this->data['imagem'] = R::findAll("imagens");
       
        //---Cargos 
        $sql1="SELECT r.id_socio, r.id_cargo, p.nome,c.descricao 
                from relacionar as r

                inner join pessoas as p
                on r.id_socio = p.id 

                inner join cargos as c 
                on c.id = r.id_cargo 

                where r.ativo = 1       
                ";
        $this->data['diretoria'] = R::getAll($sql1); 


        // Caso sistema funcione apenas logado, descomentar a linha abaixo e importar o helper URL no construtor
       // redirect("admin");

        $this->data['modulo_meiogeral'] = $this->load->view('public/includes/meiogeral.php', $this->data, TRUE);	
        $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $cfg, TRUE);	
        $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php',$cfg, TRUE);      
        $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	
        $this->data['modulo_faleconosco'] = $this->load->view('public/includes/faleconosco.php', $this->data, TRUE);	
        $this->data['modulo_meio'] = $this->load->view('public/includes/meio.php', $this->data, TRUE);	
        
        //$this->data['modulo_meio1'] = $this->load->view('public/includes/meio1.php', $this->data, TRUE);	

        $this->load->view('public/home', $this->data);
	}
    
    public function listar() { //lista os socios ativos
        $cfg = configuracao();
        $php = configuracao_PHP();

        //---pessoas(socios)
        $sql = "SELECT 	m.id,
                        m.id_socio, 
                        p.nome as socio,
                        m.valor,
                        m.ano,
                        m.janeiro,
                        m.fevereiro,
                        m.marco,
                        m.abril,
                        m.maio,
                        m.junho,
                        m.julho,
                        m.agosto,
                        m.setembro,
                        m.outubro,
                        m.novembro,
                        m.dezembro
                FROM `mensalidades` as m

                inner join pessoas as p
                on m.id_socio = p.id
				
                where p.ativo = 1 and m.ano = Year(now())";
		
		$this->data['socio'] = R::getAll($sql);
        
       
        
        $this->data['modulo_meiogeral'] = $this->load->view('public/includes/meiogeral.php', $this->data, TRUE);	
        $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $cfg, TRUE);	
        $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php',$cfg, TRUE);      
        $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	
        $this->data['modulo_faleconosco'] = $this->load->view('public/includes/faleconosco.php', $this->data, TRUE);	
        $this->data['modulo_meio'] = $this->load->view('public/includes/meio.php', $this->data, TRUE);	
         
        $this->load->view('public/listar', $this->data);
        
    }

}
