<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['title']      = 'SMED';
$config['title_mini'] = 'S';
$config['title_lg']   = 'SMED';



/* Display panel login */
$config['auth_social_network'] = FALSE;
$config['forgot_password']     = FALSE;
$config['new_membership']      = FALSE;


$config['includes']      =  array(
                                    'colorpicker' => array('grupos'),
                                    'select2' => array('bairrozona', 'regioes'),
                                    'datepicker' => array(),
                                    'cycle2' => array(),
                                    'leaflet' => array('escolas', 'regioes', 'questionario'),
                                    'chartjs' => array('relatorios')
);

/*
 * **********************
 * AdminLTE
 * **********************
 */
/* Page Title */
$config['pagetitle_open']     = '<h1>';
$config['pagetitle_close']    = '</h1>';
$config['pagetitle_el_open']  = '<small>';
$config['pagetitle_el_close'] = '</small>';

/* Breadcrumbs */
$config['breadcrumb_open']     = '<ol class="breadcrumb">';
$config['breadcrumb_close']    = '</ol>';
$config['breadcrumb_el_open']  = '<li>';
$config['breadcrumb_el_close'] = '</li>';
$config['breadcrumb_el_first'] = '<i class="fa fa-dashboard"></i>';
$config['breadcrumb_el_last']  = '<li class="active">';


