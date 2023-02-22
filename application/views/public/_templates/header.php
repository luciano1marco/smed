<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="<?php echo $CHARSET ?>">
        <meta http-equiv="content-type" content="text/html; charset=<?php echo $CHARSET; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
        <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon" />

        <title><?php echo $title; ?></title>
        
        <meta name="title" content="<?php echo $title; ?>" />
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="copyright" content="<?php echo $copyright; ?>" />
        <meta name="author" content="<?php echo $author; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Fonte Source Sans -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- /* O BASICO do Layout */ -->

        <!-- Normalize -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/normalize/normalize.css'); ?> ">
		<!-- BootStrap / Admin LTE -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?> ">  
        <!-- FontAwesome -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/fontawesome-free/css/all.min.css'); ?> "> 
        <!-- Ioniicons -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?> ">          
        <!-- ICheck Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">                   
        <!-- DATATABLES -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

        <!-- Select Picker -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap_select/bootstrap-select.min.css'); ?>"> 
        <!-- Select 2 -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/select2/css/select2.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

        <!-- /* COISAS DA PAGINA */ -->

        <!-- Loading -->
        <link rel="stylesheet" href="<?php echo base_url($public_css . '/loading.css'); ?>">
        <!-- Home -->
		<link rel="stylesheet" href="<?php echo base_url($public_css . '/home.css'); ?>"> 
        <!-- FAVICON -->
        <link rel="shortcut icon" href="<?php echo base_url($public_css . '/imagens/ico/favicon.png'); ?>" />       
       
		<!-- BEGIN tem_arq_css -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $arq_css; ?>" />

		<!-- JQuery -->		
		<script src="<?php echo base_url($public_js . '/fix_head.js'); ?>"></script>            

    </head>