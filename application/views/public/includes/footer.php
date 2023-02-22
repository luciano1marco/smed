<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--teste de footer-- #350B31--->    
    <style>
        #myFooter {
            background-color: #350B31;
            color: white;
            padding-top: 0px;
        }

        #myFooter .row {
            margin-bottom: 60px;
        }

        #myFooter .navbar-brand {
            margin-top: 45px;
            height: 65px;
        }

        #myFooter ul {
            list-style-type: none;
            padding-left: 0;
            line-height: 1.7;
        }

        #myFooter a {
            color: #d2d1d1;
            text-decoration: none;
        }

        #myFooter a:hover,
        #myFooter a:focus {
            text-decoration: none;
            color: white;
        }


        #myFooter .btn {
            color: white;
            background-color: #d84b6b;
            border-radius: 20px;
            border: none;
            width: 50px;
            display: block;
            margin: 0 auto;
            
            line-height: 25px;
        }
        #myFooter .span{
            margin-top: 50;
        }

        @media screen and (max-width: 767px) {
            #myFooter {
                text-align: center;
            }
        }


        /* CSS used for positioning the footers at the bottom of the page. */
        /* You can remove this. */

        html{
            height: 100%;
        }

        body{
            display: flex;
            display: -webkit-flex;
            flex-direction: column;
            -webkit-flex-direction: column;
            height: 100%;
        }

        .content{
        flex: 1 0 auto;
        -webkit-flex: 1 0 auto;
        min-height: 100px;
        }

        #myFooter{
        flex: 0 0 auto;
        -webkit-flex: 0 0 auto;
        }
        #direito{
            margin-top: 300;
        }
        div.topo {
            background:#FB924B;
            position: fixed;
            bottom: 25px;
            right: 25px;
            /*tentar usar z-index para aparecer apartir da segunda pagina*/
        }
        #myFooter h3 {
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin-top: 30px;
            color: #992691;
        }
        #myFooter h4 {
            font-weight: bold;
            font-size: 35px;
            text-align: center;
            margin-top: 30px;
            color: #FB893B;
        }
        #myFooter h5 {
            
            font-size: 17px;
            text-align: left;
            margin-top: 30px;
            color: #FFFFFF;
        }
        span{
            background-color:#350B31;
            color:#FFFFFF;
        }
        .map-responsive{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }

        .map-responsive iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }
    </style> 

   <footer id="myFooter">
       <div class="row"> </div>
        <div class="content-fluid">
            <div class="col-sm-3">
                <a href="#">
                    <img class="img-responsive" src="http://localhost/serzodiaco/public/images/logo-rodape.png" >
                </a>
            </div>
            <div class="col-sm-6">
                <h4>Sociedade Esportiva e Recreativa Zodíaco</h4>
                <div class="col-sm-6">
                    <h5>Endereço: Rua Apelles Porto Alegre, 60 </h5>
                    <h5> Rio Grande - RS, 96200-060</h5>
                    <h5>Telefone: (53)56445654</h5> 
                    <a href="/serzodiaco/register">
                        <img class="img-responsive" src="http://localhost/serzodiaco/public/images/sejasocio.png" >
                    </a>  
                </div>
                <div class="col-sm-6">
                    <h5>Localização - Nossa Sede</h5>
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d355.4934941374832!2d-52.09606976630629!3d-32.04102370408533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95119d224048b60f%3A0x617e1cd44c5cc3cb!2sSociedade%20Esportiva%20e%20Recreativa%20Zod%C3%ADaco!5e0!3m2!1spt-BR!2sbr!4v1662991481658!5m2!1spt-BR!2sbr" width="360" height="170" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>        
            </div>
            
            
            <div class="col-md-3" id="sociais">
                        <span><h4>
                            <ul class="list-inline">
                                <li><a target="_blank" href="http://www.facebook.com/ser.zodiaco"                       class="facebook"> <i class="fa fa-facebook" > </i></a></li>
                                <li><a target="_blank" href="http://twitter.com/"                            class="twitter">  <i class="fa fa-twitter" >  </i></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/"          class="instagram"><i class="fa fa-instagram"> </i></a></li>
                                <li><a target="_blank" href="https://www.youtube.com/"  class="youtube">  <i class="fa fa-youtube" >  </i></a></li>
                            </ul>
                        </h4></span>
                    </div>
            </div>
           
        <div class="topo">
            <a href="#topo"><i class="fa fa-angle-up" > </i></a>
        </div>
        
    </footer>
    <span> Todos direitos reseverdos #luciano1marco </span> 
             
    
    <!-- END -->

    <!-- BASICO -->
    <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>   

    <!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url($plugins_dir . '/jquery-validate/jquery.validate.min.js'); ?>"></script>

    <!-- MASK -->
    <script src="<?php echo base_url($plugins_dir . '/jquery-mask/jquery.mask.min.js'); ?>"></script>
    
    <!-- ICHECK -->
    <script src="<?php echo base_url($plugins_dir . '/icheck/icheck.min.js'); ?>"></script>
     
    <!-- DATATABLES -->
    <script src="<?php echo base_url($plugins_dir . '/datatables/datatables.min.js'); ?>"></script>

    <!-- SELECT 2 -->
    <script src="<?php echo base_url($plugins_dir . '/bootstrap_select/bootstrap-select.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/select2/js/select2.full.min.js'); ?>"></script>

    <!-- TIMEPICKER -->
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/moment.min.js'); ?>"></script>         
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/bootstrap3-datetimepicker/locales.min.js'); ?>"></script>  

    <!-- LEAFLET -->
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet/leaflet.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-markercluster/leaflet.markercluster.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/beautify-marker/leaflet-beautify-marker-icon.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/leaflet-pip/leaflet-pip.js'); ?>"></script>
    <script src="<?php echo base_url($plugins_dir . '/leaflet/map.js'); ?>"></script>

    <!-- AUTOCOMPLETE -->
    <script src="<?php echo base_url($plugins_dir . '/autocomplete/jquery.autocomplete.min.js'); ?>"></script>
  
    <?php
    $controller_atual =  $this->router->class;
    ?>

    <!-- BACKSTRECH -->
    <script src="<?php echo base_url($public_js . '/jquery.backstretch.min.js'); ?>"></script>

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
            'language': { 'url': dir_base+'/assets/plugins/datatables/portugues-br.json' },
            'paging': true,
            'ordering': true,
            'info': true,
            'searching': true,
            'autoWidth': true
        });

        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '40%' // optional
        });

        $.backstretch(dir_base+'public/images/banne1.png');     
    });
    </script>   
