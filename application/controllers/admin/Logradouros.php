<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logradouros extends Public_Controller {

    public function __construct() {
        parent::__construct();

        /* Anchor */
        $this->anchor = 'admin/'.$this->router->class;

        /* Model */
		$this->load->model('admin/logradouros_model');
        $this->load->model('admin/modelojucis_model');
		
        /* Anchor */
		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');      
    }
    
	public function index() {        
        /* Load Template */
        $this->template->public_render('public/logradouros', $this->data);
    }

    public function getLogradouros() {     
		/* POST data */
		$postData = $this->input->post();
   
		/* Get data */
		$data = $this->logradouros_model->getLogradouros($postData);
   
		$ret = json_encode($data);
		
		echo $ret;		
	}

    public function getModelojucis() 
	{     
		/* POST data */
		$postData = $this->input->post();
   
		/* Get data */
		$data = $this->modelojucis_model->getModelojucis($postData);
   
		$ret = json_encode($data);
		
		echo $ret;		
	}
     
}