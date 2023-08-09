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
            <?php  redirect('admin/escolas') ?>
        </div>

        <div class="row">
            <div class="col-md-12"> </div>
        </div>

    </section>
</div>