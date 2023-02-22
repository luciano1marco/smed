
        <?php
        $methods_array = array('create','edit','view','index');
        ?>

        <!-- COLORPICKER -->
        <?php
            $colorpicker_array = array('groups');   
            $include_colorpicker = isset($includes['colorpicker']) ? $includes['colorpicker'] : array();    
        ?>

            <?php if ( 
                        ( 
                            in_array($this->router->fetch_class(),$colorpicker_array) || in_array($this->router->fetch_class(), $include_colorpicker)
                        ) 
                        && 
                        (
                            in_array($this->router->fetch_method(),$methods_array)
                        )                
                    ): 
            ?>
            
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
                      
        <?php endif; ?>
       
        <!-- DATETIMEPICKER -->     
        <?php
        $datepicker_array = array('');     
        $include_datepicker = isset($includes['datepicker']) ? $includes['datepicker'] : array();      
        ?>
        
        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$datepicker_array) || in_array($this->router->fetch_class(), $include_datepicker)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>    

        <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/moment.min.js'); ?>"></script>         
        <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/locales.min.js'); ?>"></script>  
       
        <?php endif; ?>

        <!--  CYCLE2 -->    
        <?php
        $cycle2_array = array('');    
        $include_cycle2 = isset($includes['cycle2']) ? $includes['cycle2'] : array();                 
        ?>
       
        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$cycle2_array) || in_array($this->router->fetch_class(), $include_cycle2)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),array('index','view'))
                    )                
                ): 
        ?>    

        <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.min.js'); ?>"></script>         
        <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/cycle2/jquery.cycle2.center.min.js'); ?>"></script>  

        <?php endif; ?>

        <!-- LEAFLET --> 
        <?php
        $leaflet_array = array('');   
        $include_leaflet = isset($includes['leaflet']) ? $includes['leaflet'] : array();       
        ?>
        
        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$leaflet_array) || in_array($this->router->fetch_class(), $include_leaflet)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>     

        <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-pip/leaflet-pip.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/leaflet/map.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/leaflet/geocoder.js'); ?>"></script>
      
        <?php endif; ?>

        <!-- CHARTJS -->
        <?php
        $chartjs_array = array('');   
        $include_chartjs = isset($includes['chartjs']) ? $includes['chartjs'] : array();    
        ?>

        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$chartjs_array) || in_array($this->router->fetch_class(), $include_chartjs)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>
        
        <script src="<?php echo base_url($plugins_dir . '/chartjs/Chart.min.js'); ?>"></script>
                    
        <?php endif; ?>

        <!-- JSPDF -->
        <?php
        $jspdf_array = array('');   
        $include_jspdf = isset($includes['jspdf']) ? $includes['jspdf'] : array();    
        ?>

        <?php if ( 
                    ( 
                        in_array($this->router->fetch_class(),$jspdf_array) || in_array($this->router->fetch_class(), $include_jspdf)
                    ) 
                    && 
                    (
                        in_array($this->router->fetch_method(),$methods_array)
                    )                
                ): 
        ?>

        <script src="<?php echo base_url($plugins_dir . '/jspdf/html2canvas.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/jspdf/jspdf.min.js'); ?>"></script>
                           
        <?php endif; ?>