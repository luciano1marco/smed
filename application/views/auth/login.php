<style>
    #logar{
        background-image: url("/smed/public/images/auth/fundo2.png");
        width: 100%;
        height: 100%;
        position: relative;
    }
    #bota{
        margin-left: 200px;
        
    }
    #borda{
        background-color:#98d3de4b;
        align-items: center;
    }
    #bt:hover{
        background-color:#4c3ad9ee;  
    }
    span {
    color: black;
    font-weight: bold;
}
</style>


<div id="logar">
    <div class="content">
        <div class="login-logo">
            <a href="#"><img src="/smed/public/images/brasao.png" width="7%" height="7%"></a>
            <span style:>Secretaria Municipal de Educação</span>
        </div>
        
        <div class="row" ><br>
            <div class="col-lg-12"> 
                <div class="col-md-4"></div>
                    <div class="col-md-4"  id="borda" ><br>
                        <?php echo form_open('auth/login');?>
                        <div class="form-group has-feedback">
                            <h4>Usuário</h4>
                            <?php echo form_input($identity);?>
                        </div>
                        <div class="form-group has-feedback">
                            <h4>Senha</h4>
                            <?php echo form_input($password); ?>
                            
                        </div><br>
                            <!-- botões do login-->
                        <div class="row" id="bota" >
                            <div class="col-xs-4"><br>
                                <?php echo form_submit('submit', 'Entrar', array('class' => 'btn btn-azul btn-block btn-flat', 'id' =>'bt'));?>
                            </div>
                        </div><br><br>
                            <!--- fim botões---->    
                        <?php echo form_close();?>

                    
                        <?php if ($forgot_password == TRUE): ?>
                                        <?php echo anchor('#', lang('auth_forgot_password')); ?><br />
                        <?php endif; ?>
                        <?php if ($new_membership == TRUE): ?>
                                        <?php echo anchor('#', lang('auth_new_member')); ?><br />
                        <?php endif; ?>
                    </div>
            </div>
        </div>
    </div>
</div>   
  
