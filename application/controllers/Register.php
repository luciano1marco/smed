<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Carrega helper URL
        $this->load->helper("url");
        $this->load->helper("html");
        $this->load->helper("form");
        $this->lang->load('auth');

        $this->load->helper('configuracao');
        $this->load->helper('utilidades');

        $this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');
    }

    public function index()
    {
        $this->load->config('admin/dp_config');
        $this->load->config('common/dp_config'); 

        $this->cfg = configuracao();
        $php = configuracao_PHP();

        $this->cfg['arq_js'] = base_url() . 'public/javascript/controllers/home.js';

        $this->form_validation->set_rules('nome', 'Nome', 'required');      
           
        if ($this->form_validation->run() == TRUE) {

            $qbyte      = random_bytes(16);
            $hex        = bin2hex($qbyte);
            //Um MD5 random
            $md5id     = hash('md5', $hex);
           
            //----pega os valores do post
            $email          = $this->input->post('email');
            $nome           = $this->input->post('nome');
            $datanasc       = $this->input->post('datanasc');
            $endereco       = $this->input->post('endereco');
            $cpf            = $this->input->post('cpf');
            $telefone       = $this->input->post('telefone');
             
           
            R::begin();
            //Na tabela mae dados principais
            $socio = R::dispense("pessoas");
           
            $socio->email = isset($email) ? $email : null;
            $socio->nome = isset($nome) ? $nome : null;
            $socio->datanasc = isset($datanasc) ? $datanasc : null;
            $socio->endereco = isset($endereco) ? $endereco : null;
            $socio->cpf = isset($cpf) ? $cpf : null;
            $socio->telefone = isset($telefone) ? $telefone : null;
            
            R::store($socio);

            R::commit();

            $this->session->set_flashdata('message', 'Dados Gravados no Banco!!');
                
            redirect('home', 'refresh');
        } else {
            /* CHECK BOX E RADIO */
          
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control email',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['nome'] = array(
                'name'  => 'nome',
                'id'    => 'nome',
                'type'  => 'text',
                'class' => 'form-control nome',
                'value' => $this->form_validation->set_value('nome'),
            );
            $this->data['datanasc'] = array(
                'name'  => 'datanasc',
                'id'    => 'datanasc',
                'type'  => 'date',
                'class' => 'form-control nome',
                'value' => $this->form_validation->set_value('datanasc'),
            );
          
            $this->data['endereco'] = array(
                'name'  => 'endereco',
                'id'    => 'endereco',
                'type'  => 'text',
                'class' => 'form-control endereco',
                'value' => $this->form_validation->set_value('endereco'),
            );
             $this->data['cpf'] = array(
                'name'  => 'cpf',
                'id'    => 'cpf',
                'type'  => 'int',
                'class' => 'form-control cpf',
                'value' => $this->form_validation->set_value('cpf'),
            );
          
            $this->data['telefone'] = array(
                'name'  => 'telefone',
                'id'    => 'telefone',
                'type'  => 'text',
                'class' => 'form-control celular',
                'value' => $this->form_validation->set_value('telefone'),
            );
           
            //---chama os modulos 
            $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $this->cfg, TRUE);
            $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php', $this->cfg, TRUE);
            $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);
            
            //-----chama as questões 
            $this->data['form_socio'] = $this->load->view('public/includes/questoes/form_socio.php', $this->data, TRUE);
            
           // $this->data['q_email'] = $this->load->view('public/includes/questoes/q_email.php', $this->data, TRUE);
           // $this->data['q_nome'] = $this->load->view('public/includes/questoes/q_nome.php', $this->data, TRUE);
          
            $this->load->view('public/register', $this->data);
        } //FIM ELSE
    }

    //---Rules ----------------------------
    public function rules_responsavel($field_value)
    {
        if (empty($field_value) && !isset($_POST['endereco'])) {
            $this->form_validation->set_rules('endereco', 'Possui Acesso', 'required');
            $this->form_validation->set_message('rules_endereco', 'O campo {field} é obrigatorio');
            return false;
        }
    }
  
}
