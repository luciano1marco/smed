<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <?php //echo $dashboard_alert_file_install; 
        ?>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-legal"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Licence</span>
                        <span class="info-box-number">Free</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">AdminLTE version</span>
                        <span class="info-box-number">2.3.1</span>
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuários</span>
                        <span class="info-box-number"><?php echo $count_users; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-shield"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Número de Grupos</span>
                        <span class="info-box-number"><?php echo $count_groups; ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-bed"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quantidade de PTS</span>
                        <span class="info-box-number"><?php echo $qtd_pts; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"> </div>
        </div>

    </section>
</div>