<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logradouros_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->dados = null;
    }
    
    function getLogradouros($postData = null) {
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
        	$searchQuery = " (id like '%".$searchValue."%' OR inscricao_municipal like '%".$searchValue."%' OR nome_endereco like '%".$searchValue."%' OR bairro like'%".$searchValue."%' ) ";
     	}

        $this->db->select('count(*) as allcount');
        $records = $this->db->get('logradouros')->result();
        $totalRecords = $records[0]->allcount;

        $this->db->select('count(*) as allcount');
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('logradouros')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        $this->db->select('*');
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('logradouros')->result();

        $data = array();

        foreach($records as $record ) {           
            $nome_endereco = null;

            $id                     = $record->id;
            $inscricao_municipal    = $record->inscricao_municipal;           
            $bairro                 = $record->bairro;
            $tipo_endereco          = $record->tipo_endereco;
            $logra_endereco         = $record->nome_endereco;
            $cep                    = $record->cep;
            $numero_endereco        = $record->numero_endereco;
            $complemento_endereco   = $record->complemento_endereco;
            $zona_setor             = $record->zona_setor;

            if(!empty($tipo_endereco)) {
                $nome_endereco .= $tipo_endereco;
            }
            if(!empty($logra_endereco)) {
                $nome_endereco .= ' '.$logra_endereco;
            }
            if(!empty($numero_endereco)) {
                $nome_endereco .= ', '.$numero_endereco;
            }
            if(!empty($complemento_endereco)) {
                $nome_endereco .= '- '.$complemento_endereco;
            }

            $link = '<a href="'.base_url().'admin/logradouros/view/'.$id.'" class="btn btn-primary"><i class="fa fa-search"></i> <span>Ver</span></a>';
                    
            $data[] = array( 
               "id"                     =>$id,
               "inscricao_municipal"    =>$inscricao_municipal,
               "nome_endereco"          =>$nome_endereco,
               "cep"                    =>$cep,
               "bairro"                 =>$bairro,
               "zona_setor"             =>$zona_setor,
               "link"                   =>$link
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

    public function getLogradouro_id($id) {        
        $query = $this->db->get_where('logradouros', array('id' => $id), 100, 0);      
        return $query->result_array();
    }

    public function getCep($cep) {
        $query = $this->db->get_where('cepriogrande', array('cep' => $cep));      
        return $query->result_array();
    }

}