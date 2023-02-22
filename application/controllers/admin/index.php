<?php

$controladores = array(
    "Edificação",
    "Viabilidade Locacional",
    "Parcelamento de Solo",

    "AprovacaoUnifamiliar",
    "AprovacaoMultifamiliar",
    "AprovacaoComercial/Serviços",
    "Modificação de Fachada",
    "Projeto Hidrossanitário",
    "Laudo Acústico",
    "Calçada",
    "Parklet",
    "Marquises",

    "Desdobramento/Desmembramento",
    "Loteamento",
    "Condomínio Edificado",
    "Condomínio de Lotes",
    "Condomínio Logístico",
    "Masterplan",

    "LicencasUnifamiliar",
    "LicencasMultifamiliar",
    "LicencasComercial/Serviços",
    "Placas e Letreiros",
    "Reparo/Reforma/Demolição",
    "Muros/Tapumes/instalações Provisórias/Calçada",

    "Vistoria Parcial",
    "Vistoria Total",
    "Renovação de Vistoria",

    "RegularizacaoUnifamiliar",
    "RegularizacaoMultifamiliar",
    "RegularizacaoComercial/Serviços",

    "Alinhamento",
    "Projetos Complementares",
    "Consulta ao Arquivo SMCP"
);

$txtControlador = "
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class [NOMECONTROLADOR] extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        /* Title Page :: Common */
        \$this->page_title->push('[NOMECONTROLADOR]');
        \$this->data['pagetitle'] = \$this->page_title->show();

        /* Breadcrumbs :: Common */
        \$this->breadcrumbs->unshift(1, '[NOMECONTROLADOR]', 'admin/[NOMECMIN]');
    }


    public function index() {
        if ( ! \$this->ion_auth->logged_in() OR ! \$this->ion_auth->is_admin()) {
            redirect('auth/login', 'refresh');
        } else {
            /* Breadcrumbs */
            \$this->data['breadcrumb'] = \$this->breadcrumbs->show();

            /* Load Template */
            \$this->template->admin_render('admin/[NOMECMIN]/index', \$this->data);
        }
    }
}

?>
";

$txtView = "
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class='content-wrapper'>
    <section class='content-header'>
        <?php echo \$pagetitle; ?>
        <?php echo \$breadcrumb; ?>
    </section>

    <section class='content'>
        <div class='row'>
            <div class='col-md-12'>
                 <div class='box'>
                    <div class='box-header with-border'>
                        <h3 class='box-title'>
                        </h3>
                    </div>
                    <div class='box-body'>
                    </div>
                </div>
             </div>
        </div>
    </section>
</div>
";

for ($i=0; $i<count($controladores); $i++) {
    $controladores[$i] = str_replace(array("/", " "), "", $controladores[$i]);
    $controladores[$i] = strtolower($controladores[$i]);
    $controladores[$i] = str_replace("ç", "c", $controladores[$i]);
    $controladores[$i] = str_replace(array("á", "à", "â", "ã"), "a", $controladores[$i]);
    $controladores[$i] = str_replace(array("é", "ê"), "e", $controladores[$i]);
    $controladores[$i] = str_replace("í", "i", $controladores[$i]);
    $controladores[$i] = str_replace(array("ó", "ô", "õ"), "o", $controladores[$i]);
    $controladores[$i] = str_replace("ú", "u", $controladores[$i]);

    $cmin = $controladores[$i];
    $nomecon = strtoupper(substr($controladores[$i], 0, 1)) . substr($controladores[$i], 1);

    $txtControladorAtual = str_replace("[NOMECONTROLADOR]", $nomecon, $txtControlador);
    $txtControladorAtual = str_replace("[NOMECMIN]", $cmin, $txtControladorAtual);

    mkdir($cmin);

    $arquivo = fopen($cmin."/index.php", "w");
    fwrite($arquivo, $txtView);
    fclose($arquivo);

    $arquivoC = fopen($nomecon.".php", "w");
    fwrite($arquivoC, $txtControladorAtual);
    fclose($arquivoC);

    //$contadores[$controladores[$i]] = isset($contadores[$controladores[$i]])?$contadores[$controladores[$i]]+1:1;
}
    //echo "<pre>";var_dump($controladores);

?>

