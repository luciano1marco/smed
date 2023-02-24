<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-azul"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>

                        <?php if($isAdmin) { ?>
                        <li class="header text-uppercase"><?php echo lang('menu_administration'); ?></li>
                        <li class="<?=active_link_controller('users')?>">
                            <a href="<?php echo site_url('admin/users'); ?>">
                                <i class="fa fa-user"></i> <span><?php echo lang('menu_users'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('groups')?>">
                            <a href="<?php echo site_url('admin/groups'); ?>">
                                <i class="fa fa-shield"></i> <span><?php echo lang('menu_security_groups'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('sections')?>">
                            <a href="<?php echo site_url('admin/sections'); ?>">
                                <i class="fa fa-folder"></i> <span>Sessões de Menu</span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('menuitens')?>">
                            <a href="<?php echo site_url('admin/menuitens'); ?>">
                                <i class="fa fa-list"></i> <span>Itens de Menu</span>
                            </a>
                        </li>
                        <li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('menu_preferences'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><i class="fa fa-eye"></i><?php echo lang('menu_interfaces'); ?></a></li>
                            </ul>
                        </li>
                       
                        <?php } ?>

                        <?php foreach ($itensMenu as $title => $section) { ?>
                            <li class="header text-uppercase" style= "color:#fff; font-weight: bold;" ><?php echo $title; ?></li>
                            <?php foreach ($section as $item) { ?>
                                <li class="<?=active_link_controller($item['controller'])?>">
                                    <a href="<?php echo site_url('admin/'.$item['controller']); ?>">
                                        <i class="fa fa-<?= $item['icone'] ?>"></i> <span><?= $item['descricao'] ?></span>
                                    </a>
                                </li>
                        <?php } } ?>
                    </ul>
                </section>
            </aside>
