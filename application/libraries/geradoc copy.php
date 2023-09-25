<?php defined('BASEPATH') OR exit('No direct script access allowed');

class geradoc extends Admin_Controller {

    protected $CI;

    public function __construct() {	
            $this->CI =& get_instance();
            $this->CI->load->library('pdf');
    }
    public function index(){
        $this->CI->load->library('pdf');
        $this->pdf->loadHtml('html code or variable');
        $this->pdf->setPaper('A4','portrait');//landscape
        $this->pdf->render();
        $this->pdf->stream("abc.pdf", array('Attachment'=>0));
        //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
    }
    public function imprimeturmas($html = null,$id=null){
       
        $sqlescola = "SELECT * from escolas where id = ".$id;
        $escolas= R::getAll($sqlescola); 
        
        $dt=date("d-m-y-h-i");//pega data e hora atual
        $nome = $escolas[0]['nome']."-".$dt.".pdf"; //define o nome do arquivo em pdf
        //var_dump($nome);die;
        
        $this->CI->load->library('pdf');
        $this->CI->pdf->loadHtml($html);
        $this->CI->pdf->setPaper('A4','portrait');//landscape ->imprime no formato paisagem
        $this->CI->pdf->render();
        $this->CI->pdf->stream($nome, array('Attachment'=>true));//true faz o download do arquivo
        
    }

}           
?>