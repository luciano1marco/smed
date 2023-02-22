<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <div class="login-logo">
                <a href="#"><b><?php echo $title_lg; ?></b></a>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg"><?php echo lang('auth_sign_session'); ?></p>
                <?php echo $message;?>

                <?php echo form_open('auth/login');?>
                    <div class="form-group has-feedback">
                        <?php echo form_input($identity);?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <?php echo form_input($password);?>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <?php $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>'; ?>                                                 
                    <?php $anchor = 'home'?>               
                    <div class="row" >
                        <div class="col-xs-4">
                            <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                        </div>
                        <div class="col-xs-4">
                             <?php echo form_submit('submit', lang('auth_login'), array('class' => 'btn btn-danger btn-block btn-flat'));?>
                        </div>
                    </div>
                <?php echo form_close();?>

<?php if ($auth_social_network == TRUE): ?>
                <div class="social-auth-links text-center">
                    <p>- <?php echo lang('auth_or'); ?> -</p>
                    <?php echo anchor('#', '<i class="fa fa-facebook"></i>' . lang('auth_sign_facebook'), array('class' => 'btn btn-block btn-social btn-facebook btn-flat')); ?>
                    <?php echo anchor('#', '<i class="fa fa-google-plus"></i>' . lang('auth_sign_google'), array('class' => 'btn btn-block btn-social btn-google btn-flat')); ?>
                </div>
<?php endif; ?>
<?php if ($forgot_password == TRUE): ?>
                <?php echo anchor('#', lang('auth_forgot_password')); ?><br />
<?php endif; ?>
<?php if ($new_membership == TRUE): ?>
                <?php echo anchor('#', lang('auth_new_member')); ?><br />
<?php endif; ?>
            </div>
