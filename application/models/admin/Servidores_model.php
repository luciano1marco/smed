<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidores_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->dados = null;
    }
    
    function getServidores($postData = null) {
        $draw               = null;
		$start              = 100;
		$rowperpage         = 100;
		$columnIndex        = null;
		$columnName         = null;
		$columnSortOrder    = null;
		$searchValue        = null;

        if(!empty($postData)) :
            $draw               = $postData['draw'];
            $start              = $postData['start'];
            $rowperpage         = $postData['length']; // Rows display per page
            $columnIndex        = $postData['order'][0]['column']; // Column index
            $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
            $searchValue        = $postData['search']['value']; // Search value
        endif;

		$searchQuery = "";
     	if($searchValue != '') {
        	$searchQuery = " (id like '%".$searchValue."%' OR nome like '%".$searchValue."%' OR matricula like '%".$searchValue."%' OR telefone like'%".$searchValue."%' ) ";
     	}

        $this->db->select('count(*) as allcount');
        $records = $this->db->get('servidores')->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount');
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('servidores')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        $this->db->select('*');
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('servidores')->result();

        $data = array();

        foreach($records as $record ) {           
            
            $nome        = $record->nome;
            $matricula   = $record->matricula;           
            $telefone    = $record->telefone;
            $email       = $record->email;
            
            $link = '<a href="'.base_url().'admin/servidores/" class="btn btn-primary"><i class="fa fa-search"></i> <span>Ver</span></a>';
                    
            $data[] = array( 
               "nome"         =>$nome,
               "matricula"    =>$matricula,
               "nome_ende"    =>$telefone,
               "email"        =>$email,
            ); 
        }

        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $data
        );
    
        return $response; 
	}
    
}