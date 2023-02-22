<!-- /body -->
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo site_url('home'); ?>"><span class="glyphicon glyphicon-log-in"></span> Concurso Público</a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                   <!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>"><span class="glyphicon glyphicon-log-in"></span> Home</a>   
                    -->
                </li>        
            </ul>
            <!--  para não mostrar o botão de login
            <form class="form-inline my-2 my-lg-0">
                
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
                
                <?php                        
                $admin = '<i class="fas fa-cog"></i> <span>Admin</span>'; 
                $link_admin = base_url('admin/');     
                
                $logout = '<i class="fas fa-sign-out-alt"></i> <span>Logout</span>'; 
                $link_logout = base_url('auth/logout/public/');    
                
                $login = '<i class="fas fa-sign-in-alt"></i> <span>Login</span>'; 
                $link_login = base_url('auth/login/');    
                ?> 
                
                                        
                <?php 
                if ($admin_link): 
                echo anchor($link_admin, $admin, array('class' => 'btn btn-primary mr-2 no-print')); 
                endif;
                
                if ($logout_link):   
                echo anchor($link_logout, $logout, array('class' => 'btn btn-primary mr-2 no-print')); 
                else:
                echo anchor($link_admin, $login, array('class' => 'btn btn-primary mr-2 no-print')); 
                endif; 
                ?>

            </form>
            -->
        </div>
    </nav>