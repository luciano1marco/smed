<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
       
        <!-- BASICO ADMINLTE -->

        <!-- JQuery -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>   
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>    
        <!-- AdminLTE -->
        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
        <!-- AdminLTE Control SIDEBAR -->
        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/demo.js'); ?>"></script>       
        <!-- Datatables -->
        <script src="<?php echo base_url($frameworks_dir . '/datatables/jquery.dataTables.min.js'); ?>"></script>
        <!-- Datatables BS4 -->
        <script src="<?php echo base_url($frameworks_dir . '/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script> 
        <!-- Datatables Responsive -->
        <script src="<?php echo base_url($frameworks_dir . '/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>             
        <!-- Select Picker -->        
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap_select/bootstrap-select.min.js'); ?>"></script>
        <!-- Select 2 -->
        <script src="<?php echo base_url($frameworks_dir . '/select2/js/select2.full.min.js'); ?>"></script>       
        <!-- JQuery Validation -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery-validation/jquery.validate.min.js'); ?>"></script>
        <!-- JQuery Validation Extras -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery-validation/additional-methods.min.js'); ?>"></script>        
        <!-- ICheck -->
        <script src="<?php echo base_url($frameworks_dir . '/icheck/js/icheck.min.js'); ?>"></script>      
        <!-- Holder -->
        <script src="<?php echo base_url($frameworks_dir . '/holderjs/holder.min.js'); ?>"></script> 
        <!-- JS Mask -->        
        <script src="<?php echo base_url($plugins_dir . '/jquery-mask/jquery.mask.min.js'); ?>"></script>   
        <!-- Overlay Scroll Bar -->        
        <script src="<?php echo base_url($plugins_dir . '/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>                             
        <!-- JS DO ADMIN -->
        <script src="<?php echo base_url('public/javascript/admin/funcoes/principal.js'); ?>"></script>
        <!-- JS DO EXCLUIR -->
        <script src="<?php echo base_url('public/javascript/admin/funcoes/excluir.js'); ?>"></script>
        <!-- FIX JS -->                      
        <script src="<?php echo base_url($plugins_dir . '/jsfix/fix_body.js'); ?>"></script> 
                        
        <?php
        $methods_array = array('create','edit','view','index');
        ?>

        <!-- MOBILE -->
        <?php if ($mobile == TRUE): ?>
            <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
        <?php endif; ?>
        
        <!-- ANIMSITION TRANSITIONS -->
        <?php if ($admin_prefs['transition_page'] == TRUE): ?>
            <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
        <?php endif; ?>
        
        <!-- PASSWORD STRENGTH -->
        <?php if ($this->router->fetch_class() == 'users' && (in_array($this->router->fetch_method(),$methods_array))): ?>
        <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength-bootstrap.min.js'); ?>"></script>
        <?php endif; ?>

        <!-- Extras de cada controllador 
        <?php echo $footer_extras; ?>-->
                             
        <?php        
        //JS do Controller (Só adiciona se achar)
        $js = FCPATH . "public/javascript/admin/controllers/" . $this->router->fetch_class().'.js';       
        if(file_exists($js)):          
        ?>

        <script src="<?php echo base_url('public/javascript/admin/controllers/'.$this->router->fetch_class().'.js'); ?>"></script>  
        <?php endif; ?>

    </body>
</html>