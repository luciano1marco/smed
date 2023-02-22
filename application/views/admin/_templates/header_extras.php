
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
      
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">             
                     
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
       
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.css'); ?>">
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

        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.css');?>" />     
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.css');?>" />    
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/MarkerCluster.Default.css');?>" />             
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.css');?>" />
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/leaflet/map.css');?>" />

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
      
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/chartjs/Chart.min.css'); ?>">
               
        <?php endif; ?>