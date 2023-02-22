    <!-- Footer -->    
    <footer class="text-muted">
      	<div class="container">
			<p class="float-right"><a href="#" class="fa fa-chevron-up fa-1x pull-left "> Voltar ao Topo</a></p>
            <strong>Prefeitura Municipal do Rio Grande &copy; 2021 <a href="http://riogrande.rs.gov.br">Setor de Tecnologia da Informação</a>.</strong> All rights reserved.       
      	</div>
    </footer>
    <!-- END -->

    <!-- BASICO -->
    <!-- JQuery -->
    <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
    <!-- AdminLTE -->
    <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>            
    <!-- Datatables -->
    <script src="<?php echo base_url($frameworks_dir . '/datatables/jquery.dataTables.min.js'); ?>"></script>
    <!-- Datatables BS4 -->
    <script src="<?php echo base_url($frameworks_dir . '/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <!-- Holder -->
    <script src="<?php echo base_url($frameworks_dir . '/holderjs/holder.min.js'); ?>"></script>

    <!-- Select Picker -->        
    <script src="<?php echo base_url($frameworks_dir . '/bootstrap_select/bootstrap-select.min.js'); ?>"></script>
    <!-- Select 2 -->
    <script src="<?php echo base_url($frameworks_dir . '/select2/js/select2.full.min.js'); ?>"></script>
    
    <?php
    $controller_atual =  $this->router->class;
    ?>

    <!-- FIX BODY -->
    <script src="<?php echo base_url($public_js . '/fix_body.js'); ?>"></script>
   
    <!--Arquivo JS -->
    <script type="text/javascript" src="<?php echo $arq_js; ?>"></script>	

    <script type="text/javascript">
            var dir_img = "<?php echo $public_images; ?>", 
                dir_base = "<?php echo base_url(); ?>", 
                dir_site = "<?php echo base_url(); ?>", 
                dir_plugins = "<?php echo $public_plugins; ?>";         
    </script>

    <script type="text/javascript">
    $(document).ready(function ($) {    
        $('#datatable').DataTable({
            'language': { 'url': dir_base+'/assets/frameworks/datatables/lang/portugues-br.json' },
            'paging': true,
            'ordering': true,
            'info': true,
            'searching': true,
            'autoWidth': true
        });
       
    });
    </script>   