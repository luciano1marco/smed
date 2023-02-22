<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php $anchor = 'admin/'.$this->router->class; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                <div class="col-sm-6">
                    <?php echo $pagetitle; ?>
                </div>
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard"><i class="fa fa-tachometer-alt"></i> Painel Principal</a></li>
                    <li class="breadcrumb-item">Pessoas</li>
                    <li class="breadcrumb-item active"><?php echo $this->router->fetch_method(); ?></li>				
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Criar Pessoas</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>                
                    </div>

                </div>

                <div class="card-body">

                <!-- Alerta de Validação CODE IGNITER -->                    
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Este formulario contém erros!</h5>              
                        <?php echo validation_errors(); ?>            
                    </div>   
                <?php endif; ?>
            
                <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create')); ?>

                <div class="form-group row">                                           
                    <?php echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label text-right')); ?>       
                    <div class="col-sm-10">
                        <?php echo form_input($nome);?>
                    </div>
                </div>

                <div class="form-group row">                                           
                    <?php echo form_label('Idade', 'idade', array('class' => 'col-sm-2 control-label text-right')); ?>       
                    <div class="col-sm-10">
                        <?php echo form_input($idade);?>
                    </div>
                </div>

                <div class="form-group row">
                    <?php echo form_label('Publicado', 'publicado', array('class' => 'col-sm-2 control-label text-right')); ?>                           
                        <div class="col-sm-10">
                            <?php echo form_checkbox($publicado);?>
                        </div>
                </div>
                            
                <div class="form-group row">
                    <div class="offset-2 col-sm-10">
                        <div class="btn-group">
                            <?php
                            $submit = '<i class="fa fa-check"></i> <span>Enviar</span>';
                            $edit = '<i class="fa fa-edit"></i> <span>Editar</span>';
                            $redo = '<i class="fa fa-redo"></i> <span>Reiniciar</span>';
                            $delete = '<i class="fa fa-trash"></i> <span>Excluir</span>';
                            $cancel = '<i class="fa fa-times"></i> <span>Cancelar</span>';                                                  
                            ?>

                            <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => $submit)); ?>
                            <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => $redo)); ?>                                                   
                            <?php echo anchor($anchor, $cancel, array('class' => 'btn btn-default btn-flat')); ?>
                        
                        </div>
                        </div>
                </div>
                <?php echo form_close();?>
                
                </div>
                <!-- /.card-body -->        
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<script>
$(document).ready(function() {

    // Desliga o Validate para poder usar apenas validação SERVER CI
    //$("#form-create").validate({ ignore: "*" });

    $("#form-create").validate({   
        errorClass: "is-invalid",
        validClass: "is-valid",   
        errorElement: 'p',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },     
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() {
                $(element).addClass(errorClass);
                $(element).fadeIn();                                
            });
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element.form).find("label[for=" + element.id + "]")
            .removeClass(errorClass);
        },
        rules: {
            nome: {
                required: true,
            },
            idade: {
                required: true,
            }     
        },
        messages: {
            nome: 'O campo Nome é obrigatório.',   
            idade:  'O campo Idade é obrigatório.'                 
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
});

</script>